@extends('layouts.mainlayout')

@section('title', 'Customers List')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
@endsection

@section('page-contant')

    <div class="container">
        <h1>Customer's List</h1>
        <a href="{{ route('customer_registration_form') }}" class="btn btn-outline-primary">ADD</a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="zero_configuration_table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Profile Image</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Address 1</th>
                                    <th>Address 2</th>
                                    <th>Zipcode</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(document).ready(function() {


            dtable = $('#zero_configuration_table').DataTable({
                "language": {
                    "lengthMenu": "_MENU_",
                },
                "columnDefs": [{
                    "targets": "_all",
                    "orderable": false
                }],
                responsive: true,
                'serverSide': true,

                "ajax": {
                    "url": "{{ route('getCustomers') }}",
                    'beforeSend': function(request) {
                        request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr(
                            'content'));
                    },
                    "type": "POST",
                    "data": function(data) {

                    },
                },
            });

            $('.panel-ctrls').append("<i class='separator'></i>");

            $('.panel-footer').append($(".dataTable+.row"));
            $('.dataTables_paginate>ul.pagination').addClass("pull-right");

            $("#apply_filter_btn").click(function() {
                dtable.ajax.reload(null, false);
            });
        });
    </script>
@endsection
