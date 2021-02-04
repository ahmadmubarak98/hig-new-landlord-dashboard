@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-primary mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="home" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $total_properties }}</h4>
                                        <p class="card-text font-small-3 mb-0">Total Properties</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="media">
                                    <div class="avatar bg-light-danger mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="box" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $total_lease_orders }}</h4>
                                        <p class="card-text font-small-3 mb-0">Lease Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>

        <div class="row match-height">

            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-success mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="home" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $total_leased_properties }}</h4>
                                        <p class="card-text font-small-3 mb-0">Total Leased Properties</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-danger mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="home" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $total_empty_properties }}</h4>
                                        <p class="card-text font-small-3 mb-0">Total Empty Properties</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="file" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $total_invoices }}</h4>
                                        <p class="card-text font-small-3 mb-0">Invoices</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="file-text" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0">{{ $total_contracts }}</h4>
                                        <p class="card-text font-small-3 mb-0">Contracts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>

        <div class="row match-height">
        </div>

        <div class="row match-height">
            <!-- Company Table Card -->
            <div class="col-lg-12 col-12">
                <div class="card card-company-table">
                    <div class="card-header">
                        <div class="card-title">
                            Latest Lease Orders
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th># NO.</th>
                                        <th>Tenant</th>
                                        <th>Landlord</th>
                                        <th>Property</th>
                                        <th>Status</th>
                                        <th>Move-In Date</th>
                                        <th>Leave Date</th>
                                        <th>OPTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latest_lease_orders as $item)
                                        <tr>
                                            <th scope="row">{{ $item['lease_order_no'] }}</th>
                                            <td>{{ $item['tenant']['first_name'] . ' ' . $item['tenant']['last_name'] }}</td>
                                            <td>{{ $item['landlord'] ? $item['landlord']['first_name'] . ' ' . $item['landlord']['last_name'] : 'HIG' }}
                                            </td>
                                            <td>{{ $item['property']['address_line_1'] }} -
                                                {{ $item['property']['address_line_2'] }}</td>
                                            <td>{{ $item['status'] }}</td>
                                            <td>{{ Carbon\Carbon::parse($item['move_in_date'])->format('Y-m-d') }}</td>
                                            <td>{{ Carbon\Carbon::parse($item['move_out_date'])->format('Y-m-d') }}</td>
                                            <td>
                                                {!!  
                                                $item['status'] !== "accepted" && $item['status'] !== "rejected" ? 
                                                '
                                                <a href="/tenant/'.$item['tenant']['id'].'">
                                                    <button class="mr-1 mb-1 round btn btn-outline-info">Review Tenant</button>
                                                </a>
                                                <a href="/lease-order/'.$item['id'].'/accept">
                                                    <button class="mr-1 mb-1 round btn btn-outline-warning">Accept</button>
                                                </a>
                                                <a href="/lease-order/'.$item['id'].'/reject">
                                                    <button class="mr-1 mb-1 round btn btn-outline-danger">Reject</button>
                                                </a>
                                                ' : null
                                                !!}

                                                {!!  
                                                $item['status'] == "rejected" ? 
                                                '
                                                <a href="/tenant/'.$item['tenant']['id'].'">
                                                    <button class="mr-1 mb-1 round btn btn-outline-info">Review Tenant</button>
                                                </a>
                                                <a href="/lease-order/'.$item['id'].'/accept">
                                                    <button class="mr-1 mb-1 round btn btn-outline-danger">Accept</button>
                                                </a>
                                                ' : null
                                                !!}
                                                
                                                {!!  
                                                $item['status'] == "accepted" ? 
                                                '
                                                <a href="/tenant/'.$item['tenant']['id'].'">
                                                    <button class="mr-1 mb-1 round btn btn-outline-info">Review Tenant</button>
                                                </a>
                                                <a href="/lease-order/'.$item['id'].'/reject">
                                                    <button class="mr-1 mb-1 round btn btn-outline-warning">Reject</button>
                                                </a>
                                                ' : null
                                                !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Company Table Card -->
        </div>


        <div class="row match-height">
            <!-- Company Table Card -->
            <div class="col-lg-12 col-12">
                <div class="card card-company-table">
                    <div class="card-header">
                        <div class="card-title">
                            Properties to be empty soon
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th># NO.</th>
                                        <th>Contract NO.</th>
                                        <th>Location</th>
                                        <th>Landlord</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties_to_empty_soon as $item)
                                        <tr>
                                            <td scope="row">{{ $item['property_no'] }}</td>
                                            <td scope="row">{{ $item['contract']['contract_no'] }}</td>
                                            <td scope="row">{{ $item['country']['name'] . ", " .$item['city']['name'] . ", " .$item['address_line_1'] . ' ' . $item['address_line_2'] }}</td>
                                            <td scope="row">{{ $item['landlord'] ? $item['landlord']['first_name'] . ' ' . $item['landlord']['last_name'] : 'HIG' }}</td>
                                            <td scope="row">{{ Carbon\Carbon::parse($item['contract']['end_date'])->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Company Table Card -->
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
@endsection
