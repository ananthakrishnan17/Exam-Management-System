<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTS</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form class="form-horizontal" action="/Authenticate" method="post">
        @csrf
            <h2 id="panel">&nbsp;User Login</h2>
            <div class="input-box">
                <div>
                    <label><b>User Id<b></label>
                    <input type="text" name="user_id" value="{{old('user_id')}}">
                    @if($errors -> has ('user_id'))
                        <span class="text-danger">{{$errors->first('user_id')}}</span>
                    @endif
                </div>
                <br>

                <div>
                    <label id="password-label"><b>Password<b></label>
                    <input type="password" name="contact_number" value="{{old('contact_number')}}">
                    @if($errors -> has ('contact_number'))
                        <span class="text-danger">{{$errors->first('contact_number')}}</span>
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
