<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\HomepageAbout;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Homepage\CreateAboutRequest;
use App\Http\Requests\Homepage\UpdateAboutRequest;

class HomepageAboutController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = HomepageAbout::class;
    protected const THEADERS = ['fields.id', 'fields.name'];
    protected $route;

    public function __construct()
    {
        $this->route = 'homepage.about';
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
     * @param  CreateAboutRequest $request  $request
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
     * @param  HomepageAbout $about
     * @return \Illuminate\Http\Response
     */
    public function show(HomepageAbout $about)
    {
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
            $about->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  HomepageAbout $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomepageAbout $about, Request $request)
    {
        try {
            $about->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
