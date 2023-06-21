@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product Form</h5>
            <form method="POST" action="{{ route('addProductsForm') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category Name</label>
                            <select id="categoryName" name="categoryName">
                                @foreach ($categoryNames as $category)
                                    <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                        </div>
                        <div class="mb-3">
                            <label for="product_brand" class="form-label">Product Brand</label>
                            <input type="text" class="form-control" id="product_brand" name="product_brand">
                        </div>
                        <div class="mb-3">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="text" class="form-control" id="product_code" name="product_code">
                            <span id="generate_code" class="mdi mdi-autorenew">generate random code</span>

                        </div>
                        <div class="mb-3">
                            <label for="product_stock_quantity" class="form-label">Product Stock Quantity</label>
                            <input type="text" class="form-control" id="product_stock_quantity"
                                name="product_stock_quantity">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="product_thumbnail" class="form-label">Product Thumbnail</label>
                            <input type="file" class="form-control" id="product_thumbnail" name="product_thumbnail">
                        </div>
                        <div class="mb-3">
                            <label for="product_images" class="form-label">Product Images</label>
                            <input type="file" class="form-control" id="product_images" name="product_images[]" multiple>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="text" class="form-control" id="product_price" name="product_price">
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="form-label">Product Description</label>
                            <textarea class="form-control" id="product_description" name="product_description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="product_status" class="form-label">Product Status</label>
                            <select class="form-select" id="product_status" name="product_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary add-product">Submit</button>
            </form>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
        </div>
    </div>


@endsection

@section('page-js')
    <script>
        document.getElementById("generate_code").addEventListener("click", function() {
            var characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var length = 8;
            var generatedCode = "";

            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * characters.length);
                generatedCode += characters.charAt(randomIndex);
            }

            document.getElementById("product_code").value = generatedCode;
        });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".add-product").click(function(e) {

            e.preventDefault();

            var category_id = $("#categoryName").val();
            var product_name = $("#product_name").val();
            var product_brand = $("#product_brand").val();
            var product_code = $("#product_code").val();
            var product_thumbnail = $("#product_thumbnail").val();
            var product_price = $("#product_price").val();
            var product_description = $("#product_description").val();
            var product_stock_quantity = $("#product_stock_quantity").val();
            var product_status = $("#product_status").val();



            $.ajax({

                type: 'POST',
                url: "{{ route('addProductsForm') }}",
                data: {
                    category_id: category_id
                    product_name: product_name
                    product_brand: product_brand
                    product_code: product_code
                    product_thumbnail: product_thumbnail
                    product_price: product_price
                    product_description: product_description
                    product_stock_quantity: product_stock_quantity
                    product_status: product_status
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);

                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>
@endsection
