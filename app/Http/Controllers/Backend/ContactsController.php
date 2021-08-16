<?php

namespace app\Http\Controllers\Backend;

use App\Models\Contacts;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\CreateContactsRequest;
use App\Http\Requests\Contacts\UpdateContactsRequest;

class ContactsController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Contacts::class;
    protected const COLUMNS = ['id', 'name', 'value'];
    protected const UPLOAD_PATH = "contacts\\";
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'contacts';
        $this->object = 'contacts';
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
     * @param  CreateContactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContactsRequest $request)
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
     * @param  Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contacts $contacts)
    {
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateContactsRequest $request
     * @param  Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactsRequest $request, Contacts $contacts)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $contacts->image, self::UPLOAD_PATH);
            $contacts->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  Contacts $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contacts, Request $request)
    {
        try {
            $contacts->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
