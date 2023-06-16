<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use App\Models\Template;
use App\Models\Answer;
use App\Models\Task;
use App\Models\TaskLog;
use App\Models\Unit;
use App\Models\AnswerDetail;
use App\Models\QuestionAnswer;
use App\Models\Admin;
use App\Models\QuestionType;
use App\Http\Resources\QuestionResource;
use App\Models\Company;
use App\Models\Notifcation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\UnitType;
use App\Models\companyRatio;
use App\Models\Log;
//use App\Models\AnswerDetailsLog;
use Exception;
use App\Models\Exception as ExceptionModel;

class AnswerController extends Controller
{
    protected $answerTable ,$answerTableLogs
    ,$answer;
    function __construct(){
        $this->answerTable = new AnswerDetail;
        //$this->answerTableLogs = new AnswerDetailsLog;
        $this->answer = new Answer;
    }
    function store(Request $req)
    {
        $notifcations=[];
        $answer = new Answer;
        $answer->template_id  = $req['id'];
        $answer->unit_id  = $req['unit_id'];
        $answer->company_id  = $req['company_id'];
        $answer->user_id = $req['user_id'];
         $answer->office_id = $req['office_id'];
        $answer->save();
        $operation_id = $req['operation_id'];
        
        foreach ($req['questions'] as $q) {
            $question = Question::findOrFail($q['id']);

            $answerTable = new AnswerDetail;

            if ($question->type->multi_answer == 0) {
                // print_r($q['id']);
                $answerTable = new AnswerDetail;
                $answerTable->question_id = $q['id'];
                $answerTable->answer_id = $answer->id;
                $answerTable->answer = $q['choose'];
                $answerTable->notes = NULL;
            } else {

                $choose = explode(',', $q['choose']);
                //$i = 0;
                // return $q["choose"];
                $counter = 0;
                //if (is_array($q["choose"]))
                {
                    $counter = count($choose);
                }
                for ($i = 0; $i < $counter; $i++) {
                    // return "Adel";
                    // foreach($q["choose"] as $chose){
                    $answerTable = new AnswerDetail;
                    $answerTable->question_id = $q['id'];
                    $answerTable->answer_id = $answer->id;
                    $answerTable->answer = $choose[$i];
                    $answerTable->save();
                }
                // return "Ahmed & Yousef";
            }
            $image = $q['image'];
            //print_r($image->getClientOriginalExtension());
            if (!empty($image) || $image != null) {
                // return $image;
                $name = $q['id'] . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $image->move($destinationPath, $name);


                // $q['image']->store('uploads');
                $answerTable->image = $name;
            }
            if (!empty($q["notes"]) && $q["notes"] != null && $q["notes"] != "null") {
                $answerTable->notes = $q["notes"];
            } else {
                $answerTable->notes = null;
            } 
            $answerTable->save();
         
            if (!empty($operation_id))
            {  
              
                $task = new Task;
                $task->user_id = $req['user_id'];
                $task->assign_user_id = $operation_id;
                $task->answer_detail_id = $answerTable->id;
                $task->save();
               $noti= Notifcation::create([
                    "sender_id"=>$req['user_id'],
                     "reciver_id"=>$operation_id,
                ]);
                $notifcations[]=$noti;
                 $taskLog = new TaskLog;
                $taskLog->task_id = $task->id;
                $taskLog->notes = $q["notes"];
                $taskLog->user_id = $req['user_id'];;
                $taskLog->save();
            }
           // print_r('data save');
        };
        return response()->json([
            'message' => $notifcations
        ], 201);
    }


