<?php

namespace App\Http\Controllers\Auth;
use Carbon\Carbon;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use App\Services\Sms\Contracts\Sms;

use App\Subscriber;

class SubscriberLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/subscriber';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm()
    {
        return view('subscriber.new');
    }

    public function login(Request $request, Sms $sms)
    {
        $number = $request->get('number');

        $subscriber = Subscriber::firstOrNew(['number' => $number]);
        $new = !$subscriber->exists;

        // Generate a verification pin.
        $pin = str_pad(strval(rand(0, 999999)), 6, '0');

        // Save it as the subscriber's password.
        $subscriber->fill([
            'login_attempt' => Carbon::now(),
            'password' => Hash::make($pin),
        ])->save();

        if ($new) {
            $subscriber->tags()->sync(Tag::subscriberDefaults()->get());
            $subscriber->locale = App::getLocale();
        }

        // Text it to the number.
        $sms->send($number, $pin);

        // redirect to /subscriber/verify, passing along the phone number
        return redirect(route('subscriber.verifyForm'))->with('number', $number);
    }

    public function verifyForm()
    {
        return view('subscriber.verify', ['number' => session('number')]);
    }

    public function verify(Request $request)
    {
        if (Auth::guard('subscriber')->attempt($request->only(['number', 'password']))) {
            if (!Auth::guard('subscriber')->user()->withinValidVerifyTime()) {
                return redirect()->back()->with('notify', 'Verification timed out, please try again.');
            }

            return redirect()->intended($this->redirectTo);
        }
        return redirect(route('subscriber.login'))->with('notify', 'Login failed, give it another shot.');
    }
}
