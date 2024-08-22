
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('css/question.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-AJpXi1j3eMWUcHJzZEdho3d8FvM9ZNG3T0SKa+kCmfGJv8Qz4v1piST02QVfTOQ" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script src="{{ asset('js/question.js') }}"></script>

<body id="pattern-bg">

 <form action="/quest" method="post" id="pattern-register-header">

    @csrf

    <br><br><br>

    <div class="mypage">

        <div class="form-group row" id="loginPage">

            <div class="col-sm-12">

                <h2 id="pattern_header">QUESTION PATTERN REGISTRATION</h2>

            </div>

        </div><br>

        <div class="form-group row">

            <label for="Question_Pattern" id="text" class="col-lg-4 col-form-label">Question Pattern&nbsp;<span class="star">*</span></label>

            <div class="col-sm-15">

                <input type="text" name="question_pattern_id" class="form-control" id="Question_Pattern" >

                <p class="error-message"></p>

            </div>

        </div>

        <div class="">

        </div>

        <br>

        <div class="form-group row">

            <div class="col-sm-10">

                <button type="submit" id="login" class="btn btn-primary">Create</button><br><br>

            </div>

        </div>

    </div>

</body>

</form>

