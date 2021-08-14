<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\About\CreateAboutRequest;
use App\Http\Requests\About\UpdateAboutRequest;

class AboutController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = About::class;
    protected const COLUMNS = ['id', 'name'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'about';
        $this->object = 'about';
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        $about = About::first();
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  About $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateAboutRequest $request
     * @param  About $about
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        try {
            $about->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
