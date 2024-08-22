@extends('layouts.layout')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/result.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/result.js') }}" defer></script>
    <title>Result View</title>
</head>
<body id="body">

    @if(isset($student) && isset($student->employeeDetails) && isset($questions) && $questions->isNotEmpty())
    <h1 class="result-head"><i class="fa fa-clipboard" style="font-size:36px"></i> Result . View - <span id="head">{{ $student->employeeDetails->first_name }} {{ $student->employeeDetails->last_name }}</span></h1>
    <button class="button-back" onclick="goBack()">
        <i class="fa fa-arrow-left"></i> Back
    </button><br>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <div class="">
        <div class="result-section">
            <p><strong>User ID</strong><label id="name1">:  &nbsp;{{ $student->user_id }} </label></p>
        </div>
    </div>
    <table id="table_list">
        <thead>
            <tr>
                <th id="question-id">Qn No</th>
                <th class="question">Question (Question pattern : {{ $student->question_pattern_id }})</th>
                <th id="question-column">Correct Answer</th>
                <th>User Response</th>
                <th id="question-column">Result</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalCorrect = 0;
                $totalIncorrect = 0;
            @endphp
            @foreach ($questions as $question)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td id="question-row">{{ $question->question }}</td>
                    <td id="question-column">
                    @if($question->answer == 1)
                        {{ $question->answer }}: {{ $question->option1 }}
                    @elseif($question->answer == 2)
                        {{ $question->answer }}: {{ $question->option2 }}
                    @elseif($question->answer == 3)
                        {{ $question->answer }}: {{ $question->option3 }}
                    @elseif($question->answer == 4)
                        {{ $question->answer }}: {{ $question->option4 }}
                    @else
                        Unknown
                    @endif
                    </td>
                    <td>
                    @if($question->user_response == 1)
                        1: {{ $question->option1 }}
                    @elseif($question->user_response == 2)
                        2: {{ $question->option2 }}
                    @elseif($question->user_response == 3)
                        3: {{ $question->option3 }}
                    @elseif($question->user_response == 4)
                        4: {{ $question->option4 }}
                    @else
                        Unknown
                    @endif
                    </td>
                    <td id="question-column" class="{{ $question->user_response == $question->answer ? 'correct' : 'incorrect' }}">
                        @if($question->user_response == $question->answer)
                            Correct
                        @else
                            Incorrect
                        @endif
                    </td>

                    @if($question->user_response == $question->answer)
                        @php
                            $totalCorrect++;
                        @endphp
                    @else
                        @php
                            $totalIncorrect++;
                        @endphp
                    @endif
                </tr>
            @endforeach
            <div class="">
            <span id="result-text">Result 
                <label><label id="colan">:</label>&nbsp;
                <label id="totalCorrect"  class="{{ ($totalCorrect / ($totalCorrect + $totalIncorrect) * 100) >= session('pass_percentage') ? 'green' : 'red' }}">{{ $totalCorrect }}</label>
                <label id="colan"> / </label> 
                <label id="total">{{ $totalCorrect + $totalIncorrect }}</label> 
                <label id="colan"  class="{{ ($totalCorrect / ($totalCorrect + $totalIncorrect) * 100) >= session('pass_percentage') ? 'green' : 'red' }}">({{ number_format($totalCorrect / ($totalCorrect + $totalIncorrect) * 100, 2) }}%)</label>
                </label>
            </span>
        </tbody>
    </table>
    <br>
    @else
        <p>No data found.</p>
    @endif
</body>
</html>
@stop
