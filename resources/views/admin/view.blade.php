@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <script src="{{ asset('js/admin.js') }}"></script>
</head>
<body>
    <div class="container-fluid">
        <h1 id="header-view">
            <i class="fa fa-user icon" aria-hidden="true"></i> Admin . View
        </h1>
        <div class="main">
            <button type="button" class="btn btn-secondary" id="back" name="back" value="Back" onclick="window.history.back()">
                <i class="fa fa-arrow-left icon"></i> Back
            </button>
         
            <a href="{{route('Auth.AdminEdit',$admins->id)}}">
                <button  class="btn btn-success font-weight-bold" id="edit">
                    <i class="fa fa-edit icon"></i> Edit
                </button>
            </a>
        </div>
        <div class="body">
            <table class="table-view">
                <tr>
                    <td>
                        <b class="text-primary">Admin ID</b>
                    </td>
                    <td class="text-danger data">
                        <b>{{$admins->admin_id}}</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b class="text-primary">First Name</b>
                    </td>
                    <td class="data">
                        {{$admins->first_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b class="text-primary">Last Name</b>
                    </td>
                    <td class="data">
                        {{$admins->last_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                       <b class="text-primary"> DOB</b>
                    </td>
                    <td class="data">
                        {{ date('d-m-Y', strtotime($admins->dob)) }} (Age: <span id="age"></span>)
                    </td>
                    <script>
                        var dateOfBirth = '{{$admins->dob}}';
                        var age = calculateAge(dateOfBirth);
                        document.getElementById('age').innerText = age;
                    </script>
                </tr>
                <tr>
                    <td>
                       <b class="text-primary"> Gender</b>
                    </td>
                    <td class="data">
                        @if($admins->gender == 0)
                            Male
                        @elseif($admins->gender == 1)
                            Female
                        @else
                            Others
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                       <b class="text-primary"> Email</b>
                    </td>
                    <td class="data">
                     {{$admins->email}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b class="text-primary">Contact</b>
                    </td>
                    <td class="data">
                        {{$admins->contact_number}}
                    </td>
                </tr>
                <tr>
                    <td>
                       <b class="text-primary"> Address</b>
                    </td>
                    <td class="data">
                        {{$admins->address}}
                    </td>
                </tr>
                <tr>
                    <td>
                       <b class="text-primary"> Marital Status</b>
                    </td>
                    <td class="data">
                        {{$admins-> marital_status ? 'Married' : 'Single' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
@stop
