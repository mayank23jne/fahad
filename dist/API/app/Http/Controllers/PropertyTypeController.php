<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;
class PropertyTypeController extends Controller
{
    function shoWPropertyTypes(Request $request){
        $propertyTypes = PropertyType::where('is_deleted','0')->where('user_id',$request->user_id)->get();
        return response()->json($propertyTypes);
    }
    
    function archivePropertyTypes(Request $request){
        $propertyTypes = PropertyType::where('is_deleted', $request->val)->where('user_id', $request->user_id)->get();
        return response()->json($propertyTypes);
    }
    
    function store(Request $request){
        $propertyType = new PropertyType;
        $propertyType->name_en = $request->name_en;
         $propertyType->name_ar = $request->name_ar;
          $propertyType->user_id = $request->user_id;
        $propertyType->save();
        return response()->json($propertyType,200);
    }
    
    function update(Request $request){
      //  $industryType = IndustryType::where('id',  $request["id"])->get();
     $propertyType = PropertyType::find($request["id"]);
    // print_r($request->name_en);die;
        $propertyType->name_en = $request->name_en;
         $propertyType->name_ar = $request->name_ar;
         $propertyType->user_id = $request->user_id;
        $propertyType->save();
        return response()->json($propertyType,200);
    }
    
    function showPropertyTypeId(Request $request){
$propertyType = PropertyType::where('user_id',$request->user_id)->where('id',$request->id)->get();
        return response()->json($propertyType);
    }
    
    public function destroy(PropertyType $propertyType,$id)
    {
        $propertyType->findOrFail($id)
            ->delete();
        return response()->json("industry type has been deleted");
    }
    
    function changeStatus(Request $request){
        $propertyType = PropertyType::find($request->id);
        $propertyType->status = $request->status;
        $propertyType->save();
       
        return response()->json("status has been updated successfully");
    }
    
    function isDelete(Request $request){
        $propertyType = PropertyType::find($request->id);
        $propertyType->is_deleted = $request->delete;
        $propertyType->save();
       
        return response()->json("data has been archive successfully");
    }
}
