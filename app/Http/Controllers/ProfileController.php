<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
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
      try {
        return view('profile.index');
      } catch (Exception $e) {
        Exceptions::exception($e);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      try {
        return view('profile.edit');
      } catch (Exception $e) {
      	Exceptions::exception($e);
      }
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
      try {
        $this->validate($request, [
          'first_name' => 'required|string|max:255',
          'last_name' => 'required|string|max:255',
        ],
        [
          'first_name.required' => 'Please enter first name',
          'last_name.required' => 'Please enter last name',
        ]);

        $user = User::findOrFail($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');

        if ($request->input('change_password')) {
          $this->validate($request, [
              'current_password' => 'required',
              'new_password' => 'required|string|min:6|confirmed',
          ], [
            'current_password.required' => 'Please enter current password',
            'new_password.required' => 'Please enter new password',
            'new_password.min' => 'Please enter minimum 6 characters password'
          ]);

          if (!(Hash::check($request->input('current_password'), Auth::user()->password))) {
              return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
          }

          if(strcmp($request->input('current_password'), $request->input('new_password')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
          }
          $user->password = bcrypt($request->input('new_password'));
        }

        if (!$user->save()) {
          return redirect()->route('users.edit', $id)->with('error', 'Something went wrong!');
        }
      } catch (Exception $e) {
      	Exceptions::exception($e);
      }

      return redirect()->route('profile.index')->with('success', 'Profile updated!');
    }

    public function updateProfilePic(Request $request) {
      try {

        if ($request->hasFile('picture')) {
          $user = User::findOrFail(Auth::user()->id);
          $old_file_path = User::FILE_UPLOAD_DIR.'/'.$user->picture;
          if (file_exists($old_file_path)) {
            unlink($old_file_path);
          }

          $picture = $request->file('picture');
          $picture_name = time().'.'.$picture->getClientOriginalExtension();
          $destinationPath = public_path(User::FILE_UPLOAD_DIR);
          $picture->move($destinationPath, $picture_name);
          $user->picture = $picture_name;
          if (!$user->save()) {
            return redirect()->route('profile')->with('error', 'Something went wrong!');
          }
        }
      } catch (Exception $e) {
        return response()->json([
         'status'   => 'error',
        ]);
      }

      return response()->json([
       'status'   => 'success',
      ]);
    }

}
