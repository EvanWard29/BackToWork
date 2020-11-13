<?php include_once "header.php" ?>
<html>
    <body>
        <div class="container-fluid main">
            <h1>Welcome</h1>
            <div class="container">
                <p>Please Login/Register to Continue</p>
                <div class="container background text-center" id="loginForm">
                    <form class="form-signin">
                        <input class="form-control inpPadding" type="text" placeholder="Email" id="inpLgnEmail">
                        <input class="form-control inpPadding" type="password" placeholder="Password" id="inpLgnPassword">
                        <div class="checkbox mb-3 text-left">
                            <label><input type="checkbox" value="remember-me">Remember Me</label>
                        </div>
                        <div class="text-center">
                            <button id="btnLogin" class="btn btn-lrg btn-primary" style="width: 80%" type="submit">Login</button>
                        </div>
                    </form>
                    <p>Need an Account?<a href="registration.php"> Register Here</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
