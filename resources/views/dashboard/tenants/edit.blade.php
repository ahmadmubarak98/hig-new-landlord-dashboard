@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Tenant')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/tenant">
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

    <section id="multiple-column-form">
        <div class="row">
            <div class="col-md-12 col-lg-6 ">
                <div class="card">
                    <div class="card-body">
                        <form class="form" method="post" action="/tenant" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <input name="id" type="hidden" value={{$responseBody['id']}}>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control"
                                            placeholder="First Name"
                                            value="{{ old('first_name') ?? $responseBody['first_name'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                            placeholder="Last Name"
                                            value="{{ old('last_name') ?? $responseBody['last_name'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nationality">Nationality</label>
                                        <select name="nationality" id="nationality" class="form-control"
                                            value="{{ old('nationality') ?? $responseBody['nationality'] }}">
                                            @foreach ($nationalities as $item)
                                                <option value="{{ $item }}" {{$item == $responseBody['nationality'] ? 'selected="selected"' : ''}}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            placeholder="Phone Number"
                                            value="{{ old('phone_number') ?? $responseBody['phone_number'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address_line_1">Address Line 1</label>
                                        <input type="text" name="address_line_1" id="address_line_1" class="form-control"
                                            placeholder="Address Line 1"
                                            value="{{ old('address_line_1') ?? $responseBody['address_line_1'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address_line_2">Address Line 2</label>
                                        <input type="text" name="address_line_2" id="address_line_2" class="form-control"
                                            placeholder="Address Line 2"
                                            value="{{ old('address_line_2') ?? $responseBody['address_line_2'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                            value="{{ old('email') ?? $responseBody['email'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Only if you want to change it" value="{{ old('password') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="documents">Add new documents</label>
                                        <input type="file" name="documents[]" id="documents" class="form-control"
                                            multiple="true" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1">Update</button>
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
