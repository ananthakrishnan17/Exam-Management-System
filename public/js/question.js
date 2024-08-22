$(document).ready(function () {

    $('#Question_Pattern').datepicker({

        format: 'yyyymmdd',

        autoclose: true,

        todayHighlight: true

    });

});

$(document).ready(function () {
    // Retrieve filtering state from URL parameters
    var urlParams = new URLSearchParams(window.location.search);
    var searchText = urlParams.get('filterText');
    if (searchText) {
        $("#searchInput").val(searchText);
        filterTable();
    }

    // Store original row classes
    var originalRowClasses = [];
    $("table tr").each(function() {
        originalRowClasses.push($(this).attr('class'));
    });

    $("#searchInput").on("input", function () {
        filterTable();
    });
});

function filterTable() {
    var searchText = $("#searchInput").val().toLowerCase();
    var visibleRowsCount = 0;

    // Update URL with filtering state
    var urlParams = new URLSearchParams(window.location.search);
    urlParams.set('filterText', searchText);
    history.replaceState(null, null, '?' + urlParams.toString());

    // Iterate through each row and update its visibility
    $("table tr:gt(0)").each(function (index) {
        var rowText = $(this).text().toLowerCase();
        var showRow = rowText.indexOf(searchText) > -1;
        $(this).toggle(showRow);

        if (showRow) {
            visibleRowsCount++;
            // Update the first cell (index) content and add a class for center alignment
            $(this).find('td:first').text(visibleRowsCount).addClass('center-align');
        } else {
            // Remove the center-align class for non-visible rows
            $(this).find('td:first').removeClass('center-align');
        }
    });

    // Manually apply odd-even row colors to visible rows
    $("table tr:visible").css("background-color", function (index) {
        return index % 2 === 0 ? "#dae9f8" : "white";
    });

    $(".center-align").css("text-align", "center");
}

    //Script for patternlist blade

    // Initialize the datepicker on the input field with 'datepicker' class
    $('.datepicker').datepicker({
        format: 'yyyymmdd', // Specify the date format
        autoclose: true // Close the datepicker when a date is selected
    });


    function confirmDelete(patternId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this pattern!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form for deletion
                document.getElementById('deleteForm_' + patternId).submit();
            }
        });
    }

    function checkQuestionPattern(questionPatternId) {
        console.log('questionPatternId:', questionPatternId);
    
        // Make an AJAX request to check if the pattern is associated with completed test results
        fetch(`/check-answer/${questionPatternId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.exists) {
                    // If the pattern is associated with completed test results, show a warning message
                    Swal.fire({
                        title: "Warning",
                        text: "You can't delete this pattern because it is associated with completed test results.",
                        icon: "warning"
                    });
                } else {
                    // If the pattern is not associated with completed test results, make another AJAX request
                    fetch(`/check-question-pattern/${questionPatternId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                            if (data.exists) {
                                // If the pattern contains records, show an alert message
                                Swal.fire({
                                    title: "Alert",
                                    text: "Make sure Question pattern contains records",
                                    icon: "warning",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // If confirmed, prompt for deletion
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: 'You will not be able to recover this pattern!',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes, delete it!',
                                            cancelButtonText: 'Cancel'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // If confirmed, submit the form for deletion
                                                document.getElementById('deleteForm_' + questionPatternId).submit();
                                            }
                                        });
                                    }
                                });
                            } else {
    
                                confirmDelete(questionPatternId);
                            }
                        })
                        .catch(error => {
                            console.error('Failed to check question pattern existence', error);
                            // Handle error if needed
                        });
                }
            })
            .catch(error => {
                console.error('Failed to check answer pattern existence', error);
                // Handle error if needed
            });
        }