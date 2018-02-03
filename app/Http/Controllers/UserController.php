<?php

namespace App\Http\Controllers;

use App\Events\UserEvent;
use App\Notifications\UserNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Image;

class UserController extends Controller
{
    public function index()
    {
//        $user = User::find(1);
        // to display the notifications in web application
//        dd($user->notifications);
//        $user->notify(new UserNotification([
//            'message' => 'This is a queueable notifications'
//        ]));
//        exit();

        $users = User::orderBy("id", "DESC")->paginate(10);

        // pass data to view

        return view("users", compact('users'));
    }

    public function create()
    {
        return view("create");
    }

    public function store(UserRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $image = $request->file('photo');
        $filename = uniqid() . $image->getClientOriginalName();
        $path = 'images/';
        $image->move($path, $filename);

        Image::make($path . $filename)->resize(100, 100)->save('thumbs/'.$filename);

        // Create a folder to save image

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'image' => $path . $filename
        ]);

        event(new UserEvent($user));

        \Session::flash('success', 'User create successfully.');
        return redirect('/users');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            \Session::flash('error', 'User not found');
            return redirect('users');
        }

        return view('edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        if (empty($user)) {
            \Session::flash('error', 'User not found');
            return redirect('users');
        }

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ]);

        // pass data to notification class
        $user->notify(new UserNotification([
            'message' => 'Your profile updated.'
        ]));

        \Session::flash('success', 'User updated successfully.');
        return redirect('/users');
    }

    public function show($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            \Session::flash('error', 'User not found');
            return redirect('users');
        }

        return view('detail', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            \Session::flash('error', 'User not found');
            return redirect('users');
        }

        $user->delete();

        \Session::flash('success', 'User deleted successfully.');
        return redirect('users');
    }
}
