<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/layout.js') }}" defer></script>
</head>
<body>
    @php
    $role = session()->get('role');
    @endphp
    @if($role == 0)
    <h2 class="head  text-white p-2">&nbsp;SuperAdmin
        <a href="{{url('logout')}}" id="logout">
            <i class="fa fa-power-off icon"></i>
            <span id="logout-text">Logout</span>
        </a>
    </h2>
    <ul class="nav nav-tabs" id="ul_list">
        <li class="nav-item" id="admin">
            <a class="nav-link" href="/admin/list" id="menu_A">Admin</a>
        </li>
        <li class="nav-item" id="user">
            <a class="nav-link" href="/user/list" id="menu_A">User</a>
        </li>
        <li class="nav-item" id="questions">
            <a class="nav-link" href="/question/pattern-list" id="menu_A">Question</a>
        </li>
        <li class="nav-item" id="result">
            <a class="nav-link" href="/result/list" id="menu_A">Result</a>
        </li>
        <li class="nav-item" id="master">
            <a class="nav-link" href="/master/masterlist" id="menu_A">Master</a>
        </li>
    </ul>

    <div class="container-fluid">
        @yield('content')
    </div>

    @else
    <h1 class="head text-white p-2">&nbsp;Admin
        <a href="{{url('logout')}}" id="logout">
            <i class="fa fa-power-off icon"></i>
            <span id="logout-text">Logout</span>
        </a>
    </h1>
    <ul class="nav nav-tabs" id="ul_list">
        <li class="nav-item" id="user">
            <a class="nav-link" href="/user/list" id="menu_A">User</a>
        </li>
        <li class="nav-item" id="questions">
            <a class="nav-link" href="/question/pattern-list" id="menu_A">Question</a>
        </li>
        <li class="nav-item" id="result">
            <a class="nav-link" href="/result/list" id="menu_A">Result</a>
        </li>
    </ul>


    <div class="container-fluid">
        @yield('content')
    </div>

    <!-- Bootstrap JS (Optional - if you need JavaScript features) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endif
</body>
</html>
