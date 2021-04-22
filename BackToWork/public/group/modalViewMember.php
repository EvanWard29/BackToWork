<!-- Modal View Member -->
<div class="modal fade" id="modalViewMember" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Family Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form For Viewing User Details -->
                <form>
                    <label id="memberID" hidden>TEST</label>
                    <div class="form-group">
                        <label class="text-danger" id="invName" hidden>First Name Cannot Be Empty And Longer Than 45 Characters!</label><br>
                        <label class="font-weight-bold" for="inpName">Name</label>
                        <input class="form-control" type="text" id="inpName" readonly/>
                    </div>
                    <div class="form-group">
                        <label class="text-danger" id="invChoresCompleted" hidden>Cannot Be Empty And Must Be A Number!</label><br>
                        <label class="font-weight-bold" for="inpChoresCompleted">Chores Completed</label>
                        <input class="form-control" type="text" id="inpChoresCompleted" readonly/>
                    </div>
                    <div class="form-group">
                        <label class="text-danger" id="invPoints" hidden>Cannot Be Empty And Must Be A Number!</label><br>
                        <label class="font-weight-bold" for="inpPoints">Points</label>
                        <input class="form-control" type="text" id="inpPoints" readonly/>
                    </div>
                </form>
                <?php if($_COOKIE['accountType'] == 0){ ?>
                    <div class="stickRight">
                        <a class="text-danger btn" id="btnDeleteMember">Delete Account</a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div id="viewMemberFooter" class="modal-footer">
                <?php if($_COOKIE['accountType'] == 0){?>
                    <button id="btnSave" type="button" class="btn btn-primary" hidden>Save</button>
                    <button id="btnEditMember" type="button" class="btn btn-primary">Edit</button>
                    <?php
                } ?>
                <button id="btnCloseMember" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>