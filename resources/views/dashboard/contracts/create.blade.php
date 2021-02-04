@extends('layouts/contentLayoutMaster')

@section('title', 'Create New Contract')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="/contract">
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
                        <form class="form" method="post" action="/contract" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="latitude" id="latitude" type="hidden">
                            <input name="longitude" id="longitude" type="hidden">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contract_no">Contract No.</label>
                                        <input type="text" name="contract_no" id="contract_no" class="form-control"
                                            placeholder="Leave empty to fill automatically"
                                            value="{{ old('contract_no') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="property_id">Property</label>
                                        <select name="property_id" id="property_id" class="select2 form-control"
                                            value="{{ old('property_id') }}">
                                            @foreach ($properties as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['property_no'] . ' - OMR' . $item['monthly_rent'] . '/month' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tenant_id">Tenant</label>
                                        <select name="tenant_id" id="tenant_id" class="select2 form-control"
                                            value="{{ old('tenant_id') }}">
                                            @foreach ($tenants as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['first_name'] . ' ' . $item['last_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="text" class="form-control date-picker flatpickr-input active"
                                            name="start_date" id="start_date" value="{{ old('start_date') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="text" class="form-control date-picker flatpickr-input active"
                                            name="end_date" id="end_date" value="{{ old('end_date') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="next_payment_date">Next Payment Date</label>
                                        <input type="text" class="form-control date-picker flatpickr-input active"
                                            name="next_payment_date" id="next_payment_date"
                                            value="{{ old('next_payment_date') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="payment_terms">Payment Terms</label>
                                        <select name="payment_terms" id="payment_terms" class="form-control"
                                            value="{{ old('payment_terms') }}">
                                            @foreach ($payment_terms as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="rent">Rent</label>
                                        <input type="text" name="rent" id="rent" class="form-control" placeholder="Rent"
                                            value="{{ old('rent') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="documents">Documents</label>
                                        <input type="file" name="documents[]" id="documents" class="form-control"
                                            multiple="true" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"></div>
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
    <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset('js/scripts/pages/app-invoice.js') }}"></script>
@endsection
