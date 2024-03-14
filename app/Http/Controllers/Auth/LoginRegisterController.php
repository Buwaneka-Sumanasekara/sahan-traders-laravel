<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UmUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\UserTrait;
use Illuminate\Auth\Events\Registered;
use App\CustomModels\CusModel_Product;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LoginRegisterController extends Controller implements HasMiddleware
{
    use userTrait;
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    // public function __construct()
    // {
    //     // $this->middleware('guest')->except([
    //     //     'logout', 'verify'
    //     // ]);
    //     // $this->middleware('auth')->only('logout', 'verify');
    //     // // $this->middleware('verified')->only('homePage');
    // }

    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['logout']),
            new Middleware('auth', only: ['logout','verify']),
        ];
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerPage()
    {
        return view('pages.general.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:um_user,email',
            'password' => 'required|min:3|confirmed'
        ]);

        $userId = $this->getNextUserId();
        $user = UmUser::create([
            'id' => $userId,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "um_user_status_id" => config("global.user_status_active"),
            "um_user_role_id" => config("global.user_role_buyer"),
        ]);
        $user->id = $userId;


        //register buyer
        $buyer = new \App\Models\BmBuyer();
        $buyer->id = $userId;
        $buyer->user_id = $userId;
        $buyer->total_orders = 0;
        $buyer->contact_1 = "";
        $buyer->contact_2 = "";
        $buyer->save();

        event(new Registered($user));

     



        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        $request->session()->regenerate();
        return redirect()->route('home')
            ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginPage(Request $request)
    {
        $RedirectToProdId = $request->query('redirect-to-item');

        if (!session()->has('redirect_to_product_id')) {
            session()->put('redirect_to_product_id', $RedirectToProdId);
        }
        return view('pages.general.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if (session()->has('redirect_to_product_id')) {
                $productId = session()->pull('redirect_to_product_id');
                $product = CusModel_Product::getProductById($productId);
                $request->session()->regenerate();
                return redirect('/product/' . $product->slug);
            } else {
                return redirect()->route("home");
            }
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }



    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }
}
