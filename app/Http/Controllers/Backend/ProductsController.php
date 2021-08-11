<?php

namespace App\Http\Controllers\Backend;

use App\Models\Size;
use App\Models\Format;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductsController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Product::class;

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
        return view('backend.pages.products.create', 
            compact('product', 'categories', 'formats', 'sizes'));
    }

    /**
     * @param  CreateProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductRequest $request)
    {
        try {
            $product = Product::create($data = $request->validated());
            $product->sizes()->attach($data['size']);
            $product->formats()->attach($data['formats']);
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
        return view('backend.pages.products.edit', 
            compact('product', 'categories', 'formats', 'sizes'));
    }

    /**
     * @param  UpdateProductRequest  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->update($data = $request->validated());
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
