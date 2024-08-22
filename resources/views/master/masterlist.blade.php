@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/master.js') }}"></script>
</head>
<body>
    <h1>
        <i class="fa fa-list-ul" aria-hidden="true"></i> Master . List
    </h1>
    <br>
    <div class="table-responsive" id="table_list">
        <table class="table table-bordered table-striped">
            <thead>
                <tr id="heading">
                    <th>
                        <center>Master</center>
                    </th>
                    <th>
                        <center>View</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Degree
                    </td>
                    <td>
                        <center>
                            <a href="/master/degreelist" class="userid">
                                Manage
                            </a>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>
                        Pagination Limit
                    </td>
                    <td>
                        <center>
                            <a href="/master/paginationlist" class="userid">
                                Manage
                            </a>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>
                        Pass Percentage
                    </td>
                    <td>
                        <center>
                            <a href="/master/percentage" class="userid">
                                Manage
                            </a>
                        </center>
                    </td>
                </tr>                                
            </tbody>
        </table>
    </div>
</body>

</html>
@stop