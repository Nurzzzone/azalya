<?php

namespace App\Http\Controllers\Backend;

use App\Models\Format;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Format\CreateFormatRequest;
use App\Http\Requests\Format\UpdateFormatRequest;

class FormatsController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Format::class;
    protected const ROUTE = 'formats';
    protected const THEADERS = ['fields.id', 'fields.name'];

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.formats.index', 
        [
            'formats' => (self::MODEL)::paginate(10),
            'theaders' => self::THEADERS
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = self::MODEL;
        return view('backend.pages.'.self::ROUTE.'.create', ['format' => new $class()]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormatRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backend.'.self::ROUTE.'.index');
    }

    /**
     * @param  Format $format
     * @return \Illuminate\Http\Response
     */
    public function show(Format $format)
    {
        return view('backend.pages.formats.show', compact('format'));
    }

    /**
     * @param  Format $format
     * @return \Illuminate\Http\Response
     */
    public function edit(Format $format)
    {
        return view('backend.pages.formats.edit', compact('format'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormatRequest $request, Format $format)
    {
        try {
            $format->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backend.'.self::ROUTE.'.index');
    }

    /**
     * @param  Format $format
     * @return \Illuminate\Http\Response
     */
    public function destroy(Format $format, Request $request)
    {
        try {
            $format->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, 'backend.'.self::ROUTE.'.index');
    }
}
