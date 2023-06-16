<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskLog;
use App\Models\Exception as ExceptionModel;
class TaskMobileController extends Controller
{
    function update(Request $request)
    {
        $task = Task::where('id', $request['templateId'])->first();
        $image = $request['image'];
        $confirm = $request['confirm'];

        $status = $request['status_id'];

        if ($request['image'] != 'null' && !empty($image)) {
            try{
            
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
            }catch(\Error $e){
                    $exception = new ExceptionModel();
                    $exception->exception = $e->getMessage();
                    $exception->api = $request->server('REQUEST_URI');
                    $exception->save();
                    return $e->getMessage();
                }
        } else {
                $task->update([
                    'notes' => $request['notes'],
                    // 'image'=>'',
                    'confirm' => $request['confirm'],
                    'status_id' => $status,
                    'monitorNotes' => $request['monitorNotes'],
                    'Monitor_id' => $request['monitor_id']
                ]);
                if(!$task){
                    return 'error';
                }
        }
        // $taskLog = new TaskLog;
        //         $taskLog->task_id = $task->id;
        //         $taskLog->notes = $request["monitorNotes"];
        //         $taskLog->user_notes = $request['notes'];
        //         $taskLog->user_id = $request['monitor_id'];;
        //         $taskLog->save();
        return response()->json('success');
    }
}
