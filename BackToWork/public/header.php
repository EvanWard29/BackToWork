<?php include_once $_SERVER['DOCUMENT_ROOT']."/BackToWork/src/model/DBConnection.php";?>

<html lang="en">
    <head>
        <title>Back To Work</title>
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
        <link href="/BackToWork/assets/css/navbar.css" type="text/css" rel="stylesheet">
        <link href="/BackToWork/assets/css/header.css" type="text/css" rel="stylesheet">
        <link href="/BackToWork/assets/css/myGroup.css" type="text/css" rel="stylesheet">
        <link href="/BackToWork/assets/css/account.css" type="text/css" rel="stylesheet">
        <link href="/BackToWork/assets/css/login.css" type="text/css" rel="stylesheet">

        <script src="/BackToWork/assets/js/getCookie.js"></script>
        <script async src="/BackToWork/assets/js/account/checkLogin.js"></script>
        <script src="/BackToWork/assets/js/account/logout.js"></script>
    </head>
    <body>

        <ul id="header">
            <li id><a class="active" href="/BackToWork/public/group/myGroup.php" id="linkFamily">My Group</a></li>
            <li id><a href="/BackToWork/public/chores/chores.php" id="linkChores">Chores</a></li>
            <li id><a href="/BackToWork/public/calendar/calendar.php" id="linkCalendar">Calendar</a></li>
            <li id><a href="/BackToWork/public/rewards/rewards.php" id="linkRewards">Rewards</a></li>
            <li id><a href="/BackToWork/public/account/account.php" id="linkAccount">My Account</a></li>
            <li id><a href="/BackToWork/public/account/login/login.php" id="logout">Logout</a></li>
        </ul>

        <div class="container-fluid" style="background-color: #DAE8FC;">
            <div class="container-fluid header">
                <a class="headerLink" href="/BackToWork/public/group/myGroup.php" id="linkMain"><h1>Back To Work</h1></a>
            </div>
        </div>

    </body>
</html>
<script>

    let page = window.location.pathname;

    if(page === "/BackToWork/public/account/login/login.php" || page === "/BackToWork/public/account/registration/registration.php") {
        //If user is already logged in - redirect to main page
        if(getCookie('userID') !== ""){
            location.replace("/BackToWork/public/group/myGroup.php");
        }else{
            $('#header').attr('hidden', true);
            $('#linkMain').addClass("linkDisabled");
        }
    }

</script>


