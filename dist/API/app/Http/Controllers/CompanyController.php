<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    function showCompanies(){
        $company = Company::where('is_deleted','0')->get();
        return CompanyResource::collection($company);
    }
    
    function store(Request $request){
        $company = new Company;
        $company->company_name = $request->company_name;
        $company->save();
        return response()->json($company,200);
    }
    
    function archiveCompany(Request $request){
        $company = Company::where('is_deleted', $request->val)->get();
        return CompanyResource::collection($company);
    }
    
      function update(Request $request){
     $company = Company::find($request["id"]);
        $company->company_name = $request->company_name;
        $company->save();
        return response()->json($company,200);
    }
    
    function showCompanyId($id){
        $company = Company::find($id);
        return response()->json($company);
    }
    
    public function destroy(Company $Company,$id)
    {
        $Company->findOrFail($id)
            ->delete();
        return response()->json("industry type has been deleted");
    }
    
    function changeStatus(Request $request){
        $company = Company::find($request->id);
        $company->status = $request->status;
        $company->save();
       
        return response()->json("status has been updated successfully");
    }
    
    function isDelete(Request $request){
        $company = Company::find($request->id);
        $company->is_deleted = $request->delete;
        $company->save();
       
        return response()->json("data has been archive successfully");
    }
}
