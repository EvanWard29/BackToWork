<?php include_once "header.php" ?>
<html>
<head>
    <script src="../assets/js/registration.js"></script>
</head>
<body>
<div class="container-fluid main">
    <h1>Registration</h1>
    <div class="container">
        <div class="container background text-center" id="registrationForm">
            <form class="form-signin">
                <div class="form-group">
                    <label for="inpFirstName" id="invFirstName" class="text-danger" hidden>First Name Cannot Be Empty!</label>
                    <input class="form-control inpPadding" type="text" placeholder="First Name" id="inpFirstName">
                </div>
                <div class="form-group">
                    <label for="inpLastName" id="invLastName" class="text-danger" hidden>Last Name Cannot Be Empty!</label>
                    <input class="form-control inpPadding" type="text" placeholder="Last Name" id="inpLastName">
                </div>
                <div class="form-group">
                    <label for="inpEmail" id="invEmail" class="text-danger" hidden>Email Cannot Be Empty And Must Contain '@'</label>
                    <input class="form-control inpPadding" type="text" placeholder="Email" id="inpEmail">
                </div>
                <div class="form-group">
                    <label for="inpPassword" id="invPassword" class="text-danger" hidden>Passwords Cannot Be Empty And Must Match!</label>
                    <input class="form-control inpPadding" type="password" placeholder="Password" id="inpPassword">
                </div>
                <div class="form-group">
                    <input class="form-control inPadding" type="password" placeholder="Confirm Password" id="inpConfirmPassword">
                </div>
                <div class="form-group">
                    <label id="invType" class="text-danger" hidden>Please Select An Account Type!</label>
                    <select class="form-select" aria-label="Default select example" style="width: 100%" id="inpType">
                        <option selected>Select Account Type</option>
                        <option value="0">Adult</option>
                        <option value="1">Child</option>
                    </select>
                </div>
                <label id="familyID" hidden>0</label>
            </form>
            <div class="text-center">
                <button id="btnRegister" class="btn btn-lrg btn-primary" style="width: 80%" type="submit">Register</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
