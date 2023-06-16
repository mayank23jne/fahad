<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\AnswerDetail;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Template;
use App\Models\QuestionAnswer;
use App\Models\Unit;
use App\Models\Admin;
use App\Models\TaskLog;
use Illuminate\Pagination\Paginator;


abstract class userRoles{
    const r_Admin = 1;
    const r_User = 2;
    const r_Owner = 5;
    const r_Company = 16;
    const r_CompanyMonitor = 15;
    const r_CompanyAssist = 14;
}

abstract class taskStatus{
    const s_Completed = 1;
    const s_UnderReview = 2;
    const s_refused = 3;
}

class TaskController extends Controller
{
    public function showInfo($user_id)
    {
        $user = Admin::where('id', $user_id)->first();
        // if user is admin show all tasks
        if ($user->role_id == userRoles::r_Admin) {
            $tasks = Task::where('confirm', 0)->get();
        }
        // if user is a unit Owner show all not resolved tasks and not confirmed
        else if ($user->role_id == userRoles::r_Owner) {
            $units = Unit::where('client_id', $user_id)->pluck('id');
            $answers = Answer::whereIn('unit_id', $units)->pluck('id');

            $tasks = Task::where('confirm', 0)->whereIn('answer_detail_id', AnswerDetail::whereIn('answer_id', $answers)->pluck('id'))->where('status_id', '!=', taskStatus::s_Completed)->get();

        }
        // if user is a Company agent show all not resolved tasks and not confirmed
        else if ($user->role_id == userRoles::r_CompanyMonitor || $user->role_id == userRoles::r_CompanyAssist) {
            $units = Unit::where('company', $user->company)->pluck('id');
            $hrTemplates = Template::where('category', 'موارد بشرية')->pluck('id');
            $answers = Answer::whereIn('unit_id', $units)->whereIn('template_id', $hrTemplates)->pluck('id');

            $tasks = Task::where('confirm', 0)->whereIn('answer_detail_id', AnswerDetail::whereIn('answer_id', $answers)->pluck('id'))->where('status_id', '!=', taskStatus::s_Completed)->where('confirm', 0)->get();

        }
        // for all other user show his assigned or created by him (not completed or not confirmed)
        else {
            $tasks = Task::where('confirm', 0)->where('assign_user_id', $user_id)->orWhere('user_id', $user_id)->where('confirm', 0)->get();
        }
        return $this->paginate_Show_TaskInfo($tasks);
    }


    public function paginate_Show_TaskInfo($tasks, $perPage = 15, $page = null, $options = [])
    {
        $url = url('/') . '/api/showInfo';
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $_data["data"]=array();
        $_data["current_page"] = $page;
        $_data["first_page_url"]=  "/?page=1";
        $total = ceil(count($tasks)/15);
        $_data["next_page_url"]= $total <= $page ? null : "/?page=".$page+1;
        $_data["path"] =  $url;
        $_data["prev_page_url"]= $page ==1 ? null : "/?page=".$page-1;

        $_data["total"]= $total;
        $_data["Count"]= count($tasks);

        $data = array();
        $arrTasks=$tasks->skip(($page-1) * 15)->take(15);
        foreach ($arrTasks as $task) {

            $answer_detail_id = $task->answer_detail_id;
            $answerDetail = AnswerDetail::where('id', $answer_detail_id)->first();
            $notes = $answerDetail->notes;
            $question_id = $answerDetail->question_id;
            $question = Question::where('id', $question_id)->first();
            $title = $question->question;
            $answer = Answer::find($answerDetail->answer_id)->first();
            $notes = '';
            $_answer = '';
            $Date = $task->created_at;
            $image = '';
            if ($question->type->multi_answer != 0) {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
                // $Date = $answer->created_at;
                // Concat Answers, Image, and notes for multi_Answer Questions
                // foreach ($answerDetail->where('question_id', $question->id) as $detail) {
                //     $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                //     $notes .= $detail->notes;
                // }
                $_answer = QuestionAnswer::find($answerDetail->answer)->first()->answer;
                // $_answer = substr_replace(trim($_answer), "", -1);
            } else {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;

                $_answer = $answerDetail->answer;
                $notes = $answerDetail->notes;
            }


            //$_tasks["unit"]=;
            $_tasks["status"] = $task->status->status;
            $_tasks["detail"] = 'رقم المبنى : ' . $unit . ' - تعليق المفتش : ' . $_answer . ' - ' . $notes;
            $_tasks["Date"] = $Date->format('Y-m-d H:i:s');
            $_tasks["question"] = $title;
            $_tasks["task_id"] = $task->id;
            $_tasks["imageAnswer"] = $image;
            array_push($data, $_tasks);
        }
        $_data["data"]= ($data);

        return $_data;
    }

