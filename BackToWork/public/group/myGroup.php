<?php include_once "../header.php"?>

<html>
    <head>
        <script src="../../assets/js/account/registration/registration.js"></script>
        <script src="../../assets/js/group/myGroup.js"></script>
        <script src="../../assets/js/group/deleteMember.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1>My Group</h1>
            <div id="myGroup-content" class="container containerBackground">
                <table id="family" class="table-bordered" style="height: 60%">
                    <thead>
                        <tr><th>Name</th><th>Chores Completed</th><th>Points</th></tr>
                    </thead>
                    <tbody>
                    <?php
                        $db = new DBConnection();
                        $members = $db->getUsers($_COOKIE['groupID']);
                        foreach($members as $member){
                            $userID = $member->getUserID();
                            $name = $member->getFirstName();
                            $points = $member->getPoints();
                            $choresCompleted = $member->getChoresCompleted();
                            ?>
                            <tr>
                                <td class='table-light names' id="user<?php echo $userID ?>"> <?php echo $name; ?> </td>
                                <td class='table-light choresCompleted'><?php echo $choresCompleted; ?></td>
                                <td class='table-light points'> <?php echo $points; ?> </td>
                            </tr>

                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if($_COOKIE['accountType'] == 0){?>
                <div class="container">
                    <button id="btnNewMember" type="button" class="btn btn-primary btn-block btnTop">Register New Group Member</button>
                </div>
                <?php
            }  ?>
        </div>

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

        <!-- Modal Confirm Delete -->
        <div class="modal fade" id="modalConfirmDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="text-center">Are You Sure You Wish To Delete <span class="font-weight-bold" id="deleteName"></span>Account?</p>
                        <div id="options" class="text-center">
                            <button type="button" class="btn btn-primary" id="btnConfirmDelete">Confirm</button>
                            <button type="button" class="btn btn-danger" id="btnCancelDelete" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
include_once "../footer.php";