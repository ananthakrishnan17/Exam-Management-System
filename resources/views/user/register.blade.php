@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"  href="icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
</head>
<body>
    <form method="post" action="/store">
        <h1 id="reg-h1">
            <i class="fa fa-user-circle" aria-hidden="true"></i> User . Register
        </h1>
        <br>
        <div class="reg-content">
            <table class="reg-table">
                <tr>
                    <td class="text-primary" id="column">
                        First Name <span class="text-danger">*</span>
                    </td>
                    <td>
                        <input class="input-field" name="firstName" type="text" value="{{old('firstName')}}">
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('firstName'))
                            &nbsp;{{ $errors->first('firstName') }}
                        @endif
		            </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        Last Name  <span class="text-danger">*</span>
                    </td>
                    <td>
                        <input class="input-field" name="lastName" type="text" value="{{old('lastName')}}">
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('lastName'))
                            &nbsp;{{ $errors->first('lastName') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        Gender <span class="text-danger">*</span>
                    </td>
                    <td id="radio_btns">
                        <input class="married" type="radio" name="gender" value="0" {{old('gender')=='0' ? 'checked' : ''}}>&nbsp;Male
                        <input type="radio" name="gender" value="1" {{old('gender')=='1' ? 'checked' : ''}}>&nbsp;Female
                        <input type="radio" name="gender" value="2" {{old('gender')=='2' ? 'checked' : ''}}>&nbsp;Others
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('gender'))
                            &nbsp;{{ $errors->first('gender') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        DOB  <span class="text-danger">*</span>
                    </td>
                    <td >
                        <input class="input-field" name="dob" type="date" value="{{old('dob')}}"  >
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('dob'))
                            &nbsp;{{ $errors->first('dob') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        Marital Status  <span class="text-danger">*</span>
                    </td>
                    <td id="radio_btns">
                        <input class="married" type="radio" name="maritialStatus" value="1" {{old('maritialStatus')=='1' ? 'checked' : ''}}>&nbsp;Married
                        <input type="radio" name="maritialStatus" value="0" {{old('maritialStatus')=='0' ? 'checked' : ''}}>&nbsp;Single
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('maritialStatus'))
                            &nbsp;{{ $errors->first('maritialStatus') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        Email <span class="text-danger">*</span>
                    </td>
                    <td >
                        <input class="input-field" name="email" value="{{old('email')}}">
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('email'))
                            &nbsp;{{ $errors->first('email') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="text_area">
                        Address  <span class="text-danger">*</span>
                    </td>
                    <td >
                        <textarea class="add" type="text" rows="3" cols="24" name="address"> {{old('address')}}</textarea>
                    </td>
                    <td class="text-danger" id="reg_text_area_field">
                        @if ($errors->has('address'))
                            &nbsp;{{ $errors->first('address') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        Contact Number  <span class="text-danger">*</span>
                    </td>
                    <td >
                        <input type="text" class="input-field" name="contactNumber" value="{{old('contactNumber')}}">
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('contactNumber'))
                            &nbsp;{{ $errors->first('contactNumber') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        Year of Graduation <span class="text-danger">*</span>
                    </td>
                    <td class="td">
                        <input type="text" class="input-field" name="passedout_year" value="{{old('passedout_year')}}">
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('passedout_year'))
                            &nbsp;{{ $errors->first('passedout_year') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column" >
                        CGPA <span class="text-danger">*</span>
                    </td>
                    <td >
                        <input type="text" class="input-field" name="cgpa" value="{{old('cgpa')}}">
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('cgpa'))
                            &nbsp;{{ $errors->first('cgpa') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-primary" id="column">
                        Degree <span class="text-danger">*</span>
                    </td>
                    <td >
                        <select class="degree" name="degree" >
                            <option value=""></option>
                            @foreach($degrees as $degree)
                                <option value="{{ $degree->id }}" {{ old('degree') == $degree->id ? 'selected' : '' }}>{{ $degree->degree_name_s }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-danger" id="error_collum">
                        @if ($errors->has('degree'))
                            &nbsp;{{ $errors->first('degree') }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <br>
		<div class="footer">
            <button type="submit" class="btn btn-success" id="btn_register">
                <i class="fa fa-plus"></i>&nbsp;Register
            </button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='/user/list'" id="reg_cancel">
                <i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp;Cancel
            </button>
        </div>
        @csrf
    </form>
</body>
</html>
@stop
