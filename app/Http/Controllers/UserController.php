<?php

namespace shiraishi\Http\Controllers;

use shiraishi\User;
use Illuminate\Http\Request;
use shiraishi\Http\Requests\UserRequest;
use tsumugi\Repositories\RoleRepository;
use tsumugi\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var \tsumugi\Repositories\RoleRepository
     */
    protected $roles;

    /**
     * @var \tsumugi\Repositories\UserRepository
     */
    protected $user;

    public function __construct(RoleRepository $roleRepository, UserRepository $userRepository)
    {
        $this->roles = $roleRepository;
        $this->user = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', [
            'users'    => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param \shiraishi\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $availableRoles = $this->roles->getAvailableRoles();

        return view('users.edit', [
            'user'           => $user,
            'availableRoles' => $availableRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \shiraishi\Http\Requests\UserRequest $request
     * @param \shiraishi\User                      $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill([
            'name'    => $request->name,
            'email'   => $request->email,
            'contact' => $request->contact,
        ]);

        $user->save();
        $user->syncRoles($request->roles);

        return back()->with('success', 'User has been updated.');
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
