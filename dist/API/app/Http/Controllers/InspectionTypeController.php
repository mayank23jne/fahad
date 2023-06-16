<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InspectionType;
class InspectionTypeController extends Controller
{
    public function shoWInspectionTypes(Request $request){
        $inspectionType = InspectionType::where('is_deleted','0')->where('user_id', $request->user_id)->get();
        return response()->json($inspectionType);
    }
    
    function archiveInspectionTypes(Request $request){
        $inspectionType = InspectionType::where('is_deleted', $request->val)->where('user_id', $request->user_id)->get();
        return response()->json($inspectionType);
    }
    
    public function store(Request $request){
        $inspectionType = new InspectionType;
        $inspectionType->name_en = $request->name_en;
         $inspectionType->name_ar = $request->name_ar;
         $inspectionType->user_id = $request->user_id;
        $inspectionType->save();
        return response()->json($inspectionType,200);
    }
    
    public function update(Request $request){
     $inspectionType = InspectionType::find($request["id"]);
        $inspectionType->name_en = $request->name_en;
         $inspectionType->name_ar = $request->name_ar;
         $inspectionType->user_id = $request->user_id;
        $inspectionType->save();
        return response()->json($inspectionType,200);
    }
    
    public function showInspectionTypeId(Request $request){
        $inspectionType = InspectionType::where('id',$request->id)->get();
        return response()->json($inspectionType);
    }
    
    public function destroy(InspectionType $inspectionType, $id)
    {
        $inspectionType->findOrFail($id)
            ->delete();
        return response()->json("industry type has been deleted");
    }
    
    function changeStatus(Request $request){
        $inspectionType = InspectionType::find($request->id);
        $inspectionType->status = $request->status;
        $inspectionType->save();
       
        return response()->json("status has been updated successfully");
    }
    
     function isDelete(Request $request){
        $inspectionType = InspectionType::find($request->id);
        $inspectionType->is_deleted = $request->delete;
        $inspectionType->save();
       
        return response()->json("data has been archive successfully");
    }
    
    public function showAllInspectionTypes(){
        $inspectionType = InspectionType::where('is_deleted','0')->where('status', '1')->get();
        return response()->json($inspectionType);
    }
    
     public function showInspectionTypeById(Request $request){
        $inspectionType = InspectionType::where('id',$request->id)->where('status','1')->get();
        return response()->json($inspectionType);
    }
}
