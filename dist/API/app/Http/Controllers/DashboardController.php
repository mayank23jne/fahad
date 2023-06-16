<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Template;
use App\Models\Task;
use App\Models\Unit;
use App\Models\Admin;
use App\Models\Question;
use App\Models\Company;
use App\Models\QuestionAnswer;
use App\Models\QuestionType;
use App\Models\AnswerDetail;

class DashboardController extends Controller
{
    function showDashboard()
    {
        $data = array();
        // $answers = Answer::where('created_at', '<', 'CURRENT_DATE + INTERVAL 1 DAY')->get();
        
        // $templates = Template::where('category', 'موارد بشرية')->pluck('id');
        $templates = Template::where('inspectiontype', '2')->where('is_deleted', '0')->pluck('id');
        // $templateswh = Template::where('category', 'اماكن')->pluck('id');
        $templateswh = Template::where('inspectiontype', '5')->where('is_deleted', '0')->pluck('id');
        $answers = Answer::whereIn('template_id', $templates)->get();
        $answerswh = Answer::whereIn('template_id', $templateswh)->get();
        $conutOfAnswers = Count($answers);
        $conutOfAnswerswh = Count($answerswh);

        $tasks = Task::get();
        $conutOfTasks = count($tasks);
        $completedTasks = Task::where("status_id", 1)->get();
        $conutOfCompletedTasks = count($completedTasks);
        $pendingTasks = Task::where("status_id", 2)->get();
        $conutOfPendingTasks = count($pendingTasks);
        $NotDoneTasks = Task::where("status_id", 3)->get();
        $conutOfNotDoneTasks = count($NotDoneTasks);

        // $templatesHr = Template::where('category', 'موارد بشرية')->pluck('id');
         $templatesHr = Template::where('inspectiontype', '2')->where('is_deleted', '0')->pluck('id');
        $answersHr = Answer::whereIn('template_id', $templatesHr)->pluck('id');
        $answerDetailsHr = AnswerDetail::whereIn('answer_id', $answersHr)->pluck('id');
        $Hrtasks = Task::whereIn('answer_detail_id', $answerDetailsHr)->get();

        $Hrtasks = count($Hrtasks);
        $HrtasksCompleted = Task::whereIn('answer_detail_id', $answerDetailsHr)->where("status_id", 1)->get()->count();
        $HrconutOfPendingTasks = Task::whereIn('answer_detail_id', $answerDetailsHr)->where("status_id", 2)->get()->count();
        $HrconutOfNotDoneTasks = Task::whereIn('answer_detail_id', $answerDetailsHr)->where("status_id", 3)->get()->count();

        $ans["answershr"] = $conutOfAnswers;
        $ans["Answerswh"] = $conutOfAnswerswh;
        $ans["Hrtasks"] = $Hrtasks;
        $ans["HrtasksCompleted"] = $HrtasksCompleted;
        $ans["HrconutOfPendingTasks"] = $HrconutOfPendingTasks;
        $ans["HrconutOfNotDoneTasks"] = $HrconutOfNotDoneTasks;

        $ans["emtasks"] = $conutOfTasks - $Hrtasks;
        $ans["emcompletedTasks"] = $conutOfCompletedTasks - $HrtasksCompleted;
        $ans["emconutOfPendingTasks"] = $conutOfPendingTasks - $HrconutOfPendingTasks;
        $ans["emconutOfNotDoneTasks"] = $conutOfNotDoneTasks - $HrconutOfNotDoneTasks;

        array_push($data, $ans);
        return $data;
    }


    function hrReport()
    {
        $data = array();
        $travels = Answer::where('template_id', 9)->get();
        $travelsCount = Count($travels);

        $Units = $travels->pluck('unit_id');
        $arrUnits = json_decode(json_encode($Units), true);
        $pilCount = Unit::whereIn('id', array_unique($arrUnits))->sum('pilgrims');

        $workers = AnswerDetail::where('question_id', 349)->sum('answer');
        $time_avg = 2.7;
        $workerAvg = round($workers/$travelsCount,2);


        $ans["travelsCount"] = $travelsCount;
        $ans["pilCount"] = $pilCount;
        $ans["workers"] = $workers;
        $ans["time_avg"] = $time_avg;
        $ans["workerAvg"] = $workerAvg;

        array_push($data, $ans);
        return $data;
    }

