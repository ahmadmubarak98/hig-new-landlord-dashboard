@extends('layouts/contentLayoutMaster')

@section('title', 'View Property')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/property">
                    <button class="mr-1 mb-1 bg-gradient-primary btn btn-none">VIEW ALL</button>
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
                            <tbody>
                                <tr>
                                    <th>Propert No</th>
                                    <td>{{ $responseBody->property_no }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $responseBody->name }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $responseBody->country->name }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $responseBody->city->name }}</td>
                                </tr>
                                <tr>
                                    <th>Address Line 1</th>
                                    <td>{{ $responseBody->address_line_1 }}</td>
                                </tr>
                                <tr>
                                    <th>Address Line 2</th>
                                    <td>{{ $responseBody->address_line_2 }} </td>
                                </tr>
                                <tr>
                                    <th>Property Type</th>
                                    <td>{{ $responseBody->property_type->name }}</td>
                                </tr>
                                <tr>
                                    <th>Has child properties?</th>
                                    <td>{{ $responseBody->has_child_properties ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Parent Property No.</th>
                                    <td>{{ $responseBody->parent_property ? $responseBody->parent_property->property_no : null }}</td>
                                </tr>
                                <tr>
                                    <th>Area (Feet)</th>
                                    <td>{{ $responseBody->area_foot }}</td>
                                </tr>
                                <tr>
                                    <th>Monthly Rent</th>
                                    <td>{{ $responseBody->monthly_rent }}</td>
                                </tr>
                                <tr>
                                    <th>Published</th>
                                    <td>{{ $responseBody->is_listed ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Notes</th>
                                    <td>{{ $responseBody->notes }}</td>
                                </tr>
                                <tr>
                                    <th>Details</th>
                                    <td>{{ $responseBody->details }}</td>
                                </tr>
                                <tr>
                                    <th>Landlord</th>
                                    <td>{!! $responseBody->landlord ? '<a href="/landlord/'. $responseBody->landlord->id .'">'. $responseBody->landlord->first_name . " " . $responseBody->landlord->last_name .'</a>'  : 'HIG' !!}</td>
                                </tr>
                                <tr>
                                    <th>Images</th>
                                    <td>
                                        @foreach ($responseBody->images as $image)
                                            <a href="{{ config('constants.UPLOADS_URL') . '/' . str_replace('public/', '', $image->path) }}"
                                                target="_blank">{{ $image->id }}</a>&nbsp;
                                        @endforeach
                                    </td>
                                </tr>
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
