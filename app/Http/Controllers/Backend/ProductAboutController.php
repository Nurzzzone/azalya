<?php

namespace App\Http\Controllers\Backend;

use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateAboutRequest;
use App\Models\ProductAbout;

class ProductAboutController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = ProductAbout::class;
    protected const THEADERS = ['fields.id', 'fields.name'];
    protected const UPLOAD_PATH = "product\\about\\";
    protected $route;

    public function __construct()
    {
        $this->route = 'product.about';
    }

    /**
     * @param  ProductAbout $about
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAbout $about)
    {
        $about = ProductAbout::first();
        return view("backend.pages.{$this->route}.show", compact('about'));
    }

    /**
     * @param  ProductAbout $about
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAbout $about)
    {
        return view("backend.pages.{$this->route}.edit", compact('about'));
    }

    /**
     * @param  UpdateCategoryRequest $request
     * @param  ProductAbout $about
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutRequest $request, ProductAbout $about)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $about->image, self::UPLOAD_PATH);
            $about->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
