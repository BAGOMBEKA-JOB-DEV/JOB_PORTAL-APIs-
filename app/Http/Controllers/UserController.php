<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // Fetch all users
           $user = User::all();

           return response()->json($user);
    }


    public function store(Request $request)
    {
           // Validate the form data
           $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
      
        ]);
     

        // Insert the data into the database
        User::create($validatedData);
    
        // Return a response
        return response()->json(['message' => 'User Created Successfully!'], 201);
    }



    public function update(Request $request,  $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        return response()->json(['message' => 'User updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully!']);
    }
}
