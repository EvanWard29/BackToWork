<?php
    include_once "../../header.php";
?>
<html>
    <head>
        <script src="../../../assets/js/account/login/login.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1>Welcome</h1>
            <div class="container">
                <p>Please Login/Register to Continue</p>
                <div class="container background text-center" id="loginForm">
                    <form class="form-signin">
                        <label id="invLogin" class="text-danger" hidden>Invalid Email or Password</label>
                        <div class="form-group">
                            <label id="invLgnEmail" for="inpLgnEmail" class="text-danger" hidden>Email Cannot Be Empty And Must Contain '@'</label>
                            <input class="form-control inpPadding" type="text" placeholder="Email" id="inpLgnEmail" name="inpLgnEmail">
                        </div>
                        <div class="form-group">
                            <label id="invLgnPassword" for="inpLgnPassword" class="text-danger" hidden>Password Cannot Be Empty</label>
                            <input class="form-control inpPadding" type="password" placeholder="Password" id="inpLgnPassword" name="inpLgnPassword">
                        </div>
                        <div class="checkbox mb-3 text-left">
                            <label class="text-danger" id="invAgree" hidden>You Must Agree to the use of Cookies before proceeding</label><br>
                            <label><input type="checkbox" value="agree" id="lgnAgree"> I AGREE to the use of cookies</label>
                        </div>
                        <div class="checkbox mb-3 text-left">
                            <label><input type="checkbox" value="remember-me" id="lgnRemember" disabled> Remember Me</label>
                        </div>
                    </form>
                    <div class="text-center">
                        <button id="btnLogin" class="btn btn-lrg btn-primary" style="width: 80%">Login</button>
                    </div>
                    <p>Need an Account?<br><a href="../registration/registration.php">Register For an Admin Account Here!</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
