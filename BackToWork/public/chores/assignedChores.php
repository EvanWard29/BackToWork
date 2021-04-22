<?php
/** Admin Get Assigned Chores **/
if($_COOKIE['accountType'] == 0){?>
    <!-- Assigned Chores -->
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
}?>