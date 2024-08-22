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


    <h1>
        <i class="fa fa-user-plus" aria-hidden="true"></i> Pagination Limit . List
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
                        <center>Pages</center>
                    </th>
                    <th>
                        <center>Page Limit</center>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
                <form action="/AdminListPagintaion" method="post">
                    @csrf
                    <tr>
                        <td>
                            <center>Admin List</center>
                        </td>
                        <td>
                            <center>

                                <select name="admin_pagination_limit" id="admin-pagination-limit" class="form-control">
                                @for ($i = 5; $i <= 50; $i+=5)
                                <option value="{{ $i }}" {{ session('admin_pagination_limit') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                                </select>

                            </center>
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
                <form action="/userlist" method="post">
                    @csrf
                    <tr>
                        <td>
                            <center>User List</center>
                        </td>
                        <td>
                            <center>
                                <select name="user_pagination_limit" id="user-pagination-limit" class="form-control">
                                    <option value="5" {{ old('user_pagination_limit', session('user_pagination_limit')) == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ old('user_pagination_limit', session('user_pagination_limit')) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ old('user_pagination_limit', session('user_pagination_limit')) == 15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ old('user_pagination_limit', session('user_pagination_limit')) == 20 ? 'selected' : '' }}>20</option>
                                    <option value="25" {{ old('user_pagination_limit', session('user_pagination_limit')) == 25 ? 'selected' : '' }}>25</option>
                                    <option value="30" {{ old('user_pagination_limit', session('user_pagination_limit')) == 30 ? 'selected' : '' }}>30</option>
                                    <option value="35" {{ old('user_pagination_limit', session('user_pagination_limit')) == 35 ? 'selected' : '' }}>35</option>
                                    <option value="40" {{ old('user_pagination_limit', session('user_pagination_limit')) == 40 ? 'selected' : '' }}>40</option>
                                    <option value="45" {{ old('user_pagination_limit', session('user_pagination_limit')) == 45 ? 'selected' : '' }}>45</option>
                                    <option value="50" {{ old('user_pagination_limit', session('user_pagination_limit')) == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </center>
                        </td>
                        <td>
                            <center>
                                <button type="submit" class="btn btn-primary">
                                    Set
                                </button>
                            </center>
                        </td>
                    </tr>
                </form>

                <form action="/paginationlist" method="post">
                    @csrf
                    <tr>
                        <td>
                            <center>Question Pattern List</center>
                        </td>
                        <td>
                            <center>

                                <select name="pattern_pagination_limit" id="pattern-pagination-limit" class="form-control">
                                    <option value="5" {{ session('pattern_pagination_limit') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ session('pattern_pagination_limit') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ session('pattern_pagination_limit') == 15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ session('pattern_pagination_limit') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="25" {{ session('pattern_pagination_limit') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="30" {{ session('pattern_pagination_limit') == 30 ? 'selected' : '' }}>30</option>
                                    <option value="35" {{ session('pattern_pagination_limit') == 35 ? 'selected' : '' }}>35</option>
                                    <option value="40" {{ session('pattern_pagination_limit') == 40 ? 'selected' : '' }}>40</option>
                                    <option value="45" {{ session('pattern_pagination_limit') == 45 ? 'selected' : '' }}>45</option>
                                    <option value="50" {{ session('pattern_pagination_limit') == 50 ? 'selected' : '' }}>50</option>
                                </select>

                            </center>
                        </td>
                        <td>
                            <center>
                                <button type="submit" class="btn btn-primary">
                                    Set
                                </button>
                            </center>
                        </td>
                    </tr>
                </form>

                <form action="/ResultListPagintaion" method="post">
                    @csrf
                    <tr>
                        <td>
                            <center>Result List</center>
                        </td>
                        <td>
                            <center>
                                <select name="result_pagination_limit" id="result-pagination-limit" class="form-control">
                                    @for ($i = 5; $i <= 50; $i+=5) <option value="{{ $i }}" {{ session('result_pagination_limit') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                </select>
                            </center>
                        </td>
                        <td>
                            <center>
                                <button type="submit" class="btn btn-primary">
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