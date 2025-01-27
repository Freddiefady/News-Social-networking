<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResoucre extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data =  [  
            'id' => $this->id,
            'title'=>$this->title,
            'slug'=>$this->slug,
            'num_of_views'=>$this->num_of_views,
            'status'=>$this->status(),
            'date'=>$this->created_at->format('y-m-d'),
            'publisher'=>$this->user_id == null ?  new AdminResource($this->admin) : new UserResource($this->user),
            'media'=>ImagesResource::collection($this->images),
            'category_name'=>$this->category->name,
        ];

        if($request->is('api/posts/show/*'))
        {
            $data['description'] = $this->description;
            $data['comment_able'] = $this->comment_able == 1 ? "Commentable" : "Not Commentable";
            $data['category'] = new CategoryResource($this->category);
        }
        return $data;
    }
}
