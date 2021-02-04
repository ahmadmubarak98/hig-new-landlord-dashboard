@extends('layouts/contentLayoutMaster')

@section('title', 'View Landlord')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/landlord">
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
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>First Name</th>
                                    <td>{{ $responseBody->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>{{ $responseBody->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Nationality</th>
                                    <td>{{ $responseBody->nationality }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $responseBody->email }} </td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $responseBody->phone_number }} </td>
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
                                    <th>User Type</th>
                                    <td>{{ $responseBody->user_type }}</td>
                                </tr>
                                <tr>
                                    <th>Access Level</th>
                                    <td>{{ $responseBody->access_level }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $responseBody->status }}</td>
                                </tr>
                                <tr>
                                    <th>Documents</th>
                                    <td>
                                        @foreach ($responseBody->documents as $document)
                                            <a href="{{ config('constants.UPLOADS_URL') . '/' . str_replace('public/', '', $document->path) }}"
                                                target="_blank">{{ $document->id }}</a>&nbsp;
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
