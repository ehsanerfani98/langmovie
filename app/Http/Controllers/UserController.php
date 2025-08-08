<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Additionalinformation;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = User::with('document')->latest()->paginate(5);
        return view('admin.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'phone' => 'required|regex:/^[0][9][0-9]{9,9}$/|unique:users,phone',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);



        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'کاربر با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('title', 'name')->all();
        $userRole = $user->roles->pluck('title', 'name')->all();
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            // 'name' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|regex:/^[0][9][0-9]{9,9}$/|unique:users,phone,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'کاربر با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'کاربر با موفقیت حذف شد');
    }

    public function user_edit_profile()
    {
        $user = Auth::user();
        return view('admin.users.edit-profile', compact('user'));
    }

    public function user_update_profile(Request $request)
    {

        $user = Auth::user();
        $id = $user->id;

        $this->validate($request, [
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();

        // if (!is_null($user->email)) {
        //     $input = Arr::except($input, ['email']);
        // }

        // if (!is_null($user->name)) {
        //     $input = Arr::except($input, ['name']);
        // }

        $input = Arr::except($input, ['phone']);


        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);


        return redirect()->back()
            ->with('success', 'پروفایل با موفقیت بروزرسانی شد');
    }


    public function unblock(User $user)
    {
        Redis::del("blocked:{$user->id}");
        Redis::del("rate:{$user->id}");

        return redirect()->route('users.index')
            ->with('success', 'مسدودیت کاربر با موفقیت رفع شد');
    }
}
