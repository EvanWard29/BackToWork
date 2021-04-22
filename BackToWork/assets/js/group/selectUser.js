$(function(){
    /** Select User **/
    $('tr').click(function(){
        $('#modalViewMember').modal('show');

        $('#memberID').html($(this).find(".names").attr('id').replace( /^\D+/g, ''));
        $('#inpName').val($(this).find(".names").html());
        $('#inpChoresCompleted').val($(this).find(".choresCompleted").html());
        $('#inpPoints').val($(this).find(".points").html().replace(/ /g,''));

        if($('#memberID').html() === getCookie('userID')){
            $('#btnDeleteMember').attr('hidden', true);
        }else{
            $('#btnDeleteMember').attr('hidden', false);
        }
    });

    //Show new member modal
    $('#btnNewMember').click(function(){
        $('#modalNewMember').modal('show');
    });

    //Switch to user details Edit layout
    $('#btnEditMember').click(function(){
       $('#inpName').attr('readonly', false);
       $('#inpChoresCompleted').attr('readonly', false);
       $('#inpPoints').attr('readonly', false);

       $('#btnEditMember').attr('hidden', true);
       $('#btnSave').attr('hidden', false);
    });

   //Tidy up modal when closed
   $('#btnCloseMember').click(function(){
       $('#inpName').attr('readonly', true);
       $('#inpChoresCompleted').attr('readonly', true);
       $('#inpPoints').attr('readonly', true);

       $('#btnSave').attr('hidden', true);
       $('#btnEditMember').attr('hidden', false);
   });

    //Cancel creating new member, revert layout to view user mode
    $('#btnCloseNewMember').click(function(){
        $('#inpFirstName').removeClass("is-invalid");
        $('#invFirstName').attr('hidden', true);

        $('#inpLastName').removeClass("is-invalid");
        $('#invLastName').attr('hidden', true);

        $('#inpEmail').removeClass("is-invalid");
        $('#invEmail').attr('hidden', true);

        $('#inpPassword').removeClass("is-invalid");
        $('#invPassword').attr('hidden', true);

        $('#inpConfirmPassword').removeClass("is-invalid");
        $('#invConfirmPassword').attr('hidden', true);
    });
});