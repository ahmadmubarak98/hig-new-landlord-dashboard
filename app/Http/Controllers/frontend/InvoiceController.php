<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function all()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/invoice?landlord=" . \Cookie::get('user_id');

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/invoices/all', compact('responseBody'));
    }

    public function view($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/invoice/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return view('/dashboard/invoices/view', compact('responseBody'));
    }

    public function print($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/invoice/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return view('/dashboard/invoices/print', compact('responseBody'));
    }

    public function create(Request $request)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client

        // Get clients list
        $clients = \Config::get('constants.API_URL') . "/v1/tenant";
        $clients = $client->request('GET', $clients, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $clients = json_decode($clients->getBody(), true);
        $clients = $clients['data'];

        // Get invoice types list
        $invoice_types = \Config::get('constants.API_URL') . "/v1/invoice_type";
        $invoice_types = $client->request('GET', $invoice_types, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $invoice_types = json_decode($invoice_types->getBody(), true);
        $invoice_types = $invoice_types['data'];

        return view('/dashboard/invoices/create', [
            'invoice_types' => $invoice_types,
            'clients' => $clients,
        ]);
    }

    public function store(Request $request)
    {
        // Prepare data
        $output = [];

        if ($request->filled('invoice_no')) {
            $output[] = [
                'name' => 'invoice_no',
                'contents' => $request->invoice_no,
            ];
        }


        $output[] = ['name' => 'landlord_id', 'contents' => \Cookie::get('user_id')];
        $output[] = ['name' => 'name', 'contents' => $request->name];
        $output[] = ['name' => 'issued_for_user_id', 'contents' => $request->issued_for_user_id];
        $output[] = ['name' => 'invoice_type_id', 'contents' => $request->invoice_type_id];
        $output[] = ['name' => 'issue_date', 'contents' => $request->issue_date];
        $output[] = ['name' => 'due_date', 'contents' => $request->due_date];
        $output[] = ['name' => 'details', 'contents' => json_encode($request->details, true)];
        $output[] = ['name' => 'tax_rate', 'contents' => 0.05];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/invoice/create";
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
            return redirect()->route('all-invoices')
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

    public function delete($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/invoice/" . $id . "/delete";

        $response = $client->request('DELETE', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-invoices')
                ->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->route('all-invoices');
        }
    }

}
