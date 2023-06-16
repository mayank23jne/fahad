<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndustryType;
class IndustryTypeController extends Controller
{
    function shoWIndustryTypes(Request $request){
        $industryTypes = IndustryType::where('is_deleted','0')->where('user_id',$request->user_id)->get();
        return response()->json($industryTypes);
    }
    
    function archiveIndustryTypes(Request $request){
        $industryTypes = IndustryType::where('is_deleted', $request->val)->where('user_id', $request->user_id)->get();
        return response()->json($industryTypes);
    }
    
    function store(Request $request){
        $industryType = new IndustryType;
        $industryType->name_en = $request->name_en;
         $industryType->name_ar = $request->name_ar;
          $industryType->user_id = $request->user_id;
        $industryType->save();
        return response()->json($industryType,200);
    }
    
    function update(Request $request){
      //  $industryType = IndustryType::where('id',  $request["id"])->get();
     $industryType = IndustryType::find($request["id"]);
    // print_r($request->name_en);die;
        $industryType->name_en = $request->name_en;
         $industryType->name_ar = $request->name_ar;
         $industryType->user_id = $request->user_id;
        $industryType->save();
        return response()->json($industryType,200);
    }
    
    function showIndustryTypeId(Request $request){
$industryType = IndustryType::where('user_id',$request->user_id)->where('id',$request->id)->get();
        return response()->json($industryType);
    }
    
    public function destroy(IndustryType $IndustryType,$id)
    {
        $IndustryType->findOrFail($id)
            ->delete();
        return response()->json("industry type has been deleted");
    }
    
    function changeStatus(Request $request){
        $IndustryType = IndustryType::find($request->id);
        $IndustryType->status = $request->status;
        $IndustryType->save();
       
        return response()->json("status has been updated successfully");
    }
    
    function isDelete(Request $request){
        $IndustryType = IndustryType::find($request->id);
        $IndustryType->is_deleted = $request->delete;
        $IndustryType->save();
       
        return response()->json("data has been archive successfully");
    }
}
