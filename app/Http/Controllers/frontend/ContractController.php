<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function all()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/contract?landlord=" . \Cookie::get('user_id');

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/contracts/all', compact('responseBody'));
    }

    public function create()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client

        // Get landlords list
        $landlords = \Config::get('constants.API_URL') . "/v1/landlord";
        $landlords = $client->request('GET', $landlords, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $landlords = json_decode($landlords->getBody(), true);
        $landlords = $landlords['data'];

        // Get tenants list
        $tenants = \Config::get('constants.API_URL') . "/v1/tenant";
        $tenants = $client->request('GET', $tenants, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $tenants = json_decode($tenants->getBody(), true);
        $tenants = $tenants['data'];

        // Get property list
        $properties = \Config::get('constants.API_URL') . "/v1/property?landlord=" . \Cookie::get('user_id');
        $properties = $client->request('GET', $properties, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $properties = json_decode($properties->getBody(), true);
        $properties = $properties['data'];

        $payment_terms = ['monthly', 'quarterly', 'semiannual', 'yearly', 'bianually'];

        return view('/dashboard/contracts/create', [
            'landlords' => $landlords,
            'tenants' => $tenants,
            'properties' => $properties,
            'payment_terms' => $payment_terms,
        ]);
    }

    public function edit($id)
    {
        // Get Contract Details
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client

        $url = \Config::get('constants.API_URL') . "/v1/contract/" . $id;
        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody(), true);

        // Get landlords list
        $landlords = \Config::get('constants.API_URL') . "/v1/landlord";
        $landlords = $client->request('GET', $landlords, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $landlords = json_decode($landlords->getBody(), true);
        $landlords = $landlords['data'];

        // Get tenants list
        $tenants = \Config::get('constants.API_URL') . "/v1/tenant?landlord=" . \Cookie::get('user_id');
        $tenants = $client->request('GET', $tenants, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $tenants = json_decode($tenants->getBody(), true);
        $tenants = $tenants['data'];

        // Get property list
        $properties = \Config::get('constants.API_URL') . "/v1/property?landlord=" . \Cookie::get('user_id');
        $properties = $client->request('GET', $properties, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $properties = json_decode($properties->getBody(), true);
        $properties = $properties['data'];

        $payment_terms = ['monthly', 'quarterly', 'semiannual', 'yearly', 'bianually'];

        return view('/dashboard/contracts/edit', [
            'responseBody' => $responseBody,
            'landlords' => $landlords,
            'tenants' => $tenants,
            'properties' => $properties,
            'payment_terms' => $payment_terms,
        ]);
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

        if ($request->filled('contract_no')) {
            $output[] = [
                'name' => 'contract_no',
                'contents' => $request->contract_no,
            ];
        }

        if ($request->filled('landlord_id') && $request->landlord_id !== '0') {
            $output[] = [
                'name' => 'landlord_id',
                'contents' => $request->landlord_id,
            ];
        }

        $output[] = ['name' => 'landlord_id', 'contents' => \Cookie::get('user_id')];
        $output[] = ['name' => 'tenant_id', 'contents' => $request->tenant_id];
        $output[] = ['name' => 'property_id', 'contents' => $request->property_id];
        $output[] = ['name' => 'start_date', 'contents' => $request->start_date];
        $output[] = ['name' => 'end_date', 'contents' => $request->end_date];
        $output[] = ['name' => 'next_payment_date', 'contents' => $request->next_payment_date];
        $output[] = ['name' => 'rent', 'contents' => $request->rent];
        $output[] = ['name' => 'payment_terms', 'contents' => $request->payment_terms];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/contract/" . $id . "/update";
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

        if ($request->filled('contract_no')) {
            $output[] = [
                'name' => 'contract_no',
                'contents' => $request->contract_no,
            ];
        }
        
        $output[] = ['name' => 'landlord_id', 'contents' => \Cookie::get('user_id')];
        $output[] = ['name' => 'tenant_id', 'contents' => $request->tenant_id];
        $output[] = ['name' => 'property_id', 'contents' => $request->property_id];
        $output[] = ['name' => 'start_date', 'contents' => $request->start_date];
        $output[] = ['name' => 'end_date', 'contents' => $request->end_date];
        $output[] = ['name' => 'next_payment_date', 'contents' => $request->next_payment_date];
        $output[] = ['name' => 'rent', 'contents' => $request->rent];
        $output[] = ['name' => 'payment_terms', 'contents' => $request->payment_terms];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/contract/create";
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
            return redirect()->route('all-contracts')
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

    public function terminate($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/contract/" . $id . " /terminate";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return redirect()->route('all-contracts')
            ->with('success', 'Item terminated successfully!');
    }

    public function view($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/contract/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/contracts/view', compact('responseBody'));
    }

    public function delete($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/conract/" . $id . "/delete";

        $response = $client->request('DELETE', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-contracts')
                ->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->route('all-contracts');
        }
    }
}