    function SaveMobileAnswer(Request $req)
    {
        $notifcations=[];
        $answer = new Answer;
        $answer->template_id  = $req->id;
        $answer->unit_id  = $req['unit_id'];
        $answer->company_id  = $req['company_id'];
        $answer->user_id = $req['user_id'];
        $answer->save();
        foreach ($req['questions'] as $q) {
            $question = Question::find($q['id']);
            $answerTable = new AnswerDetail;
            if ($question->type->multi_answer == 0) {
                $answerTable = new AnswerDetail;
                $answerTable->question_id = $q['id'];
                $answerTable->answer_id = $answer->id;
                $answerTable->answer = $q['choose'];
                $answerTable->notes = NULL;
            } else if ($q["answerType"] == 2){
                $counter = 0;
                $choose = $q["choose"];
                $counter = count($choose);
                for ($i = 0; $i < $counter; $i++) {
                    $answerTable = new AnswerDetail;
                    $answerTable->question_id = $q['id'];
                    $answerTable->answer_id = $answer->id;
                    $answerTable->answer = $choose[$i];
                    $answerTable->save();
                }
            }else{
                $answerTable = new AnswerDetail;
                $answerTable->question_id = $q['id'];
                $answerTable->answer_id = $answer->id;
                $answerTable->answer = $q['choose'];
                $answerTable->notes = NULL;
            }
            $image = $q['image'];
            if (!empty($image) && $image != null) {
                try{
                    // return $image;
                    $name = $q['id'] . time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads');
                    $image->move($destinationPath, $name);
                    $answerTable->image = $name;
                }catch(\Error $e){
                    $exception = new ExceptionModel();
                    $exception->exception = gettype($image);
                    $exception->api = $req->server('REQUEST_URI');
                    $exception->save();
                    return $image;
                }
            }
                if (!empty($q["notes"]) && $q["notes"] != null && $q["notes"] != "null") {
                    $answerTable->notes = $q["notes"];
                } else {
                    $answerTable->notes = null;
                }
                $answerTable->save();
            if (!empty($q['operation_id']))
            {
                $task = new Task;
                $task->user_id = $req['user_id'];
                $task->assign_user_id = $q['operation_id'];
                $task->answer_detail_id = $answerTable->id;
                $task->save();
                $noti= Notifcation::create([
                    "sender_id"=>$req['user_id'],
                        "reciver_id"=>$q['operation_id'],
                ]);
                $notifcations[]=$noti;
                    $taskLog = new TaskLog;
                $taskLog->task_id = $task->id;
                $taskLog->notes = $q["notes"];
                $taskLog->user_id = $req['user_id'];;
                $taskLog->save();
            }
        };
        return response()->json([
            'message' => $notifcations
        ], 201);
    }

