@extends('layouts.layout')

@section('content')

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Question Pattern Details</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/question.css') }}">

    {{-- <script src="{{ asset('js/question/questionlist.js') }}"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-vNOz3m3KRk5trpyDlGzVDAW7mM9vZcH5C9eKI+LObaqqx4xXEcqj5g3iDE3dJb6" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        


        function removeQAField() {

            // Ensure at least two rows are present

            if ($("#newt tr").length > 2) {

                // Remove the last two rows

                $("#newt tr:last, #newt tr:nth-last-child(2)").remove();

            } else {

                alert("Cannot remove the last two rows.");

            }

        }
    </script>

    <script>

        //save multiple questions
       $(document).ready(function() {
    $('#newQuestionForm').hide();

    $('#add').click(function() {
        // Toggle the visibility of the form
        $('#newQuestionForm').toggle();
    });

    $('#newQuestionForm').submit(function(e) {
        e.preventDefault();

        // Your form submission AJAX request
        $.ajax({
            type: 'POST',
            url: '{{ route("save.data") }}',
            data: $(this).serialize(), // Send serialized form data to the server
            success: function(response) {
                window.location.reload();
                console.log(response);
                // Show SweetAlert notification for successful addition
                Swal.fire({
                    icon: 'success',
                    title: 'Question added successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Fetch the latest data from the server without refreshing the page
                reloadTable();
            },
            error: function(error) {
                console.error(error);
            }
        });
    });


});

    </script>

    <script>
        $(document).ready(function() {

            $.ajax({

                url: '/get-previous-id',

                method: 'GET',

                success: function(response) {

                    let previousId = parseInt(response.previousId);

                    let newId = isNaN(previousId) ? 1 : previousId + 1;

                    $('#autoIncrementDisplay').text(newId);

                },

                error: function(xhr, status, error) {

                    console.error(error);

                }

            });

        });
    </script>

    <script>
        $(document).ready(function() {

            var timeout;

            $('#navbar-toggle').on('mouseover', function() {

                clearTimeout(timeout);

                $('.user-settings').show();

            });

            $('.user-settings').on('mouseover', function() {

                clearTimeout(timeout);

            });

            $('#navbar-toggle, .user-settings').on('mouseout', function() {

                timeout = setTimeout(function() {

                    $('.user-settings').hide();

                }, 500);

            });

            $("#search").on("input", function() {

                filterTable();

            });

            var sortOrders = [];

            $("th").on("click", function() {

                var columnIndex = $(this).index();

                sortTable(columnIndex);

            });

            function filterTable() {

                var searchText = $("#search").val().toLowerCase();

                $("table tr:gt(0)").each(function() {

                    var rowText = $(this).text().toLowerCase();

                    var showRow = rowText.indexOf(searchText) > -1;

                    $(this).toggle(showRow);

                });
            }

            
        });




        $(document).ready(function() {

            $("#columnSelector").change(function() {

                var selectedColumn = $(this).val();

                toggleColumns(selectedColumn);

            });

        });
    </script>

    <script>
        $(document).ready(function() {

            $('#editable').on('click', '.delete-btn', function() {

                var questionId = $(this).data('question-id');

                if (confirm('Are you sure you want to delete this question?')) {

                    // Send AJAX request to delete the question

                    $.ajax({

                        type: 'POST',

                        url: '/delete/question/' + questionId,

                        data: {

                            _token: '{{ csrf_token() }}',

                        },

                        success: function(response) {

                            console.log(response);

                            $('#editable tr[data-question-id="' + questionId + '"]').remove();

                            alert('Question deleted successfully!');

                            updateQnnumbers();

                        },

                        error: function(xhr, status, error) {

                            console.error(xhr.responseText);

                            alert('An error occurred while deleting the question. Please try again later.');

                        }

                    });

                }

            });


            $("tr").click(function() {

                var row = $(this);

                row.find("#icon_save").show();

                row.find("#icon_edit").hide();

            });

        });

    </script>

    <script>
        
        $(document).ready(function() {
        $('#editable').on('click', '.save-btn', function() {
        var $row = $(this).closest('tr');
        var questionId = $row.data('question-id');
        var updatedData = {};

        $row.find('.editable').each(function() {
            var fieldName = $(this).data('field-name');
            var value = $(this).text().trim();
            updatedData[fieldName] = value;
        });

        var $secondRow = $('#editable').find('tr[data-question-id="' + questionId + '"].options-row');

        $secondRow.find('.editable').each(function() {
            var fieldName = $(this).data('field-name');
            var value = $(this).text().trim();
            updatedData[fieldName] = value;
        });

        // Show confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to update this question. Do you want to proceed?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger ml-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/update-question/' + questionId,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: updatedData,
                    success: function(response) {
                        console.log(response);
                        // Show SweetAlert notification for successful update
                        Swal.fire({
                            icon: 'success',
                            title: 'Data updated successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                popup: 'swal2-modal-lg'
                            }
                        });

                        // Reload only the table after successful update
                        reloadTable();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    });
});


function reloadTable() {

    $('#editable').DataTable().ajax.reload();
}

    </script>

    <script>
        $(document).ready(function() {

            // Hide the tdToHide element

            $('#tdToHide').hide();

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.editable').on('blur', function() {
                console.log('Blur event triggered.');
                var newValue = $(this).text();
                var fieldName = $(this).data('field-name');
                var questionId = $(this).closest('tr').data('question-id');

                console.log('Question ID:', questionId);
                console.log('Field Name:', fieldName);
                console.log('New Value:', newValue);

                // Used Ajax to send the updated data to the server
                $.ajax({
                    url: '/update-question',
                    method: 'POST',
                    data: {
                        questionId: questionId,
                        fieldName: fieldName,
                        newValue: newValue
                    },
                    success: function(response) {
                        console.log(response);
                        // Handle success, if needed
                    },
                    error: function(error) {
                        console.error(error);
                        // Handle error, if needed
                    }
                });
            });


            $('.save-btn').on('click', function() {

                console.log('Save button clicked.');

                var questionId = $(this).closest('tr').data('question-id');

                var updatedData = {
                    option1: $('#option1_' + questionId).text(),
                    option2: $('#option2_' + questionId).text(),
                    option3: $('#option3_' + questionId).text(),
                    option4: $('#option4_' + questionId).text(),
                };

                console.log('Updated Data:', updatedData);

                // Send AJAX request to update data
                $.ajax({
                    url: '/update-question',
                    method: 'POST', // Change this to POST
                    contentType: 'application/json',
                    data: JSON.stringify({
                        questionId: questionId,
                        updatedData: updatedData
                    }),
                    success: function(response) {
                        console.log(response);
                        // Handle success, if needed
                    },
                    error: function(error) {
                        console.error(error);
                        // Handle error, if needed
                    }
                });
            });
        });
    </script>
    <script>
        //change rows color
        const rows = document.querySelectorAll('#question-container tbody tr');

// Loop through each group of rows
for (let i = 0; i < rows.length; i += 2) {
    // Add class to question rows
    rows[i].classList.add('color1');
    rows[i + 1].classList.add('color1');

    // Add class to answer rows
    rows[i + 2].classList.add('color2');
    rows[i + 3].classList.add('color2');
}
    </script>

    <script>
        $(document).ready(function() {

            $('#editable').on('click', '.save-btn', function() {

                var $row = $(this).closest('tr');

                var $editableCell = $row.find('.editable');
                l
                var content = $editableCell.text().trim();

                $editableCell.html('<textarea class="edit-textarea">' + content + '</textarea>');

                $row.find("#icon_save").hide();

                $row.find("#icon_edit").show();
            });

            $('#editable').on('click', '.edit-btn', function() {

                var $row = $(this).closest('tr');

                var $textarea = $row.find('.edit-textarea');

                var content = $textarea.val().trim();

                $textarea.closest('#editable').text(content);

                $row.find("#icon_edit").hide();

                $row.find("#icon_save").show();
            });
        });
    </script>


</head>

<body id="body">




    <div id="spinner" style="display: none;">

        <div class="spinner-border text-primary" role="status">

            <span class="sr-only">Loading...</span>

        </div>

    </div>


    <h1 id="main1"> <i class="fa fa-list" aria-hidden="true"></i> Question.List<a href="{{url('logout')}}" id="logout"></a></h1>

    <a href="{{ route('question.pattern-list') }}"><button type="button" class="btn btn" id="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>




    <div class="search-box">

            <form id="searchForm" action="{{ route('search') }}" method="GET">

                @csrf
                <div class="box">
                    <input type="hidden" value="{{ $questionPattern->first()->question_pattern_id }}" name="idhidden">
                    <input id="searchInput" type="text" name="query" placeholder="Type Something..." value="{{ $query ?? '' }}" >
                    <button type="submit" id="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
    <h3 id="question">Question Pattern:<span class="id">{{ $questionPattern->first()->question_pattern_id }}</span> </h3>
    <br>
    <br>
    <div class="user-settings" style="display: none;">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlJqngNJ42uWE0Zy6S6rHTuW8pn6p-cuogyQ&usqp=CAU">

        <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Users</a>

        <a href="#"><i class="fa fa-user-secret" aria-hidden="true"></i>Admin</a>

        <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>Exam Date</a>

        <a href="/pattern"><i class="fa fa-book" aria-hidden="true"></i>Exam</a>

        <a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>Questions</a>

        <a href="#"><i class="fa fa-check" aria-hidden="true"></i>Answers</a>

        <a href="/pattern"><i class="fa fa-pie-chart" aria-hidden="true"></i>Results</a>

        <a href="/pattern"><i class="fa fa-comments" aria-hidden="true"></i>Feedback</a>

        <a href="/pattern"><i class="fa fa-cogs" aria-hidden="true"></i>Settings</a>

        <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>About us</a>

        <a href="/"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>

    </div>

    <div id="question-container">

        <table id="editable" class="table">

            <thead class="bg-primary text-white">

                <tr>

                    <th id="qn" class="text-white">

                        <center >Qn No</center>

                    </th>

                    <th colspan="4" id="question_head">

                        <center>Question</center>

                    </th>

                    <th id="ans">

                        <center>Answer</center>

                    </th>

                    <th id="action"></th>

                </tr>

            </thead>

            <tbody>

            @php
    $key = 0; // Default value if not using pagination

    // Check if $todolists is an instance of LengthAwarePaginator
    if ($todolists instanceof \Illuminate\Pagination\LengthAwarePaginator) {
        $key = ($todolists->currentPage() - 1) * $todolists->perPage();
    }
@endphp


                @foreach($todolists as $question)


               
                <tr data-question-id="{{ $question->id }}" class="{{ ($loop->index % 2 == 0) ? 'color1' : 'color2' }}">
    <td id="qno-data" rowspan="2">
        <center id="qno" >{{ $loop->index + 1 }}</center>
    </td>
    <td id="heading" class="editable" data-field-name="question" colspan="4" id="resize">
        {{ $question->question }}
    </td>
    <td id="answer-data" rowspan="2" class="editable" data-field-name="answer">
        <center id="ans">{{ $question->answer }}</center>
    </td>
    <td rowspan="2" id="actions">
        <center>
            <button class="edit-btn">
                <i class="fa fa-edit" style="color: orange; font-size: 25px;"></i>
            </button>
            <button class="save-btn" style="display: none;">
                <i class="fa fa-save" style="color: green; font-size: 25px;"></i>
            </button>
            <button class="delete-btn" data-question-id="{{ $question->id }}">
                <i class="fa fa-trash" style="color:red; font-size:25px"></i>
            </button>
        </center>
    </td>
</tr>

<tr class="{{ ($loop->index % 2 == 0) ? 'color1' : 'color2' }} options-row" data-question-id="{{ $question->id }}" >
    <td contenteditable="false" id="option1_{{ $question->id }}" id="resize1" class="editable" data-field-name="option1" style="@if($question->answer == 1) background-color: #83C0C1; @endif">{{ $question->option1 }}</td>
    <td contenteditable="false" id="option2_{{ $question->id }}" id="resize2" class="editable" data-field-name="option2" style="@if($question->answer == 2) background-color: #83C0C1; @endif">{{ $question->option2 }}</td>
    <td contenteditable="false" id="option3_{{ $question->id }}" id="resize3" class="editable" data-field-name="option3" style="@if($question->answer == 3) background-color: #83C0C1; @endif">{{ $question->option3 }}</td>
    <td contenteditable="false" id="option4_{{ $question->id }}" id="resize4" class="editable" data-field-name="option4" style="@if($question->answer == 4) background-color: #83C0C1; @endif">{{ $question->option4 }}</td>
</tr>
<script>
 document.querySelectorAll('.edit-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const parentRow = this.closest('tr');
        const questionCell = parentRow.querySelector('.editable[data-field-name="question"]');
        const answerCell = parentRow.querySelector('.editable[data-field-name="answer"]');
        const optionRow = parentRow.nextElementSibling; // Get the next row (options row)
        const optionCells = optionRow.querySelectorAll('.editable');

        // Toggle contenteditable for question cell
        questionCell.contentEditable = true;
        answerCell.contentEditable=true;

        // Toggle contenteditable for option cells
        optionCells.forEach(function(td) {
            td.contentEditable = true;
        });

        parentRow.querySelector('.edit-btn').style.display = 'none';
        parentRow.querySelector('.editable').style.border = 'groove';
        parentRow.querySelector('#answer-data').style.border = 'groove';
        optionRow.querySelector('#option1_{{ $question->id }}').style.border = 'groove';
        optionRow.querySelector('#option2_{{ $question->id }}').style.border = 'groove';
        optionRow.querySelector('#option3_{{ $question->id }}').style.border = 'groove';
        optionRow.querySelector('#option4_{{ $question->id }}').style.border = 'groove'
        parentRow.querySelector('.save-btn').style.display = 'inline-block';
    });
});