    function workerChart(){

    }


    function userReports()
    {
        $data = array();
        $day = date('d') - 7;
        $_data['users'] = array();
        $_data['Values'] = array();
        //for($i = 0; $i<=6; $i++){
        $dayName = date('D', strtotime(date('Y-m-' . $day)));


        $day = date('d');
        $answers = Answer::where('created_at', '<=', date('Y-m-' . ++$day))->where('created_at', '>=', date('Y-m-' . ($day - 7)))->select('user_id')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('user_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        foreach ($answers as $answer) {
            $user = Admin::where('id', $answer->user_id)->first();
            array_push($_data['users'], $user->firstname . ' ' . $user->lastname);
            array_push($_data['Values'], $answer->count);
        }

        $_data["Name"] = "أكثر المستخدمين نشاطاً أخر 7 أيام";
        $_data["minValue"] = min($_data["Values"]);
        $_data["max_Value"] = max($_data["Values"]);
        $_data["step"] = ($_data["minValue"] + $_data["max_Value"]) / 5;
        return response()->json($_data);
    }


    function unitChart()
    {

        $Units = Unit::all();
        $data = array();
        $answers = Answer::all();
        foreach ($answers as $ans) {
            $template = Template::find($ans->template_id);
            $unit_id = $ans->unit_id;
            $unit = Unit::find($unit_id);
            $unit_number = $unit->unit_number;
            $numberofQuestions = 0;
            $count_Yes = 0;
            $count_No = 0;
            $ansDetails = AnswerDetail::where("answer_id", $ans->id)->get();
            $numberofQuestions = count($ansDetails);
            foreach ($ansDetails as $detail) {
                $detail_answer = $detail->answer;
                $question_id = $detail->question_id;
                $questions = Question::where("id", $question_id)->first();
                $type = QuestionType::where("id", $questions->type_id)->where("multi_answer", 1)->first();
                // print_r($questions->type_id);
                if ($type != null) {
                    $qanswersid = QuestionAnswer::where("question_id", $question_id)->first()->id;
                    if ($qanswersid == $detail_answer) {
                        $count_Yes++;
                    } else {
                        $tasks = Task::where('answer_detail_id', $detail->id)->first();
                        if ($tasks != null) {
                            if ($tasks->status_id == 1 && $tasks->confirm == true) {
                                $count_Yes++;
                            } else {
                                $count_No++;
                            }
                        } else {
                            $qAnswers = QuestionAnswer::where("question_id", $question_id)->get();
                            $cQAnswer = count($qAnswers);
                            if ($cQAnswer > 2) {
                                $ind = $cQAnswer;
                                foreach ($qAnswers as $qAns) {
                                    if ($qAns->id == $detail_answer) {
                                        $count_No += ($cQAnswer - $ind) / $cQAnswer;
                                        $count_Yes += (1 - ($cQAnswer - $ind) / $cQAnswer);

                                        break;
                                    }
                                    $ind--;
                                }
                            } else {
                                $count_No++;
                            }
                        }
                    }
                } else {
                    $numberofQuestions--;
                }
            }
            if ($numberofQuestions != 0) {
                $units["Name"] = $unit->building_number . ' ' . $unit_number . ' ' . $unit->nationality;
                $units["data"] = ["مكتمل", 'غير مكتمل'];
                $units["Values"] = array();
                array_push($units["Values"], round($count_Yes / $numberofQuestions * 100, 2));
                array_push($units["Values"], round($count_No / $numberofQuestions * 100, 2));
                array_push($data, $units);
            }
        }
        return response()->json($data);
    }

