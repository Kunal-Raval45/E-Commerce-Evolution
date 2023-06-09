@extends('layouts.mainlayout')

@section('title', 'Custmor Registration')

@section('page-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection

@section('page-contant')

    <style>
        div.scroll {

            width: 1500px;
            height: 700px;
            overflow: auto;
            text-align: justify;
        }

        label {
            font-weight: bold;
        }
    </style>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <center>
                <h1>Customer's Registration</h1>
            </center>
            <div class="scroll">

                <form method="post" action="{{ route('add_customers') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control-file" id="profile_image">
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname"
                            placeholder="Enter your full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" name="phone" id="phone"
                            placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>

                    </div>
                    <div class="form-group">
                        <select id="country-dropdown" name="country" class="form-control">
                            <option value="">--- Select Country --</option>
                            @foreach ($countries as $data)
                                <option value="{{ $data->id }}">
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>

                    </div>
                    <div class="form-group">
                        <select id="state-dropdown" name="state" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>

                    </div>
                    <div class="form-group">
                        <select id="city-dropdown" name="city" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address_1">Address 1</label>
                        <input type="text" class="form-control" name="address_1" id="address_1"
                            placeholder="Enter your address 1">
                    </div>
                    <div class="form-group">
                        <label for="address_2">Address 2</label>
                        <input type="text" class="form-control" id="address_2" name="address_2"
                            placeholder="Enter your address 2">
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Zip Code</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode"
                            placeholder="Enter your zip code">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>

        </div>
    </div>

@endsection

@section('page-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#country-dropdown').on('change', function() {
                var idCountry = this.value;

                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-states') }}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html(
                            '<option value="">-- Select State --</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            State Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#state-dropdown').on('change', function() {
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-cities') }}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
@endsection
