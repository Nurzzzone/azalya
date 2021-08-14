<?php

namespace app\Http\Controllers\Backend;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Type\CreateTypeRequest;
use App\Http\Requests\Type\UpdateTypeRequest;

class TypeController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Type::class;
    protected const COLUMNS = ['id', 'name'];
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'type';
        $this->object = 'type';
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
     * @param  CreateTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTypeRequest $request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateTypeRequest $request
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        try {
            $type->update($request->validated());
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type, Request $request)
    {
        try {
            $type->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
