<?php

namespace app\Http\Controllers\Backend;

use App\Models\GeneralSettings;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateSettingsRequest;
use App\Traits\HasFile;

class GeneralSettingsController extends Controller
{
    use HasFlashMessage, HasFile;

    protected const MODEL = GeneralSettings::class;
    protected const UPLOAD_PATH = 'general\\settings\\';
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'general.settings';
        $this->object = 'settings';
    }

    /**
     * @param  GeneralSettings $settings
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralSettings $settings)
    {
        $settings = (self::MODEL)::first();
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  GeneralSettings $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralSettings $settings)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateSettingsRequest $request
     * @param  GeneralSettings $settings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingsRequest $request, GeneralSettings $settings)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $settings->image, self::UPLOAD_PATH);
            $settings->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.show");
    }
}
