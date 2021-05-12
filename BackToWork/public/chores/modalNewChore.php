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
                <!-- Form For Adding New Chore -->
                <form>
                    <div class="form-group">
                        <label id="invChoreName" class="text-danger" hidden>Chore Name Cannot Be Empty And Longer Than 45 Characters!</label><br>
                        <label class="font-weight-bold" for="inpChoreName">Name</label>
                        <input class="form-control" type="text" id="inpChoreName"/>
                    </div>
                    <div class="form-group">
                        <label id="invChoreDescription" class="text-danger" hidden>Chore Description Cannot Be Empty And Longer Than 150 Characters!</label><br>
                        <label class="font-weight-bold" for="inpChoreDescription">Description</label>
                        <textarea class="form-control" type="text" id="inpChoreDescription"></textarea>
                    </div>
                    <div class="form-group">
                        <label id="invChorePoints" class="text-danger" hidden>Points Value Cannot Be Empty And Must Be A Number!</label><br>
                        <label class="font-weight-bold" for="inpChorePoints">Points Value</label>
                        <input class="form-control" type="text" id="inpChorePoints"/>
                    </div>
                    <div class="form-group">
                        <label id="invChorePenalty" class="text-danger" hidden>Penalty Value Cannot Be Empty And Must Be A Number!</label><br>
                        <label class="font-weight-bold" for="inpChorePenalty">Penalty Value</label>
                        <input class="form-control" type="text" id="inpChorePenalty"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnAddChore">Add Chore</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>