    function CompanyChart()
    {
        $data = array();
        $companies = Company::all();
        foreach ($companies as $company) {
            $cunits = Unit::where('company', $company->id)->get();
            $yesCount = 0;
            $noCount = 0;
            $unitsCount = 0;
            foreach ($cunits as $unit) {
                $answers = Answer::where('unit_id', $unit->id)->get();
                // return $answers;
                foreach ($answers as $ans) {
                    // $template = Template::where('id', $ans->template_id)->where('category', 'موارد بشرية')->get();
                     $template = Template::where('id', $ans->template_id)->where('inspectiontype','2')->where('is_deleted','0')->get();
                    $unit_id = $ans->unit_id;
                    $unit = Unit::find($unit_id);
                    $unit_number = $unit->unit_number;
                    $numberofQuestions = 0;
                    $count_Yes = 0;
                    $count_No = 0;
                    $ansDetails = AnswerDetail::where("answer_id", $ans->id)->get();
                    $numberofQuestions = count($ansDetails);
                    // return $numberofQuestions;
                    foreach ($ansDetails as $detail) {
                        $detail_answer = $detail->answer;
                        $question_id = $detail->question_id;
                        $questions = Question::where("id", $question_id)->first();
                        $type = QuestionType::where("id", $questions->type_id)->where("multi_answer", 1)->first();
                        // return $type;
                        // print_r($questions->type_id);
                        if ($type != null) {
                            $qanswersid = QuestionAnswer::where("question_id", $question_id)->first()->id;
                            if ($qanswersid == $detail_answer) {
                                $count_Yes++;
                                // echo $count_Yes;
                            } else {
                                $tasks = Task::where('answer_detail_id', $detail->id)->first();
                                if ($tasks != null) {
                                    if ($tasks->status_id == 1 && $tasks->confirm == true) {
                                        $count_Yes++;
                                    } else {
                                        $count_No++;
                                    }
                                } else {
                                    $qAnswers = QuestionAnswer::where("question_id", $question_id)->get();
                                    $cQAnswer = count($qAnswers);
                                    if ($cQAnswer > 2) {
                                        $ind = $cQAnswer;
                                        foreach ($qAnswers as $qAns) {
                                            if ($qAns->id == $detail_answer) {
                                                $count_No += ($cQAnswer - $ind) / $cQAnswer;
                                                $count_Yes += (1 - ($cQAnswer - $ind) / $cQAnswer);
                                                break;
                                            }
                                            $ind--;
                                        }
                                    } else {
                                        $count_No++;
                                    }
                                }
                            }
                        } else {
                            $numberofQuestions--;
                        }
                    }
                    if ($numberofQuestions != 0) {
                        $yesCount += $count_Yes / $numberofQuestions * 100;
                        $noCount += $count_No / $numberofQuestions * 100;
                        $unitsCount++;
                    }
                }


            }
            if ($unitsCount != 0) {
                $units["company_id"] = $company->id;
                $units["Name"] = $company->company_name . ' - عدد الوحدات ' . $cunits;
                $units["data"] = ["مكتمل", 'غير مكتمل'];
                $units["Values"] = array();
                $yes = round(($yesCount / $unitsCount),2);
                $no = round(($noCount / $unitsCount),2);
                array_push($units["Values"], $yes);
                array_push($units["Values"], $no);
                array_push($data, $units);
            }
        }
        return response()->json($data);
    }

    function CompanyWheres()
    {

        $Units = Unit::all();
        $data = array();
        // $template = Template::where('category','اماكن')->get();
         $template = Template::where('inspectiontype','5')->where('is_deleted','0')->get();
        foreach ($template as $form)
        {
            $answers = Answer::where('template_id',$form->id)->get();
            foreach ($answers as $ans) {
                $unit_id = $ans->unit_id;
                $unit = Unit::find($unit_id);
                $unit_number = $unit->unit_number;
                $numberofQuestions = 0;
                $count_Yes = 0;
                $count_No = 0;
                $ansDetails = AnswerDetail::where("answer_id", $ans->id)->get();
                $numberofQuestions = count($ansDetails);
                foreach ($ansDetails as $detail) {
                    $detail_answer = $detail->answer;
                    $question_id = $detail->question_id;
                    $questions = Question::where("id", $question_id)->first();
                    $type = QuestionType::where("id", $questions->type_id)->where("multi_answer", 1)->first();
                    // print_r($questions->type_id);
                    if ($type != null) {
                        $qanswersid = QuestionAnswer::where("question_id", $question_id)->first()->id;
                        if ($qanswersid == $detail_answer) {
                            $count_Yes++;
                        } else {
                            $tasks = Task::where('answer_detail_id', $detail->id)->first();
                            if ($tasks != null) {
                                if ($tasks->status_id == 1 && $tasks->confirm == true) {
                                    $count_Yes++;
                                } else {
                                    $count_No++;
                                }
                            } else {
                                $qAnswers = QuestionAnswer::where("question_id", $question_id)->get();
                                $cQAnswer = count($qAnswers);
                                if ($cQAnswer > 2) {
                                    $ind = $cQAnswer;
                                    foreach ($qAnswers as $qAns) {
                                        if ($qAns->id == $detail_answer) {
                                            $count_No += ($cQAnswer - $ind) / $cQAnswer;
                                            $count_Yes += (1 - ($cQAnswer - $ind) / $cQAnswer);

                                            break;
                                        }
                                        $ind--;
                                    }
                                } else {
                                    $count_No++;
                                }
                            }
                        }
                    } else {
                        $numberofQuestions--;
                    }
                }
                if ($numberofQuestions != 0) {
                    $units["form"] = $form->template_name;
                    $units["Name"] = $unit->building_number . ' ' . $unit_number . ' ' . $unit->nationality;
                    $units["data"] = ["مكتمل", 'غير مكتمل'];
                    $units["Values"] = array();
                    array_push($units["Values"], round($count_Yes / $numberofQuestions * 100, 2));
                    array_push($units["Values"], round($count_No / $numberofQuestions * 100, 2));
                    array_push($data, $units);
                }
            }
        }
        return response()->json($data);
    }

