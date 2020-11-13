<?php include_once "header.php" ?>
<html>
<body>
<div class="container-fluid main">
    <h1>Registration</h1>
    <div class="container">
        <div class="container background text-center" id="registrationForm">
            <form class="form-signin">
                <input class="form-control inpPadding" type="text" placeholder="First Name" id="inpFirstName">
                <input class="form-control inpPadding" type="text" placeholder="Last Name" id="inpLastName">
                <input class="form-control inpPadding" type="text" placeholder="Email" id="inpEmail">
                <input class="form-control inpPadding" type="password" placeholder="Password" id="inpPassword">
                <input class="form-control inPadding" type="password" placeholder="Confirm Password" id="inpConfirmPassword">
                <div class="text-center">
                    <button id="btnRegister" class="btn btn-lrg btn-primary" style="width: 80%" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
