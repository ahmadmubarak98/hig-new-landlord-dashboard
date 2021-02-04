<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard - Analytics
    public function dashboardAnalytics()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
    }

    // Dashboard - Ecommerce
    public function dashboardEcommerce()
    {
        $pageConfigs = ['pageHeader' => false];

        $client = new \GuzzleHttp\Client(); //GuzzleHttp\Client

        // Get landlords list
        $statistics = \Config::get('constants.API_URL') . "/v1/stats/" . \Cookie::get('user_id');
        $statistics = $client->request('GET', $statistics, [
            'headers' => ['login_token' => '6013d13c20f8b'],
            'verify' => false,
        ]);
        $statistics = json_decode($statistics->getBody(), true);
          
        return view('/content/dashboard/dashboard-ecommerce', [
            'pageConfigs' => $pageConfigs,
            'total_properties' => $statistics['total_properties'],
            'total_leased_properties' => $statistics['total_leased_properties'],
            'total_empty_properties' => $statistics['total_empty_properties'],
            'total_lease_orders' => $statistics['total_lease_orders'],
            'latest_lease_orders' => $statistics['latest_lease_orders'],
            'properties_to_empty_soon' => $statistics['properties_to_empty_soon'],
            'total_contracts' => $statistics['total_contracts'],
            'total_invoices' => $statistics['total_invoices'],
        ]);
    }
}
