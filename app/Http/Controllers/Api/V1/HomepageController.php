<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Benefit;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomepageCard;
use App\Models\HomepageAbout;
use App\Models\HomepageSlider;
use App\Http\Controllers\Api\V1\Controller;
use App\Traits\HasJsonResponse;

class HomepageController extends Controller
{
    use HasJsonResponse;

    /**
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        return $this->sendSuccessMessage([
            'slider' => HomepageSlider::all(),
            'benefits' => Benefit::inHome()->get(['name', 'image']),
            'cards' => HomepageCard::all(),
            'categories' => Category::inHome()->get(['name', 'slug']),
            'products' => Product::inHome()->paginate(6, ['name', 'image', 'price', 'discount', 'description', 'in_stock', 'is_popular', 'formats', 'sizes']),
            'about' => HomepageAbout::first(),
        ]);
    }
}
