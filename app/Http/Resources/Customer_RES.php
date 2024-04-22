<?php

namespace App\Http\Resources;

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;

class Customer_RES extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'name' => $this->name,
            'email'=> $this->email,
            'phonenumber' =>$this->phonenumber,
            'address' =>$this->address,
        ];
    }
}
