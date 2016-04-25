<?php

class DefaultController extends \BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function showLogin()
    {
        return View::make('admin.login');
    }

    public function authenticateUser()
    {
        $rules = array(
            'username' => 'Required',
            'password' => 'Required'

        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

            // attempt to do the login
            if (Auth::admin()->attempt($userdata,false)) {


                return Redirect::route('dashboard');

            } else {

                return Redirect::back()->with("auth_error", "The Username/Password is not correct");
            }
        } else {
            return Redirect::back()->withErrors($validator->errors());

        }
    }

    public function dashboard()
    {
        $breadcrumbs = array(
            array(
                "type" => "inactive",
                "value" => "Control Panel"
            )
        );
        return View::make('admin.dashboard')->with("breadcrumbs", $breadcrumbs);
    }

    public function logout()
    {
        if (Auth::admin()->check()) {
            Auth::admin()->logout();
        }
        return Redirect::route("login-form");
    }

}
