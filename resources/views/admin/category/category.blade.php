@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('page-css')

@endsection

@section('page-contant')
    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <h1>Category</h1>
        <a href="{{ route('Category.viewAddCategory') }}"><button class="btn btn-primary mb-4">ADD</button></a>
        <style>
            .table,
            tr,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;

                text-align: center
            }
        </style>
        <div class="container">

            <div class="">
                <table id='empTable' width='100%' border="1" style='border-collapse: collapse;'>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $category->categoryName }}</td>
                                <td><img src="{{ $category->img }}" width="100"></td>
                                <td>
                                    @if ($category->status == 0)
                                        Active
                                    @else
                                        InActive
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('Category.viewEditCategory', $category->id) }}"
                                        class="btn btn-primary">EDIT</a>
                                    <a href="{{ route('Category.viewCategory', $category->id) }}"><button
                                            class="btn btn-primary">VIEW</button></a>
                                    <a href="#" class="btn btn-danger">DELETE</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>



    </div>

@endsection

@section('page-js')
    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function() {

            // DataTable
            var empTable = $('#empTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('Category.category') }}",
                    data: function(data) {
                        data.searchCity = $('#sel_city').val();
                        data.searchGender = $('#sel_gender').val();
                        data.searchName = $('#searchName').val();
                    }
                },
                columns: [{
                        data: 'CategoryName'
                    },
                    {
                        data: 'img'
                    },
                    {
                        data: 'status'
                    },

                ]
            });

            $('#sel_city,#sel_gender').change(function() {
                empTable.draw();
            });

            $('#searchName').keyup(function() {
                empTable.draw();
            });

        });
    </script>
    </body>

    </html>
@endsection
