@extends('layouts/contentLayoutMaster')

@section('title', 'Tenants')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/tenant/create">
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
        <div class="card">
            <table>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th># NO.</th>
                                        <th>Name</th>
                                        <th>Nationality</th>
                                        <th>OPTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($responseBody->data as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                            <td>{{ $item->nationality }}</td>
                                            <td>
                                                <a href="/tenant/{{ $item->id }}">
                                                    <button class="mr-1 mb-1 round btn btn-outline-info">View</button>
                                                </a>

                                                <a href="/tenant/{{ $item->id }}/edit">
                                                    <button class="mr-1 mb-1 round btn btn-outline-warning">Edit</button>
                                                </a>

                                                <a href="/tenant/{{ $item->id }}/delete">
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
