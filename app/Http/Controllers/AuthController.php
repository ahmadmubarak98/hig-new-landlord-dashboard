<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|',
            'c_password' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if ($user->save()) {
            return response()->json([
                'message' => 'Successfully created user!',
            ], 201);
        } else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);
        // Prepare data
        $output = [];

        $output[] = ['name' => 'identifier', 'contents' => $request->identifier];
        $output[] = ['name' => 'password', 'contents' => $request->password];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/auth/login";
        $response = $client->post($url, [
            'http_errors' => false,
            'multipart' => $output,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            $token = [];
            $token['token'] = $response['data']['login_token'];
            $token['expires_at'] = Carbon::now()->addWeeks(30);
            return redirect()->to('/')->withCookie(cookie('the_login_token', $token['token']));
        } elseif (422 === $statuscode) {
            $errors = $response['errors'];
            return back()
                ->withInput($request->input());
        } else if (501 === $statuscode) {
            return back()
                ->withInput($request->input())
                ->with('login_failed', 'Check your email or password');
        } else {
            $errors = $response['errors'];
            return back()
                ->withInput($request->input())
                ->withErrors($errors);
        }

    }

    public function signin(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);
        // Prepare data
        $output = [];

        $output[] = ['name' => 'identifier', 'contents' => $request->identifier];
        $output[] = ['name' => 'password', 'contents' => $request->password];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/auth/loginLandlord";
        $response = $client->post($url, [
            'http_errors' => false,
            'multipart' => $output,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            $token = [];
            $token['token'] = $response['data']['login_token'];
            $token['expires_at'] = Carbon::now()->addWeeks(30);
            $user = [];
            $user['id'] = $response['data']['id'];
            $user['name'] = $response['data']['first_name'] . " " . $response['data']['last_name'];
            $user['email'] = $response['data']['email'];
            $user['login_token'] = $response['data']['login_token'];
            return redirect()->to('/')->withCookie(cookie('the_login_token', $token['token']))
                ->withCookie(cookie('user_id', $user['id']))
                ->withCookie(cookie('user_name', $user['name']))
                ->withCookie(cookie('email', $user['email']))
                ->withCookie(cookie('the_login_token', $user['login_token']));
            return redirect()->to('/');
        } elseif (422 === $statuscode) {
            return back()
                ->withInput($request->input());
        } else if (501 === $statuscode) {
            return back()
                ->withInput($request->input())
                ->with('login_failed', 'Check your email or password');
        } else if (404 === $statuscode) {
            return back()
                ->withInput($request->input())
                ->with('login_failed', 'You are not a landlord');
        } else {
            return back()
                ->withInput($request->input());
        }
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        return redirect()->to('/')->withCookie(\Cookie::forget('the_login_token'));
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
