@extends('layouts/contentLayoutMaster')

@section('title', 'Create New City')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/city">
                    <button class="mr-1 mb-1 bg-gradient-primary btn btn-none">VIEW ALL</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Error</h4>
                <div class="alert-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </section>

    <section id="multiple-column-form">
        <div class="row">
            <div class="col-md-12 col-lg-6 ">
                <div class="card">
                    <div class="card-body">
                        <form class="form" method="post" action="/city" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                            value="{{ old('name') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Country</label>
                                        <select name="country" id="country" class="form-control"
                                            value="{{ old('country') }}">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1">Create</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
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
