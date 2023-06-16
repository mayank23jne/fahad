<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Template;
use App\Models\Answer;
use App\Models\Task;
use App\Models\Unit;
use App\Models\AnswerDetail;
use App\Models\QuestionAnswer;
use App\Models\UnitType;
use App\Models\Admin;
use App\Models\QuestionType;
use App\Http\Controllers\AnswerController;
use PDF;
class PrintController extends Controller
{
    function show($answer_id)
    {
        $ansController = new AnswerController;
        $answer = Answer::find($answer_id);
        $unit = Unit::where('id', $answer->unit_id)->first();
        $user = $answer->user->firstname . ' ' . $answer->user->lastname;
        $formName =  Template::find($answer->template_id);
        $ansDetail = AnswerDetail::where('answer_id', $answer->id)->get();
        $multi_answer = "";
        $day ="";
        $qq = array();
        $_data['data'] = array();
      
        foreach ($ansDetail as $a) {
            if (!in_array($a->question, $qq))
                array_push($qq, $a->question);
        }
        foreach ($qq as $question) {
            $_answer = '';
            $notes = '';
            $image = '';
            if ($question->type->multi_answer != 0) {

                $unit = Unit::where('id', $answer->unit_id)->first();
                $unitType = UnitType::find($unit->unitType_id);
                $ans["unit"] = $unit->building_number . ' - ' . $unit->unit_number . ' - ' . $unitType->type . ' - ' . $unit->nationality;
                $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                $ans["question"] = $question->question;
                foreach ($ansDetail->where('question_id', $question->id) as $detail) {
                    $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                    if (!empty($detail->notes) || $detail->notes != null)
                        $notes .= $detail->notes;
                    if (!empty($detail->image) || $detail->image != null)
                        $image .= $detail->image;
                    $ansController->getTasks($detail, $ans);
                }
                $ans["answer"] = substr_replace(trim($_answer), "", -1);
                $ans["notes"] = $notes;
                array_push($_data['data'], $ans);
            } else {
                $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                $ans["question"] = $question->question;
                $detail = $ansDetail->where('question_id', $question->id)->first();
                $ans["answer"] = $detail->answer;
                $ans["notes"] = $detail->notes;
                $ansController->getTasks($detail, $ans);
                array_push($_data['data'], $ans);
            }
        }
       
       
        if($unit->created_at->format('D') == 'Sun'){
            $day="الأحد";
        }else if($unit->created_at->format('D') == 'Mon'){
            $day="الاثنين";
        }else if($unit->created_at->format('D') == 'Tue'){
            $day="الثلاثاء";
        }else if($unit->created_at->format('D') == 'Wed'){
            $day="الأربعاء";
        }else if($unit->created_at->format('D') == 'Thu'){
            $day="الخميس";
        }else if($unit->created_at->format('D') == 'Fri'){
            $day="الجمعة";
        } else if($unit->created_at->format('D') == 'Sat'){
            $day="السبت";
        }
       
        return view('pdf',[
            'unit'=>$unit,
            'user'=>$user,
            'formName' =>$formName->template_name,
            'data'=>$_data['data'],
            'day'=>$day,
        ]);
    }

}
