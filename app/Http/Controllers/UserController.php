<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
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
        return view('users.index');
      } catch (Exception $e) {
      	Exceptions::exception($e);
      }
    }

    public function getData() {
      $users = User::latest()->get();

  		return Datatables::of($users)
        ->addColumn('picture', function($user) {
          $url = url(User::FILE_UPLOAD_DIR.'/'.$user->picture);
          return '<img src="'.$url.'" width=50 height=30 />';
        })
  			->addColumn('action', function ($user) {
            return '<a href="'.route('users.show', $user->id).'" title="Show User Details" class="btn btn-xs btn-flat btn-warning"><i class="glyphicon glyphicon-eye-open"></i> Show</a>
            <a href="'.route('users.edit', $user->id).'" title="Edit User" class="btn btn-xs btn-flat btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		        <a href="#" class="btn btn-xs btn-flat btn-danger btn-delete" data-remote="'. route('users.destroy', $user->id) .'" title="Delete User"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })
        ->rawColumns(['picture', 'action'])
  		->make(true);
  	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      try {
        return view('users.create');
      } catch (Exception $e) {
      	Exceptions::exception($e);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $this->validate($request, [
          'first_name' => 'required|string|max:255',
          'last_name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
          'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
          'first_name.required' => 'Please enter first name',
          'last_name.required' => 'Please enter last name',
          'email.required' => 'Please enter email address',
          'email.email' => 'Please enter valid email address',
          'password.required' => 'Please enter password',
          'password.min' => 'Please enter minimum 6 characters password'
        ]);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->phone = $request->input('phone');
        $user->status = $request->input('status');

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picture_name = time().'.'.$picture->getClientOriginalExtension();
            $destinationPath = public_path(User::FILE_UPLOAD_DIR);
            $picture->move($destinationPath, $picture_name);
            $user->picture = $picture_name;
        }
        if (!$user->save()) {
          return redirect()->route('users.create')->with('error', 'Something went wrong!');
        }
      } catch (Exception $e) {
      	Exceptions::exception($e);
      }

      return redirect('users')->with('success', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
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
    public function edit($id)
    {
      try {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
          'email' => 'required|string|email|max:255|unique:users,email,'.$id,
          'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
          'first_name.required' => 'Please enter first name',
          'last_name.required' => 'Please enter last name',
          'email.required' => 'Please enter email address',
          'email.email' => 'Please enter valid email address',
        ]);

        $user = User::findOrFail($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->status = $request->input('status');

        if ($request->input('change_password')) {
          $this->validate($request, [
              'new_password' => 'required|string|min:6|confirmed',
          ], [
            'new_password.required' => 'Please enter password',
            'new_password.min' => 'Please enter minimum 6 characters password'
          ]);
          $user->password = bcrypt($request->input('new_password'));
        }

        if ($request->hasFile('picture')) {
            $old_file_path = User::FILE_UPLOAD_DIR.'/'.$user->picture;
            if (file_exists($old_file_path)) {
              unlink($old_file_path);
            }

            $picture = $request->file('picture');
            $picture_name = time().'.'.$picture->getClientOriginalExtension();
            $destinationPath = public_path(User::FILE_UPLOAD_DIR);
            $picture->move($destinationPath, $picture_name);

            $user->picture = $picture_name;
        }

        if (!$user->save()) {

          return redirect()->route('users.edit', $id)->with('error', 'Something went wrong!');
        }
      } catch (Exception $e) {
      	Exceptions::exception($e);
      }

      return redirect()->route('users.index')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        $user = User::findOrFail($id);
        $file_path = User::FILE_UPLOAD_DIR.'/'.$user->picture;
        if (file_exists($file_path)) {
          unlink($file_path);
        }

        if (!$user->delete()) {
          return redirect()->route('users.index')->with('error', 'Something went wrong!');
        }
      } catch (Exception $e) {
      	Exceptions::exception($e);
      }

      return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
