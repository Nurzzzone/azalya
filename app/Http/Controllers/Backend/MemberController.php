<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Traits\HasFlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\CreateMemberRequest;

class MemberController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = Member::class;
    protected const COLUMNS = ['id', 'fullname', 'position'];
    protected const UPLOAD_PATH = "member\\";
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'member';
        $this->object = 'member';
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
     * @param  CreateMemberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMemberRequest $request)
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
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }

    /**
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view("backend.pages.{$this->route}.edit", compact($this->object));
    }

    /**
     * @param  UpdateCategoryRequest $request
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMemberRequest $request, Member $member)
    {
        try {
            $data = $request->validationData();
            $data['image'] = $this->updateImage($data['image'] ?? null, $data['previous_image'], $member->image, self::UPLOAD_PATH);
            $member->update($data);
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }

    /**
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member, Request $request)
    {
        try {
            $member->delete();
        } catch (\Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "backend.{$this->route}.index");
    }
}
