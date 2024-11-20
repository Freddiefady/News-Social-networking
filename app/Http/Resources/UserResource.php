<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'user_name'=>$this->name,
            'user_status'=>$this->status(),
            'date'=>$this->created_at->diffForHumans(),
        ];
        if ($request->is('api/user')){
            $data['user_id'] = $this->id;
            $data['email'] = $this->email;
            $data['user_image'] = asset($this->image);
            $data['username'] = $this->username;
            $data['phone'] = $this->phone;
            $data['city'] = $this->city;
            $data['country'] = $this->country;
            $data['street'] = $this->street;
        }
        return $data;
    }
}
