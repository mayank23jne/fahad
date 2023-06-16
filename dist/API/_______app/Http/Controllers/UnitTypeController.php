<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitType;
class UnitTypeController extends Controller
{
    function shoWUnitsTypes(){
        $unitTypes = UnitType::all();
        return response()->json($unitTypes);
    }
    function store(Request $request){
        $unitType = new UnitType;
        $unitType->type = $request->unit_type;
        $unitType->save();
        return response()->json($unitType,200);
    }
}
