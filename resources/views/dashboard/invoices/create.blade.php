@extends('layouts/contentLayoutMaster')

@section('title', 'Create Invoice')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice.css') }}">
@endsection

@section('content')
    <form class="form" method="post" action="invoice" enctype="multipart/form-data">
        {{ csrf_field() }}
        <section class="invoice-add-wrapper">
            <div class="row invoice-add">
                <!-- Invoice Add Left starts -->
                <div class="col-xl-9 col-md-8 col-12">
                    <div class="card invoice-preview-card">
                        <!-- Header starts -->
                        <div class="card-body invoice-padding pb-0">
                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                <div>
                                    <div class="logo-wrapper">
                                        <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                            <defs>
                                                <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%"
                                                    x2="50%" y2="89.4879456%">
                                                    <stop stop-color="#000000" offset="0%"></stop>
                                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                </linearGradient>
                                                <linearGradient id="invoice-linearGradient-2" x1="64.0437835%"
                                                    y1="46.3276743%" x2="37.373316%" y2="100%">
                                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                </linearGradient>
                                            </defs>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-400.000000, -178.000000)">
                                                    <g transform="translate(400.000000, 178.000000)">
                                                        <path class="text-primary"
                                                            d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                            style="fill: currentColor"></path>
                                                        <path
                                                            d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                            fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                        <polygon fill="#000000" opacity="0.049999997"
                                                            points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                                        </polygon>
                                                        <polygon fill="#000000" opacity="0.099999994"
                                                            points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                                        </polygon>
                                                        <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994"
                                                            points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                                        </polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <h3 class="text-primary invoice-logo">HIG</h3>
                                    </div>
                                    <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                    <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                    <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                </div>
                                <div class="invoice-number-date mt-md-0 mt-2">
                                    <div class="d-flex align-items-center justify-content-md-end mb-1">
                                        <span class="title">Type:</span>
                                        <select name="invoice_type_id" id="invoice_type_id" class="form-control">
                                            @foreach ($invoice_types as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <h4 class="invoice-title">Invoice</h4>
                                        <div class="input-group input-group-merge invoice-edit-input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i data-feather="hash"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control invoice-edit-input"
                                                placeholder="Empty(Auto)" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="title">Date:</span>
                                        <input type="text" class="form-control invoice-edit-input date-picker"
                                            name="issue_date" id="issue_date" />
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="title">Due Date:</span>
                                        <input type="text" class="form-control invoice-edit-input due-date-picker"
                                            name="due_date" id="due_date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Header ends -->

                        <hr class="invoice-spacing" />

                        <!-- Address and Contact starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row row-bill-to invoice-spacing">
                                <div class="col-xl-8 mb-lg-1 col-bill-to pl-0">
                                    <h6 class="invoice-to-title">Invoice To:</h6>
                                    <div class="invoice-customer">
                                        <select name="issued_for_user_id" id="issued_for_user_id"
                                            class="select2 form-control">
                                            @foreach ($clients as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['first_name'] . ' ' . $item['first_name'] . ' - ' . $item['id'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 pr-0 mt-xl-0 mt-2">
                                    <h6 class="mb-2">Payment Details:</h6>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="pr-1">Bank name:</td>
                                                <td>Arab Bank</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Country:</td>
                                                <td>Jordan</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">IBAN:</td>
                                                <td>ETD95476213874685</td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">SWIFT code:</td>
                                                <td>BR91905</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row row-bill-to invoice-spacing">
                                    <div class="col-xl-8 mb-lg-1 col-bill-to pl-0">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Address and Contact ends -->

                        <hr class="invoice-spacing" />

                        <!-- Product Details starts -->
                        <div class="card-body invoice-padding invoice-product-details">
                            <div class="source-item">
                                <div data-repeater-list="details">
                                    <div class="repeater-wrapper" data-repeater-item>
                                        <div class="row">
                                            <div class="col-12 d-flex product-details-border position-relative pr-0">
                                                <div class="row w-100 pr-lg-0 pr-1 py-2">
                                                    <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                        <p class="card-text col-title mb-md-2 mb-0">Detail</p>
                                                        <input type="text" class="form-control" name="detail[][detail]"
                                                            id="detail[][detail]" placeholder="Enter Detail Description" />
                                                    </div>
                                                    <div class="col-lg-3 col-12 my-lg-0 my-2">
                                                        <p class="card-text col-title mb-md-2 mb-0">Amount</p>
                                                        <input type="text" class="detailAmount form-control"
                                                            name="detail[][amount]" id="detail[][amount]" />
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex flex-column align-items-center justify-content-between border-left invoice-product-actions py-50 px-25">
                                                    <i data-feather="x" class="cursor-pointer font-medium-3"
                                                        data-repeater-delete></i>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12 px-0">
                                        <button type="button" class="btn btn-primary btn-sm btn-add-new"
                                            data-repeater-create>
                                            <i data-feather="plus" class="mr-25"></i>
                                            <span class="align-middle">Add Item</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details ends -->
                    </div>
                </div>
                <!-- Invoice Add Left ends -->

                <!-- Invoice Add Right starts -->
                <div class="col-xl-3 col-md-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block mb-75">Save Invoice</button>
                        </div>
                    </div>
                </div>
                <!-- Invoice Add Right ends -->
            </div>
        </section>
    </form>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/scripts/pages/app-invoice.js') }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