    function showDetailedAns($id)
    {
        $form = Template::find($id);
        $_data = array();

        $answers = Answer::leftJoin('units', 'units.id', '=', 'answers.unit_id')->with('user:id,firstname,lastname')->with('units:id')->where('template_id', $form->id)->get();
        // return $answers;
        $answers = Answer::where('template_id', $id)->get();
        $data = array();
        $data["title"] = $form->template_name;
        $data["data"] = array();
        foreach($answers as $ans){
            $_data = array();
            $_data['id'] = $ans->id;
            $_data['created_at'] = $ans->created_at;
            $user_id = $ans->user_id;
            $_data['user'] = Admin::where('id', $user_id)->select('id','firstname','lastname')->get();
            $unit = Unit::where('id',$ans->unit_id)->first();
            $_data['building_number'] = $unit->building_number;
            $_data['unit_number'] = $unit->unit_number;
            $_data['pilgrims'] = $unit->pilgrims;
            $_data['permissions'] = $unit->permissions;
            $_data['nationality'] = $unit->nationality;
            array_push($data["data"], $_data);
        }
        return $data;
    }
    function editAnswer(Request $req,$answer_id)
    {
        $notifcations=[];
        // return $req;
        $operation_id = $req['operation_id'];
        foreach ($req['questions'] as $q) {
            $question = Question::find($q['id']);
           
            if ($question->type->multi_answer == 0) {
                $answerTable = AnswerDetail::where("answer_id",$answer_id)->where("id",$q['answers_id'])->first();
                $answerTable->question_id = $q['id'];
                $answerTable->answer_id = $answer_id;
                $answerTable->answer = $q['choose'];
                $answerTable->notes = NULL;
                ///// answerTableLogs
                // $this->answerTableLogs->question_id = $q['id'];
                // $this->answerTableLogs->answer_id = $req['answer_id'];
                // $this->answerTableLogs->answer = $q['choose'];
                // $this->answerTableLogs->notes = NULL;
            } else {
               
                $choose = explode(',', $q['choose']);
                $counter = 0;
             
                {
                    $counter = count($choose);
                }
                      echo "<br>".'choose';
                print_r($choose);
                echo "counter";
                print_r($counter);
                for ($i = 0; $i < $counter; $i++) {
                    echo "qid";
                    print_r($q['id']);
                    echo "answerid";
                    print_r($q['answers_id']);
                    $answerTable = AnswerDetail::where("answer_id",$answer_id)->where("id",$q['answers_id'])->first();
                    echo "ansawer table";
                    print_r($answerTable);
                    $answerTable->question_id = $q['id'];
                    $answerTable->answer_id = $answer_id;
                    $answerTable->answer = $choose[$i];
                    $answerTable->save();
                    ////answerTableLogs
                    // $this->answerTableLogs->question_id = $q['id'];
                    // $this->answerTableLogs->answer_id = $req['answer_id'];
                    // $this->answerTableLogs->answer = $choose[$i];
                    // $this->answerTableLogs->save();
                }
            }
            $image = $q['image'];
            if (!empty($image) || $image != null) {
                $name = $q['id'] . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $image->move($destinationPath, $name);
                $answerTable->image = $name;
                // $this->answerTableLogs->image = $name;
            }
            if (!empty($q["notes"]) && $q["notes"] != null && $q["notes"] != "null") {
                $answerTable->notes = $q["notes"];
                // $this->answerTableLogs->notes = $q["notes"];
            } else {
                $answerTable->notes = null;
                // $this->answerTableLogs->notes = null;
            }
            // $this->answerTableLogs->save();
            $answerTable->save();
    
            if (!empty($operation_id))
            {
                $task = new Task;
                $task->user_id = $req['user_id'];
                $task->assign_user_id = $operation_id;
                $task->answer_detail_id = $answerTable->id;
                $task->save();
               $noti= Notifcation::create([
                    "sender_id"=>$req['user_id'],
                     "reciver_id"=>$operation_id,
                ]);
                $notifcations[]=$noti;
                $taskLog = new TaskLog;
                $taskLog->task_id = $task->id;
                $taskLog->notes = $q["notes"];
                $taskLog->user_id = $req['user_id'];;
                $taskLog->save();
            }
        };
        return response()->json([
            'message' => $notifcations
        ], 201);
    }
    
    function showAnswer($id)
    {
        $form = Template::find($id);
        
        $_data = array();

        $answers = Answer::where('template_id', $form->id)->get();
        foreach ($answers as $answer) {
            $ansDetail =
                AnswerDetail::where('answer_id', $answer->id)->get();
            $multi_answer = "";
            $qq = array();
            foreach ($ansDetail as $a) {
                if (!in_array($a->question, $qq))
                    array_push($qq, $a->question);
            }
            foreach ($qq as $question) {

                $_answer = '';
                $notes = '';
                $image = '';

                if ($question->type->multi_answer != 0) {
                    $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                    $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                    $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                    $ans["question"] = $question->question;
                    // Concat Answers, Image, and notes for multi_Answer Questions
                    foreach ($ansDetail->where('question_id', $question->id) as $detail) {
                        $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                        if (!empty($detail->notes) || $detail->notes != null)
                            $notes .= $detail->notes;

                        if (!empty($detail->image) || $detail->image != null)
                            $image .= $detail->image;

                        //$task = Task::where("answer_detail_id", $detail->id)->first();
                        // $ans["TaskNote"]= $task->notes;
                        // $ans["TaskImage"]= $task->image;
                        // $ans["TaskStatus"]= $task->status->status;
                        // $ans["TaskUser"]= $task->user->firstname . ' ' . $answer->user->lastname;
                        $this->getTasks($detail, $ans);
                    }

                    $ans["answer"] = substr_replace(trim($_answer), "", -1);
                    $ans["notes"] = $notes;
                    $ans["image"] = $image;

                    array_push($_data, $ans);
                } else {
                    $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                    $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                    $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                    $ans["question"] = $question->question;
                    $detail = $ansDetail->where('question_id', $question->id)->first();
                    $ans["answer"] = $detail->answer;
                    $ans["notes"] = $detail->notes;
                    $ans["image"] = $detail->image;
                    $this->getTasks($detail, $ans);

                    array_push($_data, $ans);
                }
            }
        }
        return response()->json($_data);
    }

