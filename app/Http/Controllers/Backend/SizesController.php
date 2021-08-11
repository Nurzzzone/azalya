<?php

namespace App\Http\Controllers\Backend;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Size\CreateSizeRequest;
use App\Http\Requests\Size\UpdateSizeRequest;

class SizesController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Size::class;
    protected const ROUTE = 'size';
    protected const THEADERS = ['fields.id', 'fields.name'];

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.pages.".self::ROUTE.".index", 
        [
            'sizes' => (self::MODEL)::paginate(10),
            'theaders' => self::THEADERS
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = self::MODEL;
        return view('backend.pages.'.self::ROUTE.'.create', ['size' => new $class()]);
    }

    /**
     * @param  CreateSizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSizeRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backend.'.self::ROUTE.'.index');
    }

    /**
     * @param  Size $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        return view('backend.pages.'.self::ROUTE.'.show', compact('size'));
    }

    /**
     * @param  Size $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('backend.pages.'.self::ROUTE.'.edit', compact('size'));
    }

    /**
     * @param  UpdateSizeRequest  $request
     * @param  Size $size
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        try {
            $size->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backned.'.self::ROUTE.'.index');
    }

    /**
     * @param  Size $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size, Request $request)
    {
        try {
            $size->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backned.'.self::ROUTE.'.index');
    }
}
