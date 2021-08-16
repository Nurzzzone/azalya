<?php

namespace app\Http\Controllers\Backend;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Promotion\CreatePromotionRequest;
use App\Http\Requests\Promotion\UpdatePromotionRequest;
use App\Traits\HasFile;

class PromotionController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = Promotion::class;
    protected const COLUMNS = ['id', 'name', 'image'];
    protected const UPLOAD_PATH = "promotions\\";
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'promotion';
        $this->object = 'promotion';
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.pages.{$this->route}.index", 
        [
            $this->object => (self::MODEL)::paginate(10),
            'columns' => self::COLUMNS
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = self::MODEL;
        return view("backend.pages.{$this->route}.create", [$this->object => new $model()]);
    }

    /**
     * @param  CreatePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePromotionRequest $request)
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
     * @param  Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdatePromotionRequest $request
     * @param  Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $promotion->image, self::UPLOAD_PATH);
            $promotion->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion, Request $request)
    {
        try {
            $promotion->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
