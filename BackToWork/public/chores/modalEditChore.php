<!-- Modal Edit Chore -->
<div class="modal fade" id="modalEditChore" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblEditChore">Assign Chore</h5>
                <button id="btnCloseChore" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form For Viewing Selected Chore -->
                <form>
                    <div class="form-group" hidden>
                        <label id="editChoreID"></label>
                    </div>
                    <div class="form-group">
                        <label id="invEditChoreName" class="text-danger" hidden>Chore Name Cannot Be Empty!</label><br>
                        <label class="font-weight-bold" for="editChoreName">Name</label>
                        <input class="form-control" type="text" id="editChoreName" readonly/>
                    </div>
                    <div class="form-group">
                        <label id="invEditChoreDescription" class="text-danger" hidden>Chore Description Cannot Be Empty!</label><br>
                        <label class="font-weight-bold" for="editChoreDescription">Description</label>
                        <input class="form-control" type="text" id="editChoreDescription" readonly/>
                    </div>
                    <div class="form-group">
                        <label id="invEditChorePoints" class="text-danger" hidden>Points Value Cannot Be Empty And Must Be A Number!</label><br>
                        <label class="font-weight-bold" for="editChorePoints">Points Value</label>
                        <input class="form-control" type="text" id="editChorePoints" readonly/>
                    </div>
                    <?php if($_COOKIE['accountType'] == 0){?>
                        <!-- User Assignment Selection -->
                        <div>
                            <label id="lblAssignTo" class="font-weight-bold" for="assignChore">Assign To</label>
                            <select class="form-control" type="text" id="assignChore">
                                <option selected>Select User</option>
                                <?php
                                foreach($users as $user){
                                    ?>
                                    <option><?php echo $user->getFirstName() ?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div>
                            <label id="invDeadline" class="text-danger" hidden>Please Select A Deadline!</label><br>
                            <label id="lblDeadline" class="font-weight-bold" for="choreDeadline">Deadline</label>
                            <input id="choreDeadline" class="form-control" type="datetime-local"/>
                        </div>
                        <?php
                    } ?>
                </form>
            </div>
            <div class="modal-footer">
                <?php if($_COOKIE['accountType'] == 0){?>
                    <!-- Admin Options -->
                    <button id="btnDeleteChore" type="button" class="btn btn-danger" data-dismiss="modal" hidden>Delete Chore</button>
                    <button id="btnEditChore" type="button" class="btn btn-info">Edit</button>
                    <button id="btnSaveChore" type="button" class="btn btn-info" hidden>Save</button>
                    <button id="btnAssignChore" type="button" class="btn btn-primary" disabled>Assign Chore</button>
                    <?php
                } ?>
                <button id="btnCloseChore" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Chore -->
<div class="modal fade" id="modalConfirmChoreDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblEditChore">Delete Chore</h5>
                <button id="btnCloseChore" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are You Sure You Want To Delete This Chore?</p>
                <div class="text-center">
                    <button id="btnConfirmChoreDelete" class="btn btn-danger btnMargin-Right">Confirm</button>
                    <button id="btnCancelChoreDelete" class="btn btn-primary btnMargin-Left">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>