@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/master.js') }}" defer></script>

</head>

<body>
    <h1>
        <i class="fa fa-graduation-cap" aria-hidden="true"></i> Degree . List
    </h1>
    <br>
    <div class="container-fluid">
        <a href="{{url('master/masterlist')}}" >
            <button class="btn btn-warning" id="back-btns" type="button">
                <i class="fa fa-arrow-left icon"></i> Back
            </button>
        </a>
        <a href="{{url('master/degreeregister')}}">
            <button type="button" id="register-btn" class="btn btn-success">
                <i class="fa fa-plus"></i>&nbsp;Register
            </button>
        </a>

        <div class="search-box">
            <div class="box">
                <input id="searchInput" type="text" placeholder="Type Something...">
                <a href="#">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive" id="list_table">
        <table class="table table-bordered table-striped" id="table_list">
            <thead>
                <tr id="heading">
                    <th>
                        <center>S.No</center>
                    </th>
                    <th>Degree</th>
                    <th>Degree Name</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $user)
                <tr>
                    <td>
                        <center>
                            {{ $loop->index + 1 }}
                        </center>
                    </td>
                    <td>
                        {{ $user->degree_name_s }}
                    </td>
                    <td>
                        {{ $user->degree_name }}
                    </td>
                    <td>
                        <center>
                            <a href="{{ url('master/degreeview',$user->id) }}" class="userid">
                                view
                            </a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="{{ route('users.masteredit', $user->id) }}" class="userid">
                                Edit
                            </a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="#" class="delete-btn" data-id="{{ $user->id }}">
                                <i class="fa fa-trash" id="delete" aria-hidden="true"></i>
                            </a>
                        </center>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Function to confirm delete action as a SweetAlert pop-up
        function confirmDelete(id) {
            return Swal.fire({
                title: 'Are you sure?',
                text: 'You about to delete this degree data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                return result.isConfirmed;
            });
        }

        // Function to show error message as a SweetAlert pop-up
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message
            });
        }

        // Function to show success message as a SweetAlert pop-up
        function showSuccess(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: message
            });
        }

        // Handle AJAX request for deleting a record
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            confirmDelete(id).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        url: '{{ route("users.masterdelete", ["id" => $user->id]) }}', // Use the correct variable $user->id
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            showSuccess(response.message);
                            location.reload(); // Reload the page
                        },
                        error: function(xhr, status, error) {
                            showError(xhr.responseJSON.message);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
@endsection