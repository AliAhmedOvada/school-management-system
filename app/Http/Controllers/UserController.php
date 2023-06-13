<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = request('status');
        $user->save();

        return redirect()->route('home')->with('success', 'User status updated successfully.');
    }

}
