@extends('layouts/contentLayoutMaster')

@section('title', 'Leased Properties')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="property/create">
                    <button class="mr-1 mb-1 bg-gradient-primary btn btn-none">CREATE NEW</button>
                </a>
            </div>
        </div>

        <div class="card">
            <table>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th># NO.</th>
                                        <th>Property Location</th>
                                        <th>Property Type</th>
                                        <th>Tenant</th>
                                        <th>STATUS</th>
                                        <th>LISTED</th>
                                        <th>OPTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($responseBody->data as $item)
                                        <tr>
                                            <th scope="row">{{ $item->property_no }}</th>
                                            <td>{{ $item->address_line_1 }} - {{ $item->address_line_2 }}</td>
                                            <td>{{ $item->property_type->name }}</td>
                                            <td>{{ $item->tenant->first_name . " " . $item->tenant->last_name }}</td>
                                            <td>{!! $item->is_leased === 1 ? '<span
                                                    class="badge badge-success">LEASED</span>' : '<span
                                                    class="badge badge-warning">EMPTY</span>' !!}</td>
                                            <td>{{ $item->is_listed === 1 ? 'YES' : 'NO' }}</td>
                                            <td>
                                                <a href="property/{{ $item->id }}/edit">
                                                    <button class="mr-1 mb-1 round btn btn-outline-warning">Edit</button>
                                                </a>
                                                <a href="property/{{ $item->id }}/delete">
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
            </table>
        </div>
    </section>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
@endsection
