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
                        <form class="form" method="post" action="/rent" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="latitude" id="latitude" type="hidden">
                            <input name="longitude" id="longitude" type="hidden">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contract_no">Contract No.</label>
                                        <select name="contract_no" id="contract_no" class="select2 form-control"
                                            value="{{ old('contract_no') }}">
                                            @foreach ($contracts as $item)
                                                <option value="{{ $item['contract_no'] }}">
                                                    {{ $item['contract_no'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="due_date">Due Date</label>
                                        <input type="text" class="form-control date-picker flatpickr-input active"
                                            name="due_date" id="due_date" value="{{ old('due_date') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="payment_date">Payment Date</label>
                                        <input type="text" class="form-control date-picker flatpickr-input active"
                                            name="payment_date" id="payment_date" value="{{ old('payment_date') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount"
                                            value="{{ old('amount') }}" />
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
