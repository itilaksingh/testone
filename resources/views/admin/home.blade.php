@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Users List') }}</div>
                <div class="card-body">

                    <table id="userlist" class="table">
                        <thead>

                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Manglik</th>
                            <th>Income </th>
                            <th>Email </th>
                            <th>Reg. Date</th>
                            <th>Action</th>

                          </tr>
                        </thead>
                    
                    </table>
                    
                </div>
            </div>
           
        </div>
    </div>
 
</div>
@endsection



@section('js')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"><script> -->

<script>
    $('#userlist').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("user_records")}}',
        columns: [
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'gender', name: 'gender'},
            {data: 'dob', name: 'dob'},
            {data: 'manglik', name: 'manglik'},
            {data: 'annual_income', name: 'annual_income'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
</script>

@endsection

