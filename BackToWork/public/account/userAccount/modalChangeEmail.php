<script src="../../../assets/js/account/details/changeEmail.js"></script>

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
                        <label id="invChangeEmail" class="text-danger" hidden>Email Cannot Be Empty, Must Contain '@' And No Longer Than 45 Characters!</label>
                        <label id="invChangeEmailExists" class="text-danger" hidden>Email Already Exists. Please Use An Alternative Email!</label>
                        <label id="invChangeEmailSame" class="text-danger" hidden>New Email Cannot Be The Same As Your Current Email!</label><br>
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