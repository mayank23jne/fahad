<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use App\Models\Admin;
use App\Models\Unit;
use App\Models\Role;
use App\Models\Company;
use App\Models\Permission;
use App\Models\UsersPermission;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

use phpDocumentor\Reflection\Types\Boolean;

class ClientController extends Controller
{
    function showClients($id){
        $client_id = Unit::where('id', $id)->first()->client_id;

        //return $client_id;
        $data = array();
        //$client = admin::where('id', $client_id)->get();
        $clients = admin::where('id', $client_id)->orWhere('role_id','>',5)->orderBy('role_id','asc')->get();
        $_data["data"]=array();
        foreach($clients as $client){
            $data["id"] = $client->id;
            $data["firstname"] =  Role::where('id', $client->role_id)->first()->role_name;
            $data["lastname"] = '- ' . $client->firstname . ' ' . $client->lastname;
            array_push($_data["data"],$data);
        }
        return $_data;
        return new ClientResource($clients);
    }

    function showClientsData(){

        //return $client_id;
        $data = array();
        //$client = admin::where('id', $client_id)->get();
        $_data["data"]=array();

        
        $pdata = $this->paginate($_data);
        return $pdata;
        // return $_data;
        // return new ClientResource($clients);

    }

    function showUnitClients(){

        //return $client_id;

        $clients = admin::where('role_id',5)->get();

        //return $_data;
        return new ClientResource($clients);
    }

    function store(Request $request){
        return $request;
    }

    
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $url = url('/') . '/api/showClientsData';
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $_data["data"]=array();
        $_data["current_page"] = $page;
        $_data["first_page_url"]=  "/?page=1";
        $total = ceil(count(Admin::all())/15);
        $_data["next_page_url"]= $total <= $page ? null : "/?page=".$page+1;
        $_data["path"] =  $url;
        $_data["prev_page_url"]= $page ==1 ? null : "/?page=".$page-1;
        
        $_data["total"]= $total;
        $_data["Count"]= count(Admin::all());
        $clients= Admin::skip(($page-1) * 15)->take(15)->get();
        foreach($clients as $client){
            $data["id"] = $client->id;
            $data["role"] =  Role::where('id', $client->role_id)->first()->role_name;
            
            if ( $client->company_id != null)
            $data["company"] =  Company::where('id', $client->company_id)->first()->company_id;
            $data["lastname"] = $client->lastname;
            $data["firstname"] =  $client->firstname;
            $data["email"] = $client->email;
            $data["mobile"] = $client->mobile;
            $data["nationality"]=$client->nationality;
            array_push($_data["data"],$data);
        }
        return $_data;
        // // printf(' ' . count($_data["data"]));
        // // return;

        // $items = $items instanceof Collection ? $items : Collection::make($items);
        // return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
