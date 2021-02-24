<?php include_once "header.php";
    $db = new DBConnection();
    $user = $db->getUserDetails($_COOKIE['userID']);

?>
<html>
    <head>
        <script src="../assets/js/accountOptions.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1>My Account</h1>
            <div class="container text-left background details">
                <h3>My Details</h3>
                <p>Name: <strong><span id="userName"><?php echo $user->getFirstName() . " " . $user->getLastName() ?></span></strong></p>
                <p>Email: <strong><span id="userEmail"><?php echo $user->getEmail() ?></span></strong></p>
                <p>Points: <strong><span id="userPoints"><?php echo $user->getPoints() ?></span></strong></p>
            </div>
            <div class="container background options">
                <h3>Options</h3>
                <button type="button" id="redeem" class="btn btn-primary btn-block">Redeem Rewards</button>
                <button type="button" id="btnChangeEmail" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalChangeEmail">Change Email</button>
                <button type="button" id="btnChangePassword" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalChangePassword">Change Password</button>
                <button type="button" id="btnNotifications" class="btn btn-primary btn-block" disabled>Notifications</button>
                <button type="button" id="btnLogout" class="btn btn-primary btn-block">Logout</button>
                <a href="#" class="delete">Delete Account</a>
            </div>
        </div>

        <!-- Modal Change Email -->
        <div class="modal fade" id="modalChangeEmail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="font-weight-bold" for="currentEmail">Current Email</label>
                                <input class="form-control" type="text" id="currentEmail" value="<?php echo $user->getEmail() ?>" readonly/>
                            </div>
                            <div class="form-group">
                                <label id="invChangeEmail" class="text-danger" hidden>Email Cannot Be Empty And Must Contain '@' And Must Be Different!</label><br>
                                <label class="font-weight-bold" for="inpChangeEmail">New Email</label>
                                <input class="form-control" type="text" id="inpChangeEmail"/>
                            </div>
                            <div class="form-group">
                                <label id="invConfirmPassword" class="text-danger" hidden>Password Cannot Be Empty And Must Be Correct!</label><br>
                                <label class="font-weight-bold" for="inpConfirmPassword">Confirm Password</label>
                                <input class="form-control" type="password" id="inpConfirmPassword"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnSaveEmail">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Change Password -->
        <div class="modal fade" id="modalChangePassword" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label id="invLogin" class="text-danger" hidden>Email or Password is Incorrect!</label>
                            <div class="form-group">
                                <label id="invConfirmEmail" class="text-danger" hidden>Email Cannot Be Empty And Must Contain '@' And Must Be Different!</label><br>
                                <label class="font-weight-bold" for="inpConfirmEmail">Email</label>
                                <input class="form-control" type="text" id="inpConfirmEmail"/>
                            </div>
                            <div class="form-group">
                                <label id="invConfirmOld" class="text-danger" hidden>Password Cannot Be Empty!</label><br>
                                <label class="font-weight-bold" for="inpOldPassword">Old Password</label>
                                <input class="form-control" type="password" id="inpOldPassword"/>
                            </div>
                            <div class="form-group">
                                <label id="invChangePassword" class="text-danger" hidden>Password Cannot Be Empty And Must Match!</label><br>
                                <label class="font-weight-bold" for="inpChangePassword">Password</label>
                                <input class="form-control" type="password" id="inpChangePassword"/>
                            </div>
                            <div class="form-group">
                                <br>
                                <label class="font-weight-bold" for="inpConfirmPasswordChange">Confirm Password</label>
                                <input class="form-control" type="password" id="inpConfirmPasswordChange"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnSavePassword">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>