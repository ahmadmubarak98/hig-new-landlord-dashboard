<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandlordController extends Controller
{
    public function all()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/landlord";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/landlords/all', compact('responseBody'));
    }

    public function view($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/landlord/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/landlords/view', compact('responseBody'));
    }

    public function delete($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/landlord/" . $id . "/delete";

        $response = $client->request('DELETE', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-landlords')
                ->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->route('all-landlords');
        }
    }

    public function create()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/landlord";

        $nationalities = ['Oman', 'GCC', 'Foreign'];

        return view('/dashboard/landlords/create', ['nationalities' => $nationalities]);
    }

    public function edit($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/landlord/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        $nationalities = ['Oman', 'GCC', 'Foreign'];

        return view('/dashboard/landlords/edit', ['responseBody' => $responseBody, 'nationalities' => $nationalities]);
    }

    public function store(Request $request)
    {
        // Prepare data
        $output = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $output[] = [
                    'name' => 'documents[]',
                    'contents' => file_get_contents($file->getPathname()),
                    'filename' => basename($file->getPathname()),
                ];
            }
        }

        $output[] = ['name' => 'first_name', 'contents' => $request->first_name];
        $output[] = ['name' => 'last_name', 'contents' => $request->last_name];
        $output[] = ['name' => 'nationality', 'contents' => $request->nationality];
        $output[] = ['name' => 'address_line_1', 'contents' => $request->address_line_1];
        $output[] = ['name' => 'address_line_2', 'contents' => $request->address_line_2];
        $output[] = ['name' => 'email', 'contents' => $request->email];
        $output[] = ['name' => 'phone_number', 'contents' => $request->phone_number];
        $output[] = ['name' => 'password', 'contents' => $request->password];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/auth/register";
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
            return redirect()->route('all-landlords')
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
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $output[] = [
                    'name' => 'documents[]',
                    'contents' => file_get_contents($file->getPathname()),
                    'filename' => basename($file->getPathname()),
                ];
            }
        }

        $output[] = ['name' => 'first_name', 'contents' => $request->first_name];
        $output[] = ['name' => 'last_name', 'contents' => $request->last_name];
        $output[] = ['name' => 'nationality', 'contents' => $request->nationality];
        $output[] = ['name' => 'address_line_1', 'contents' => $request->address_line_1];
        $output[] = ['name' => 'address_line_2', 'contents' => $request->address_line_2];
        $output[] = ['name' => 'email', 'contents' => $request->email];
        $output[] = ['name' => 'phone_number', 'contents' => $request->phone_number];
        $output[] = ['name' => 'password', 'contents' => $request->password];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/landlord/" . $id . "/update";
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
