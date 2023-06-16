<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\AnswerDetail;

class ExcelController extends Controller
{
    function expoertExcel(){
        return fastexcel()->export('file.xlsx');
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

}
