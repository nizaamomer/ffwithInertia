<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users =  UserResource::collection(
            User::OfSearch($request->search)
                ->latest()
                ->get()
        );
        return inertia('Users/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Users/reusableForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        // $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request, 'image', 'userImages');
        }
        User::create($data);
        return redirect()->route('users.index')
            ->with('message', 'user created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return inertia('Users/reusableForm', [
            'user' => UserResource::make($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        info($data);
        if ($request->hasFile('image')) {
            if ($user->image) {
                $this->deleteImage('userImages/' . $user->image);
            }
            $data['image'] = $this->uploadImage($request, 'image', 'userImages');
        }
        $user->update($data);
        return redirect()->route('users.index')
            ->with('message', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->deleteImage('userImages/' . $user->image);
        $user->delete();
        return redirect()->route('users.index')
            ->with('message', 'user created successfully');
    }
}