    function CompanyDevelopment()
    {
        $Units = Unit::all();
        $data = array();
        // $template = Template::where('category','موارد بشرية')->get();
          $template = Template::where('inspectiontype','2')->where('is_deleted','0')->get();
        foreach ($template as $form)
        {
            $answers = Answer::where('template_id',$form->id)->get();
            foreach ($answers as $ans) {
                $unit_id = $ans->unit_id;
                $unit = Unit::find($unit_id);
                $unit_number = $unit->unit_number;
                $numberofQuestions = 0;
                $count_Yes = 0;
                $count_No = 0;
                $ansDetails = AnswerDetail::where("answer_id", $ans->id)->get();
                $numberofQuestions = count($ansDetails);
                foreach ($ansDetails as $detail) {
                    $detail_answer = $detail->answer;
                    $question_id = $detail->question_id;
                    $questions = Question::where("id", $question_id)->first();
                    $type = QuestionType::where("id", $questions->type_id)->where("multi_answer", 1)->first();
                    // print_r($questions->type_id);
                    if ($type != null) {
                        $qanswersid = QuestionAnswer::where("question_id", $question_id)->first()->id;
                        if ($qanswersid == $detail_answer) {
                            $count_Yes++;
                        } else {
                            $tasks = Task::where('answer_detail_id', $detail->id)->first();
                            if ($tasks != null) {
                                if ($tasks->status_id == 1 && $tasks->confirm == true) {
                                    $count_Yes++;
                                } else {
                                    $count_No++;
                                }
                            } else {
                                $qAnswers = QuestionAnswer::where("question_id", $question_id)->get();
                                $cQAnswer = count($qAnswers);
                                if ($cQAnswer > 2) {
                                    $ind = $cQAnswer;
                                    foreach ($qAnswers as $qAns) {
                                        if ($qAns->id == $detail_answer) {
                                            $count_No += ($cQAnswer - $ind) / $cQAnswer;
                                            $count_Yes += (1 - ($cQAnswer - $ind) / $cQAnswer);

                                            break;
                                        }
                                        $ind--;
                                    }
                                } else {
                                    $count_No++;
                                }
                            }
                        }
                    } else {
                        $numberofQuestions--;
                    }
                }
                if ($numberofQuestions != 0) {
                    $company = '';
                    if($unit->company_id != null){
                        $company =Company::where('id', $unit->company_id)->first();
                        $comapny = 'المتعهد' . $company->company_name;
                    }
                    $units["form"] = $form->template_name;
                    $units["Name"] = $form->template_name . ' - وحدة ' . $unit->building_number . ' ' . $unit_number
                        . ' ' . $unit->nationality . ' ' . $company;
                    $units["data"] = ["مكتمل", 'غير مكتمل'];
                    $units["Values"] = array();
                    array_push($units["Values"], round($count_Yes / $numberofQuestions * 100, 2));
                    array_push($units["Values"], round($count_No / $numberofQuestions * 100, 2));
                    array_push($data, $units);
                }
            }
        }
        return response()->json($data);
    }

