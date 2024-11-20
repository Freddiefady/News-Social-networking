<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'category_name'=>$this->name,
            'category_slug'=>$this->slug,
            'status'=>$this->status(),
            'date'=>$this->created_at->format('Y-m-d'),
        ];
        if(!$request->is('api/posts/show/*') && $request->is('categories'))
        {
            $data['posts'] = PostsResoucre::collection($this->posts);
        }
        return $data;
    }
}
