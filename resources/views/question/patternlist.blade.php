@extends('layouts.app')

@section('content')

@include('layouts.layout')

@yield('content')

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Question Pattern List</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/question.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/question.js') }}"></script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

</head>

<body id="body">



    <h1 id="main">
        <i class="fa fa-list" aria-hidden="true"></i>

        Question Pattern . List<a href="{{ url('logout') }}" id="logout"></a></h1>

    <div class="">

        <div class="table">



            <div id="pattern"  > 

                <livewire:Pattern>
                   
                </livewire:Pattern>
            
            </div>

            <div class="pattern-search-box" id="search-box">

                <div class="box">

                    <input id="searchInput" type="text" placeholder="Type Something...">

                    <a href="#">

                        <i class="fa fa-search" aria-hidden="true"></i>

                    </a>

                </div>

            </div>

    

            <table id="table_list1" class="table table-bordered">

                <thead>

                    <tr id="header">

                        <th id="qp">S.No</th>

                        <th id="qp">Question Pattern</th>

                        <th id="qp">Exam Assignment</th>

                        <th id="qp">Delete</th>

                    </tr>

                </thead>

                <tbody>

                    @php $key = ($questionPatterns->currentPage() - 1) * $questionPatterns->perPage() + 1; @endphp

                    @foreach ($questionPatterns as $pattern)

                    <tr>

                    <center>
                        
                        <td id="cell">{{ $key }}</td>

                        <td id="cell">

                            <a id="question_pattern" href="{{ route('question-list', ['question_pattern_id' => $pattern->question_pattern_id]) }}">
                                {{ $pattern->question_pattern_id }}
                            </a>

                        </td>

                        <td id="cell">


                            <a href="{{ route('unassigned', ['id' => $pattern->id]) }}" class="{{ $pattern->use_notuse ? 'assigned' : 'unassigned' }}">


                                    {{ $pattern->use_notuse ? 'Assigned' : 'Unassigned' }}


                            </a>

                        </td>

                        <td id="cell">

                        <form id="deleteForm_{{ $pattern->question_pattern_id }}" action="{{ route('pattern.destroy', ['pattern' => $pattern->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="btn btn-link text-danger delete-link"  onclick="checkQuestionPattern('{{ $pattern->question_pattern_id }}')" >
                                    <i id="delete" class="fa fa-trash" style="color: red; font-size:20px;" aria-hidden="true" ></i>
                                </a>
                                
                            </form>
                         
            

                        </td>

                    </tr>

                    @php $key++; @endphp

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

                    @for ($i = $start; $i <= $end; $i++) <a href="{{ $questionPatterns->url($i) }}" class="pagination-number {{ $questionPatterns->currentPage() == $i ? 'current' : '' }}">{{ $i }}</a>

                    @endfor

                        @if ($questionPatterns->hasMorePages())

                        <a href="{{ $questionPatterns->nextPageUrl() }}" class="pagination-button">Next</a>

                        @else

                        <span class="pagination-button disabled">Next</span>

                        @endif

                </div>

            </center>

        </div>

    </div>
    
</body>

</html>

@stop