document.querySelectorAll('.save-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const parentRow = this.closest('tr');
        const questionCell = parentRow.querySelector('.editable[data-field-name="question"]');
        const answerCell = parentRow.querySelector('.editable[data-field-name="answer"]');
        const optionRow = parentRow.nextElementSibling; 
        const optionCells = optionRow.querySelectorAll('.editable');

      
        questionCell.contentEditable = false;

     
        optionCells.forEach(function(td) {
            td.contentEditable = false;
        });

        parentRow.querySelector('.edit-btn').style.display = 'inline-block';
        parentRow.querySelector('.save-btn').style.display = 'none';
        parentRow.querySelector('#answer-data').style.border = 'none';
        parentRow.querySelector('.editable').style.border = 'none';
        optionRow.querySelector('#option1_{{ $question->id }}').style.border = 'none';
        optionRow.querySelector('#option2_{{ $question->id }}').style.border = 'none';
        optionRow.querySelector('#option3_{{ $question->id }}').style.border = 'none';
        optionRow.querySelector('#option4_{{ $question->id }}').style.border = 'none';
    });
});

</script>

@php $key++; @endphp

<script>

var key = {{ $loop->last ? $loop->index + 2 : 0 }};

function addQAField() {
// Create a new question row
key++;

var newQuestionRow = $('<tr>');

  
// Set a new value for question_pattern_id
newQuestionRow.append('<td rowspan="2" id="q_no"><span name="autoIncrementInput"><center>' + key + '</center></span></td>');

// Add question field
newQuestionRow.append('<td colspan="4" id="question_td"><div class="cell"><div id="question_field" class="textarea-wrapper"><textarea name="question[]" rows="1" placeholder="&nbsp;Type your question here"></textarea></div></div></td>');

// Add the answer
newQuestionRow.append('<td rowspan="2" id="answer_choice" ><select id="answer" name="answer[]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>');

newQuestionRow.append(' <td rowspan="2" id="btn-data"> <button type="button" id="plus" class="btn btn-success" onclick="addQAField(1)"><i class="fa fa-plus-square" aria-hidden="true"></i></button>&nbsp;<button type="button" class="btn btn-danger" id="drop" onclick="removeQAField(1)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>');

// Append the new question row to the table
$("#newt").append(newQuestionRow);

// Create a new options row
var newOptionsRow = $('<tr id="options-row" >');

// Add option cells
newOptionsRow.append('<td id="answer-option"><textarea name="option1[]" rows="1" placeholder="&nbsp;Option 1"></textarea></td>');

newOptionsRow.append('<td id="answer-option"><textarea name="option2[]" rows="1" placeholder="&nbsp;Option 2"></textarea></td>');

newOptionsRow.append('<td id="answer-option"><textarea name="option3[]" rows="1" placeholder="&nbsp;Option 3"></textarea></td>');

newOptionsRow.append('<td id="answer-option"><textarea name="option4[]" rows="1" placeholder="&nbsp;Option 4"></textarea></td>');

$("#newt").append(newOptionsRow);
}
</script>

                @endforeach

            </tbody>

        </table>

    </div>
    
    <button class="btn btn-success" id="add"><i class="fa fa-plus-square" aria-hidden="true"></i> &nbsp;ADD QUESTIONS</button>

    <br>

    <div class="content">

        <div class="new-question-form">

            <form id="newQuestionForm">

                @csrf

                <div class="table-responsive" id="td">

                    <table id="newt">

                        <tr>

                            <td rowspan="2" id="q_no"> @if($questionPattern)

                                <h3 class="question_pattern_id"><span class="id" style="display: none;"><input type="hidden" id="question_pattern_id" name="question_pattern_id" value="{{ $questionPattern->first()->question_pattern_id }}">

                                    </span> </h3>

                                @endif

                              <span > <center>{{ $key + 1 }}</center></span>


                            </td>

                            <td colspan="4" id="question_td">

                                <div class="cell">

                                    <div id="question_field" class="textarea-wrapper">

                                        <textarea name="question[]" value="question[]" id="question_area" rows="1" placeholder="&nbsp;Type your question here"></textarea>

                                    </div>

                                </div>

                            </td>

                            <td rowspan="2" id="answer_choice">

                                <center>

                                    <select class="" id="answer" name="answer[]" value="answer[]">

                                        <option value="1">1</option>

                                        <option value="2">2</option>

                                        <option value="3">3</option>

                                        <option value="4">4</option>

                                    </select>

                                </center>

                            </td>

                            <td rowspan="2" id="btn-data"> <button type="button" id="plus" class="btn btn-success" onclick="addQAField(1)"><i class="fa fa-plus-square" aria-hidden="true"></i> </button>

                                <button type="button" id="drop" class="btn btn-danger" onclick="removeQAField(1)"> <i class="fa fa-trash"></i></button>

                            </td>

                        </tr>

                        <tr class="options-row">

                            <td>

                                <div class="cell">

                                    <div class="textarea-wrapper">

                                        <textarea name="option1[]" value="option1[]" id="options" cols="14" rows="1" placeholder="&nbsp;Option 1"></textarea>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <div class="cell">

                                    <div class="textarea-wrapper">

                                        <textarea name="option2[]" value="option2[]" id="options" cols="15" rows="1" placeholder="&nbsp;Option 2"></textarea>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <div class="cell">

                                    <div class="textarea-wrapper">

                                        <textarea name="option3[]" value="option3[]" id="options" cols="15" rows="1" placeholder="&nbsp;Option 3"></textarea>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <div class="cell">

                                    <div class="textarea-wrapper">

                                        <textarea name="option4[]" value="option4[]" id="options" cols="17" rows="1" placeholder="&nbsp;Option 4"></textarea>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    </table>

                    <br>
                    <button type="submit" class="btn btn-info" id="saveButton"><i class="fa fa-check-circle" aria-hidden="true"></i> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <button type="reset" class="btn btn-danger" id="cancelButton"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancel</button>
                                
                    

                </div>

            </form>

        </div>



        @stop


</body>

</html>