<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use App\Models\UnitType;
use App\Models\Admin;
use App\Models\Company;

class UnitController extends Controller
{
    function showUnits()
    {
        $units = Unit::orderBy('id','desc')->get();
        $_data = [];
        $_data["data"] = array();
        foreach ($units as $unit) {
            $client = Admin::where('id', $unit->client_id)->first();
            $unitType = UnitType::find($unit->unitType_id);
            $data['id'] = $unit->id;
            $data['unit_number'] = $unit->unit_number . ' - ' . $unitType->type . ' - ' . $unit->nationality;
            $data['unit_type'] = $unitType->type;
            if($unit->client_id != null){
            $data['client_id'] = $unit->client_id;
            $data['client_name'] = $client->firstname . ' ' . $client->lastname;}else{
                $data['client_id'] = NULL;
                $data['client_name'] = NULL;
            }
            $data['building_number'] = $unit->building_number . ' - ' . $unit->unit_number . ' - ' . $unitType->type . ' - ' . $unit->nationality;
            
            $data['permissions'] = $unit->permissions;
            $data['pilgrims'] = $unit->pilgrims;
            $data['nationality']=$unit->nationality;
            $company = Company::find($unit->company);
        // return $company;
        if($company != null){
            $data['company'] = $company->company_name;
        }
            $data['image'] = $unit->image;
            array_push($_data["data"], $data);
        }
        // return $units['type_id'];
        return response()->json($_data);
    }

    function showUnit($id)
    {
        //$unit = Unit::with('user:id,firstname,lastname')->where('id', $id)->first();
        $unit = Unit::where('id', $id)->first();
        // return response()->json($unit);
        $user = '';
        if($unit->client_id != null){
        $user = array(
            "id" => $unit->user->id,
            "firstname" => $unit->user->firstname,
            "lastname" => $unit->user->lastname,
        );
        }
        $_data = [];
        $_data["data"] = array();
        $unitType = UnitType::find($unit->unitType_id);
        $data['id'] = $unit->id;
        $data['unit_number'] = $unit->unit_number . ' - ' . $unitType->type . ' - ' . $unit->nationality;
        $data['client_id'] = $unit->client_id;
        $data['building_number'] = $unit->building_number . ' - ' . $unit->unit_number . ' - ' . $unitType->type . ' - ' . $unit->nationality;
        $data['permissions'] = $unit->permissions;
        $data['pilgrims'] = $unit->pilgrims;
        $data['nationality']=$unit->nationality;
        $data['image'] = $unit->image;
        $data['user'] = $user;



        $company = Company::where('id',$unit->company)->first();
        // return $company;
        if($company != null){
            $data['company'] = $company->company_name;
        }else{
            $data['company']= '';
        }
        array_push($_data["data"], $data);
        return response()->json($_data);
    }

    function ShowUnitDetail($id)
    {
        $data = Unit::where('id', $id)->first();
        return response()->json($data);
    }

    function store(Request $request)
    {

        //if(!isEmptyOrNullString($request['unit_id'])){
        $unit = Unit::where('unit_number', $request['unit_id'])->first();
        // return $unit;
        if ($unit == null || empty($unit)) {
            $unit = new Unit();
        }
        $unit->unit_number = $request->unit_id;
        $unit->nationality = $request->nationnality;
        if($request->client_id != null && $request->client_id != 'null'){
        $unit->client_id = $request->client_id;
        }
        $unit->building_number = $request->bulding_number;
        $unit->permissions = $request->declaration;
        $unit->pilgrims = $request->pilgrims;
        if($request->company!= null && $request->company != 'null'){
        $unit->company = $request->company;
        }
        $image = $request->image;
        //print_r($image->getClientOriginalExtension());
        if (!empty($image) || $image != null) {
            $name = $request->unit_id . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $name);


            // $q['image']->store('uploads');
            $unit->image = $name;
        }
        $unit->unitType_id = $request->unitType_id;
        $unit->save();
        return response()->json("unit created ");
    }
}
