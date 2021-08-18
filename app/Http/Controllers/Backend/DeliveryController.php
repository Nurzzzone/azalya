<?php

namespace app\Http\Controllers\Backend;

use App\Traits\HasFile;
use App\Models\Delivery;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Delivery\UpdateDeliveryRequest;

class DeliveryController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = Delivery::class;
    protected const COLUMNS = ['id', 'title', 'description'];
    protected const UPLOAD_PATH = "delivery\\";
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'delivery';
        $this->object = 'delivery';
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
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $delivery->image, self::UPLOAD_PATH);
            $delivery->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.show");
    }
}
