@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
</head>
<body>
    <div class="container-fluid">
        <h1 id="header-list">
            <i class="fa fa-user icon" aria-hidden="true"></i> Admin . List
        </h1>
        <div>
            <a href="{{url('admin/register')}}">
                <button type="button" class="btn btn-success btn-lg font-weight-bold" id="register-list" name="register">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Register
                </button>
            </a>
        </div>
        <div class="search-box">
            <div class="box">
                <input id="searchInput" type="text" placeholder="Type Something...">
                <a href="#">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <br>
        <div class="table-responsive" id="table-list">
            <table class="table table-bordered table-striped" id="list-table">
                <thead class="text-white">
                    <tr id="heading">
                        <th><center>S.No</center></th>
                        <th><center>Admin Id</center></th>
                        <th><center>First Name</center></th>
                        <th><center>Last Name</center></th>
                        <th><center>Gender</center></th>
                        <th><center>Email</center></th>
                        <th><center>Contact Number</center></th>
                        <th><center>DOB</center></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $key = ($admins->currentPage() - 1) * $admins->perPage();
                    @endphp
                    @foreach($admins as $admin)
                    <tr>
                        <td>
                            <center>{{ $key + $loop->index + 1 }}</center>
                        </td>
                        <td class="admin-id">
                            <a href="{{url('admin/view',$admin->id)}}" class="text-danger font-weight-bold">
                                <center>{{$admin->admin_id}}</center>
                            </a>
                        </td>
                        <td>
                            {{$admin->first_name}}
                        </td>
                        <td>
                            {{$admin->last_name}}
                        </td>
                        <td>
                            <center>
                                @if($admin->gender == 0)
                                    Male
                                @elseif($admin->gender == 1)
                                    Female
                                @else
                                    Others
                                @endif
                            </center>
                        </td>
                        <td>
                            {{$admin->email}}
                        </td>
                        <td>
                            <center>{{$admin->contact_number}}</center>
                        </td>
                        <td>
                            <center>{{ date('d-m-Y', strtotime($admin->dob)) }}</center>
                        </td>
                        <td>
                            <center>
                                <a href="/{{$admin->id}}" class="text-danger">
                                    <b> {{$admin-> use_notuse ? 'Not Use' : 'Use' }}</b>
                                </a>
                            </center>
                        </td>
                        <td>
                            <center>
                            <a href="{{ route('admin.delete', ['id' => $admin->id]) }}" class="text-danger">
                                <i class="fa fa-trash icon"></i>
                            </a>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                <span class="pagination-label">Page {{ $admins->currentPage() }} of {{ $admins->lastPage() }}</span>
                
                @if ($admins->onFirstPage())
                    <span class="pagination-button disabled">Previous</span>
                @else
                    <a href="{{ $admins->previousPageUrl() }}" class="pagination-button">Previous</a>
                @endif
                
                @php
                    $start = max(1, $admins->currentPage() - 2);
                    $end = min($admins->lastPage(), $admins->currentPage() + 2);
                @endphp
                
                @for ($i = $start; $i <= $end; $i++)
                    <a href="{{ $admins->url($i) }}" class="pagination-number {{ $admins->currentPage() == $i ? 'current' : '' }}">{{ $i }}</a>
                @endfor
                
                @if ($admins->hasMorePages())
                    <a href="{{ $admins->nextPageUrl() }}" class="pagination-button">Next</a>
                @else
                    <span class="pagination-button disabled">Next</span>
                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/masterlist.js') }}"></script>
</body>
</html>
@stop
