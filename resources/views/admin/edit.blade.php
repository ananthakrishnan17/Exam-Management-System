@extends('layouts.layout')

@section('content')
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"  href="icon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
</head>
<body>
    <h1 id="h1"><i class="fa fa-user icon" aria-hidden="true"></i> Admin . Edit</h1>
    <form method="post" action="{{route('admins.update',$admins->id)}}">
    @csrf
    @method('put')
	    <div class="content">
	        <table class="table-edit">
                <tr>
                    <td id="title_field" class="text-primary">
                        Admin Id <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td class="text-danger" id="usr_id">
                        &nbsp;{{$admins->admin_id}}
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        First Name  <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input class="input-field" name="first_name" type="text" value="{{$admins->first_name}}">
                    </td>
                    <td class="text-danger" >
                        @if ($errors->has('first_name'))
                            &nbsp;{{ $errors->first('first_name') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Last Name  <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td >
                        <input class="input-field" name="last_name" type="text" value="{{$admins->last_name}}">
                    </td>
                    <td class="text-danger" >
                        @if ($errors->has('last_name'))
                            &nbsp;{{ $errors->first('last_name') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        DOB  <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input class="input-field" name="dob"  type="date" value="{{$admins->dob}}" >
                    </td>
                    <td class="text-danger" >
                        @if ($errors->has('dob'))
                            &nbsp;{{ $errors->first('dob') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Gender  <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td class="gender">
                        <input type="radio" name="gender"  value='0' {{ $admins->gender === '0' ? 'checked' : '' }}>&nbsp;Male
                        <input type="radio" name="gender" value='1' {{ $admins->gender === '1' ? 'checked' : '' }}>&nbsp;Female
                        <input type="radio" name="gender" value="2" {{ $admins->gender === '2' ? 'checked' : ''}}>&nbsp;Others
                    </td>
                    <td class="text-danger" >
                        @if ($errors->has('gender'))
                            &nbsp;{{ $errors->first('gender') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Email  <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td >
                        <input class="input-field" name="email" value="{{ $admins->email}}">
                    </td>
                    <td class="text-danger" >
                        @if ($errors->has('email'))
                            &nbsp;{{ $errors->first('email') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Maritial Status <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td class="maritial">
                        <input  type="radio" name="marital_status" value='1' {{ $admins->marital_status === '1' ? 'checked' : '' }}>&nbsp;Married
                        <input type="radio" name="marital_status" value='0' {{ $admins->marital_status === '0' ? 'checked' : '' }}>&nbsp;Single
                    </td>
                    <td class="text-danger" >
                        @if ($errors->has('marital_status'))
                            &nbsp;{{ $errors->first('marital_status') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field1" class="text-primary">
                        Address <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td id="title_field2">
                        <textarea type="text" rows="3" cols="24" name="address"> {{ $admins->address}}</textarea>
                    </td>
                    <td class="text-danger" id="title_field3" >
                        @if ($errors->has('address'))
                            &nbsp;{{ $errors->first('address') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Contact Number  <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td >
                        <input type="text" class="input-field" name="contact_number" value="{{ $admins->contact_number}}">
                    </td>
                    <td class="text-danger" >
                        @if ($errors->has('contact_number'))
                            &nbsp;{{ $errors->first('contact_number') }}
                        @endif
                    </td>
                </tr>
	        </table>
        </div>
        <br>
	    <div class="footer">
            <button class="btn btn-success" type="submit" id="btn_update">
                <i class="fa fa-plus"></i> Update
            </button>
            <button type="button" class="btn btn-danger" id="btn_cancel" onclick="window.location.href='/admin/list'">
                <i class="fa fa-times-circle" aria-hidden="true">&nbsp;Cancel</i>
            </button>
        </div>
    </form>
</body>
</html>
@stop
