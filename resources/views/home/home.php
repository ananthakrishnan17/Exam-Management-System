<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTS</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<script>

    window.addEventListener('pageshow', function (event) {
        const overlay = document.getElementById('overlay');

        if (event.persisted) {
            overlay.style.display = 'none';
        }
    });

    function navigateTo(url) {
        const overlay = document.getElementById('overlay');



        if (overlay.style.display === 'flex') {
            overlay.style.display = 'none';
        } else {
            overlay.style.display = 'flex';
            setTimeout(() => {
                window.location.href = url;
            }, 500);
        }
    }
</script>

<body>

    <div class="container" id="login-container">
        <!-- Use Bootstrap buttons for styling -->
        <button class="link-button" onclick="navigateTo('/admin/login')">ADMIN</button><br>
        <button class="link-button" onclick="navigateTo('/user/login')">USER</button>

    </div>

    <div class="overlay" id="overlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
