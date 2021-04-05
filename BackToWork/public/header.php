<?php include_once "../src/model/DBConnection.php"; $_SESSION['admin'] = true ?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap Javascript Plugins-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
                integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

        <!-- Other Javascript Plugins -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">

        <!-- Custom CSS Files -->
        <link href="../assets/css/navbar.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/header.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/family.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/account.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/login.css" type="text/css" rel="stylesheet">

        <script async src="../assets/js/checkLogin.js"></script>
        <script src="../assets/js/logout.js"></script>
    </head>
    <body>

        <ul>
            <li><a class="active" href="myFamily.php" id="linkFamily">Back To Work</a></li>
            <li><a href="chores.php" id="linkChores">Chores</a></li>
            <li><a href="calendar.php" id="linkCalendar">Calendar</a></li>
            <li><a href="rewards.php" id="linkRewards">Rewards</a></li>
            <li><a href="account.php" id="linkAccount">My Account</a></li>
            <li><a href="login.php" id="logout">Logout</a></li>
        </ul>

        <div class="container-fluid" style="background-color: #DAE8FC;">
            <div class="container-fluid header">
                <a class="headerLink" href="myFamily.php" id="linkMain"><h1>Back To Work</h1></a>
            </div>
        </div>

    </body>
</html>
<script>
    let page = window.location.pathname;

    if(page === "/BackToWork/public/login.php" || page === "/BackToWork/public/registration.php") {
        $('#linkFamily').addClass("linkDisabled");
        $('#linkChores').addClass("linkDisabled");
        $('#linkCalendar').addClass("linkDisabled");
        $('#linkRewards').addClass("linkDisabled");
        $('#linkAccount').addClass("linkDisabled");
        $('#logout').attr('hidden', true);
        $('#linkMain').addClass("linkDisabled");

    }
</script>


