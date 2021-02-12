<?php include_once "header.php" ?>

<html>
    <head>
        <script src="../assets/js/family.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1>My Family</h1>
            <div class="container background">
                <table id="family" class="table-bordered" style="height: 60%">
                    <thead>
                        <tr><th>Name</th><th>Chores Completed</th><th>Points</th></tr>
                    </thead>
                    <tbody>
                    <?php
                        $db = new DBConnection();
                        $members = $db->getUsers(1); //Get familyID from SESSION
                        foreach($members as $member){
                            $name = $member->getFirstName();
                            $points = $member->getPoints();
                            ?>
                            <tr>
                                <td class='table-light'> <?php echo $name; ?> </td>
                                <td class='table-light'>CHORES COMPLETE</td>
                                <td class='table-light'> <?php echo $points; ?> </td>
                            </tr>

                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <button id="btnNewMember" type="button" class="btn btn-primary btn-lg">Add Family Member</button>
        </div>

        <!-- Modal Manage Family -->
        <div class="modal fade" id="modalNewMember" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lblAssignedChore">Add Family Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frmNewMember">
                            <div class="form-group">
                                <label class="text-danger" id="invFirstName" hidden>First Name Cannot Be Empty!</label><br>
                                <label class="font-weight-bold" for="inpFirstName">First Name</label>
                                <input class="form-control" type="text" id="inpFirstName"/>
                            </div>
                            <div class="form-group">
                                <label class="text-danger" id="invLastName" hidden>Last Name Cannot Be Empty!</label><br>
                                <label class="font-weight-bold" for="inpLastName">Last Name</label>
                                <input class="form-control" type="text" id="inpLastName"/>
                            </div>
                            <div class="form-group">
                                <label class="text-danger" id="invEmail" hidden>Email Cannot Be Empty And Must Contain '@'</label><br>
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnSaveMember" type="button" class="btn btn-primary">Save</button>
                        <button id="btnCloseNewMember" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
