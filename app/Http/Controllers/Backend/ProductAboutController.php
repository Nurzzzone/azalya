<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateAboutRequest;
use App\Http\Requests\Product\UpdateAboutRequest;
use App\Models\ProductAbout;

class ProductAboutController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = ProductAbout::class;
    protected const THEADERS = ['fields.id', 'fields.name'];
    protected $route;

    public function __construct()
    {
        $this->route = 'product.about';
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.pages.{$this->route}.index", 
        [
            'about' => (self::MODEL)::paginate(10),
            'theaders' => self::THEADERS
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = self::MODEL;
        return view("backend.pages.{$this->route}.create", ['about' => new $model()]);
    }

    /**
     * @param  CreateAboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAboutRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  ProductAbout $about
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAbout $about)
    {
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
            $about->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  ProductAbout $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAbout $about, Request $request)
    {
        try {
            $about->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
