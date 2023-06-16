<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"=>$this->id,
            "company_name"=>$this->company_name,
             "status"=>$this->status,
              "is_deleted"=>$this->is_deleted,
            // "created_at"=>$this->created_at,
            ];
    }
}