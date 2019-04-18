<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
          'first_name.required' => 'Please enter first name',
          'last_name.required' => 'Please enter last name',
          'email.required' => 'Please enter email address',
          'email.email' => 'Please enter valid email address',
          'password.required' => 'Please enter password',
          'password.min' => 'Please enter minimum 6 characters password'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $picture_name = 'null';
        if (Input::hasFile('picture')) {
          if (Input::file('picture')->isValid()) {
            $picture = Input::file('picture');
            $picture_name = time().'.'.$picture->getClientOriginalExtension();
            $destinationPath = public_path(User::FILE_UPLOAD_DIR);
            $picture->move($destinationPath, $picture_name);
          }
        }

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'picture' => $picture_name
        ]);
    }

    protected function register(Request $request)
    {

      $input = $request->all();
      $validator = $this->validator($input);

      if ($validator->passes()) {
        $data = $this->create($input)->toArray();

        $data['token'] = str_random(25);

        $user = User::find($data['id']);
        $user->token = $data['token'];
        $user->save();

        Mail::send('mails.confirmation', $data, function($message) use($data) {
          $message->to($data['email']);
          $message->subject('Registration Confirmation!');
        });

        return redirect(route('login'))->with('status', 'Confirmation mail has been sent. please check you email.');
      } else {
        $validator->validate();
      }

      return redirect(route('login'))->with('status', 'Something went wrong');
    }

    public function confirmation($token)
    {
      $user = User::where('token', $token)->first();

      if (!is_null($user)) {
        $user->confirmed = 1;
        $user->token = '';
        $user->save();
        return redirect(route('login'))->with('status', 'Your account activation completed.');
      }
      return redirect(route('login'))->with('Something went wrong.');
    }
}
