<script src="../../../assets/js/account/details/changePassword.js"></script>

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
                        <label id="invConfirmEmail" class="text-danger" hidden>Email Cannot Be Empty And Must Contain '@'!</label><br>
                        <label class="font-weight-bold" for="inpConfirmEmail">Email</label>
                        <input class="form-control" type="text" id="inpConfirmEmail"/>
                    </div>
                    <div class="form-group">
                        <label id="invConfirmOld" class="text-danger" hidden>Password Cannot Be Empty!</label><br>
                        <label class="font-weight-bold" for="inpOldPassword">Old Password</label>
                        <input class="form-control" type="password" id="inpOldPassword"/>
                    </div>
                    <div class="form-group">
                        <label id="invChangePassword" class="text-danger" hidden>Password Cannot Be Empty, Less Than 5 Characters Long And Must Match!</label><br>
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

<!-- Modal Confirm Change Password -->
<div class="modal fade" id="modalConfirmChangePassword" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are You Sure You Want To Change Your Password?</p>
                <div class="text-center">
                    <button id="btnConfirmPasswordChange" class="btn btn-danger btnMargin-Right">Confirm</button>
                    <button id="btnCancelChangePassword" class="btn btn-primary btnMargin-Left">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>