<!-- Modal Assigned Chore -->
<div class="modal fade" id="modalAssignedChore" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblAssignedChore">Assigned Chore</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form For Viewing Assigned Chore -->
                <form>
                    <label id="assignedChoreID" hidden></label>
                    <div class="form-group">
                        <label class="font-weight-bold" for="assignedChoreName">Name</label>
                        <input class="form-control" type="text" id="assignedChoreName" readonly/>
                    </div>
                    <div>
                        <label class="font-weight-bold" for="assignedChoreDescription">Description</label>
                        <input class="form-control" type="text" id="assignedChoreDescription" readonly/>
                    </div>
                    <div>
                        <label class="font-weight-bold" for="assignedUser" id="lblAssignedUser">Assigned User</label>
                        <input class="form-control" type="text" id="assignedChoreUser" readonly/>
                    </div>
                    <?php if($_COOKIE['accountType'] == 0){?>
                        <!-- Admin Options -->
                        <div>
                            <label class="font-weight-bold" for="assignUser" hidden id="lblAssignNewUser">Assign To</label>
                            <select class="form-control" type="text" id="assignUser" hidden>
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
                        <?php
                    } ?>
                    <div>
                        <label class="font-weight-bold" for="assignedChoreDeadline">Deadline</label>
                        <input class="form-control" id="assignedChoreDeadline" type="text" readonly>
                    </div>
                    <div>
                        <label class="font-weight-bold" for="assignedChoreStatus">Status</label>
                        <input class="form-control" type="text" id="assignedChoreStatus" readonly/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnComplete" type="button" class="btn btn-primary" data-dismiss="modal">Mark Complete</button>
                <?php
                if($_COOKIE['accountType'] == 0){?>
                    <!-- Admin Options -->
                    <button id="btnReassign" type="button" class="btn btn-info">Reassign Chore</button>
                    <?php
                }
                ?>
                <button id="btnSaveReassign" type="button" class="btn btn-info" hidden disabled>Save</button>
                <button id="btnCloseChore" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>