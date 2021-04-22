<!-- My Chores -->
<div class="col">
    <table id="available" class="table-bordered smallChores">
        <thead>
            <tr><th>My Chores</th></tr>
        </thead>
        <tbody>
        <?php
        //Get all assigned chores where userID = logged user
        $userChores = $db->getUserChores($_COOKIE['userID'], $_COOKIE['groupID']);

        if($userChores == null){?>
            <tr><td class="card-body card">You Have No Chores To Complete!</td></tr>
            <?php
        }

        $chores = $db->getAllChores($_COOKIE['groupID']);
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
        }
        ?>
        </tbody>
    </table>
</div>