    function showAnswerHrForm()
    {
        // $forms = Template::where('category','موارد بشرية')->where('is_deleted','0')->get();
        $forms = Template::where('inspectiontype','2')->where('is_deleted','0')->get();
        $_data = array();
        foreach ($forms as $form) {
            $answers = Answer::where('template_id', $form->id)->get();
            foreach ($answers as $answer) {
                $ansDetail =
                    AnswerDetail::where('answer_id', $answer->id)->get();
                $multi_answer = "";
                $qq = array();
                foreach ($ansDetail as $a) {
                    if (!in_array($a->question, $qq))
                        array_push($qq, $a->question);
                }
                foreach ($qq as $question) {

                    $_answer = '';
                    $notes = '';
                    $image = '';

                    if ($question->type->multi_answer != 0) {
                        $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                        $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                        $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                        $ans["question"] = $question->question;
                        // Concat Answers, Image, and notes for multi_Answer Questions
                        foreach ($ansDetail->where('question_id', $question->id) as $detail) {
                            $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                            if (!empty($detail->notes) || $detail->notes != null)
                                $notes .= $detail->notes;

                            if (!empty($detail->image) || $detail->image != null)
                                $image .= $detail->image;

                            //$task = Task::where("answer_detail_id", $detail->id)->first();
                            // $ans["TaskNote"]= $task->notes;
                            // $ans["TaskImage"]= $task->image;
                            // $ans["TaskStatus"]= $task->status->status;
                            // $ans["TaskUser"]= $task->user->firstname . ' ' . $answer->user->lastname;
                            $this->getTasks($detail, $ans);
                        }

                        $ans["answer"] = substr_replace(trim($_answer), "", -1);
                        $ans["notes"] = $notes;
                        $ans["image"] = $image;

                        array_push($_data, $ans);
                    } else {
                        $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                        $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                        $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                        $ans["question"] = $question->question;
                        $detail = $ansDetail->where('question_id', $question->id)->first();
                        $ans["answer"] = $detail->answer;
                        $ans["notes"] = $detail->notes;
                        $ans["image"] = $detail->image;
                        $this->getTasks($detail, $ans);

                        array_push($_data, $ans);
                    }
                }
            }
        }
        return response()->json($_data);
    }

    function showAnswerWhereForm()
    {
        // $forms = Template::where('category','اماكن')->where('is_deleted','0')->get();
         $forms = Template::where('inspectiontype','5')->where('is_deleted','0')->get();
        $_data = array();
        foreach ($forms as $form) {
            $answers = Answer::where('template_id', $form->id)->get();
            foreach ($answers as $answer) {
                $ansDetail =
                    AnswerDetail::where('answer_id', $answer->id)->get();
                $multi_answer = "";
                $qq = array();
                foreach ($ansDetail as $a) {
                    if (!in_array($a->question, $qq))
                        array_push($qq, $a->question);
                }
                foreach ($qq as $question) {

                    $_answer = '';
                    $notes = '';
                    $image = '';

                    if ($question->type->multi_answer != 0) {
                        $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                        $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                        $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                        $ans["question"] = $question->question;
                        // Concat Answers, Image, and notes for multi_Answer Questions
                        foreach ($ansDetail->where('question_id', $question->id) as $detail) {
                            $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                            if (!empty($detail->notes) || $detail->notes != null)
                                $notes .= $detail->notes;

                            if (!empty($detail->image) || $detail->image != null)
                                $image .= $detail->image;

                            //$task = Task::where("answer_detail_id", $detail->id)->first();
                            // $ans["TaskNote"]= $task->notes;
                            // $ans["TaskImage"]= $task->image;
                            // $ans["TaskStatus"]= $task->status->status;
                            // $ans["TaskUser"]= $task->user->firstname . ' ' . $answer->user->lastname;
                            $this->getTasks($detail, $ans);
                        }

                        $ans["answer"] = substr_replace(trim($_answer), "", -1);
                        $ans["notes"] = $notes;
                        $ans["image"] = $image;

                        array_push($_data, $ans);
                    } else {
                        $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                        $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                        $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                        $ans["question"] = $question->question;
                        $detail = $ansDetail->where('question_id', $question->id)->first();
                        $ans["answer"] = $detail->answer;
                        $ans["notes"] = $detail->notes;
                        $ans["image"] = $detail->image;
                        $this->getTasks($detail, $ans);

                        array_push($_data, $ans);
                    }
                }
            }
        }
        return response()->json($_data);
    }

