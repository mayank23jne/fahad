<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Unit;
use App\Models\Template;
use App\Models\QuestionType;
use App\Models\Task;
use App\Models\Company;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\AnswerDetail;
use App\Models\companyRatio;

class ChartController extends Controller
{
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
        // $data = array();
        // $comRatios = companyRatio::get();
        // foreach($comRatios as $ratio){
        //         $units["company_id"] = $ratio->company_id;
        //         $units["Name"] = $ratio->company_name;
        //         $units["data"] = ["مكتمل", 'غير مكتمل'];
        //         $units["Values"] = array();
        //         array_push($units["Values"], $ratio->complete);
        //         array_push($units["Values"], $ratio->noncomplete);
        //         array_push($data, $units);
            
        // }
        // return response()->json($data);
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
                     $template = Template::where('id', $ans->template_id)->where('inspectiontype', '2')->get();
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
                $units["Name"] = $company->company_name;
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

    function saveCompanyChartInDB(){
        companyRatio::where('id', '>', 0)->delete();
        $data = array();
        $companies = Company::all();
        foreach ($companies as $company) {
            $cunits = Unit::where('company', $company->id)->get();
            $yesCount = 0;
            $noCount = 0;
            $unitsCount = 0;
            if($company->id == 6){
                $answers = Answer::where('template_id', 19)->get();
                // return $answers;
                foreach ($answers as $ans) {
                    $template = Template::where('id', $ans->template_id)->where('category', 'موارد بشرية')->get();
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
            }else{
                foreach ($cunits as $unit) {
                $answers = Answer::where('unit_id', $unit->id)->get();
                // return $answers;
                foreach ($answers as $ans) {
                    // $template = Template::where('id', $ans->template_id)->where('category', 'موارد بشرية')->get();
                    $template = Template::where('id', $ans->template_id)->where('inspectiontype', '2')->where('is_deleted','0')->get();
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
                }
                    if ($numberofQuestions != 0) {
                        $yesCount += $count_Yes / $numberofQuestions * 100;
                        $noCount += $count_No / $numberofQuestions * 100;
                        $unitsCount++;
                    }
                }


            }
            if ($unitsCount != 0) {
                $cRatio= new companyRatio;
                $cRatio->company_id =$company->id;
                $cRatio->complete =round(($yesCount / $unitsCount),2);
                $cRatio->noncomplete =round(($noCount / $unitsCount),2);
                $cRatio->company_name =$company->company_name . ' - عدد الوحدات ' . $unitsCount;
                $cRatio->save();
            }
        }
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
        // $template = Template::where('category','موارد بشرية')->whereIn('id', Question::where('type_id', 1)->pluck('template_id'))->get();
           $template = Template::where('inspectiontype','2')->where('is_deleted','0')->whereIn('id', Question::where('type_id', 1)->pluck('template_id'))->get();
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

    function nationality(){
        $data = array();
        $data["data"]= array();
        $data["Values"]= array();
        $units = Unit::select('nationality')->groupBy('nationality')->get();
        foreach($units as $unit){
            $unitcount = Unit::where('nationality', $unit->nationality)->sum('pilgrims');
            array_push($data["data"], $unit->nationality);
            array_push($data["Values"], $unitcount);
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

    
    
    function totalemTemplates(){
        // return $this->totalTemplateSuccess('اماكن');
         return $this->totalTemplateSuccess('5');
    }
    
    function totalHrTemplates(){
        // return $this->totalTemplateSuccess('موارد بشرية');
          return $this->totalTemplateSuccess('2');
    }

    function totalTemplateSuccess($category){
        $questions = Question::where('type_id', 1)->pluck('template_id');
        // $templates = Template::where('category',$category)->whereIn('id', $questions)->get();
         $templates = Template::where('inspectiontype',$category)->where('is_deleted',0)->whereIn('id', $questions)->get();
        // echo "templates";
        // echo "<pre>";
        // print_r($templates);
        $numberofQuestions = 0;
        $data = array();
        foreach($templates as $template){
            $answers = Answer::where('template_id', $template->id)->pluck('id');
            $answerIds = AnswerDetail::whereIn('answer_id', $answers)->whereIn('question_id', (Question::where('type_id', 1)->pluck('id')))->get();
            $count_Yes = 0;
            $count_No = 0;
            $numberofQuestions = count($answerIds);
            foreach ($answerIds as $detail){
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
                            }else{
                                $count_No++;
                            }
                        } else {
                            $qAnswers = QuestionAnswer::where("question_id", $question_id)->get();
                            $cQAnswer = count($qAnswers);
                            if($cQAnswer > 2){
                                $ind =$cQAnswer;
                                foreach($qAnswers as $qAns){
                                    if($qAns->id == $detail_answer){
                                        $count_No += ($cQAnswer - $ind)/$cQAnswer;
                                        $count_Yes += (1-($cQAnswer - $ind)/$cQAnswer);

                                        break;
                                    }
                                    $ind--;
                                }
                            }
                            else{
                            $count_No++;
                            }
                        }
                    }
                } else {
                    $numberofQuestions--;
                }
            }
        
            if ($numberofQuestions != 0) {
                $units["template_id"] = $template->id;
                $units["Name"] = $template->description;
                $units["data"] = ["مكتمل", 'غير مكتمل'];
                $units["Values"] = array();
                array_push($units["Values"], round($count_Yes / $numberofQuestions * 100, 2));
                array_push($units["Values"], round($count_No / $numberofQuestions * 100, 2));
                array_push($data, $units);
            }
        }
        return $data;
    }
}
