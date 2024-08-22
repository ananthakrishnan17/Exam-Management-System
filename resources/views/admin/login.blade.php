<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTS</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body style="background-color:  #dae9f8;   ">
    <div class="container">
        <form action="/authenticate" method="POST">
        @csrf
            <h2 id="panel">&nbsp;Admin Login</h2>
            <div class="input-box">
                <div>
                    <label><b>User Id<b></label>
                    <input type="text" class="login-input" name="admin_id" value="{{old('admin_id')}}">
                    @if($errors -> has ('admin_id'))
                        <span class="text-danger">{{$errors->first('admin_id')}}</span>
                    @endif
                </div>
                <br>

                <div>
                    <label id="password-label"><b>Password<b></label>
                    <input type="password" class="login-input" name="password"  value="{{old('password')}}">
                    @if($errors -> has ('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <br>

                <div>
                    <button type="submit" class="btn btn-primary" id="log-button">Login</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <br>
    @if(session('error'))
        <div class="text-danger text-center">
            {{session('error')}}
        </div>
    @endif
</body>
</html>