    function answerCount(){
        // $forms = Template::get();
          $forms = Template::where('is_deleted', '0')->get();
        $data = array();
        foreach ($forms as $form) {
            $questions = Question::where('template_id',$form->id)->get();
            foreach ($questions as $question) {
                $answers = AnswerDetail::where('question_id',$question->id)->get();
                $_data['form_name'] = $form->template_name;
                $_data['questions'] = array();
                array_push($_data['questions'] , $question->question);
                $_data['answers'] = array();
                foreach ($answers as $answer) {
                    array_push($_data['answers'] , $answer->answer);
                }
                $_data['count_answers'] = count($answers);
                array_push($data,$_data);
            }
        }
        // $answerDetail = AnswerDetail::get();
        return response()->json($data);
    }

    function forms()
    {
        $data = array();
        // $templates = Template::all();
          $templates =Template::where('is_deleted', '0')->get();
        foreach ($templates as $template) {

            $yesCount = 0;
            $noCount = 0;
            $answerCount = 0;

            // $answerCount = Answer::where('template_id', $template->id)->count();
            $questions = Question::where('template_id', $template->id)->where('type_id', 1)->get();
            foreach ($questions as $question) {
                $ansDetails = AnswerDetail::where('question_id', $question->id)->get();
                $numberofQuestions = count($ansDetails);

                $count_Yes = 0;
                $count_No = 0;
                foreach ($ansDetails as $detail) {
                    $detail_answer = $detail->answer;
                    $question_id = $detail->question_id;


                        $qanswersid = QuestionAnswer::where("question_id", $question_id)->first()->id;
                        if ($qanswersid == $detail_answer) {
                            $count_Yes++;
                        } else {
                            $tasks = Task::where('answer_detail_id', $detail->id)->first();
                            if ($tasks != null) {
                                if ($tasks->status_id == 1 && $tasks->confirm == 1) {
                                    $count_Yes++;
                                } else {
                                    $count_No++;
                                }
                            } else {
                                $qAnswers = QuestionAnswer::where("question_id", $question_id)->get();
                                $cQAnswer = count($qAnswers);
                                if ($cQAnswer > 2) {
                                    $ind = $cQAnswer;
                                    foreach ($qAnswers as $qAns) {
                                        if ($qAns->id == $detail_answer) {
                                            $count_No += ($cQAnswer - $ind) / $cQAnswer;
                                            $count_Yes += (1 - ($cQAnswer - $ind) / $cQAnswer);
                                            break;
                                        }
                                        $ind--;
                                    }
                                } else {
                                    $count_No++;
                                }
                            }
                        }

                }

            if ($numberofQuestions > 0) {
                $yesCount += $count_Yes / $numberofQuestions * 100;
                $noCount += $count_No / $numberofQuestions * 100;
                $answerCount++;
            }
        }

            if ($answerCount != 0) {
                $forms["form_id"] = $template->id;
                $forms["form_Name"] = $template->template_name . ' - عدد الاجابات ' . $answerCount;
                $forms["data"] = ["مكتمل", 'غير مكتمل'];
                $forms["Values"] = array();
                $yes = round(($yesCount/$answerCount),2);
                $no = round(($noCount/$answerCount),2);
                array_push($forms["Values"], $yes);
                array_push($forms["Values"], $no);
                array_push($data, $forms);
            }
        }
        return response()->json($data);
    }

    function nationality(){
        $data = array();
        $data["data"]= array();
        $data["Values"]= array();
        $units = Unit::select('nationality')->groupBy('nationality')->get();
        
        $unitTotalcount = Unit::sum('pilgrims');
        foreach($units as $unit){
            $unitcount = Unit::where('nationality', $unit->nationality)->sum('pilgrims');
            array_push($data["data"], $unit->nationality);
            array_push($data["Values"], round(($unitcount/$unitTotalcount)*100, 2));
        }
        $data["Name"] = "جنسيات الحجاج";
        // $data["minValue"] = min($data["count"]);
        // $data["max_Value"] = max($data["count"]);
        // $data["step"] = ($data["minValue"] + $data["max_Value"]) / 5;
        return $data;
    }

    function WorkersChart(){
        $data = array();
        $data["data"] = array();
        $data["Value"] = array();
        $data["name"] = "عدد العمالة";
        $data["data"] = ['[0,3]', '[3,6]', '[6,9]', '[9,12]', '[12,15]', '[15,18]', '[18,21]', '[21,24]'];
        $data["Value"]=[2,6,100,50,12,0,67,65];
        return $data;
    }
}
