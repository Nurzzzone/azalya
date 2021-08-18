<?php

namespace App\Http\Controllers\Backend;

use App\Traits\HasFile;
use App\Models\HomepageAbout;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Homepage\UpdateAboutRequest;

class HomepageAboutController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = HomepageAbout::class;
    protected const THEADERS = ['fields.id', 'fields.name'];
    protected const UPLOAD_PATH = "homepage\\about\\";
    protected $route;

    public function __construct()
    {
        $this->route = 'homepage.about';
    }


    /**
     * @param  HomepageAbout $about
     * @return \Illuminate\Http\Response
     */
    public function show(HomepageAbout $about)
    {
        $about = HomepageAbout::first();
        return view("backend.pages.{$this->route}.show", compact('about'));
    }

    /**
     * @param  HomepageAbout $about
     * @return \Illuminate\Http\Response
     */
    public function edit(HomepageAbout $about)
    {
        return view("backend.pages.{$this->route}.edit", compact('about'));
    }

    /**
     * @param  UpdateCategoryRequest $request
     * @param  HomepageAbout $about
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutRequest $request, HomepageAbout $about)
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