    function showTask($id)
    {
        $task = Task::where('id', $id)->first();
        $data = array();
        $answer_detail_id = $task->answer_detail_id;
        $answerDetail = AnswerDetail::where('id', $answer_detail_id)->first();
        $notes = $answerDetail->notes;
        $question_id = $answerDetail->question_id;
        $question = Question::where('id', $question_id)->first();
        $title = $question->question;
        $answer = Answer::find($answerDetail->answer_id)->first();
        $unit = '';
        $notes = '';
        $_answer = '';
        $Date = '';
        $image = '';
        $monitorNotes = '';
        $monitor_id = null;
        if ($question->type->multi_answer != 0) {
            $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
            $Date = $answer->created_at;
            // Concat Answers, Image, and notes for multi_Answer Questions
            // foreach ($answerDetail->where('question_id', $question->id) as $detail) {
            //     $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
            //     $notes .= $detail->notes;
            // }
            $_answer = QuestionAnswer::find($answerDetail->answer)->first()->answer;
            // $_answer = substr_replace(trim($_answer), "", -1);
        } else {
            $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
            $Date = $answer->created_at;

            $_answer = $answerDetail->answer;
            $notes = $answerDetail->notes;
            $image = $answerDetail->image;
        }


        //$_tasks["unit"]=;
        $_tasks["status"] = $task->status->id;
        $_tasks["detail"] = 'رقم المبنى : ' . $unit . ' - تعليق المفتش : ' . $_answer . ' - ' . $notes;
        $_tasks["Date"] = $Date->format('Y-m-d H:i:s');
        $_tasks["question"] = $title;
        $_tasks["task_id"] = $task->id;
        $_tasks["notes"] = $task->notes;
        $_tasks["image"] = $task->image;
        $_tasks["imageAnswer"] = $image;
        $_tasks["confirm"] = $task->confirm;
        $_task["monitorNotes"] = $task->monitorNotes;
        $_tasks["monitor_id"] = $monitor_id;
        array_push($data, $_tasks);
        return response()->json($data);
    }

