<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use App\Traits\HasFile;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\About\UpdateAboutRequest;

class AboutController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = About::class;
    protected const COLUMNS = ['id', 'name'];
    protected const UPLOAD_PATH = "about\\";
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
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $about->image, self::UPLOAD_PATH);
            $about->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.show");
    }
}
