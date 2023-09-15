<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthenticationException;
use App\Http\Resources\ErrorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthResponse;
use App\Models\SmUserLogin;
use App\Models\UmUser;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;


//trait
use App\Http\Traits\UserTrait;

class AuthController extends Controller
{
    use UserTrait;

    public function login(Request $request): RedirectResponse
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ], [
                'email.required' => ':attribute field is required.',
                'password.required' => ':attribute field is required.',
            ]);



            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $username = $request->get('email');
            $password = $request->get('password');

            $user_login_object = SmUserLogin::where("username", $username)->first();
            if (!$user_login_object) {
                throw new Exception("Invalid User");
            } else {
                if (Hash::check($password, $user_login_object->password)) {
                    $user_obj = UmUser::find($user_login_object->um_user_id);
                    if ($user_obj) {
                        if ($user_obj->um_user_status_id === config('global.user_status_active')) {
                            $user_permissions = $this->user_role_getUserRolePermissions($user_obj->um_user_role_id);
                            $user_permissions_tabs = $this->user_role_getUserRolePermissions_menus($user_obj->um_user_role_id);

                            Auth::login($user_login_object);
                            $request->session()->regenerate();
                            $request->session()->put('user', $user_obj);
                            $request->session()->put('user_permissions', $user_permissions);
                            $request->session()->put('user_permissions_tabs', $user_permissions_tabs);


                            return redirect('/');
                        } else {
                            throw new Exception("Your account has been blocked, Please contact System Admin");
                        }
                    } else {
                        throw new Exception("User not found");
                    }
                } else {
                    throw new Exception("Login failed, Please check your credentials");
                }
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->withErrors([
                'custom_error' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
