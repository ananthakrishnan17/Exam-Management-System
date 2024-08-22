<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Pattern Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
</head>
<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="question_pattern_id" class="form-control datepicker" id="Question_Pattern" required>
                                    <span class="input-group-text" id="datepicker">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @if ($errors->has('question_pattern_id'))
                                   
                                    <script>
                                        $(document).ready(function () {
                                            alert('{{ $errors->first('question_pattern_id') }}');
                                        });
                                    </script>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger mt-2">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <button type="submit" id="login" class="btn btn-primary">Create</button>
                                <button type="button" id="livecancel" class="btn btn-primary" onclick="window.location.href='/question/pattern-list';">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body"></div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize the datepicker on the input field with 'datepicker' class
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Specify the date format
                autoclose: true // Close the datepicker when a date is selected
            });
        });
    </script>
</body>
</html>
