document.addEventListener('DOMContentLoaded', function() {
    // Check if the user is on the admin page
    var isAdminPage = window.location.href.includes("/admin");
    if (isAdminPage) {
        // Apply styles for the element with the "admin" ID
        var adminElement = document.getElementById('admin');
        if (adminElement) {
            adminElement.style.backgroundColor = 'whitesmoke';
            adminElement.style.borderBottom = '2px solid #357EC7';
            // Add more styles as needed
        }
       
    }

    var isUserPage = window.location.href.includes("/user");
    if (isUserPage) {
        // Apply styles for the element with the "admin" ID
        var userElement = document.getElementById('user');
        if (userElement) {
            userElement.style.backgroundColor = 'whitesmoke';
            userElement.style.borderBottom = '2px solid #357EC7';
            // Add more styles as needed
        }
       
    }

    var isQuestionPage = window.location.href.includes("/question");
    if (isQuestionPage) {
        // Apply styles for the element with the "admin" ID
        var QuestionElement = document.getElementById('questions');
        if (QuestionElement) {
            QuestionElement.style.backgroundColor = 'whitesmoke';
            QuestionElement.style.borderBottom = '2px solid #357EC7';
            // Add more styles as needed
        }
       
    }

    var isResultPage = window.location.href.includes("/result");
    if (isResultPage) {
        // Apply styles for the element with the "admin" ID
        var resultElement = document.getElementById('result');
        if (resultElement) {
            resultElement.style.backgroundColor = 'whitesmoke';
            resultElement.style.borderBottom = '2px solid #357EC7';
            // Add more styles as needed
        }
       
    }

    var isMasterPage = window.location.href.includes("/master");
    if (isMasterPage) {
        // Apply styles for the element with the "admin" ID
        var masterElement = document.getElementById('master');
        if (masterElement) {
            masterElement.style.backgroundColor = 'whitesmoke';
            masterElement.style.borderBottom = '2px solid #357EC7';   
            
        }
        
    
    }

});
