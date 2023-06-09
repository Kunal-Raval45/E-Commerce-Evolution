@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('page-css')

@endsection

@section('page-contant')
    {{-- <script>
        function buttonOnclickMethod() {

            var formvariable = new FormData($('#storecategory')[0]);

            $.ajax({
                url: "{{ route('storecategory') }}",
                type: 'post',
                data: formvariable,
                //async: false,
                beforeSend: function() {
                    // before form submit
                },
                // success: function(response) {
                //     if (response.yoursuccessmsg) {
                //         // your success msg

                //     } else {
                //         // your error msg
                //     }
                // },
                error: function(response) {
                    // if (response.responseJSON.errors.yourformfieldname) {
                    //     // your error msg
                    // } else {
                    //     // remove this else if you don't want to show any msg
                    // }

                },
                complete: function() {
                    // after form submit
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    </script> --}}
    <div class="container">
        <h1>Add Category </h1>

        <div>
            <form id="myForm" method="POST" action="{{ route('storecategory') }}" id="storecategory"
                enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" class="form-control" placeholder="Enter a Category Name" id="category_name"
                        name="category_name">
                </div>
                <div class="form-group">
                    <label for="category_name">Upload an Image:</label>
                    <input type="file" class="form-control" id="cat_img" name="cat_img">
                </div>
                <div class="form-group">
                    <button id="add" type="submit" name="submit" class="btn btn-primary">Add</button>
                </div>

            </form>
        </div>
        {{-- <div class="form-group">
            <button id="uploadCategories" name="uploadCategories" class="btn btn-primary">UPLOAD CATEGORIES</button></a>
        </div> --}}

    </div>

@endsection

@section('page-js')

@endsection
