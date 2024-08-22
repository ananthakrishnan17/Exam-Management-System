@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">   
</head>
<body>
    <h1>
        <i class="fa fa-graduation-cap" aria-hidden="true"></i> Degree . View
    </h1>
    <div class="button">
        <a href="{{ route('users.masteredit', $student->id) }}">
            <button class="btn btn-success" id="edit-btn" type="button">
                <i class="fa fa-edit icon"></i> Edit
            </button>
        </a>
        <a href="javascript:history.back()" id="back">
            <button class=" btn btn-warning" id="back-btn" type="button">
                <i class="fa fa-arrow-left icon"></i> Back
            </button>
        </a>
    </div>
    <div id="list">
        <p class="degrees">
            <span id="name" class="text-primary">Degree</span>
            <span class="degreename">{{ $student->degree_name_s }}</span>
        </p>
        <p class="degree">
            <span id="name" class="text-primary">Degree Name</span>
            <span class="degreename">{{ $student->degree_name }}</span>
        </p>
    </div>
</body>
</html>
@stop
