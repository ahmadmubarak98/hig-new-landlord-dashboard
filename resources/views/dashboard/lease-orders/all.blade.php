@extends('layouts/contentLayoutMaster')

@section('title', 'Lease Orders')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/property/create">
                    <button class="mr-1 mb-1 bg-gradient-primary btn btn-none">CREATE NEW</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        @if ($success = Session::has('success'))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Success</h4>
                <div class="alert-body">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif
    </section>

    <section class="">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="table-responsive">
<table class="table">
                            <thead class="thead-dark">
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
                                    @foreach ($responseBody->data as $item)
                                        <tr>
                                            <th scope="row">{{ $item->lease_order_no }}</th>
                                            <td>{{ $item->tenant->first_name . ' ' . $item->tenant->last_name }}</td>
                                            <td>{{ $item->landlord ? $item->landlord->first_name . ' ' . $item->landlord->last_name : 'HIG' }}
                                            </td>
                                            <td>{{ $item->property->address_line_1 }} -
                                                {{ $item->property->address_line_2 }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->move_in_date)->format('Y-m-d') }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->move_out_date)->format('Y-m-d') }}</td>
                                            <td>
                                                {!!  
                                                $item->status !== "accepted" && $item->status !== "rejected" ? 
                                                '
                                                <a href="/tenant/'.$item->tenant->id.'">
                                                    <button class="mr-1 mb-1 round btn btn-outline-info">Review Tenant</button>
                                                </a>
                                                <a href="/lease-order/'.$item->id.'/accept">
                                                    <button class="mr-1 mb-1 round btn btn-outline-warning">Accept</button>
                                                </a>
                                                <a href="/lease-order/'.$item->id.'/reject">
                                                    <button class="mr-1 mb-1 round btn btn-outline-danger">Reject</button>
                                                </a>
                                                ' : null
                                                !!}

                                                {!!  
                                                $item->status == "rejected" ? 
                                                '
                                                <a href="/tenant/'.$item->tenant->id.'">
                                                    <button class="mr-1 mb-1 round btn btn-outline-info">Review Tenant</button>
                                                </a>
                                                <a href="/lease-order/'.$item->id.'/accept">
                                                    <button class="mr-1 mb-1 round btn btn-outline-danger">Accept</button>
                                                </a>
                                                ' : null
                                                !!}
                                                
                                                {!!  
                                                $item->status == "accepted" ? 
                                                '
                                                <a href="/tenant/'.$item->tenant->id.'">
                                                    <button class="mr-1 mb-1 round btn btn-outline-info">Review Tenant</button>
                                                </a>
                                                <a href="/lease-order/'.$item->id.'/reject">
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
    </section>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
@endsection
