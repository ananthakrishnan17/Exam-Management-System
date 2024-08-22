@extends('layouts.layout')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"  href="icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
</head>
<body>
    <form method="post" action="/graduate">
        <h1>
            <i class="fa fa-graduation-cap" aria-hidden="true"></i> Degree . Register
        </h1>
        <div class="container-fluid" id="content">
            <div class="form-group">
                <label for="degree_s" class="text-primary" id="degrees">
                    Degree <span class="important">*</span>
                </label>
                <input id="input-field"  name="degree_s" type="text" value="{{old('degree_s')}}">
                @if ($errors->has('degree_s'))
                    <span class="text-danger">&nbsp;{{ $errors->first('degree_s') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="degree" class="text-primary" id="degree">
                    Degree Name <span class="important">*</span>
                </label>
                <input id="input-field"  name="degree" type="text" value="{{old('degree')}}">
                @if ($errors->has('degree'))
                    <span class="text-danger">&nbsp;{{ $errors->first('degree') }}</span>
                @endif
            </div>
        </div>
        <div class="footer"  id="footer">
            <button type="submit" class="btn btn-success" id="register">
                <i class="fa fa-plus"></i>&nbsp;Register
            </button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='/master/degreelist'" id="cancel">
                <i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp;Cancel
            </button>
        </div>
        @csrf
    </form>
</body>
</html>
@stop
