<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitType;
class UnitTypeController extends Controller
{
    function shoWUnitsTypes(){
        $unitTypes = UnitType::where('is_deleted','0')->orderBy('id', 'DESC')->get();
        return response()->json($unitTypes);
    }
    
    function archiveUnitsTypes(Request $request){
        $unitTypes = UnitType::where('is_deleted', $request->val)->get();
        return response()->json($unitTypes);
    }
    
    function store(Request $request, UnitType $UnitType){
        
        $data = $request->validate([
            "type"=>"required|unique:unit_types,type"
        ]);
        
        $unitType = new UnitType;
        $unitType->type = $request->type;
        $unitType->type_en = $request->type_en;
        $unitType->save();
        return response()->json($unitType,200);
    }
    
    function update(Request $request){
     $unitType = UnitType::find($request["id"]);
        $unitType->type = $request->unit_type_ar;
        $unitType->type_en = $request->unit_type_en;
        $unitType->save();
        return response()->json($unitType,200);
    }
    
    function showUnitsTypesId(Request $request){
$unitType = UnitType::where('id',$request->id)->get();
        return response()->json($unitType);
    }
    
    public function destroy(UnitType $UnitType,$id)
    {
        $UnitType->findOrFail($id)
            ->delete();
        return response()->json("industry type has been deleted");
    }
    
    function changeStatus(Request $request){
        $unitType = UnitType::find($request->id);
        $unitType->status = $request->status;
        $unitType->save();
       
        return response()->json("status has been updated successfully");
    }
    
    function isDelete(Request $request){
        $unitType = UnitType::find($request->id);
        $unitType->is_deleted = $request->delete;
        $unitType->save();
       
        return response()->json("data has been archive successfully");
    }
}
