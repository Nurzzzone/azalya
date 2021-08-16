<?php

namespace app\Http\Controllers\Backend;

use App\Models\Benefit;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Benefit\CreateBenefitRequest;
use App\Http\Requests\Benefit\UpdateBenefitRequest;
use App\Traits\HasFile;

class BenefitController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = Benefit::class;
    protected const COLUMNS = ['id', 'name', 'image'];
    protected const UPLOAD_PATH = 'benefit\\';
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'benefit';
        $this->object = 'benefit';
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
     * @param  CreateBenefitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBenefitRequest $request)
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
     * @param  Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function show(Benefit $benefit)
    {
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function edit(Benefit $benefit)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateBenefitRequest $request
     * @param  Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBenefitRequest $request, Benefit $benefit)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $benefit->image, self::UPLOAD_PATH);
            $benefit->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Benefit $benefit, Request $request)
    {
        try {
            $this->deleteFile($benefit->image);
            $benefit->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
