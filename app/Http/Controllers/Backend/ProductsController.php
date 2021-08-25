<?php

namespace App\Http\Controllers\Backend;

use App\Models\Size;
use App\Models\Type;
use App\Models\Format;
use App\Models\Product;
use App\Traits\HasFile;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductsController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = Product::class;
    protected const UPLOAD_PATH = "product\\products\\";

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.products.index', 
            ['products' => (self::MODEL)::paginate(10)]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::pluck('name', 'id');
        $formats = Format::pluck('name', 'id');
        $sizes = Size::pluck('name', 'id');
        $types = Type::pluck('name', 'id');
        return view('backend.pages.products.create', 
            compact('product', 'categories', 'formats', 'sizes', 'types'));
    }

    /**
     * @param  CreateProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductRequest $request)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->uploadFile($request['image'], self::UPLOAD_PATH);
            $product = (self::MODEL)::create($data);
            $product->sizes()->attach($data['size'] ?? [Size::where('slug', 's')->first()->id]);
            $product->formats()->attach($data['format'] ?? [Format::where('slug', 'lenta')->first()->id]);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backend.products.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('backend.pages.products.show', 
            compact('product'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id');
        $formats = Format::pluck('name', 'id');
        $sizes = Size::pluck('name', 'id');
        $types = Type::pluck('name', 'id');
        return view('backend.pages.products.edit', 
            compact('product', 'categories', 'formats', 'sizes', 'types'));
    }

    /**
     * @param  UpdateProductRequest  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $product->image, self::UPLOAD_PATH);
            $product->update($data);
            $product->formats()->sync($data['format'] ?? []);
            $product->sizes()->sync($data['size'] ?? []);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backend.products.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        try {
            $product->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backend.products.index');
    }
}
