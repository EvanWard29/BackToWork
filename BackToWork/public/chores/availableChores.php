<?php
/** Get Available Chores **/
if($_COOKIE['accountType'] == 0){?>
    <!-- Available Chores -->
    <div class="col">
        <table id="available" class="table-bordered">
            <thead>
                <tr><th>Available Chores</th></tr>
            </thead>
            <tbody>
                <?php
                //Get available chores from DB & add to table
                $availableChores = getAvailableChores();
                if($availableChores != null){
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
                }else{
                    //If there are no available chores
                    ?>
                    <tr><td class="card-body card">There Are No Chores Available!</td></tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

//Function for getting the available chores from DB
function getAvailableChores(){
    $db = new DBConnection();
    $chores = $db->getAllChores($_COOKIE['groupID']);
    $assignedChores = $db->getAssignedChores($_COOKIE['groupID']);

    $availableChores = [];

    //Filter out assigned and unassigned chores - return unassigned chores
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
}?>