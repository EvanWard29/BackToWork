<?php include_once "header.php" ?>
<html>
    <head>

    </head>
    <body>
        <div class="container-fluid main">
            <h1>Chores</h1>
            <div class="container background">
                <div class="row">
                    <div class="col">
                        <table id="available" class="table-bordered">
                            <thead>
                            <tr><th>Available Chores</th></tr>
                            <tr><td id="chore">TestChore</td></tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col">
                        <table id="assigned" class="table-bordered">
                            <thead>
                            <tr><th>Assigned Chores</th></tr>
                            <tr><td id="assignedChore">TestChore</td></tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>