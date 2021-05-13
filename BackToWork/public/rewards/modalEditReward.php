<!-- Modal Edit Reward -->
<div class="modal fade" id="modalEditReward" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Reward</h5>
                <button id="btnCloseRewardEdit" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label id="invEditRewardName" class="text-danger" hidden>Reward Name Cannot Be Empty And Longer Than 45 Characters!</label><br>
                        <label for="inpEditRewardName" class="font-weight-bold">Reward Name:</label>
                        <input id="inpEditRewardName" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label id="invEditRewardPoints" class="text-danger" hidden>Points Cost Cannot Be Empty!</label><br>
                        <label for="inpEditRewardPoints" class="font-weight-bold">Reward Points:</label>
                        <input id="inpEditRewardPoints" type="number" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSaveReward" type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnCancelRewardEdit">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Edit Reward -->
<div class="modal fade" id="modalConfirmEditReward" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Reward</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are You Sure You Want To Edit This Reward?</p>
                <div class="text-center">
                    <button id="btnConfirmEditReward" class="btn btn-danger btnMargin-Right">Confirm</button>
                    <button type="button" class="btn btn-primary btnMargin-Left" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Reward -->
<div class="modal fade" id="modalConfirmDeleteReward" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Reward</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are You Sure You Want To Delete This Reward?</p>
                <div class="text-center">
                    <button id="btnConfirmDeleteReward" class="btn btn-danger btnMargin-Right">Confirm</button>
                    <button type="button" class="btn btn-primary btnMargin-Left" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>