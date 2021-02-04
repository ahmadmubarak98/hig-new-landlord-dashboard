@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Property')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
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
                        <form class="form" method="post" action="/property" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <input name="id" type="hidden" value={{ $responseBody['id'] }}>
                            <input name="latitude" id="latitude" type="hidden"
                                value="{{ old('latitude') ?? $responseBody['latitude'] }}">
                            <input name="longitude" id="longitude" type="hidden"
                                value="{{ old('longitude') ?? $responseBody['longitude'] }}">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="property_no">Property No.</label>
                                        <input type="text" name="property_no" id="property_no" class="form-control"
                                            placeholder="Leave empty to fill automatically"
                                            value="{{ old('property_no') ?? $responseBody['property_no'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                            value="{{ old('name') ?? $responseBody['name'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Country</label>
                                        <select name="country" id="country" class="form-control"
                                            value="{{ old('country') ?? $responseBody['country']['id'] }}">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ $item['id'] == $responseBody['country']['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">City</label>
                                        <select name="city" id="city" class="form-control"
                                            value="{{ old('city') ?? $responseBody['city']['id'] }}">
                                            @foreach ($cities as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ $item['id'] == $responseBody['city']['id'] ? 'selected="selected"' : '' }}>
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Property Type</label>
                                        <select name="property_type_id" id="property_type_id" class="form-control"
                                            value="{{ old('property_type_id') ?? $responseBody['property_type_id'] }}">
                                            @foreach ($property_types as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ $item['id'] == $responseBody['property_type_id'] ? 'selected="selected"' : '' }}>
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Parent Property</label>
                                        <select name="parent_property" id="parent_property" class="select2 form-control"
                                            value="{{ old('parent_property_id') ?? $responseBody['parent_property_id'] }}">
                                            @foreach ($properties as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ $item['id'] == $responseBody['parent_property_id'] ? 'selected="selected"' : '' }}>
                                                    {{ $item['property_no'] }}</option>
                                            @endforeach
                                        </select>
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
                                        <label for="area_foot">Area (Feet)</label>
                                        <input type="text" name="area_foot" id="area_foot" class="form-control"
                                            placeholder="Area (Feet)"
                                            value="{{ old('area_foot') ?? $responseBody['area_foot'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="monthly_rent">Monthly Rent</label>
                                        <input type="text" name="monthly_rent" id="monthly_rent" class="form-control"
                                            placeholder="Monthly Rent"
                                            value="{{ old('monthly_rent') ?? $responseBody['monthly_rent'] }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" name="notes" id="notes" rows="3"
                                            placeholder="Your notes will not be shown in website">{{ old('notes') ?? $responseBody['notes'] }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="details">Details</label>
                                        <textarea class="form-control" name="details" id="details" rows="3"
                                            placeholder="Details shown in website">{{ old('details') ?? $responseBody['details'] }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="images">Images</label>
                                        <input type="file" name="images[]" id="images" class="form-control"
                                            multiple="true" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"></div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="demo-inline-spacing">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    name="has_child_properties" id="has_child_properties"
                                                    {{ old('has_child_properties') === 'on' || $responseBody['has_child_properties'] ? 'checked=checked' : '' }} />

                                                <label class="custom-control-label" for="has_child_properties">Has child
                                                    properties?</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_listed"
                                                    id="is_listed"
                                                    {{ old('is_listed') === 'on' || $responseBody['is_listed'] ? 'checked=checked' : '' }} />
                                                <label class="custom-control-label" for="is_listed">Publish in
                                                    website</label>
                                            </div>
                                        </div>
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
            <div class="col-md-12 col-lg-6 ">
                <div class="card">
                    <div class="card-body">
                        <div id="map_canvas" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('vendor-script')
    <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0WvIwwAbHVWR6zPNhgAByeY_msTiUB2I&libraries=places"></script>
    <script>
        window.onload = function() {
            var map = new google.maps.Map(document.getElementById("map_canvas"), {
                center: new google.maps.LatLng(document.getElementById("latitude").value, document
                    .getElementById("longitude").value),
                zoom: 15
            });

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(document.getElementById("latitude").value, document
                    .getElementById("longitude").value),
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, "position_changed", function() {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;
            });
        }

    </script>
@endsection
