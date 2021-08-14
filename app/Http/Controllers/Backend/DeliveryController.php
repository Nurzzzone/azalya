<?php

namespace app\Http\Controllers\Backend;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Delivery\CreateDeliveryRequest;
use App\Http\Requests\Delivery\UpdateDeliveryRequest;

class DeliveryController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Delivery::class;
    protected const COLUMNS = ['id', 'title', 'description'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'delivery';
        $this->object = 'delivery';
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
     * @param  Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        $delivery = Delivery::first();
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateDeliveryRequest $request
     * @param  Delivery $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        try {
            $delivery->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
