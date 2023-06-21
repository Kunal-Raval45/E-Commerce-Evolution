@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@endsection

@section('page-contant')
    <style>
        <style>.product-details {
            padding: 20px;
        }

        .product-thumbnail {
            max-width: 100%;
            height: auto;
        }

        .product-images {
            margin-top: 20px;
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .product-images img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .product-description {
            margin-top: 20px;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="../{{ $Products->product_thumbnail }}" alt="Product Thumbnail" class="product-thumbnail"
                    id="productThumbnail">
            </div>
            <div class="col-md-6 product-info">
                <h3>{{ $Products->product_name }}</h3>
                <p>Product Brand: <span id="productBrand">{{ $Products->product_brand }}</span></p>
                <p>Product Code: <span id="productCode">{{ $Products->product_code }}</span></p>
                <p>Category Name: <span id="categoryName">{{ $Products->categoryName }}</span></p>
                <p>Status: <span id="status" class="{{ $Products->product_status ? 'text-success' : 'text-danger' }}">
                        {{ $Products->product_status ? 'Active' : 'Inactive' }}
                    </span></p>

                <h4>Description</h4>
                <p id="productDescription">{{ $Products->product_description }}</p>
                <div class="col-md-6">
                    <h4>Price</h4>
                    <p id="productPrice" class="product-price">{{ $Products->product_price }} Rs</p>
                </div>
                <div class="col-md-6">
                    <h4>In Stock:</h4>
                    <p>{{ $Products->product_stock_quantity }}</p>
                </div>
            </div>
        </div>
        <div class="row mt-4">

            <h4>Product Images</h4>
            <div class="product-images" id="productImages">

            </div>

        </div>

    </div>

@endsection

@section('page-js')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
