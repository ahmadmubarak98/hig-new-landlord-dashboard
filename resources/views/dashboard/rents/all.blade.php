@extends('layouts/contentLayoutMaster')

@section('title', 'All Rents')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')

    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/rent/create">
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-nowrap" scope="col"># NO.</th>
                                    <th class="text-nowrap" scope="col">Contract No.</th>
                                    <th class="text-nowrap" scope="col">Property No.</th>
                                    <th class="text-nowrap" scope="col">Landlord</th>
                                    <th class="text-nowrap" scope="col">Tenant</th>
                                    <th class="text-nowrap" scope="col">Amount</th>
                                    <th class="text-nowrap" scope="col">Due Date</th>
                                    <th class="text-nowrap" scope="col">Paid Date</th>
                                    <th class="text-nowrap" scope="col">OPTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($responseBody->data as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->contract->contract_no }}</td>
                                        <td>
                                            {{ $item->property->property_no }}
                                        </td>
                                        <td>
                                            {{ $item->landlord_id ? $item->landlord->first_name . ' ' . $item->landlord->last_name : 'HIG' }}
                                        </td>
                                        <td>
                                            {{ $item->tenant->first_name . ' ' . $item->tenant->last_name }}
                                        </td>
                                        <td>
                                            {{ $item->amount }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->due_date)->format('Y-m-d') }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->due_date)->format('Y-m-d') }}
                                        </td>
                                        <td>
                                            <a href="/rent/{{ $item->id }}/delete">
                                                <button class="mr-1 mb-1 round btn btn-outline-danger">Delete</button>
                                            </a>
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
