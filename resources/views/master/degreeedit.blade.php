@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="icon.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap<link rel=" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
</head>
<body>
    <h1 id="h1">
        <i class="fa fa-graduation-cap" aria-hidden="true"></i> Degree . Edit
    </h1>
    <br>
    <form method="post" action="{{ route('users.masterupdate', $user->id) }}">
        @csrf
        @method('put')
        <div class="contents">
            <label id="degree_s" class="text-primary">
                Degree <span class="important">*</span>
            </label>
            <input name="degree_s" id="input-field" type="text" value="{{$user->degree_name_s}}">
                @if ($errors->has('degree_s'))
                    <span class="text-danger">&nbsp;{{ $errors->first('degree_s') }}</span>
                @endif
                <br>
            <label id="degre" class="text-primary">
                Degree Name <span class="important">*</span>
            </label>
            <input name="degree" id="input-field" type="text" value="{{$user->degree_name}}">
                @if ($errors->has('degree'))
                    <span class="text-danger">&nbsp;{{ $errors->first('degree') }}</span>
                @endif
        </div>
        <br>
        <div class="footer">
            <button class="btn btn-success" type="submit" id="update">
                <i class="fa fa-plus"></i> Update
            </button>
            <button type="button" class="btn btn-danger" id="cancel" onclick="window.location.href='/master/degreelist'">
                <i class="fa fa-times-circle">&nbsp;Cancel</i>
            </button>
        </div>
    </form>
</body>
</html>
@stop
