<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Benefit;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomepageCard;
use App\Models\HomepageAbout;
use App\Models\HomepageSlider;
use App\Traits\HasJsonResponse;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Resources\ProductCollection;

class HomepageController extends Controller
{
    use HasJsonResponse;

    /**
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        return $this->sendSuccessMessage([
            'slider' => HomepageSlider::all(['name', 'description', 'image']),
            'benefits' => Benefit::inHome()->get(['name', 'image']),
            'cards' => HomepageCard::all(['name', 'image']),
            'categories' => Category::inHome()->get(['name', 'slug']),
            'products' => (new ProductCollection(Product::inHome()->take(6)->get())),
            'about' => HomepageAbout::first(['name', 'description', 'image']),
        ]);
    }
}
