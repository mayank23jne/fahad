<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifcation;
use Illuminate\Support\Facades\Auth;

class NotifcationController extends Controller
{

    public function all_notifcation(Request $request)
    {
        $notifcations=Notifcation::where('reciver_id',$request->id)->where('read_at',null)->get();
        return response()->json($notifcations,200);
    }
    public function read_all_notifcations(Request $request)
    {

        $notifcations=Notifcation::where('reciver_id',$request->id)->where('read_at',null)->get();

        foreach($notifcations as $noft)
        {
            $noft->update([
                "read_at"=>date('Y-m-d H:i:s')
               ]);

        }
        return response()->json("read_all",200);


    }




}
