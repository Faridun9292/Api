<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'initials' => $this?->initials,
            'company' => $this->company,
            'phone' => $this->phone,
            'email' => $this->email,
            'birthday' => $this->birthday?->format('m-d-Y'),
            'photo' => $this->photo,
        ];
    }
}