    function showAnswersCompanyForm($company_id)
    {
        $units = Unit::where('company',$company_id)->get();
        // $forms = Template::where('category','اماكن')->get();
        $_data = array();
        foreach ($units as $unit) {
            $answers = Answer::where('unit_id', $unit->id)->get();
            foreach ($answers as $answer) {
                $ansDetail =
                    AnswerDetail::where('answer_id', $answer->id)->get();
                $multi_answer = "";
                $qq = array();
                foreach ($ansDetail as $a) {
                    if (!in_array($a->question, $qq))
                        array_push($qq, $a->question);
                }
                foreach ($qq as $question) {

                    $_answer = '';
                    $notes = '';
                    $image = '';

                    if ($question->type->multi_answer != 0) {
                        $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                        $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                        $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                        $ans["question"] = $question->question;
                        // Concat Answers, Image, and notes for multi_Answer Questions
                        foreach ($ansDetail->where('question_id', $question->id) as $detail) {
                            $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                            if (!empty($detail->notes) || $detail->notes != null)
                                $notes .= $detail->notes;

                            if (!empty($detail->image) || $detail->image != null)
                                $image .= $detail->image;
                                $this->getTasks($detail, $ans);
                        }

                        $ans["answer"] = substr_replace(trim($_answer), "", -1);
                        $ans["notes"] = $notes;
                        $ans["image"] = $image;

                        array_push($_data, $ans);
                    } else {
                        $ans["unit"] = Unit::where('id', $answer->unit_id)->first()->unit_number;
                        $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                        $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                        $ans["question"] = $question->question;
                        $detail = $ansDetail->where('question_id', $question->id)->first();
                        $ans["answer"] = $detail->answer;
                        $ans["notes"] = $detail->notes;
                        $ans["image"] = $detail->image;
                        $this->getTasks($detail, $ans);

                        array_push($_data, $ans);
                    }
                }
            }
        }
        return response()->json($_data);
    }

