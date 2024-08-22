@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <script src="js/master/list.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/user.js') }}" defer></script>
</head>

<body>
    <h1 id="header">
        <i class="fa fa-user-circle" aria-hidden="true"></i> User . List
    </h1>
    <a href="{{url('user/register')}}">
        <button type="button" id="list_register" class="btn btn-success">
            <i class="fa fa-plus"></i>&nbsp;Register
        </button>
    </a>
    <div class="search-box">
        <div class="box">
            <input id="searchInput" type="text" placeholder="Type Something...">
            <a href="#">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="table-responsive" id="table_list">
        <table class="table table-bordered table-striped" id="table_list">
            <thead>
                <tr id="table_head">
                    <th>
                        <center>S.No</center>
                    </th>
                    <th>
                        <center>User Id</center>
                    </th>
                    <th>
                        <center>First Name</center>
                    </th>
                    <th>
                        <center>Last Name</center>
                    </th>
                    <th>
                        <center>Gender</center>
                    </th>
                    <th>
                        <center>DOB</center>
                    </th>
                    <th>
                        <center>Email</center>
                    </th>
                    <th>
                        <center>Year of Graduation</center>
                    </th>
                    <th>
                        <center>Contact Number</center>
                    </th>
                    <th>
                        <center>CGPA</center>
                    </th>
                    <th>
                        <center>Degree</center>
                    </th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $key = ($students->currentPage() - 1) * $students->perPage() + 1; @endphp
                @foreach($students as $users)
                <tr>
                    <td>
                        <center>
                            {{ $key}}
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="{{ url('user/view',$users->id) }}" class="text-danger font-weight-bold">
                                {{ $users->user_id }}
                            </a>
                        </center>
                    </td>
                    <td>
                        {{ $users->first_name }}
                    </td>
                    <td>
                        {{ $users->last_name }}
                    </td>
                    <td>
                        <center>
                            @if($users->gender == 0)
                                Male
                            @elseif($users->gender == 1)
                                Female
                            @else
                                Others
                            @endif
                        </center>
                    </td>
                    <td>
                        <center>
                            {{ date('d-m-Y', strtotime($users->dob)) }}
                        </center>
                    </td>
                    <td>
                        {{ $users->email }}
                    </td>
                    <td>
                        <center>
                            {{ $users->year_of_graduation }}
                        </center>
                    </td>
                    <td>
                        <center>
                            {{ $users->contact_number }}
                        </center>
                    </td>
                    <td>
                        <center>
                            {{ $users->cgpa }}
                        </center>
                    </td>
                    <td>
                        @foreach($degrees as $degree)
                            @if($degree->id == $users->degree_id)
                                {{ $degree->degree_name_s }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <center>
                            <a href="{{ route('users.notuse', ['id' => $users->id]) }}" class="text-danger">
                                <b>{{ $users->use_notuse ? 'Use' : 'Not Use' }}</b>
                            </a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="{{ route('users.delete', ['id' => $users->id]) }}" class="text-danger">
                                <i class="fa fa-trash icon"></i>
                            </a>
                        </center>
                    </td>
                </tr>
                @php $key++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span class="pagination-label">
            Page {{ $students->currentPage() }} of {{ $students->lastPage() }}
        </span>
            @if ($students->onFirstPage())
                <span class="pagination-button disabled">
                    Previous
                </span>
                @else
                    <a href="{{ $students->previousPageUrl() }}" class="pagination-button">
                        Previous
                    </a>
            @endif
        @php
            $start = max(1, $students->currentPage() - 2);
            $end = min($students->lastPage(), $students->currentPage() + 2);
        @endphp
        @for ($i = $start; $i <= $end; $i++)
            <a href="{{ $students->url($i) }}" class="pagination-number {{ $students->currentPage() == $i ? 'current' : '' }}">
                {{ $i }}
            </a>
        @endfor
            @if ($students->hasMorePages())
                <a href="{{ $students->nextPageUrl() }}" class="pagination-button">Next</a>
            @else
                <span class="pagination-button disabled">Next</span>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/masterlist.js') }}"></script>
</body>

</html>
@stop