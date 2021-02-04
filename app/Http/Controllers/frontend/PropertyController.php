<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function all()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property?landlord=" . \Cookie::get('user_id');

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/properties/all', compact('responseBody'));
    }

    public function leased()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property?leased=1&landlord=" . \Cookie::get('user_id');

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/properties/leased', compact('responseBody'));
    }

    public function listed()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property?listed=1&landlord=" . \Cookie::get('user_id');

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/properties/listed', compact('responseBody'));
    }

    function empty() {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property?leased=0&landlord=" . \Cookie::get('user_id');

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/properties/empty', compact('responseBody'));
    }

    public function create()
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client

        // Get country list
        $countries = \Config::get('constants.API_URL') . "/v1/country";
        $countries = $client->request('GET', $countries, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $countries = json_decode($countries->getBody(), true);
        $countries = $countries['data'];

        // Get city list
        $cities = \Config::get('constants.API_URL') . "/v1/city";
        $cities = $client->request('GET', $cities, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $cities = json_decode($cities->getBody(), true);
        $cities = $cities['data'];

        // Get property types list
        $property_types = \Config::get('constants.API_URL') . "/v1/property_type";
        $property_types = $client->request('GET', $property_types, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $property_types = json_decode($property_types->getBody(), true);
        $property_types = $property_types['data'];

        // Get property list
        $properties = \Config::get('constants.API_URL') . "/v1/property?landlord=" . \Cookie::get('user_id');
        $properties = $client->request('GET', $properties, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $properties = json_decode($properties->getBody(), true);
        $properties = $properties['data'];

        return view('/dashboard/properties/create', [
            'countries' => $countries,
            'cities' => $cities,
            'properties' => $properties,
            'property_types' => $property_types,
        ]);
    }

    public function edit($id)
    {
        // Get Property Details
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property/" . $id;
        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody(), true);

        // Get country list
        $countries = \Config::get('constants.API_URL') . "/v1/country";
        $countries = $client->request('GET', $countries, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $countries = json_decode($countries->getBody(), true);
        $countries = $countries['data'];

        // Get city list
        $cities = \Config::get('constants.API_URL') . "/v1/city";
        $cities = $client->request('GET', $cities, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $cities = json_decode($cities->getBody(), true);
        $cities = $cities['data'];

        // Get property types list
        $property_types = \Config::get('constants.API_URL') . "/v1/property_type";
        $property_types = $client->request('GET', $property_types, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $property_types = json_decode($property_types->getBody(), true);
        $property_types = $property_types['data'];

        // Get property list
        $properties = \Config::get('constants.API_URL') . "/v1/property?landlord=" . \Cookie::get('user_id');
        $properties = $client->request('GET', $properties, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $properties = json_decode($properties->getBody(), true);
        $properties = $properties['data'];

        return view('/dashboard/properties/edit', [
            'responseBody' => $responseBody,
            'countries' => $countries,
            'cities' => $cities,
            'properties' => $properties,
            'property_types' => $property_types,
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        // Prepare data
        $output = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $output[] = [
                    'name' => 'images[]',
                    'contents' => file_get_contents($file->getPathname()),
                    'filename' => basename($file->getPathname()),
                ];
            }
        }

        if ($request->filled('property_no')) {
            $output[] = [
                'name' => 'property_no',
                'contents' => $request->property_no,
            ];
        }

        $output[] = ['name' => 'name', 'contents' => $request->name];
        $output[] = ['name' => 'country_id', 'contents' => $request->country];
        $output[] = ['name' => 'city_id', 'contents' => $request->city];
        $output[] = ['name' => 'property_type_id', 'contents' => $request->property_type_id];
        $output[] = ['name' => 'parent_property_id', 'contents' => $request->parent_property];
        $output[] = ['name' => 'address_line_1', 'contents' => $request->address_line_1];
        $output[] = ['name' => 'address_line_2', 'contents' => $request->address_line_2];
        $output[] = ['name' => 'area_foot', 'contents' => $request->area_foot];
        $output[] = ['name' => 'monthly_rent', 'contents' => $request->monthly_rent];
        $output[] = ['name' => 'notes', 'contents' => $request->notes];
        $output[] = ['name' => 'details', 'contents' => $request->details];
        $output[] = ['name' => 'has_child_properties', 'contents' => $request->has_child_properties];
        $output[] = ['name' => 'is_listed', 'contents' => $request->is_listed];
        $output[] = ['name' => 'latitude', 'contents' => $request->latitude];
        $output[] = ['name' => 'longitude', 'contents' => $request->longitude];
        $output[] = ['name' => 'landlord_id', 'contents' => \Cookie::get('user_id')];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/property/" . $id . "/update";
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
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $output[] = [
                    'name' => 'images[]',
                    'contents' => file_get_contents($file->getPathname()),
                    'filename' => basename($file->getPathname()),
                ];
            }
        }

        if ($request->filled('property_no')) {
            $output[] = [
                'name' => 'property_no',
                'contents' => $request->property_no,
            ];
        }
        
        $output[] = ['name' => 'landlord_id', 'contents' => \Cookie::get('user_id')];
        $output[] = ['name' => 'name', 'contents' => $request->name];
        $output[] = ['name' => 'country_id', 'contents' => $request->country];
        $output[] = ['name' => 'city_id', 'contents' => $request->city];
        $output[] = ['name' => 'property_type_id', 'contents' => $request->property_type_id];
        $output[] = ['name' => 'parent_property_id', 'contents' => $request->parent_property];
        $output[] = ['name' => 'address_line_1', 'contents' => $request->address_line_1];
        $output[] = ['name' => 'address_line_2', 'contents' => $request->address_line_2];
        $output[] = ['name' => 'area_foot', 'contents' => $request->area_foot];
        $output[] = ['name' => 'monthly_rent', 'contents' => $request->monthly_rent];
        $output[] = ['name' => 'notes', 'contents' => $request->notes];
        $output[] = ['name' => 'details', 'contents' => $request->details];
        $output[] = ['name' => 'has_child_properties', 'contents' => $request->has_child_properties];
        $output[] = ['name' => 'is_listed', 'contents' => $request->is_listed];
        $output[] = ['name' => 'latitude', 'contents' => $request->latitude];
        $output[] = ['name' => 'longitude', 'contents' => $request->longitude];

        // Send request
        $client = new \GuzzleHttp\Client();
        $url = \Config::get('constants.API_URL') . "/v1/property/create";
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
            return redirect()->route('all-properties')
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

    public function publish($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property/" . $id . " /publish";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return redirect()->route('all-properties')
            ->with('success', 'Item published successfully!');
    }

    public function unpublish($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property/" . $id . " /unpublish";

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return redirect()->route('all-properties')
            ->with('success', 'Item unpublished successfully!');
    }

    public function view($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property/" . $id;

        $response = $client->request('GET', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return view('/dashboard/properties/view', compact('responseBody'));
    }

    public function delete($id)
    {
        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client
        $url = \Config::get('constants.API_URL') . "/v1/property/" . $id . "/delete";

        $response = $client->request('DELETE', $url, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);

        $response = json_decode($response->getBody(), true);
        $statuscode = $response['status_code'];

        if (200 === $statuscode) {
            return redirect()->route('all-properties')
                ->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->route('all-properties');
        }
    }
}
