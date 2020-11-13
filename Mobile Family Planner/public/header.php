<?php include "../src/controller/DBConnection.php"?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">

        <link href="../assets/css/navbar.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/header.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/family.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/account.css" type="text/css" rel="stylesheet">
        <link href="../assets/css/login.css" type="text/css" rel="stylesheet">
        <style>

        </style>
    </head>
    <body>

        <ul>
            <li><a class="active" href="family.php">Family Planner</a></li>
            <li><a href="chores.php">Chores</a></li>
            <li><a href="calendar.php">Calendar</a></li>
            <li><a href="account.php">My Account</a></li>
        </ul>

        <div class="container-fluid" style="background-color: #DAE8FC;">
            <div class="container-fluid header">
                <a class="headerLink" href="family.php" disbaled><h1>Family Planner</h1></a>
            </div>
        </div>

    </body>
</html>
