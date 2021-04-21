<script src="../../../assets/js/account/details/deleteGroup.js"></script>

<!-- Modal Disband Group -->
<div class="modal fade" id="modalDisbandGroup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">Are You Sure You Wish To Disband This Group. All Accounts Associated With This Group Will Also Be Deleted!</p>
                <div class="text-center">
                    <button class="btn btn-danger btnMargin-Right" id="btnDisbandGroup">Disband</button>
                    <button class="btn btn-primary btnMargin-Left" id="btnCancelDeleteGroup">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Disband -->
<div class="modal fade" id="modalConfirmDisband" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center"><span class="font-weight-bold text-danger">Warning!</span> This Action Is Irreversible!</p>
                <div class="text-center">
                    <button class="btn btn-danger btnMargin-Right" id="btnConfirmDisband">I Understand</button>
                    <button class="btn btn-primary btnMargin-Left" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>