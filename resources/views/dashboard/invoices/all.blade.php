@extends('layouts/contentLayoutMaster')

@section('title', 'Invoices')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="invoice/create">
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
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th># Invoice NO.</th>
                                    <th>Issued For</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Issue Date</th>
                                    <th>OPTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($responseBody->data as $item)
                                    <tr>
                                        <th scope="row">{{ $item->invoice_no }}</th>
                                        <td>{{ $item->tenant ? $item->tenant->first_name . ' ' . $item->tenant->last_name : $item->landlord->first_name . ' ' . $item->landlord->last_name }}
                                        </td>
                                        <td>{{ $item->invoice_type->name }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="invoice/{{ $item->id }}">
                                                <button class="mr-1 mb-1 round btn btn-outline-info">View</button>
                                            </a>
                                            <a href="invoice/{{ $item->id }}/delete">
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
