<?php
    include_once "header.php";
    //requireLogin();

    $db = new DBConnection();
    $data = $db->getAllChores();
    $users = $db->getUsers($_COOKIE['familyID']);
    $assignedChores = $db->getAssignedChores($_COOKIE['familyID']);

    function getAvailableChores(){
        $db = new DBConnection();
        $chores = $db->getAllChores();
        $assignedChores = $db->getAssignedChores($_COOKIE['familyID']);

        $availableChores = [];

        foreach($chores as $chore){
            $choreID = $chore->getChoreID();
            $assigned = false;
            foreach($assignedChores as $assignedChore){
                $assignedChoreID = $assignedChore->getChoreID();
                if($assignedChoreID == $choreID){
                    $assigned = true;
                    break;
                }
                else{
                    $assigned = false;
                }
            }
            if($assigned == false){
                $availableChores[] = $chore;
            }
        }
        return $availableChores;
    }
?>
<html>
    <head>
        <script src="../assets/js/newChore.js"></script>
        <script src="../assets/js/choreDetails.js"></script>
        <script src="../assets/js/assignChore.js"></script>
        <script src="../assets/js/deleteChore.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1>Chores</h1>
            <div class="container background">
                <div class="row">
                    <?php
                    if($_COOKIE['accountType'] == 0){?>
                        <div class="col">
                            <table id="available" class="table-bordered">
                                <thead>
                                <tr><th>Available Chores</th></tr>
                                </thead>
                                <tbody>
                                <?php
                                $availableChores = getAvailableChores();
                                foreach ($availableChores as $chore){
                                    $choreID = $chore->getChoreID();
                                    ?>
                                    <tr>
                                        <td id="chore<?php echo $choreID ?>" class="card card-body" data-toggle="modal" data-target="#modalEditChore">
                                            <?php echo $chore->getChoreName() ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } ?>
                    <?php
                    if($_COOKIE['accountType'] == 1){?>
                        <div class="col">
                            <table id="available" class="table-bordered">
                                <thead>
                                    <tr><th>My Chores</th></tr>
                                </thead>
                                <tbody>
                                <?php
                                    //Get all assigned chores where userID = logged user
                                    $userChores = $db->getUserChores($_COOKIE['userID'], $_COOKIE['familyID']);
                                    if($userChores == null){?>
                                        <tr><td class="card-body card">You Have No Chores To Complete!</td></tr>
                                    <?php
                                    }
                                    $chores = $db->getAllChores();
                                    foreach($userChores as $userChore){
                                        $choreID = $userChore->getChoreID();
                                        foreach($chores as $chore){
                                            if($choreID == $chore->getChoreID()){
                                                ?>
                                                <tr><td id='assignedChore<?php echo $userChore->getAssignedChoreID() ?>' class="card card-body" data-toggle="modal" data-target="#modalAssignedChore"><?php echo $chore->getChoreName() ?></td></tr>
                                                <?php
                                                break;
                                            }
                                        }
                                        ?>

                                    <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } ?>

                    <?php
                    if($_COOKIE['accountType'] == 0){?>
                        <div class="col">
                            <table id="assigned" class="table-bordered">
                                <thead>
                                    <tr><th>Assigned Chores</th></tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($assignedChores == null){
                                        ?>
                                        <tr><td class="card-body card">No Chores Have Been Assigned!</td></tr>
                                    <?php
                                    }
                                    foreach ($assignedChores as $assignedChore){
                                        $assignedChoreID = $assignedChore->getAssignedChoreID();
                                        $userID = $assignedChore->getUserID();
                                        $choreID = $assignedChore->getChoreID();

                                        $chore = null;
                                        foreach($data as $item){
                                            if($item->getChoreID() == $choreID){
                                                $chore = $item;
                                                break;
                                            }
                                        }

                                        $user = null;
                                        foreach($users as $item){
                                            if($item->getUserID() == $userID){
                                                $user = $item;
                                                break;
                                            }
                                        }

                                        if($user != null && $chore != null){
                                            $choreName = $chore->getChoreName(); //Get Chore Name
                                            $userName = $user->getFirstName(); //Get User Name
                                            $userID = $user->getUserID();
                                            if($userID !== $_COOKIE['userID']){?>
                                                <tr>
                                                    <td id='assignedChore<?php echo $assignedChoreID ?>' class="card card-body" data-toggle="modal" data-target="#modalAssignedChore">
                                                        <?php echo "<span>".$choreName."</span><span>Assigned: ". $userName . "</span>"?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                        $chore = null;
                                        $user = null;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }

                    if($_COOKIE['accountType'] == 0){?>
                        <div class="col">
                            <table id="available" class="table-bordered">
                                <thead>
                                <tr><th>My Chores</th></tr>
                                </thead>
                                <tbody>
                                <?php
                                //Get all assigned chores where userID = logged user
                                $userChores = $db->getUserChores($_COOKIE['userID'], $_COOKIE['familyID']);
                                if($userChores == null){?>
                                    <tr><td class="card-body card">You Have No Chores To Complete!</td></tr>
                                <?php
                                }
                                $chores = $db->getAllChores();
                                foreach($userChores as $userChore){
                                    $choreID = $userChore->getChoreID();
                                    foreach($chores as $chore){
                                        if($choreID == $chore->getChoreID()){
                                            ?>
                                            <tr><td id='assignedChore<?php echo $userChore->getAssignedChoreID() ?>' class="card card-body" data-toggle="modal" data-target="#modalAssignedChore"><?php echo $chore->getChoreName() ?></td></tr>
                                            <?php
                                            break;
                                        }
                                    }
                                    ?>

                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } ?>
                </div>
                <?php if($_COOKIE['accountType'] == 0){
                    ?>
                    <button id="btnNewChore" class="btn btn-primary btn-lg btn-block btnTop" data-toggle="modal" data-target="#modalNewChore">New Chore</button>
                    <?php
                } ?>
            </div>

            <!-- Modal Edit Chore -->
            <div class="modal fade" id="modalEditChore" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="lblEditChore">Edit Chore</h5>
                            <button id="btnCloseChore" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                                    <div>
                                        <label class="font-weight-bold" for="assignChore">Assign To</label>
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
                                    <?php
                                } ?>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btnCloseChore" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if($_COOKIE['accountType'] == 0){?>
                                <!--<button id="btnDeleteChore" type="button" class="btn btn-danger" data-dismiss="modal" hidden>Delete Chore</button>-->
                                <button id="btnEditChore" type="button" class="btn btn-info">Edit</button>
                                <button id="btnSaveChore" type="button" class="btn btn-info" hidden>Save</button>
                                <button id="btnAssignChore" type="button" class="btn btn-primary" data-dismiss="modal" disabled>Assign Chore</button>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <label class="font-weight-bold" for="assignedChoreStatus">Status</label>
                                    <input class="form-control" type="text" id="assignedChoreStatus" readonly/>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btnComplete" type="button" class="btn btn-primary" data-dismiss="modal" hidden>Mark Complete</button>
                            <?php
                            if($_COOKIE['accountType'] == 0){?>
                                <button id="btnReassign" type="button" class="btn btn-info">Reassign Chore</button>
                            <?php
                            }
                            ?>
                            <button id="btnSaveReassign" type="button" class="btn btn-info" hidden disabled>Save</button>
                            <button id="btnCloseChore" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <label id="invChoreName" class="text-danger" hidden>Chore Name Cannot Be Empty!</label><br>
                                    <label class="font-weight-bold" for="inpChoreName">Name</label>
                                    <input class="form-control" type="text" id="inpChoreName"/>
                                </div>
                                <div class="form-group">
                                    <label id="invChoreDescription" class="text-danger" hidden>Chore Description Cannot Be Empty!</label><br>
                                    <label class="font-weight-bold" for="inpChoreDescription">Description</label>
                                    <input class="form-control" type="text" id="inpChoreDescription"/>
                                </div>
                                <div class="form-group">
                                    <label id="invChorePoints" class="text-danger" hidden>Points Value Cannot Be Empty And Must Be A Number!</label><br>
                                    <label class="font-weight-bold" for="inpChorePoints">Points Value</label>
                                    <input class="form-control" type="text" id="inpChorePoints"/>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btnAddChore">Add Chore</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>