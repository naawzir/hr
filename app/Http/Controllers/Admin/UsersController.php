<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersActive = User::all();
        $usersInactive = User::onlyTrashed()->get();
        $data = [
            'usersActive'   => $usersActive,
            'usersInactive' => $usersInactive
        ];
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users',
            'input_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/users/create')
                ->withErrors($validator)
                ->withInput();
        }
        //$user->name = 'this value will be set by the mutator in the user model';
        $user = new User;
        $user->title = ucfirst($request->title);
        $user->password = '';
        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->job_title = $request->job_title;
        $user->dob = $request->dob;
        $user->hours_per_week = $request->hours_per_week;
        $user->holiday_entitlement= $request->holiday_entitlement;
        $user->gender = $request->gender;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $user->photo = $name;
        }
        $user->save();
        return redirect('/admin/users')->with('success','The user has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $model = new User;
        $user = findByUuid($model, $id);
        $data = [
            'user' => $user
        ];
        return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $data = [
            'user' => $user
        ];
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'input_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/users/'. $user->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }
        //$user->name = 'this value will be set by the mutator in the user model';
        $user->title = ucfirst($request->title);
        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->job_title = $request->job_title;
        $user->dob = $request->dob;
        $user->hours_per_week = $request->hours_per_week;
        $user->holiday_entitlement= $request->holiday_entitlement;
        $user->gender = $request->gender;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $user->photo = $name;
        }
        $user->save();
        return redirect('/admin/users')->with('success','The user has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $userUuid = $user->uuid;
        $user->delete();
        return redirect('/admin/users/'. $userUuid);
    }

    public function restore($id)
    {
        $user = findByUuid(new User, $id);
        $user->restore();
        return redirect('/admin/users/'. $user->uuid);
    }
}
