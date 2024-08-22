@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="icon.css">
    <link href="https://maxcdn.bootstrapcdn.com/b<link rel=" stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <script src="{{ asset('js/user.js') }}"></script>
</head>

<body>
    <h1 id="view_h1"><i class="fa fa-user-circle" aria-hidden="true"></i> User . View</h1>
    <div class="button">
        <a href="{{ route('users.edits', $student->id) }}">
            <button type="button" class="btn btn-success" id="view_edit-btn">
                <i class="fa fa-edit icon"></i> Edit
            </button>
        </a>
        <a href="javascript:history.back()" id="back">
            <button class=" btn btn-warning" id="view_back-btn" type="button">
                <i class="fa fa-arrow-left icon"></i> Back
            </button>
        </a>
    </div>
    <br>
    <div class="container-flui" id="singleview">
        <table class="table-borderless">
            <tr>
                <td class="text-primary" id="view_title">
                    User Id
                </td>
                <td class="text-danger" id="space1">
                    {{ $student->user_id }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    First Name
                </td>
                <td id="space">
                    {{ $student->first_name }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Last Name
                </td>
                <td id="space">
                    {{ $student->last_name }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Gender
                </td>
                <td id="space">
                    @if($student->gender == 0)
                        Male
                    @elseif($student->gender == 1)
                        Female
                    @else
                        Others
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    DOB
                </td>
                <td id="space">
                    {{ date('d-m-Y', strtotime($student->dob)) }}&nbsp;&nbsp; ( Age: <span id="age"></span> )
                </td>
                <script>
                    var dateOfBirth = '{{$student->dob}}';
                    var age = calculateAge(dateOfBirth);
                    document.getElementById('age').innerText = age;
                </script>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Marital Status
                </td>
                <td id="space">
                    {{ $student->marital_status ? 'Married' : 'Single' }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Email
                </td>
                <td id="space">
                    {{ $student->email }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Year of Graduation
                </td>
                <td id="space">
                    {{ $student->year_of_graduation }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Contact Number
                </td>
                <td id="space">
                    {{ $student->contact_number }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Address
                </td>
                <td id="space">
                    {{ $student->address }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    CGPA
                </td>
                <td id="space">
                    {{ $student->cgpa }}
                </td>
            </tr>
            <tr>
                <td class="text-primary" id="view_title">
                    Degree
                </td>
                <td id="space">
                    {{ $studentDegree->degree_name }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
@stop