    function update(Request $request)
    {
        $task = Task::where('id', $request['task_id'])->first();
        $image = $request['image'];
        $confirm = $request['confirm'];

        $status = $request['status'];

        if ($request['image'] != 'null' && !empty($image)) {
            $name = 'task' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $name);

            $task->update([
                'notes' => $request['notes'],
                'image' => $name,
                'confirm' => $request['confirm'],
                'status_id' => $status,
                'monitorNotes' => $request['monitorNotes'],
                'Monitor_id' => $request['monitor_id']
            ]);
        } else {

            $task->update([
                'notes' => $request['notes'],
                //'image'=>$name,
                'confirm' => $request['confirm'],
                'status_id' => $status,
                'monitorNotes' => $request['monitorNotes'],
                'Monitor_id' => $request['monitor_id']
            ]);
        }
        $taskLog = new TaskLog;
                $taskLog->task_id = $task->id;
                $taskLog->notes = $request["monitorNotes"];
                $taskLog->user_notes = $request['notes'];
                $taskLog->user_id = $request['monitor_id'];;
                $taskLog->save();
        return response()->json('success');
    }

    function completed_Hr()
    {
        // return $this->getCompletedTask('موارد بشرية', 1);
         return $this->getCompletedTask( 1, '2');
    }


    function completed_em()
    {
        // return $this->getCompletedTask('اماكن', 1)
        return $this->getCompletedTask(1, '5');
    }

    function getCompletedTask($category, $status){

        $tasks = Task::where('status_id', $status)->get();
        $data = array();
        foreach ($tasks as $task) {

            $answer_detail_id = $task->answer_detail_id;
            $answerDetail = AnswerDetail::where('id', $answer_detail_id)->first();
            $notes = $answerDetail->notes;
            $question_id = $answerDetail->question_id;
            $templates = Template::where('inspectiontype', $category)->pluck('id');
            // echo "templates";
            // print_r($templates);
            $question = Question::where('id', $question_id)->whereIn('template_id', $templates)->first();
            if($question == null) continue;
            $title = $question->question;
            $answer = Answer::where('id', $answerDetail->answer_id)->first();
            $unit = '';
            $nots = '';
            $_answer = '';
            $Date = '';
            if ($question->type->multi_answer != 0) {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
                $Date = $answer->created_at;
                // Concat Answers, Image, and notes for multi_Answer Questions
                // foreach ($answerDetail->where('question_id', $question->id) as $detail) {
                //     $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                //     $notes .= $detail->notes;
                // }
                $_answer = QuestionAnswer::find($answerDetail->answer)->first()->answer;
                // $_answer = substr_replace(trim($_answer), "", -1);
            } else {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
                $Date = $answer->created_at;

                $_answer = $answerDetail->answer;
                $notes = $answerDetail->notes;
            }


            //$_tasks["unit"]=;
            $_tasks["status"] = $task->status->status;
            $_tasks["detail"] = 'رقم المبنى : ' . $unit . ' - تعليق المفتش : ' . $_answer . ' - ' . $notes;
            $_tasks["Date"] = $Date->format('Y-m-d H:i:s');
            $_tasks["question"] = $title;
            $_tasks["task_id"] = $task->id;
            $_tasks['assign_user_id'] =  Admin::where('id', $task->assign_user_id)->first()->firstname . ' ' . Admin::where('id', $task->assign_user_id)->first()->lastname;
            array_push($data, $_tasks);
        }
        return response()->json($data);
    }

    function pending_Hr()
    {
        // return $this->getCompletedTask('موارد بشرية', 2);
        return $this->getCompletedTask( 2, '2');
    }


    function pending_em()
    {
        return $this->getCompletedTask(2, '3');
    }


    function notDone_Hr()
    {
        return $this->getCompletedTask(3, '2');
    }


    function notDone_em()
    {
        // return $this->getCompletedTask('اماكن', 3);
        return $this->getCompletedTask(3,'3');
    }
    /*
    function pending()
    {
        $tasks = Task::where('status_id', 2)->get();
        $data = array();

        foreach ($tasks as $task) {

            $answer_detail_id = $task->answer_detail_id;
            $answerDetail = AnswerDetail::where('id', $answer_detail_id)->first();
            $notes = $answerDetail->notes;
            $question_id = $answerDetail->question_id;
            $question = Question::where('id', $question_id)->first();
            $title = $question->question;
            $answer = Answer::where('id', $answerDetail->answer_id)->first();
            $unit = '';
            $nots = '';
            $_answer = '';
            $Date = '';
            if ($question->type->multi_answer != 0) {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
                $Date = $answer->created_at->format('Y-m-d H:i:s');
                // Concat Answers, Image, and notes for multi_Answer Questions
                // foreach ($answerDetail->where('question_id', $question->id) as $detail) {
                //     $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                //     $notes .= $detail->notes;
                // }
                $_answer = QuestionAnswer::find($answerDetail->answer)->first()->answer;
                // $_answer = substr_replace(trim($_answer), "", -1);
            } else {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
                $Date = $answer->created_at->format('Y-m-d H:i:s');

                $_answer = $answerDetail->answer;
                $notes = $answerDetail->notes;
            }


            //$_tasks["unit"]=;
            $_tasks["status"] = $task->status->status;
            $_tasks["detail"] = 'رقم المبنى : ' . $unit . ' - تعليق المفتش : ' . $_answer . ' - ' . $notes;
            $_tasks["Date"] = $Date;
            $_tasks["question"] = $title;
            $_tasks["task_id"] = $task->id;
            $_tasks['assign_user_id'] =  Admin::where('id', $task->assign_user_id)->first()->firstname . ' ' . Admin::where('id', $task->assign_user_id)->first()->lastname;
            array_push($data, $_tasks);
        }
        return response()->json($data);
    }
    function notdone()
    {
        $tasks = Task::where('status_id', 3)->get();
        $data = array();

        foreach ($tasks as $task) {

            $answer_detail_id = $task->answer_detail_id;
            $answerDetail = AnswerDetail::where('id', $answer_detail_id)->first();
            $notes = $answerDetail->notes;
            $question_id = $answerDetail->question_id;
            $question = Question::where('id', $question_id)->first();
            $title = $question->question;
            $answer = Answer::where('id', $answerDetail->answer_id)->first();
            $unit = '';
            $nots = '';
            $_answer = '';
            $Date = '';
            if ($question->type->multi_answer != 0) {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
                $Date = $answer->created_at->format('Y-m-d H:i:s');
                // Concat Answers, Image, and notes for multi_Answer Questions
                // foreach ($answerDetail->where('question_id', $question->id) as $detail) {
                //     $_answer .= QuestionAnswer::where('id', $detail->answer)->first()->answer . ", ";
                //     $notes .= $detail->notes;
                // }
                $_answer = QuestionAnswer::find($answerDetail->answer)->first()->answer;
                // $_answer = substr_replace(trim($_answer), "", -1);
            } else {
                $unit = Unit::where('id', $answer->unit_id)->first()->unit_number;
                $Date = $answer->created_at->format('Y-m-d H:i:s');

                $_answer = $answerDetail->answer;
                $notes = $answerDetail->notes;
            }


            //$_tasks["unit"]=;
            $_tasks["status"] = $task->status->status;
            $_tasks["detail"] = 'رقم المبنى : ' . $unit . ' - تعليق المفتش : ' . $_answer . ' - ' . $notes;
            $_tasks["Date"] = $Date->format('Y-m-d H:i:s');
            $_tasks["question"] = $title;
            $_tasks["task_id"] = $task->id;
            $_tasks['assign_user_id'] =  Admin::where('id', $task->assign_user_id)->first()->firstname . ' ' . Admin::where('id', $task->assign_user_id)->first()->lastname;
            array_push($data, $_tasks);
        }
        return response()->json($data);
    }
    */
}
