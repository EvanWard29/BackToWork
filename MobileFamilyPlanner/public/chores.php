<?php
    include_once "header.php";
    $db = new DBConnection();
    $data = $db->getAllChores();
?>
<html>
    <head>
        <script src="../assets/js/newChore.js"></script>
        <script src="../assets/js/choreDetails.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1>Chores</h1>
            <div class="container background" style="margin-bottom: 15px">
                <div class="row">
                    <div class="col">
                        <table id="available" class="table-bordered">
                            <thead>
                                <tr><th>Available Chores</th></tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($data as $chore){
                                    $name = $chore->getChoreName();
                                    ?>
                                    <tr>
                                        <td id="<?php echo str_replace(' ', '', $name) ?>" class="card card-body" data-toggle="modal" data-target="#modalEditChore">
                                            <?php echo $chore->getChoreName() ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>

                        <!-- Modal Edit Chore -->
                        <div class="modal fade" id="modalEditChore" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="lblEditChore">Edit Chore</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label class="font-weight-bold" for="editChoreName">Name</label>
                                                <input class="form-control" type="text" id="editChoreName" value="Get Description"/>
                                            </div>
                                            <div>
                                                <label class="font-weight-bold" for="editChoreDescription">Description</label>
                                                <input class="form-control" type="text" id="editChoreDescription" value="Get Description"/>
                                            </div>
                                            <div>
                                                <label class="font-weight-bold" for="assignChore">Assign To</label>
                                                <select class="form-control" type="text" id="assignChore">
                                                    <option selected>Select User</option>
                                                    <option>TEST<?php //Get Users From DB ?></option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button id="btnDeleteChore" type="button" class="btn btn-danger" data-dismiss="modal">Delete Chore</button>
                                        <button id="btnAssignChore" type="button" class="btn btn-primary" data-dismiss="modal" id="btnAddChore">Save Chore</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <table id="assigned" class="table-bordered">
                            <thead>
                                <tr><th>Assigned Chores</th></tr>
                            </thead>
                            <tbody>
                                <tr><td id="assignedChore">TestChore</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <button id="btnNewChore" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalNewChore">New Chore</button>

                    <!-- Modal New Chore -->
                    <div class="modal fade" id="modalNewChore" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="lblNewChore">New Chore</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="inpChoreName">Name</label>
                                            <input class="form-control" type="text" id="inpChoreName"/>
                                        </div>
                                        <div>
                                            <label class="font-weight-bold" for="inpChoreDescription">Description</label>
                                            <input class="form-control" type="text" id="inpChoreDescription"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnAddChore">Add Chore</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>