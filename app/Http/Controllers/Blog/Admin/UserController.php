<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

final class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        // $this->authorize('view', User::class);
      
        $users = User::get();
        // dd($users->hasRole('UserRole'));
        // dd($users->givePermissionsTo('manage-users'));
        // dd($users->hasPermission('manage-users'));

        // if (!Gate::allows('manage-users')) {
        //     abort(403);
           
        // }


        return view('blog.admin.users.index', compact('users'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
       $item = new User();
    //    dd($item);
      
       $roleList = Role::all();
    //    dd($roleList);
       return view('blog.admin.users.create', compact('item','roleList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
            // dd(__METHOD__);
        $data = $request->input();
        // dd($data);
        $user = User::create($data);
        // dd($user);

        // $this->authorize('create', User::class);
        // $user = $this
        //     // ->userService
        //     ->create($request->validated());



        if ($user) {
            return redirect()->route('blog.admin.users.index')->with('success', 'Користувач успішно доданий');
        } else {
            return back()->withErrors(['msd' => 'Помилка збереження'])
                ->withInput();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
