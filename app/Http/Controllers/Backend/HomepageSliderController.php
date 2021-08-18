<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Homepage\CreateSliderRequest;
use App\Http\Requests\Homepage\UpdateSliderRequest;
use App\Models\HomepageSlider;
use App\Traits\HasFile;

class HomepageSliderController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = HomepageSlider::class;
    protected const THEADERS = ['fields.id', 'fields.name'];
    protected const UPLOAD_PATH = "homepage\\slider";
    protected $route;

    public function __construct()
    {
        $this->route = 'homepage.slider';
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.pages.{$this->route}.index", 
        [
            'slider' => (self::MODEL)::paginate(10),
            'theaders' => self::THEADERS
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = self::MODEL;
        return view("backend.pages.{$this->route}.create", ['slider' => new $model()]);
    }

    /**
     * @param  CreateSliderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSliderRequest $request)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->uploadFile($request['image'], self::UPLOAD_PATH);
            (self::MODEL)::create($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  HomepageSlider $slider
     * @return \Illuminate\Http\Response
     */
    public function show(HomepageSlider $slider)
    {
        return view("backend.pages.{$this->route}.show", compact('slider'));
    }

    /**
     * @param  HomepageSlider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(HomepageSlider $slider)
    {
        return view("backend.pages.{$this->route}.edit", compact('slider'));
    }

    /**
     * @param  UpdateSliderRequest $request
     * @param  HomepageSlider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, HomepageSlider $slider)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $slider->image, self::UPLOAD_PATH);
            $slider->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  HomepageSlider $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomepageSlider $slider, Request $request)
    {
        try {
            $slider->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
