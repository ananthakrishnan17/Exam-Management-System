@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/result.css') }}">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Result List</title>
    <script src="{{ asset('js/result.js') }}" defer></script>

</head>
<body>
        <div class="list-head">
            <h1><i class="fa fa-list" aria-hidden="true"></i> Result . List</h1>
        </div>
        <div class="search-box">
            <div class="box">
                <input id="searchInput" type="text" placeholder="Type Something...">
                <a href="#">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <table class="table-hover" id="table_list">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Question Pattern</th>
                    <th>Exam Date</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questionPatterns as $questionPattern)
                    @php
                        $examDate = \Carbon\Carbon::parse($questionPattern->created_date);
                        $currentMonth = \Carbon\Carbon::now()->month;
                        $currentYear = \Carbon\Carbon::now()->year;
                        $examMonth = $examDate->month;
                        $examYear = $examDate->year;
                    @endphp
                    @if ($examYear == $currentYear && ($examMonth == $currentMonth || $examMonth == $currentMonth - 1))
                        <tr>
                            <td>{{ $questionPattern->user_id }}</td>
                            <td class="user-name">
                                @if ($questionPattern->employeeDetails)
                                    {{ $questionPattern->employeeDetails->first_name }} {{ $questionPattern->employeeDetails->last_name }}
                                @else
                                    Employee details not available
                                @endif
                            </td>
                            <td>{{ $questionPattern->question_pattern_id }}</td>
                            <td>{{ $examDate->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ url('result/view',$questionPattern->user_id) }}">View Result</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
        <span class="pagination-label">Page {{ $questionPatterns->currentPage() }} of {{ $questionPatterns->lastPage() }}</span>
        
        @if ($questionPatterns->onFirstPage())
            <span class="pagination-button disabled">Previous</span>
        @else
            <a href="{{ $questionPatterns->previousPageUrl() }}" class="pagination-button">Previous</a>
        @endif
        
        @php
            $start = max(1, $questionPatterns->currentPage() - 2);
            $end = min($questionPatterns->lastPage(), $questionPatterns->currentPage() + 2);
        @endphp
        
        @for ($i = $start; $i <= $end; $i++)
            <a href="{{ $questionPatterns->url($i) }}" class="pagination-number {{ $questionPatterns->currentPage() == $i ? 'current' : '' }}">{{ $i }}</a>
        @endfor
        
        @if ($questionPatterns->hasMorePages())
            <a href="{{ $questionPatterns->nextPageUrl() }}" class="pagination-button">Next</a>
        @else
            <span class="pagination-button disabled">Next</span>
        @endif
    </div>
</body>
</html>
@stop