    function showAnswerDetail($answer_id)
    {
        $answer = Answer::findOrFail($answer_id);
        
        $ansDetail = AnswerDetail::where('answer_id', $answer->id)->get();
        $multi_answer = "";
        $qq = array();
        $_data = array();
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
                
                $ans["unit_id"] = $unit->id;
                $ans["unit"] = $unit->building_number . ' - ' . $unit->unit_number . ' - ' . $unitType->type . ' - ' . $unit->nationality;
                $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                $ans["user_id"] = $answer->user_id;
                $ans["company_id"] = $answer->company_id;
                $ans["office_id"] = $answer->office_id;
                $ans["company"] = $answer->company_id != null ? Company::find($answer->company_id)->company_name : null;
                $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                $ans["question_id"] = $question->id;
                // $ans["question_type"] = $question->id;
                $ans["question"] = $question->question;
                $_answers = array();
                foreach ($ansDetail->where('question_id', $question->id) as $detail) {
                //     print_r($detail);
                //     echo "answer"."<br>";
                //      print_r($detail->answer);
                //   // die;
                    $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                    if (!empty($detail->notes) || $detail->notes != null)
                        $notes .= $detail->notes;
                    if (!empty($detail->image) || $detail->image != null)
                        $image .= $detail->image;
                    $this->getTasks($detail, $ans);
               
                    array_push($_answers, $detail->answer);
                }
                
               $ans['answers'] = $_answers;
                $ans["answer"] = substr_replace(trim($_answer), "", -1);
                $ans["notes"] = $notes;
                $ans["image"] = $image;
               
                array_push($_data, $ans);
            } else {
               
                $unit = Unit::where('id', $answer->unit_id)->first();
               
                $ans["company_id"] = $answer->company_id;
                $ans["office_id"] = $answer->office_id;
                $ans["company"] = $answer->company_id != null ? Company::find($answer->company_id)->company_name : null;
                $ans["unit"] = $unit->unit_number;
                $ans["unit_id"] = $unit->id;
                $ans["user"] = $answer->user->firstname . ' ' . $answer->user->lastname;
                 $ans["user_id"] = $answer->user_id;
                $ans["Date"] = $answer->created_at->format('Y-m-d H:i:s');
                $ans["question"] = $question->question;
                $ans["question_id"] = $question->id;
                $detail = $ansDetail->where('question_id', $question->id)->first();
                $_answers = array();
                array_push($_answers, $detail->answer);
               
                $ans['answers'] = $_answers;
                $ans["answer"] = $detail->answer;
                $ans["notes"] = $detail->notes;
                $ans["image"] = $detail->image;
                $this->getTasks($detail, $ans);
                
                array_push($_data, $ans);
            }
        }
        // }
        // return response()->json(["as"=>$_data,"hamada"=>])
        return response()->json($_data);
    }

    function AnswersPerUnit($category,Request $req)
    {
        $data = array();
        $data["companyId"] = null;
        $data["templateId"] = null;
        
        $data['unit_number'] = $req['unit_number'];
        $data['template_name'] = $req['template_name'];
        $data['client_name'] = $req['client_name'];

        $data["category"] = $category;
        return $this->paginate_Answer_per_Unit($data);
    }


    function AnswersPerUnitForCompany($companyId,Request $req)
    {
        $data = array();
        $data["companyId"] = $companyId;
        $data["templateId"] = null;
        
        $data["category"] = null;
        $data['unit_number'] = $req['unit_number'];
        $data['template_name'] = $req['template_name'];
        $data['client_name'] = $req['client_name'];
        // return $data;
        return $this->paginate_Answer_per_Unit($data);
    }

    function AnswersPerUnitForTemplates($templateId,Request $req)
    { 
        // echo "req";
        // print_r($req);
        
        // return $req;
        $data = array();
        $data["companyId"] = null;
        $data["templateId"] = $templateId;
        
        $data["category"] = null;
        $data['unit_number'] = $req['unit_number'];
        $data['template_name'] = $req['template_name'];
        $data['client_name'] = $req['client_name'];
        // RETURN $data;
        return $this->paginate_Answer_per_Unit($data);
    }

    function helper_search(array $items){
        // echo "helper array";
        // print_r($items);
        
        // Check Company units
        if($items["companyId"] != null){
            // echo "company id";
            $comId = $items["companyId"];
            $Units = Unit::where('company', $comId)->pluck('id');
                // ->where('unit_number','like','%'.$items['unit_number']. '%')
        }else{
            $Units = Unit::where('unit_number','like','%'.$items['unit_number']. '%')
                ->pluck('id');
        }
        $answers = Answer::whereIn('unit_id', $Units)->get();
        // echo "<pre>";
        //      print_r($answers);
        // check if template id selected
        if($items['templateId']!= null){
            // echo "templateId";
            //  print_r($items['templateId']);
            //  echo "template name";
            //  print_r($items['template_name']);
            $templateId = $items["templateId"];
            $template = Template::where('id', $templateId)->where('template_name', 'like','%'.$items['template_name']. '%')->where('is_deleted','0')->pluck('id');
            // $template = Template::where('category', $category)->where('id', $templateId)->where('template_name', 'like','%'.$items['template_name']. '%')->pluck('id');
           
        }
        
        // check templates category
        else if($items['category'] != null){
            $inspectiontype = "";
            if($items['category'] == "emergency"){ $category = 'اماكن';
                $inspectiontype = 5;
            }
            else {$category = 'موارد بشرية';
            $inspectiontype = 2;
        }
                $template = Template::where('inspectiontype', $inspectiontype)->where('template_name', 'like','%'.$items['template_name']. '%')->where('is_deleted','0')->pluck('id');
        }else{
                $template = Template::where('template_name', 'like','%'.$items['template_name']. '%')->where('is_deleted','0')->pluck('id');
        }
        
        // $answers= $answers->whereIn('template_id', $template);
        $answers= Answer::whereIn('template_id', $template)->get();
            // echo "helper ansswers";
            // print_r($answers);
        if(!empty($items['client_name'])){
                    $user = Admin::where('firstname', 'like','%'.$items['client_name']. '%')
                        ->orWhere('lastname', 'like','%'.$items['client_name']. '%')
                        ->pluck('id');
                        $answers= $answers->whereIn('user_id',$user)
                            ->where('template_id', '!=', 19);
                }
                return $answers->pluck('id');
    }

    public function paginate_Answer_per_Unit($items, $perPage = 15, $page = null, $options = [])
    {  
        // echo "items paginated";
        // print_r($items);
        $url = url('/') . '/api/units_status';
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $_data["data"]=array();
        $_data["current_page"] = $page;
        $_data["first_page_url"]=  "/?page=1";
        $_data["PerPage"]=15;
        
        $answers = $this->helper_search($items);
        // echo "answers";
        // print_r($answers);
        if($items["companyId"]!= null){
            
            $url = url('/') . '/api/companyForms/'.$items["companyId"];

        }
        
        else if($items["templateId"]!= null){

            
            $url = url('/') . '/api/templateForms/'.$items["templateId"];

        }
        else{
            $url = url('/') . '/api/units_status/'.$items['category'];
        }
        // $data['unit_number'] = $req['unit_number'];
        // $data['template_name'] = $req['template_name'];
        // $data['client_name'] 
        // echo "template";
        // print_r($items);
        // die;
        $data = array();
        $answerIds = AnswerDetail::whereIn('answer_id', $answers)->whereIn('question_id', (Question::where('type_id', 1)->pluck('id')))->pluck('answer_id');
        // echo "arrayid";
        // print_r($answerIds);
        $arr = json_decode(json_encode($answerIds), true);
        $p =(($page-1)*15);
        $wh = array_slice(array_unique($arr), $p, 15);
        $arrAnswers = Answer::whereIn('id', $wh)->get();
        // echo "array";
        // print_r($arrAnswers);
        foreach ($arrAnswers as $ans) {
            $template = Template::find($ans->template_id);
            $monitor = Admin::where('id', $ans->user_id)->first();
            $monitorName = $monitor->firstname . ' ' . $monitor->lastname;
            $unit_id = $ans->unit_id;
            $unit = Unit::find($unit_id);

            $company = $unit->company_id != null? Company::where('id', $ans->company_id)->first()->company_name : null;
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
                $units["answer_id"] = $ans->id;
                $units["comapny"] = $company;
                $units["unit_id"] = $unit_id;
                $units["unit_number"] = $unit_number;
                $units["Template_Title"] = $monitorName . ' - '  . $template->template_name;
                $units["Template_Detail"] = $template->description;
                $units["nationality"] = $unit->nationality;
                $units["SuccessPercentage"] = round($count_Yes / $numberofQuestions * 100, 2);
                $units["FailedPercentage"] = round($count_No / $numberofQuestions * 100, 2);
                $units["pilgrims"] = $unit->pilgrims;
                array_push($data, $units);
            }
        }
        $_data["data"]= $data;
        $total = ceil(count(array_unique($arr))/15);
        $_data["next_page_url"]= $total <= $page ? null : "/?page=".$page+1;
        $_data["path"] =  $url;
        $_data["prev_page_url"]= $page ==1 ? null : "/?page=".$page-1;

        $_data["total"]= $total;
        $_data["Count"]= count(array_unique($arr));
        // print_r($_data);
        return $_data;
    }
    public function paginate_Answer_per_Unit_2()
    {
        Log::where('id','>','0')->delete();
        // $deleteTable->delete();
        // return "deleted";
        $_data["data"]=array();
        $answers = Answer::pluck('id');
        $data = array();
        $test = Question::where('type_id', 1)->pluck('id');
        $answerIds = AnswerDetail::whereIn('answer_id', $answers)->whereIn('question_id', $test)->pluck('answer_id');
        $arr = json_decode(json_encode($answerIds), true);
        $wh = array_unique($arr);
        $arrAnswers = Answer::whereIn('id', $wh)->get();
        foreach ($arrAnswers as $ans) {
            $template = Template::find($ans->template_id);
            $monitor = Admin::where('id', $ans->user_id)->first();
            // return $monitor;
            $monitorName = $monitor->firstname . ' ' . $monitor->lastname;
            $unit_id = $ans->unit_id;
            $unit = Unit::find($unit_id);
            $company = $unit->company_id != null? Company::where('id', $unit->company_id)->first()->company_name : null;
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
                $logs = new Log();
                $logs->answer_id = $ans->id;
                $logs->comapny = $company;
                $logs->unit_id = $unit_id;
                $logs->unit_number = $unit_number;
                $logs->Template_Title= $monitorName . ' - '  . $template->template_name;
                $logs->Template_Detail = $template->description;
                $logs->nationality = $unit->nationality;
                $logs->SuccessPercentage = round($count_Yes / $numberofQuestions * 100, 2);
                $logs->FailedPercentage = round($count_No / $numberofQuestions * 100, 2);
                $logs->pilgrims = $unit->pilgrims;
                $logs->save();
            }
        }
        return "done";

    }

    function AnswersPerTemplate($id)
    {

        $form = Template::find($id);
        $data = array();
        $form_id = $form->id;
        $form_name = $form->template_name;
        $questions = Question::where("template_id", $form->id)->get();
        foreach ($questions as $question) {
            $questionAnswers = QuestionAnswer::where("question_id", $question->id)->get();
            foreach ($questionAnswers as $qans) {
                $answerDetails = AnswerDetail::where("answer", $qans->id)->get();
                $countAnswers = AnswerDetail::where("question_id", $question->id)->get();
                $forms["form_id"] = $form_id;
                $forms["form_name"] = $form_name;
                $forms["question"] = $question->question;
                $forms["questionId"] = $question->id;
                $forms["questionAnswers"] = $qans->answer;
                $forms["chooseAnswerCounts"] = count($answerDetails) / count($countAnswers) * 100;
                array_push($data, $forms);
            }
        }
        return response()->json($data);
    }

    function AnswersPerTemplateAnswers($id)
    {

        $form = Template::find($id);
        $data = array();
        $form_id = $form->id;
        $form_name = $form->template_name;
        $questions = Question::where("template_id", $form->id)->get();
        foreach ($questions as $question) {
            $questionAnswers = QuestionAnswer::where("question_id", $question->id)->get();
            $forms["form_id"] = $form_id;
            $forms["form_name"] = $form_name;
            $forms["question"] = $question->question;
            $forms["percent"] = [];
            $forms["questionId"] = $question->id;
            $forms["questionAnswers"] = array();
            foreach ($questionAnswers as $qans) {
                $answerDetails = AnswerDetail::where("answer", $qans->id)->get();
                $countAnswers = AnswerDetail::where("question_id", $question->id)->get();
                $_answ['answer'] = $qans->answer;
                $_answ['count'] = count($answerDetails);
                array_push($forms["questionAnswers"], $_answ['answer']);
                array_push($forms["percent"], $_answ['count']);
            }
            array_push($data, $forms);
        }
        return response()->json($data);
    }
    public function getTasks($ansDetail, &$ans)
    {
        $task = Task::where("answer_detail_id", $ansDetail->id)->first();
        if ($task != null) {
            $ans["answer_detail_id"] = $ansDetail->id;
            $ans["TaskNote"] = $task->notes;
            $ans["TaskImage"] = $task->image;
            $ans["TaskStatus"] = $task->status->status;
            $ans["TaskUser"] = Admin::where('id', $task->assign_user_id)->first()->firstname . ' ' . Admin::where('id', $task->assign_user_id)->first()->lastname;
            $ans["TaskUserid"] = $task->assign_user_id;
        } else {

            $ans["answer_detail_id"] = $ansDetail->id;
            $ans["TaskNote"] = "";
            $ans["TaskImage"] = "";
            $ans["TaskStatus"] = "";
            $ans["TaskUser"] = "";
            $ans["TaskUserid"]="";
        }
    }

}
