<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function all()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/rent?landlord=" . \Cookie::get('user_id');

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/rents/all', compact('responseBody'));
    }

    public function paid()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/rent?hig&paid";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/rents/all', compact('responseBody'));
    }

    public function setPaid($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/rent/" . $id . " /set_paid";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return back()
            ->with('success', 'Item set to paid successfully!');
    }

    public function create()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client

        // Get country list
        $contracts = \Config::get('constants.API_URL') . "/v1/contract?landlord=" . \Cookie::get('user_id');
        $contracts = $client->request('GET', $contracts, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $contracts = json_decode($contracts->getBody(), true);
        $contracts = $contracts['data'];

        return view('/dashboard/rents/create', [
            'contracts' => $contracts,
        ]);
    }

    public function store(Request $request)
    {
        // Prepare data
        $output = [];

        $output[] = ['name' => 'landlord_id', 'contents' => \Cookie::get('user_id')];
        $output[] = ['name' => 'contract_no', 'contents' => $request->contract_no];
        $output[] = ['name' => 'due_date', 'contents' => $request->due_date];
        $output[] = ['name' => 'payment_date', 'contents' => $request->payment_date];
        $output[] = ['name' => 'amount', 'contents' => $request->amount];
        $output[] = ['name' => 'is_hig', 'contents' => 'true'];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/rent/create";
        $response = $client->post($url, [
            'http_errors' => true,
            'multipart' => $output
            ,
            'headers' => [
                'login_token' => '6013d13c20f8b',
            ],
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-rents')
                ->with('success', 'Item paid successfully!');
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
    
    public function delete($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/rent/" . $id . "/delete";

        $response = $client->request('DELETE', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-rents')
                ->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->route('all-rents');
        }
    }
}
