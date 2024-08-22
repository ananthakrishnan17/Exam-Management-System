<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/exam.css') }}">
    <title>Questions</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/exam.js') }}" defer></script>
</head>
<body> 
    <div id="container">
        <h1>Aptitude Questions</h1>
        <form id="aptitudeForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @php
                $questionNumber = 1; 
            @endphp
            @foreach ($student as $students)
                <!-- Question {{ $questionNumber }} -->
                <div class="question">
                    <label>{{ $questionNumber }}.{{ $students->question }}</label>
                    <input type="hidden" name="questions[{{ $students->id }}][id]" value="{{ $students->id }}">
                    <div class="options">
                        <label><input type="radio" name="questions[{{ $students->id }}][answer]" value="1"> {{ $students->option1 }}</label>
                        <label><input type="radio" name="questions[{{ $students->id }}][answer]" value="2"> {{ $students->option2 }}</label>
                        <label><input type="radio" name="questions[{{ $students->id }}][answer]" value="3"> {{ $students->option3 }}</label>
                        <label><input type="radio" name="questions[{{ $students->id }}][answer]" value="4"> {{ $students->option4 }}</label>
                    </div>
                </div>
                @php
                    $questionNumber++;
                @endphp
            @endforeach
            <div class="button">
                <input type="submit" value="Submit" class="submit" id="submitBtn">
            </div>
        </form>
    </div>  
</body>
</html>


