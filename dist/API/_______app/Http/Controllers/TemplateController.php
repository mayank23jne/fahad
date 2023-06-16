<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\AnswerDetail;
use App\Models\Template;

class TemplateController extends Controller
{
    function formDetails($id){
        $form = Template::find($id);
        $answers =  $form->answer;
        $data =  array();
        foreach($answers as $answer){
            $_data['answer'] =  $answer->only('id','created_at');
            $_data['answer_detail'] =  $answer->ansDetail->each(function($answer){
                $answer->only('id','answer','created_at');
            });
            $_data['user'] = $answer->user_id;
            $unit = $answer->units;
            $_data['unit'] = $unit->only('unit_number','nationality',"building_number",'permissions','pilgrims');
            $_data['unit_type'] = $unit->unitType->type;
            $_data['unit_company'] = $unit->company_;
            $_data['unit_user'] = $answer->units->only('firstname','lastname');
            array_push($data,$_data);
        }
        return response()->json($data);
    }
}
