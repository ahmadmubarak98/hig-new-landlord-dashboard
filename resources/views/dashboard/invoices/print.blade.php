@extends('layouts/fullLayoutMaster')

@section('title', 'Invoice Print')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-print.css')) }}">
@endsection

@section('content')
    <div class="invoice-print p-3">
        <div class="d-flex justify-content-between flex-md-row flex-column pb-2">
            <div>
                <div class="d-flex mb-1">
                    <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                        <defs>
                            <linearGradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                <stop stop-color="#000000" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </linearGradient>
                            <linearGradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                y2="100%">
                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                            </linearGradient>
                        </defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                <g id="Group" transform="translate(400.000000, 178.000000)">
                                    <path class="text-primary" id="Path"
                                        d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                        style="fill: currentColor"></path>
                                    <path id="Path1"
                                        d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                        fill="url(#linearGradient-1)" opacity="0.2"></path>
                                    <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                        points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                    </polygon>
                                    <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                        points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                    </polygon>
                                    <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                        points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <h3 class="text-primary font-weight-bold ml-1">HIG OMAN</h3>
                </div>

                <p class="card-text mb-25">Office 4, Al Tameemi Building</p>
                <p class="card-text mb-25">3rd Circle, Amman, Jordan</p>
                <p class="card-text mb-25">+962-799-9999</p>
                <p class="card-text mb-0">info@sensejo.com</p>
            </div>
            <div class="mt-md-0 mt-2">
                <h4 class="font-weight-bold text-right mb-1">INVOICE
                    <span class="invoice-number">#{{ $responseBody['invoice_no'] }}</span>
                </h4>

                <div class="invoice-date-wrapper mb-50">
                    <span class="invoice-date-title">Date Issued:</span>
                    <span class="font-weight-bold">
                        {{ \Carbon\Carbon::parse($responseBody['created_at'])->format('Y-m-d') }}</span>
                </div>
                <div class="invoice-date-wrapper">
                    <span class="invoice-date-title">Due Date:</span>
                    <span class="font-weight-bold">
                        {{ \Carbon\Carbon::parse($responseBody['due_date'])->format('Y-m-d') }}</span>
                </div>
            </div>
        </div>

        <hr class="my-2" />

        <div class="row pb-2">
            <div class="col-sm-6">
                <h6 class="mb-1">Invoice To:</h6>
                <p class="mb-25">
                    {{ $responseBody['tenant_id'] ? $responseBody['tenant']['first_name'] . ' ' . $responseBody['tenant']['last_name'] : $responseBody['landlord']['first_name'] . ' ' . $responseBody['landlord']['last_name'] }}
                </p>
            </div>
            <div class="col-sm-6 mt-sm-0 mt-2">
                <h6 class="mb-1">Payment Details:</h6>
                <table>
                    <tbody>
                        <tr>
                            <td class="pr-1">Total Due:</td>
                            <td><strong>OMR {{$responseBody['total']}}</strong></td>
                        </tr>
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
        </div>

        <div class="table-responsive mt-2">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th class="py-1 pl-4">Description</th>
                        <th class="py-1">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responseBody['invoice_details'] as $item)
                        <tr>
                            <td class="py-1 pl-4">
                                <p class="text-muted text-nowrap">
                                    {{ $item['detail'] }}
                                </p>
                            </td>
                            <td class="py-1">
                                <strong>OMR {{ $item['amount'] }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row invoice-sales-total-wrapper mt-3">
            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
            </div>
            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                <div class="invoice-total-wrapper">
                    <div class="invoice-total-item">
                        <p class="invoice-total-title">Subtotal:</p>
                        <p class="invoice-total-amount">OMR {{$responseBody['subtotal']}}</p>
                    </div>
                    <div class="invoice-total-item">
                        <p class="invoice-total-title">Tax:</p>
                        <p class="invoice-total-amount">5%</p>
                    </div>
                    <hr class="my-50" />
                    <div class="invoice-total-item">
                        <p class="invoice-total-title">Total:</p>
                        <p class="invoice-total-amount">OMR {{$responseBody['total']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/app-invoice-print.js')}}"></script>
@endsection
