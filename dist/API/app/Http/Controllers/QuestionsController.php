<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use App\Models\Template;
use App\Models\Answer;
use App\Models\QuestionAnswer;
use App\Models\QuestionType;
use App\Models\AnswerDetail;
use App\Http\Resources\QuestionResource;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{

    public function getimage(Request $request)
    {
        print_r($request->all());
    }


    function store(Request $request)
    {
        $req = $request;
        $form = new Template;
        if (!empty($request->questions)) {
            //$req =  $req[0];
            $form = Template::where('id', $req->id)->first();
            $form->user_id = $req->user_id;
            $form->template_name  = $req->title .  ' new';
            $form->description  = $req->detail;
            // $form->category  = $req['category'];
            $form->industrytype = $req['industrytype'];
            $form->inspectiontype = $req['inspectiontype'];
            $form->inspectionproperty =$req['inspectionproperty'];
            $form->registeredproperty = $req['registeredproperty'];
            $form->officefield= $req['officefield'];

            $form->save();

            foreach ($req['questions'] as $q) {
                $question = new Question;
                $question->question = $q['question'];
                $question->question_en = $q['question_en'];
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
                        $answerModel->answer_en = $answer['label_en'];
                        $answerModel->save();
                    }
                } else {
                    $answerModel = new QuestionAnswer;
                    $answerModel->question_id = $question->id;
                    $answerModel->answer = 'NULL';
                      $answerModel->answer_en = 'NULL';
                    $answerModel->save();
                }
            }
        } else {
            $req = $request;
            $form->user_id = 1;
            $form->template_name  = $req->title;
            $form->description  = $req['detail'];
            // $form->category  = $req['category'];
            $form->industrytype = $req['industrytype'];
            $form->inspectiontype = $req['inspectiontype'];
            $form->inspectionproperty =$req['inspectionproperty'];
            $form->registeredproperty = $req['registeredproperty'];
            $form->officefield= $req['officefield'];
            $form->save();
        }

        return $form->id;
        return response()->json([
            'message' => 'your forms successfully registered',
        ], 201);
    }
 
 
  function updateTemplate(Request $request)
    {
        $req = $request;
        $form = Template::find($request["id"]);
       // $form = Template::where('id', $req["id"])->first();
    //  print_r($req->user_id);
    //  print_r($req['title']);
    //  print_r($req['detail']);
    //       $form->user_id = $req->user_id;
            $form->template_name  = $req['title'];
            $form->description  = $req['detail'];
            // $form->category  = $req['category'];
            $form->industrytype = $req['industrytype'];
            $form->inspectiontype = $req['inspectiontype'];
            $form->inspectionproperty =$req['inspectionproperty'];
            $form->registeredproperty = $req['registeredproperty'];
            $form->officefield= $req['officefield'];
            $form->save();

        return response()->json([
            'message' => 'your forms successfully updated',
        ], 201);
    }
 
    function update(Request $request)
    {
        $req = $request;
        $questionForms = Question::where('template_id',  $req["id"])->get();
        if (count($questionForms) > 0) {
            Question::where('template_id',  $req["id"])->delete();
        }
        $form = Template::where('id', $req["id"])->first();

        foreach ($req->questions as $q) {
            $question = new Question;
            $question->question = $q["question"];
            $question->question_en = $q["question_en"];
            $question->type_id  = $q["answerType"];
            $question->template_id  = $form->id;
            $question->save();
            $questionType = new QuestionType;
            $questionType = $questionType->where('id', $q["answerType"])->first();
            if ($questionType->multi_answer == 1) {
                foreach ($q['answers'] as $answer) {
                    $answerModel = new QuestionAnswer;
                    $answerModel->question_id = $question["id"];
                    $answerModel->answer = $answer["label"];
                    $answerModel->answer_en = $answer["label_en"];
                    $answerModel->save();
                }
            } else {
                $answerModel = new QuestionAnswer;
                $answerModel->question_id = $question["id"];
                $answerModel->answer = '';
                $answerModel->answer_en = '';
                $answerModel->save();
            }
        }

        return response()->json([
            'message' => 'your forms successfully updated',
        ], 201);
    }

    function destroy(Request $request)
    {
        $req = $request;
        $questionForms = Question::where('template_id',  $req->id)->get();
        $form = Template::where('id', $req->id)->first();
        foreach ($req['questions'] as $q) {
            $question = new Question;
            $question->question = $q['question'];
             $question->question_en = $q['question_en'];
            $question->type_id  = $q['answerType'];
            $question->template_id  = $form->id;
            $question->delete();
            $questionType = new QuestionType;
            $questionType = $questionType->find($q['answerType']);
            if ($questionType->multi_answer == 1) {
                foreach ($q['answers'] as $answer) {
                    $answerModel = new QuestionAnswer;
                    $answerModel->question_id = $question->id;
                    $answerModel->answer = $answer['label'];
                    $answerModel->delete();
                }
            } else {
                $answerModel = new QuestionAnswer;
                $answerModel->question_id = $question->id;
                $answerModel->answer = '';
                $answerModel->delete();
            }
        }

        return response()->json([
            'message' => 'your forms successfully deleted',
        ], 201);
    }

    function show()
    {
        // $templates = Template::latest()->paginate();
         $templates = Template::where('is_deleted','0')->orderBy('id', 'DESC')->get();
        $data = array();
        foreach ($templates as $form) {
            $answers = Answer::where('template_id',$form->id)->get();
            $_data["id"] = $form->id;
            $_data["title"] = $form->template_name;
            $_data["detail"] = $form->description;
            $_data["answers_count"] = count($answers);
            // $_data["category"] = $form->category;
            $_data["industrytype"] = $form->industrytype;
            $_data["inspectiontype"] = $form->inspectiontype;
            $_data["inspectionproperty"] = $form->inspectionproperty;
            $_data["registeredproperty"] = $form->registeredproperty;
            $_data["officefield"]= $form->officefield;
             $_data["is_deleted"]= $form->is_deleted;
            $_data["date"] = $form->created_at->format('Y-m-d H:i:s');
            $_data["questions"] = array();

            $Questions = Question::where('template_id', $form->id)->get();

            foreach ($Questions as $q) {

                $answers = QuestionAnswer::where('question_id', $q->id)->get();
                $_answers = array();
                foreach ($answers as $ans) {
                    array_push($_answers, array("value" => $ans->id, "label" => $ans->answer, "label_en" =>$ans->answer_en));
                }
                array_push($_data["questions"], array(
                    "id" => $q->id,
                    "user_id" => '',
                    "operation_id" => '',
                    "question" => $q->question,
                    "question_en" => $q->question_en,
                    "answerType" => $q->type_id,
                    "answers" => $_answers,
                    "choose" => ($q->type->multi_answer == 1) ? [] : NULL,
                    "notes" => NULL,
                    'image' => []
                ));
            }

            array_push($data, $_data);
        }
        $result = [
            "status" => true,
            "data" => $data
        ];
        return response()->json($result);
    }


    function showForm($id)
    {
        $form = Template::find($id);
        //$_data = [];
        $_data["id"] = $form->id;
        $_data["user_id"] = '';
        $_data["title"] = $form->template_name;
        $_data["detail"] = $form->description;
        // $_data["category"] = $form->category;
        $_data["industrytype"] = $form->industrytype;
        $_data["inspectiontype"] = $form->inspectiontype;
        $_data["inspectionproperty"] = $form->inspectionproperty;
        $_data["registeredproperty"] = $form->registeredproperty;
        $_data["officefield"] = $form->officefield;
        $_data["date"] = $form->created_at->format('Y-m-d H:i:s');
        $_data["questions"] = array();




        $Questions = Question::where('template_id', $form->id)->get();

        foreach ($Questions as $q) {

            $answers = QuestionAnswer::where('question_id', $q->id)->get();
            $_answers = array();
            foreach ($answers as $ans) {
                array_push($_answers, array("value" => $ans->id, "label" => $ans->answer,  "label_en" => $ans->answer_en));
            }
            array_push($_data["questions"], array(
                "id" => $q->id,
                "question" => $q->question,
                 "question_en" => $q->question_en,
                "answerType" => $q->type_id,
                "operation_id" => '',
                "answers" => $_answers,
                "choose" => ($q->type->multi_answer == 1) ? [] : NULL,
                "notes" => NULL,
                'image' => []
            ));
        }
        return response()->json($_data);
    }
    
    function isDeleteTemplate(Request $request){
        echo "delete";
        print_r($request->id);
        $template = Template::find($request->id);
        $template->is_deleted = $request->delete;
        $template->save();
       
        return response()->json("data has been archive successfully");
    }
}
