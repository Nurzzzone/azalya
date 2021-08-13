<?php

namespace app\Http\Controllers\Backend;

use App\Models\Map;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Map\UpdateMapRequest;

class MapController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Map::class;
    protected const COLUMNS = ['id', 'fullname', 'position'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'map';
        $this->object = 'map';
    }

    /**
     * @param  Map $map
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        $map = Map::first();
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  Map $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateMapRequest $request
     * @param  Map $map
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMapRequest $request, Map $map)
    {
        try {
            $map->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.show");
    }
}
