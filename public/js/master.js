$(document).ready(function () {
    // Retrieve filtering state from URL parameters
    var urlParams = new URLSearchParams(window.location.search);
    var searchText = urlParams.get('filterText');
    if (searchText) {
        $("#searchInput").val(searchText);
        filterTable(searchText);
    }

    // Store original row classes
    var originalRowClasses = [];
    $("table tr").each(function() {
        originalRowClasses.push($(this).attr('class'));
    });

    $("#searchInput").on("input", function () {
        var searchText = $(this).val().toLowerCase();
        filterTable(searchText);
    });
});

function filterTable(searchText) {
    // Update URL with filtering state
    var urlParams = new URLSearchParams(window.location.search);
    urlParams.set('filterText', searchText);
    history.replaceState(null, null, '?' + urlParams.toString());

    $("table tr:gt(0)").each(function (index) {
        var rowText = $(this).text().toLowerCase();
        var showRow = rowText.indexOf(searchText) > -1;
        $(this).toggle(showRow);
    });

    // Update ID numbers of visible rows
    var idCounter = 0;
    $("table tr:visible:gt(0)").each(function (index) {
        idCounter++;
        $(this).find('td:first').text(idCounter).css('text-align', 'center'); // Align S.No to center
    });

    // Apply odd-even row colors
    $("table tr:visible:even").css("background-color", "#dae9f8");
    $("table tr:visible:odd").css("background-color", "white");
}