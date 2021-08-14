<?php

namespace app\Http\Controllers\Backend;

use App\Models\HomepageCard;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Card\CreateCardRequest;
use App\Http\Requests\Card\UpdateCardRequest;
use App\Traits\HasFile;

class HomepageCardController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = HomepageCard::class;
    protected const COLUMNS = ['id', 'name', 'image'];
    protected const UPLOAD_PATH = 'homepage\\cards\\';
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'homepage.card';
        $this->object = 'card';
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
     * @param  CreateCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCardRequest $request)
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
     * @param  HomepageCard $card
     * @return \Illuminate\Http\Response
     */
    public function show(HomepageCard $card)
    {
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  HomepageCard $card
     * @return \Illuminate\Http\Response
     */
    public function edit(HomepageCard $card)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateCardRequest $request
     * @param  HomepageCard $card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardRequest $request, HomepageCard $card)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $card->image, self::UPLOAD_PATH);
            $card->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  HomepageCard $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomepageCard $card, Request $request)
    {
        try {
            $this->deleteFile($card->image);
            $card->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
