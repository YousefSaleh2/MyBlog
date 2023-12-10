<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id'           => $this->id,
            'category_id'  => $this->category_id,
            'user_id'      => $this->user_id,
            'image'        => asset('imgs/' .$this->image),
            'title'        => $this->title,
            'content'      => $this->content,
            'smallDesc'    => $this->smallDesc,
            'tag'          => $this->tag
        ];
    }
}
