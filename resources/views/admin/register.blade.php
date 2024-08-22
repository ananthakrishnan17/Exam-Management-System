@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
</head>
<body>
    <form method="post" action="/Adminstores">
    @csrf
    <div class="container-fluid">
        <h1 id="header-register">
            <i class="fa fa-user icon" aria-hidden="true"></i> Admin . Register
        </h1>
        <div class="content-register">
            <table class="table-reg">
                <tr>
                    <td class="reg">
                        <p class="text-primary m-1">
                            First Name <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <input class="input-field-reg text" type="text" name="fname" value="{{old('fname')}}" >
                    </td>
                    <td class="err">
                        @if($errors->has('fname'))
                            <span class="text-danger">&nbsp;&nbsp;{{$errors->First('fname')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="reg">
                        <p class="text-primary m-1">
                            Last Name <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <input class="input-field-reg text" type="text" name="lname" value="{{old('lname')}}" >
                    </td>
                    <td class="err">
                        @if($errors->has('lname'))
                            <span class="text-danger">&nbsp;&nbsp;{{$errors->First('lname')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="reg">
                        <p class="text-primary m-1">
                            Gender <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <input type="radio" id="gender" name="gender" value="0" {{old('gender')=='0' ? 'checked' : ' '}}>&nbsp;Male&nbsp;
                        <input type="radio"  name="gender" value="1" {{old('gender')=='1' ? 'checked' : ' '}}>&nbsp;Female&nbsp;
                        <input type="radio"  name="gender" value="2" {{old('gender')=='2' ? 'checked' : ' '}}>&nbsp;Others
                    </td>
                    <td class="err">
                        @if($errors->has('gender'))
                            <span class="text-danger">&nbsp;&nbsp;{{$errors->First('gender')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="reg">
                        <p class="text-primary m-1">
                            DOB  <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <input class="input-field-reg text"  type="date"  name="dob" value="{{old('dob')}}">
                    </td>
                    <td class="err">
                        @if($errors->has('dob'))
                            <span class="text-danger">&nbsp;&nbsp;{{$errors->First('dob')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="reg">
                        <p class="text-primary m-1">
                            Marital Status <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <input type="radio" id="marital" name="marital" value="0" {{old('marital')=='0' ? 'checked' : ' '}} >&nbsp;Single&nbsp;
                        <input type="radio"  name="marital" value="1" {{old('marital')=='1' ? 'checked' : ' '}}>&nbsp;Married
                    </td>
                    <td class="err">
                        @if($errors->has('marital'))
                            <span class="text-danger">&nbsp;&nbsp;{{$errors->First('marital')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="reg">
                        <p class="text-primary m-1">
                            Email  <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <input class="input-field-reg text" name="email" value="{{old('email')}}" >
                    </td>
                    <td class="err">
                        @if($errors->has('email'))
                            <span class="text-danger">&nbsp;&nbsp;{{$errors->First('email')}}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="address" class="reg">
                         <p class="text-primary m-1" >
                            Address  <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <textarea type="text" rows="4" cols="24" name="address" value="{{old('address')}}">{{old('address')}}</textarea>
                    </td>
                    <td class="err" id="err-address">
                        @if($errors->has('address'))
                            <span class="text-danger" >&nbsp;&nbsp;{{$errors->First('address')}}</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="reg">
                        <p class="text-primary m-1">
                            Contact Number <span class="text-danger">*</span>
                        </p>
                    </td>
                    <td class="td-red reg">
                        <input class="input-field-reg text" name="contact_no" value="{{old('contact_no')}}">
                    </td>
                    <td class="err">
                        @if($errors->has('contact_no'))
                            <span class="text-danger">&nbsp;&nbsp;{{$errors->First('contact_no')}}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer-register">
            <button type="submit" class="btn btn-success " id="register-reg" >
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Register
            </button>
            <button type="button" class="btn btn-danger " id="cancel-reg" onclick="window.location.href='/admin/list'" >
                <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;Cancel
            </button>
        </div>
    </div>
    </form>
</body>
</html>
@stop
