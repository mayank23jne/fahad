<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Admin;
use App\Models\Unit;
use App\Models\Template;
use App\Models\QuestionType;
use App\Models\Task;
use App\Models\Company;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\AnswerDetail;
use Carbon\Carbon;

class ReportController extends Controller
{
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

    function gethrReports()
    {
        $data = array();
        $day = date('d') - 7;
        $_data["Name"] = "معدل الإجابات أخر 7 أيام";
        $_data['Days'] = array();
        $_data['Values'] = array();
        for ($i = 0; $i < 7; $i++) {
            $dayName = date('D', strtotime(date('Y-m-' . $day)));
            array_push($_data['Days'], $dayName);
            $answers = Answer::where('created_at', '>=', date('Y-m-' . $day))->where('created_at', '<=', date('Y-m-' . ++$day))->get();
            array_push($_data['Values'], count($answers));
        }
        $_data["minValue"] = min($_data["Values"]);
        $_data["max_Value"] = max($_data["Values"]);
        $_data["step"] = ($_data["minValue"] + $_data["max_Value"]) / 5;
        array_push($data, $_data);
        return response()->json($_data);
    }

    function getwhReports()
    {
        $data = array();
        $day = date('d') - 7;
        $_data["Name"] = "معدل الإجابات أخر 7 أيام";
        $_data['Days'] = array();
        $_data['Values'] = array();
        for ($i = 0; $i < 7; $i++) {
            $dayName = date('D', strtotime(date('Y-m-' . $day)));
            array_push($_data['Days'], $dayName);
            $answers = Answer::where('created_at', '>=', date('Y-m-' . $day))->where('created_at', '<=', date('Y-m-' . ++$day))->get();
            array_push($_data['Values'], count($answers));
        }
        $_data["minValue"] = min($_data["Values"]);
        $_data["max_Value"] = max($_data["Values"]);
        $_data["step"] = ($_data["minValue"] + $_data["max_Value"]) / 5;
        array_push($data, $_data);
        return response()->json($_data);
    }
    function getReports()
    {
        $data = array();
        $day = date('d') - 7;
        $_data["Name"] = "معدل الإجابات أخر 7 أيام";
        $_data['Days'] = array();
        $_data['Values'] = array();
        for ($i = 0; $i < 7; $i++) {
            $dayName = date('D', strtotime(date('Y-m-' . $day)));
            array_push($_data['Days'], $dayName);
            $answers = Answer::where('created_at', '>=', date('Y-m-' . $day))->where('created_at', '<=', date('Y-m-' . ++$day))->get();
            array_push($_data['Values'], count($answers));
        }
        $_data["minValue"] = min($_data["Values"]);
        $_data["max_Value"] = max($_data["Values"]);
        $_data["step"] = ($_data["minValue"] + $_data["max_Value"]) / 5;
        array_push($data, $_data);
        return response()->json($_data);
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

    function userReportsWheres()
    {
        $_data['users'] = array();
        $_data['Values'] = array();
        $form =  Template::where('category','اماكن')->pluck('id');
            $answers = Answer::whereIn('template_id',$form)->select('user_id')
                ->selectRaw('COUNT(*) AS count')
                ->groupBy('user_id')
                ->get();
            foreach ($answers as $answer) {
                $user = Admin::where('id', $answer->user_id)->first();
                array_push($_data['users'], $user->firstname . ' ' . $user->lastname);
                array_push($_data['Values'], $answer->count);
            }

            $_data["Name"] = "اجمالى مساهمات المستخدمين";
            $_data["minValue"] = min($_data["Values"]);
            $_data["max_Value"] = max($_data["Values"]);
            $_data["step"] = ($_data["minValue"] + $_data["max_Value"]) / 5;
            return response()->json($_data);
    }

    function userReportsHr()
    {
        $_data['users'] = array();
        $_data['Values'] = array();
        $form =  Template::where('category','موارد بشرية')->pluck('id');
            $answers = Answer::whereIn('template_id',$form)->select('user_id')
                ->selectRaw('COUNT(*) AS count')
                ->groupBy('user_id')
                ->get();
            foreach ($answers as $answer) {
                $user = Admin::where('id', $answer->user_id)->first();
                array_push($_data['users'], $user->firstname . ' ' . $user->lastname);
                array_push($_data['Values'], $answer->count);
            }
            $_data["Name"] = "اجمالى مساهمات المستخدمين";
            $_data["minValue"] = min($_data["Values"]);
            $_data["max_Value"] = max($_data["Values"]);
            $_data["step"] = ($_data["minValue"] + $_data["max_Value"]) / 5;
            return response()->json($_data);
    }

    function formWhereAnswerCount()
    {
        $_data['template'] = array();
        $_data['answers_count'] = array();
        $forms =  Template::where('category','اماكن')->get();
        foreach($forms as $form){
            $answers = Answer::where('template_id',$form->id)
                ->get();
            array_push($_data['template'], $form->template_name);
            array_push($_data['answers_count'], count($answers));


        }
              $_data['Name']="اجمالى اجابات التقييمات";
        return response()->json($_data);
    }

    function formHrAnswerCount()
    {
        $_data['template'] = array();
        $_data['answers_count'] = array();
        $forms =  Template::where('category','موارد بشرية')->get();
        foreach($forms as $form){
            $answers = Answer::where('template_id',$form->id)
                ->get();
            array_push($_data['template'], $form->template_name);
            array_push($_data['answers_count'], count($answers));
        }
        $_data['Name']="اجمالى اجابات التقييمات";
        return response()->json($_data);
    }


    function answerCount(){
        $forms = Template::get();
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
        $templates = Template::all();
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

    function formWheres()
    {
            $data = array();
        $templates = Template::where('category','اماكن')->get();
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

    function formHr()
    {
        $data = array();
        $templates = Template::where('category','موارد بشرية')->get();
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

}
