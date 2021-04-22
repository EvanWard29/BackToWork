<!-- Modal Add Member -->
<div class="modal fade" id="modalNewMember" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Family Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form For Adding New User -->
                <form id="frmNewMember">
                    <div class="form-group">
                        <label class="text-danger" id="invFirstName" hidden>First Name Cannot Be Empty And Longer Than 45 Characters!</label><br>
                        <label class="font-weight-bold" for="inpFirstName">First Name</label>
                        <input class="form-control" type="text" id="inpFirstName"/>
                    </div>
                    <div class="form-group">
                        <label class="text-danger" id="invLastName" hidden>Last Name Cannot Be Empty And Longer Than 45 Characters!</label><br>
                        <label class="font-weight-bold" for="inpLastName">Last Name</label>
                        <input class="form-control" type="text" id="inpLastName"/>
                    </div>
                    <div class="form-group">
                        <label class="text-danger" id="invEmail" hidden>Email Cannot Be Empty And Must Contain '@'</label>
                        <label for="inpEmail" id="invEmailExists" class="text-danger" hidden>Email Already Exists! Please Login Or Use An Alternative Email.</label><br>
                        <label class="font-weight-bold" for="inpEmail">Email</label>
                        <input class="form-control" type="email" id="inpEmail"/>
                    </div>
                    <div class="form-group">
                        <label class="text-danger" id="invPassword" hidden>Password Cannot Be Empty And Must Match!</label><br>
                        <label class="font-weight-bold" for="inpPassword">Password</label>
                        <input class="form-control" type="password" id="inpPassword"/>
                    </div>
                    <div class="form-group">
                        <br>
                        <label class="font-weight-bold" for="inpConfirmPassword">Confirm Password</label>
                        <input class="form-control" type="password" id="inpConfirmPassword"/>
                    </div>
                    <div class="form-group">
                        <label id="invType" class="text-danger" hidden>Please Select An Account Type!</label>
                        <select class="form-select" aria-label="Default select example" style="width: 100%" id="inpType">
                            <option selected>Select Account Type</option>
                            <option value="0">Adult</option>
                            <option value="1">Child</option>
                        </select>
                    </div>
                    <label id="familyID" hidden></label>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnRegister" type="button" class="btn btn-primary">Save</button>
                <button id="btnCloseNewMember" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>