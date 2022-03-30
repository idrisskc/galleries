<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.single', compact('user'));
    }

    public function userImages($id){
        $user = User::findOrFail($id);
        $users = User::all();
        return view('users.images', compact('user', 'users'));
    }

    public function userAlbums($id){
        $user = User::findOrFail($id);
        return view('users.albums', compact('user'));
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


}
