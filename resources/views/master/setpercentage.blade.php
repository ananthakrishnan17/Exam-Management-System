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
   
</head>

<body>
    <form action="/SetPercentage" method="post">
    @csrf

        <h1>
            <i class="fa fa-user-circle" aria-hidden="true"></i> Pass Percentage . Limit
        </h1>
        <a href="javascript:history.back()">
            <button class="btn btn-warning" id="back-bts" type="button">
                <i class="fa fa-arrow-left icon"></i> Back
            </button>
        </a>
        
        <div class="table-responsive" id="table_list">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr id="heading">
                        <th>
                            <center>Percentage</center>
                        </th>
                        <th>
                            <center>Percentage limit</center>
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>               
                    <tr>
                        <td>
                            <center>Pass Percentage </center>
                        </td>
                        <td>
                        <select name="pass_percentage" id="pattern-pagination-limit" class="form-control">
                            @for ($i = 30; $i <= 100; $i+=5)
                            <option value="{{ $i }}" {{ session('pass_percentage') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        </td>
                        <td>
                            <center>
                                <button type="submit" class="btn btn-primary" >                              
                                    Set
                                </button>
                            </center>
                        </td>
                    </tr>
                    </form>              
                </tbody>
            </table>
        </div>
</body>

</html>
@stop