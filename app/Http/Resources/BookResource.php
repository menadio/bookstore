<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'author'    => $this->author,
            'user'      => $this->user,
            'rated'    => $this->ratings->avg('rating'),
            'ratings'    => RatingResource::collection($this->ratings)
        ];
    }
}
