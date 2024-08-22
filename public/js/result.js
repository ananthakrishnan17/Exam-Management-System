

//Search box
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


