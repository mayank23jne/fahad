<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
class CompanyController extends Controller
{
    function showCompanies(){
        $company = Company::all();
        return response()->json($company);
    }
    function store(Request $request){
        $company = new Company;
        $company->company_name = $request->company_name;
        $company->save();
        return response()->json($company,200);
    }
}
