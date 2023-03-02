@extends('template.master')
@section('title')
Statements
@endsection
@section('content')
<div class="row">

    <div class="col-md-1">
    </div>

    <div class="col-md-10">
        <table class="table datatable-basic" id="statement_table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Time</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Details</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="col-md-1">
    </div>


    <script>
        $(document).ready(function() {

            var customerTable = $('#statement_table');
            if ($.fn.DataTable.isDataTable(customerTable)) {
                customerTable.DataTable().clear().destroy();
            }

            var datatable = $('#statement_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                responsive: true,
                select: true,
                filter: true,
                order: [
                    [0, "desc"]
                ],
                ajax: '{{ route('user.getStatementData') }}',

                columns: [

                    {
                        data: 'id'
                    },
                    {
                        data: 'time'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'details'
                    },
                    {
                        data: 'balance'
                    }
                ],
            });
        });
    </script>
@endsection
