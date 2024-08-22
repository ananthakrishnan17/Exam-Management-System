@extends('layouts.layout')

@section('content')
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="icon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
</head>
<body>
    <h1 id="edit_h1"><i class="fa fa-user-circle" aria-hidden="true"></i> User . Edit</h1>
    <form method="post" action="/user_update/{{ $user->id }}">
        @csrf
        @method('put')
        <div class="edit_content">
            <table class="edit_table">
                <tr>
                    <td id="title_field" class="text-primary">
                        User Id <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td class="text-danger" id="usr_id">
                        &nbsp;{{$user->user_id}}
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        First Name <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input class="edit-field" name="first_name" type="text" value="{{$user->first_name}}">
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('first_name'))&nbsp;
                        {{ $errors->first('first_name') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Last Name <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input class="edit-field" name="last_name" type="text" value="{{$user->last_name}}">
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('last_name'))&nbsp;
                            {{ $errors->first('last_name') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        DOB <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input class="edit-field" name="dob" type="date" value="{{$user->dob}}">
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('dob'))&nbsp;
                            {{ $errors->first('dob') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Gender <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td class="gender">
                        <input type="radio" name="gender" value='0' {{ $user->gender === '0' ? 'checked' : '' }}>&nbsp;Male
                        <input type="radio" name="gender" value='1' {{ $user->gender === '1' ? 'checked' : '' }}>&nbsp;Female
                        <input type="radio" name="gender" value="2" {{$user->gender === '2' ? 'checked' : ''}}>&nbsp;Others
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('gender'))
                        &nbsp;{{ $errors->first('gender') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Email <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input class="edit-field" name="email" value="{{$user->email}}">
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('email'))&nbsp;
                            {{ $errors->first('email') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Maritial Status <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td class="maritial">
                        <input type="radio" name="marital_status" value='1' {{ $user->marital_status === '1' ? 'checked' : '' }}>&nbsp;Married
                        <input type="radio" name="marital_status" value='0' {{ $user->marital_status === '0' ? 'checked' : '' }}>&nbsp;Single
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('marital_status'))&nbsp;
                            {{ $errors->first('marital_status') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field1" class="text-primary">
                        Address <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td id="title_field2">
                        <textarea type="text" rows="3" cols="28" name="address">{{$user->address}}</textarea>
                    </td>
                    <td class="text-danger" id="title_field3">
                        @if ($errors->has('address'))&nbsp;
                            {{ $errors->first('address') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Contact Number <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="text" class="edit-field" name="contact_number" value="{{$user->contact_number}}">
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('contact_number'))&nbsp;
                            {{ $errors->first('contact_number') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Year of Graduation <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="text" class="edit-field" name="yearof_graduation" value="{{$user->year_of_graduation}}">
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('yearof_graduation'))&nbsp;
                            {{ $errors->first('yearof_graduation') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        CGPA <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <input type="text" class="edit-field" name="cgpa" value="{{$user->cgpa}}">
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('cgpa'))&nbsp;
                            {{ $errors->first('cgpa') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td id="title_field" class="text-primary">
                        Degree <span class="text-danger">*</span>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <select class="edit-field" name="degree">
                            @foreach($degrees as $degree)
                                <option value="{{ $degree->id }}" {{ $user->degree_id == $degree->id ? 'selected' : '' }}>
                                    {{ $degree->degree_name_s }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-danger">
                        @if ($errors->has('degree'))&nbsp;
                            {{ $errors->first('degree') }}
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
            <button type="button" class="btn btn-danger" id="edit_cancel" onclick="window.location.href='/user/list'">
                <i class="fa fa-times-circle" aria-hidden="true">&nbsp;Cancel</i>
            </button>
        </div>
    </form>
</body>
</html>
@stop
