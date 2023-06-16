<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InspectionProperty;
class InspectionPropertyController extends Controller
{
    public function showInspectionProperty(Request $request){
        $inspectionType = InspectionProperty::where('is_deleted','0')->where('user_id', $request->user_id)->get();
        return response()->json($inspectionType); 
    }
    
    function archiveInspectionProperty(Request $request){
        $inspectionType = InspectionProperty::where('is_deleted', $request->val)->where('user_id', $request->user_id)->get();
        return response()->json($inspectionType);
    }
    
    public function store(Request $request){
        $inspectionType = new InspectionProperty;
        $inspectionType->propertyname_en = $request->name_en;
         $inspectionType->propertyname_ar = $request->name_ar;
         $inspectionType->owner = $request->owner;
         $inspectionType->industry_type = $request->industry_type;
           $inspectionType->user_id = $request->user_id;
        $inspectionType->save();
        return response()->json($inspectionType,200);
    }
    
    public function update(Request $request){
     $inspectionType = InspectionProperty::find($request["id"]);
         $inspectionType->propertyname_en = $request->name_en;
         $inspectionType->propertyname_ar = $request->name_ar;
         $inspectionType->owner = $request->owner;
         $inspectionType->industry_type = $request->industry_type;
         $inspectionType->user_id = $request->user_id;
        $inspectionType->save();
        return response()->json($inspectionType,200);
    }
    
    public function showInspectionPropertyId(Request $request){
        $inspectionType = InspectionProperty::where('id',$request->id)->where('user_id',$request->user_id)->get();
        return response()->json($inspectionType);
    }
    
    public function destroy(InspectionProperty $inspectionProperty, $id)
    {
        $inspectionProperty->findOrFail($id)
            ->delete();
        return response()->json("industry type has been deleted");
    }
    
    function changeStatus(Request $request){
        $inspectionType = InspectionProperty::find($request->id);
        $inspectionType->status = $request->status;
        $inspectionType->save();
       
        return response()->json("status has been updated successfully");
    }
    
    function isDelete(Request $request){
        $inspectionType = InspectionProperty::find($request->id);
        $inspectionType->is_deleted = $request->delete;
        $inspectionType->save();
       
        return response()->json("data has been archive successfully");
    }
}
