@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product Form</h5>
            <form method="POST" action="">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category Name</label>
                            <select name="categoryName">
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
@endsection
