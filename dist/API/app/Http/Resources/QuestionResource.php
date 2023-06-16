<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'id'=> $this->id,
            'question'=>$this->question,
            'type_id'=>$this->type_id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'template_id'=>$this->template_id
        ];
    }
}
