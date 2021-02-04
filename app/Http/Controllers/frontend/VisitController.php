<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function all()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/visit";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/visits/all', compact('responseBody'));
    }
}
