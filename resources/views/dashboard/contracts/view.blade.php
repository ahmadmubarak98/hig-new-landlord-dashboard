@extends('layouts/contentLayoutMaster')

@section('title', 'View Contract')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="">
        <div class="mb-2 row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <a href="contract">
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
            <div class="col-xs-12 col-md-6">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Contract No</th>
                                    <td>{{ $responseBody->contract_no }}</td>
                                </tr>
                                <tr>
                                    <th>Property No</th>
                                    <td>{{ $responseBody->property->property_no }}</td>
                                </tr>
                                <tr>
                                    <th>Property No</th>
                                    <td>{!! '<a href="property/' . $responseBody->property->id . '">' .
                                            $responseBody->property->id . '</a>' !!}</td>
                                </tr>
                                <tr>
                                    <th>Tenant</th>
                                    <td>{!! '<a href="tenant/' . $responseBody->tenant->id . '">' .
                                            $responseBody->tenant->first_name . ' ' . $responseBody->tenant->last_name .
                                            '</a>' !!}</td>
                                </tr>
                                <tr>
                                    <th>Landlord</th>
                                    <td>{!! $responseBody->landlord ? '<a
                                            href="landlord/' . $responseBody->landlord->id . '">' .
                                            $responseBody->landlord->first_name . ' ' . $responseBody->landlord->last_name .
                                            '</a>' : 'HIG' !!}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        {!! $responseBody->status === 'active'
                                        ? '<span class="badge badge-success">Active</span>'
                                        : '<span class="badge badge-danger">Ended</span>' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rent</th>
                                    <td>
                                        {{ $responseBody->rent }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Terms</th>
                                    <td>{{ $responseBody->payment_terms }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ \Carbon\Carbon::parse($responseBody->start_date)->format('Y-m-d') }}
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ \Carbon\Carbon::parse($responseBody->end_date)->format('Y-m-d') }}
                                </tr>
                                <tr>
                                    <th>Next Payment Date</th>
                                    <td>{{ \Carbon\Carbon::parse($responseBody->next_payment_date)->format('Y-m-d') }}
                                </tr>
                                <tr>
                                    <th>Created at</th>
                                    <td>{{ \Carbon\Carbon::parse($responseBody->created_at)->format('Y-m-d') }}
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
