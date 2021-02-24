<?php include_once "header.php";
    //requireLogin();
?>
<html>
    <body>
        <div class="container-fluid main">
            <h1>My Account</h1>
            <div class="container text-left background details">
                <h3>My Details</h3>
                <p>Name: <strong><span id="userName">TestName</span></strong></p>
                <p>Email: <strong><span id="userEmail">TestEmail</span></strong></p>
                <p>Group Name: <strong><span id="userGroup">TestGroup</span></strong></p>
                <p>Points: <strong><span id="userPoints">TestPoints</span></strong></p>
                <button type="button" id="redeem" class="btn btn-primary">Redeem Rewards</button>
            </div>
            <div class="container background options">
                <h3>Options</h3>
                <button type="button" id="btnChangeEmail" class="btn btn-primary btn-block">Change Email</button>
                <button type="button" id="btnChangePassword" class="btn btn-primary btn-block">Change Password</button>
                <button type="button" id="btnNotifications" class="btn btn-primary btn-block" disabled>Notifications</button>
                <button type="button" id="btnLogout" class="btn btn-primary btn-block">Logout</button>
                <a href="#" class="delete">Delete Account</a>
            </div>
        </div>
    </body>
</html>