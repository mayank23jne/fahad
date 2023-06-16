<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredProperty;
use App\Models\RegisteredField;
class RegisteredPropertyController extends Controller
{
    public function showRegisteredProperty(Request $request){
        $registeredproperty = RegisteredProperty::where('is_deleted','0')->where('user_id', $request->user_id)->get();
        return response()->json($registeredproperty); 
    }
    
    function archiveRegisteredProperty(Request $request){
        $registeredproperty = RegisteredProperty::where('is_deleted', $request->val)->where('user_id', $request->user_id)->get();
        return response()->json($registeredproperty);
    }
    
    public function store(Request $request){
        $registeredproperty = new RegisteredProperty;
         $registeredproperty->building_no = $request->building_number;
           $registeredproperty->building_name = $request->building_name;
             $registeredproperty->owner = $request->owner;
               $registeredproperty->client_id = $request->client_id;
         $registeredproperty->permitno = $request->permitno;
         $registeredproperty->representative = $request->representative;
          $registeredproperty->unitid = $request->unittype;
          $registeredproperty->user_id = $request->user_id;
        $registeredproperty->save();
        foreach ($request->fields as $field) {
                 $registeredfield = new RegisteredField;
                    $registeredfield->registered_id = $registeredproperty->id;
                    $registeredfield->property_list = $field['list'];
                     $registeredfield->no_of_people = $field['noofpeople'];
                      $registeredfield->user_id = $request->user_id;
                    $registeredfield->save();
                }
        
        return response()->json($registeredproperty,200);
    }

    public function update(Request $request){
     $registeredproperty = RegisteredProperty::find($request["id"]);
     
      $RegisteredField = RegisteredField::where('registered_id',  $registeredproperty["id"])->get();
      
     if (count($RegisteredField) > 0) { 
            RegisteredField::where('registered_id',  $registeredproperty["id"])->delete();
        }
          $registeredproperty->building_no = $request->building_number;
          $registeredproperty->building_name = $request->building_name;
         $registeredproperty->owner = $request->owner;
           $registeredproperty->client_id = $request->client_id;
         $registeredproperty->permitno = $request->permitno;
         $registeredproperty->representative = $request->representative;
          $registeredproperty->unitid = $request->unittype;
          $registeredproperty->user_id = $request->user_id;
            $registeredproperty->user_id = $request->user_id;
        $registeredproperty->save();
        foreach ($request->fields as $field) {
                 $registeredfield = new RegisteredField;
                    $registeredfield->registered_id = $registeredproperty->id;
                    $registeredfield->property_list = $field['property_list'];
                     $registeredfield->no_of_people = $field['no_of_people'];
                      $registeredfield->user_id = $request->user_id;
                    $registeredfield->save();
                }
        return response()->json($registeredproperty,200);
    }
    
    public function showRegisteredFieldbyProperty(Request $request){
        $registeredfield = RegisteredField::where('registered_id',$request->id)->where('user_id',$request->user_id)->get();
        return response()->json($registeredfield);
    }
    
    
    public function showRegisteredPropertyId(Request $request){
        $registeredproperty = RegisteredProperty::where('id',$request->id)->where('user_id',$request->user_id)->get();
        return response()->json($registeredproperty);
    }
    
    
    public function showRegisteredPropertyunitid(Request $request){
        $registeredproperty = RegisteredProperty::where('unitid',$request->id)->get();
        return response()->json($registeredproperty);
    }
    
    public function destroy(RegisteredProperty $registeredproperty, $id)
    {
        $registeredproperty->findOrFail($id)
            ->delete();
            
             $RegisteredField = RegisteredField::where('registered_id',  $id)->get();
      
     if (count($RegisteredField) > 0) { 
            RegisteredField::where('registered_id',  $id)->delete();
        }
        
        return response()->json("registeredproperty type has been deleted");
    }
    
    function changeStatus(Request $request){
        $registeredproperty = RegisteredProperty::find($request->id);
        $registeredproperty->status = $request->status;
        $registeredproperty->save();
       
        return response()->json("status has been updated successfully");
    }
    
    function isDelete(Request $request){
        $registeredproperty = RegisteredProperty::find($request->id);
        $registeredproperty->is_deleted = $request->delete;
        $registeredproperty->save();
       
        return response()->json("data has been archive successfully");
    }
    
     public function showRegisteredFieldId(Request $request){
        $RegisteredField = RegisteredField::where('registered_id',  $request->id)->get();
        return response()->json($RegisteredField);
    }
    
     public function showRegisteredFieldbyId(Request $request){
        $RegisteredField = RegisteredField::where('id',  $request->id)->get();
        return response()->json($RegisteredField);
    }
    
    public function showRegisteredFields(){
        $RegisteredField = RegisteredField::all();
        return response()->json($RegisteredField); 
    }
    
}
