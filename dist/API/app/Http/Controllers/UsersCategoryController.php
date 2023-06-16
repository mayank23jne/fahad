<?php

namespace App\Http\Controllers;

use App\Models\UsersCategory;
use Illuminate\Http\Request;

class UsersCategoryController extends Controller
{

    public function store(Request $request, UsersCategory $UsersCategory)
    {
        $data = $request->validate([
            "category"=>"required|unique:users_categories,category"
        ]);
        
        $UsersCategory = new UsersCategory;
        $UsersCategory->category = $request->category;
        $UsersCategory->category_en = $request->category_en;
        $UsersCategory->save();
        return response()->json($UsersCategory,200);
        
        // $UsersCategory->create($data);
        // print_r($UsersCategory);
        // return response()->json($UsersCategory);
    }

    public function show(UsersCategory $UsersCategory)
    {
        return response()->json($UsersCategory->where('is_deleted','0')->get());
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "category"=>"required|unique:users_categories,category",
        ]);
        
        $UsersCategory = UsersCategory::find($id);
        $UsersCategory->category = $request->category;
        $UsersCategory->category_en = $request->category_en;
        $UsersCategory->save();
        return response()->json($UsersCategory,200);
        // $UsersCategory->findOrFail($id)
        //     ->update($data);
        // return response()->json($UsersCategory);
    }

    public function destroy(UsersCategory $UsersCategory,$id)
    {
        $UsersCategory->findOrFail($id)
            ->delete();
        return response()->json("user category has been deleted");
    }
    
    function showbyId(Request $request){
      $UsersCategory = UsersCategory::find($request->id);
        return response()->json($UsersCategory);
    }
    
    function changeStatus(Request $request){
        $UsersCategory = UsersCategory::find($request->id);
        $UsersCategory->status = $request->status;
        $UsersCategory->save();
       
        return response()->json("status has been updated successfully");
    }
    
    function isDelete(Request $request){
        $UsersCategory = UsersCategory::find($request->id);
        $UsersCategory->is_deleted = $request->delete;
        $UsersCategory->save();
       
        return response()->json("data has been archive successfully");
    }
    
     function archive(Request $request){
        $UsersCategory = UsersCategory::where('is_deleted', $request->val)->get();
        return response()->json($UsersCategory);
    }
    
}
