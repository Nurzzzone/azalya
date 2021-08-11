<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'price' => $this->price,
            'discount' => $this->discount,
            'description' => $this->description,
            'in_stock' => $this->in_stock,
            'is_popular' => $this->is_popular,
            'in_homepage' => $this->in_homepage,
            'category' => ['name' => $this->category->name, 'slug' => $this->category->slug],
            'formats' => $this->formats()->get(['name', 'slug']),
            'sizes' => $this->sizes()->get(['name', 'slug'])
        ];
    }
}
