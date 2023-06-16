<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use App\Models\Template;
use App\Models\Answer;
use App\Models\QuestionAnswer;
use App\Models\QuestionType;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    
    function store(Request $request)
    {
        // $validator = Validator::make($req->all(), [
        //     'FormName'=>'required',
        //     'Description'=>'required',
        // ]);
        // $req->validate([
        //     'FormName'=>'required',
        //     'Description'=>'required',
        // ]);
        //$req = json_decode($req);
        $req = $request;
        
            $form = new Template;
        if(!empty($request->questions)){
        //$req =  $req[0];
        $form = Template::where('id', $req->id)->first();
        $form->user_id = 1;
        $form->template_name  = $req->title .  ' new';
        $form->description  = $req->detail;
        $form->category  = $req['category'];
        $form->save();

        foreach ($req['questions'] as $q) {
            $question = new Question;
            $question->question = $q['question'];
            $question->type_id  = $q['answerType'];
            $question->template_id  = $form->id;
            $question->save();
            $questionType = new QuestionType;
            $questionType = $questionType->find($q['answerType']);
            if ($questionType->multi_answer == 1) {
                foreach ($q['answers'] as $answer) {
                    $answerModel = new QuestionAnswer;
                    $answerModel->question_id = $question->id;
                    $answerModel->answer = $answer['label'];
                    $answerModel->save();
                }
            } else {
                $answerModel = new QuestionAnswer;
                $answerModel->question_id = $question->id;
                $answerModel->answer = 'NULL';
                $answerModel->save();
            }
        }
        }else{$req = $request;
            $form->user_id = 1;
            $form->template_name  = $req->title;
            $form->description  = $req['detail'];
            $form->category  = $req['category'];
            $form->save();
        }
        
return $form->id;
        return response()->json([
            'message' => 'your forms successfully registered',
        ], 201);
    }

    function update(Request $request)
    {
        
        $req = $request;
        Question::where('form_id',  $req->id)->delete();
        $form = Template::where('id', $req->id)->first();
        //$form->user_id = 1;
        //$form->template_name  = $req->title .  ' new';
        //$form->description  = $req->detail;
        //$form->category  = $req['category'];
        //$form->save();
        
        

        foreach ($req['questions'] as $q) {
            $question = new Question;
            $question->question = $q['question'];
            $question->type_id  = $q['answerType'];
            $question->template_id  = $form->id;
            $question->save();
            $questionType = new QuestionType;
            $questionType = $questionType->find($q['answerType']);
            if ($questionType->multi_answer == 1) {
                foreach ($q['answers'] as $answer) {
                    $answerModel = new QuestionAnswer;
                    $answerModel->question_id = $question->id;
                    $answerModel->answer = $answer['label'];
                    $answerModel->save();
                }
            } else {
                $answerModel = new QuestionAnswer;
                $answerModel->question_id = $question->id;
                $answerModel->answer = 'NULL';
                $answerModel->save();
            }
        }
        
        
        return response()->json([
            'message' => 'your forms successfully registered',
        ], 201);
    }


    function show()
    {
        // return "hello";
        $templates = Template::get();
        $data = array();
        foreach ($templates as $form) {


            $_data["id"] = $form->id;
            $_data["title"] = $form->template_name;
            $_data["detail"] = $form->description;
            $_data["category"] = $form->category;
            $_data["date"] = $form->created_at;
            $_data["questions"] = array();




            $Questions = Question::where('template_id', $form->id)->get();

            //$_data["questions"]["answers"] = array();

            foreach ($Questions as $q) {

                $answers = QuestionAnswer::where('question_id', $q->id)->get();
                $_answers = array();
                foreach ($answers as $ans) {
                    array_push($_answers, array("value" => $ans->id, "label" => $ans->answer));
                }
                array_push($_data["questions"], array(
                    "id" => $q->id, "question" => $q->question,
                    "answerType" => $q->type_id, "answers" => $_answers
                ));
            }

            // array_push($_data["questions"], array(
            //     "id"=> $form->id,
            //     "question"=> $form->question,
            //     "answerType"=>$form->type->id,
            //      "answers"=> ($_answers)
            // ));
            array_push($data, $_data);
        }
        $result = [
            "status" => true,
            "data" => $data
        ];
        echo json_encode($result, true);
    }


    function showForm($id){
        $form = Template::find($id);
        //$_data = [];
        $_data["id"] = $form->id;
            $_data["title"] = $form->template_name;
            $_data["detail"] = $form->description;
            $_data["category"] = $form->category;
            $_data["date"] = $form->created_at;
            $_data["questions"] = array();




            $Questions = Question::where('template_id', $form->id)->get();

            //$_data["questions"]["answers"] = array();

            foreach ($Questions as $q) {

                $answers = QuestionAnswer::where('question_id', $q->id)->get();
                $_answers = array();
                foreach ($answers as $ans) {
                    array_push($_answers, array("value" => $ans->id, "label" => $ans->answer));
                }
                array_push($_data["questions"], array(
                    "id" => $q->id, "question" => $q->question,
                    "answerType" => $q->type_id, "answers" => $_answers
                ));
            }

            // array_push($_data["questions"], array(
            //     "id"=> $form->id,
            //     "question"=> $form->question,
            //     "answerType"=>$form->type->id,
            //      "answers"=> ($_answers)
            // ));
            //array_push($data, $_data);
        
                    return json_encode($_data, true);
    }
    // function showQuestion($id){
    //     $questions = Question::find($id)->template()->get();
    //     $questionTypes = Question::find($id)->type()->get();
    //     $answers = question::find($id)->answer()->get();
    //     foreach ($questions as $question) {
    //         $data = [

    //                 "FormName"=> $question->template_name,
    //                 "Description"=>$question->description,
    //                 "Questions"=>[
    //                        "Question"=> $question->question,
    //                         "QuestionType"=> $questionTypes->each(function ($questionType){
    //                             $questionType->type;
    //                         }),
    //                         "Answers"=> $answers->each(function ($answer){
    //                             $answer->answer;
    //                         }),

    //                 ]
    //             ];
    //         return json_encode($data);
    //     }
    // }
}
