<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Admin;
use App\Models\Template;
use App\Models\QuestionType;
use App\Models\Task;
use App\Models\Company;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\AnswerDetail;
use Carbon\Carbon;

class ExcelController extends Controller
{
    function arabicDate($time)
{
    $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
    $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    $am_pm = ['AM' => 'صباحاً', 'PM' => 'مساءً'];

    $day = $days[date('D', $time)];
    $month = $months[date('M', $time)];
    $am_pm = $am_pm[date('A', $time)];
    $date = $day . ' ' . date('d', $time) . ' - ' . $month . ' - ' . date('Y', $time) . '   ' . date('h:i', $time) . ' ' . $am_pm;
    $numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    $numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace($numbers_en, $numbers_ar, $date);
}
    function exportExcel($id){
        $data = array();
        $answers = Answer::where("template_id",$id)->get();
        $questions = Question::where("template_id",$id)->get();
        $unit_detail = null;$user_detail = null;
        $data["header"] = array();
        array_push($data["header"], "الوحدة");
        array_push($data["header"], "المستخدم");
        array_push($data["header"], "التاريخ");
        //array_push($data["header"],"الهجرى");
        //array_push($data["header"], "التوقيت");
        foreach($questions as $question){
            array_push($data["header"], $question->question);
        }
        $data["answers"] = array();
        foreach($answers as $answer){
            $_data = array();
            $unit = Unit::where('id', $answer->unit_id)->first();
            array_push($_data,$unit->building_number . ' '. $unit->unit_number . ' ' . $unit->permissions);
            $user = Admin::where('id', $answer->user_id)->first();
            array_push($_data, $user->firstname . ' '. $user->lastname);
            array_push($_data, $this->arabicDate(Strtotime($answer->created_at)));
            //array_push($_data, $answer->created_at->format('H:i:s'));
            foreach($questions as $question){
                $answerDetails = AnswerDetail::where('answer_id',$answer->id)->where('question_id', $question->id)->get();
                    
                    if($answerDetails == null){
                       
                        array_push($_data,'');
                    }else{
                        $_answer = '';
                        foreach($answerDetails as $answerDetail){
                            $qType = $answerDetail->question->type_id;
                            if($qType == 1||$qType == 2){
                                $qAnswers = QuestionAnswer::where("id",$answerDetail->answer)->first()->answer;
                                $_answer .= $qAnswers . ', ';
                            }else{
                                   $_answer = $answerDetail->answer . ', ';
                            }
                        }
                        array_push($_data,(substr_replace(trim($_answer), "", -1)));
                // $_data['
                        // print_r(substr_replace(($_answer), "", -1));
                        
                    }

                }
                // $unit = Unit::where('id', $answer->unit_id)->first();
                // $_data['unit'] = $unit_detail = $unit->building_number . ' '. $unit->unit_number . ' ' . $unit->permissions;
                // $user = Admin::where('id', $answer->user_id)->first();
                // $_data['user'] = $user_detail = $user->firstname . ' '. $user->lastname;
                array_push($data['answers'],$_data);
        }
        // return $data;
        return view('travelTemplate',[
            "data"=>$data
        ]);
    }
    function exportExceml($id){
        $data = array();
        $answers = Answer::where("template_id",$id)->get();
        $questions = Question::where("template_id",$id)->get();
        $unit_detail = null;$user_detail = null;
        $data["header"] = array();
        array_push($data["header"], "الوحدة");
        array_push($data["header"], "المستخدم");
        array_push($data["header"], "التاريخ الميلادي");
        array_push($data["header"], "التاريخ الهجري");
        foreach($questions as $question){
            array_push($data["header"], $question->question);
        }
        $data["answers"] = array();
        foreach($answers as $answer){
            $_data = array();
            $unit = Unit::where('id', $answer->unit_id)->first();
            $date = $answer->created_at->format('d-m-Y');
            $hijri = Hijri::ShortDate($date);
            // Hijri::Date('l ، j F ، Y', $date);
            array_push($_data,$unit->building_number . ' '. $unit->unit_number . ' ' . $unit->permissions);
            $user = Admin::where('id', $answer->user_id)->first();
            array_push($_data, $user->firstname . ' '. $user->lastname);
            array_push($_data, $answer->created_at->format('d-m-Y'));
            array_push($_data, $hijri);
            foreach($questions as $question){
                $answerDetails = AnswerDetail::where('answer_id',$answer->id)->where('question_id', $question->id)->get();

                    if($answerDetails == null){

                        array_push($_data,'');
                    }else{
                        $_answer = '';
                        foreach($answerDetails as $answerDetail){
                            $qType = $answerDetail->question->type_id;
                            if($qType == 1||$qType == 2){
                                $qAnswers = QuestionAnswer::where("id",$answerDetail->answer)->first()->answer;
                                $_answer .= $qAnswers . ', ';
                            }else{
                                   $_answer = $answerDetail->answer . ', ';
                            }
                        }
                        array_push($_data,(substr_replace(trim($_answer), "", -1)));
                // $_data['
                        // print_r(substr_replace(($_answer), "", -1));

                    }

                }
                // $unit = Unit::where('id', $answer->unit_id)->first();
                // $_data['unit'] = $unit_detail = $unit->building_number . ' '. $unit->unit_number . ' ' . $unit->permissions;
                // $user = Admin::where('id', $answer->user_id)->first();
                // $_data['user'] = $user_detail = $user->firstname . ' '. $user->lastname;
                array_push($data['answers'],$_data);
        }
        // return $data;
        return view('travelTemplate',[
            "data"=>$data
        ]);
    }
    function importExcel(){
        $ansDetail = array();
        $collection = fastexcel()->import('answerDetails.xlsx');$count = 0;
        foreach ($collection as $data) {
            if(empty($data['AnswerDetailId']) && !empty($data['Answer'])){
                printf($count++);
                // array_push($ansDetail,$data);
                $answer = str($data['Answer']);
                $qId = $data['questionId'];
                $ansId =$data['Answer Id'];
                $str = 'Insert into answer_details (answer, question_id, answer_id) Values (' .  ($answer) . ',  ' . str($qId) . ', '. str($ansId) . ');';
            }
        }
        return $str;
        // return response()->json("answer details has been added");
        // return response()->json($ansDetail);

    }

    function UsersPerformance($category){
        $data =  array();
        $data["header"] = array();
            array_push($data["header"], "المستخدم");
        $templates=Template::where('category', $category)->get();
        foreach($templates as $template){
            array_push($data["header"], $template->template_name);
        }
        array_push($data["header"], "الإجمالي");

        $data["answers"] = array();
        $users = Admin::get();
        foreach ($users as $user) {
            $_data = array();
            array_push($_data, $user->firstname . ' ' . $user->lastname);
            $totalAnswers = 0;
            foreach($templates as $template){
                $AnsCount = Answer::where('template_id', $template->id)->where('user_id', $user->id)->get()->count();
                array_push($_data, $AnsCount);
                $totalAnswers += $AnsCount;
            }
            array_push($_data,$totalAnswers);
            if($totalAnswers > 0){
                array_push($data['answers'],$_data);
            }
        }
            return $data;

    }

    function userReportsAnswers($category)
    {
        return response()->json($this->UsersPerformance($category));
    }

    function exportUserReportsAnswer($category)
    {
        $data =  array();
        $data = $this->UsersPerformance($category);
        return view('travelTemplate',[
            "data"=>$data
        ]);
    }
    

}
