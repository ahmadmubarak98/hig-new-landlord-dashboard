<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function all()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/city";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/cities/all', compact('responseBody'));
    }

    public function view($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/city/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/cities/view', compact('responseBody'));
    }

    public function delete($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/city/" . $id . "/delete";

        $response = $client->request('DELETE', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-cities')
                ->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->route('all-cities');
        }
    }

    public function create()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/country";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);
        $countries = $responseBody['data'];

        return view('/dashboard/cities/create', ['countries' => $countries]);
    }

    public function edit($id)
    {
        // Get City Details
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/city/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        // Get Country List
        $url = \Config::get('constants.API_URL') . "/v1/country";
        $countries = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $countries = json_decode($countries->getBody(), true);
        $countries = $countries['data'];

        return view('/dashboard/cities/edit', ['responseBody' => $responseBody, 'countries' => $countries]);
    }

    public function store(Request $request)
    {
        // Prepare data
        $output = [];

        $output[] = ['name' => 'name', 'contents' => $request->name];
        $output[] = ['name' => 'country_id', 'contents' => $request->country];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/city/create";
        $response = $client->post($url, [
            'http_errors' => false,
            'multipart' => $output
            ,
            'headers' => [
                'login_token' => '6013d13c20f8b',
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-cities')
                ->with('success', 'Item created successfully!');
        } elseif (422 === $statuscode) {
            $errors = $response['errors'];
            return back()
                ->withInput($request->input())
                ->withErrors($errors);
        } else {
            $errors = $response['errors'];
            return back()
                ->withInput($request->input())
                ->withErrors($errors);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;

        // Prepare data
        $output = [];

        $output[] = ['name' => 'name', 'contents' => $request->name];
        $output[] = ['name' => 'country_id', 'contents' => $request->country];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/city/" . $id . "/update";
        $response = $client->post($url, [
            'http_errors' => false,
            'multipart' => $output
            ,
            'headers' => [
                'login_token' => '6013d13c20f8b',
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return back()
                ->with(['id' => $id, 'success' => 'Item updated successfully!'])
                ->withInput($request->input());
        } elseif (422 === $statuscode) {
            $errors = $response['errors'];
            return back()
                ->with(['id' => $id])
                ->withInput($request->input())
                ->withErrors($errors);
        } else {
            $errors = $response['errors'];
            return back()
                ->with(['id' => $id])
                ->withInput($request->input())
                ->withErrors($errors);
        }
    }
}
