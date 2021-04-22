$(function (){
   /** New Chore **/
   $("#btnAddChore").click(function(){
      let nameErr = false;
      let descriptionErr = false;
      let pointsErr = false;
      let penaltyErr = false;

      //Get details of new chore
      let choreName = $("#inpChoreName").val();
      let choreDescription = $("#inpChoreDescription").val();
      let chorePoints = $("#inpChorePoints").val();
      let chorePenalty = $("#inpChorePenalty").val();

      //Perform validation techniques on user inputs
      if(choreName === ""){
         //Chore Name is empty
         nameErr = true;

         $('#inpChoreName').addClass('is-invalid');
         $('#invChoreName').attr('hidden', false);
      }else{
         //Chore Name is NOT empty
         if(choreName.length > 45){
            //Chore Name is too long
            nameErr = true;

            $('#inpChoreName').addClass('is-invalid');
            $('#invChoreName').attr('hidden', false);
         }else{
            nameErr = false;

            $('#inpChoreName').removeClass('is-invalid');
            $('#invChoreName').attr('hidden', true);
         }
      }

      if(choreDescription === ""){
         //Chore Description is empty
         descriptionErr = true;

         $('#inpChoreDescription').addClass('is-invalid');
         $('#invChoreDescription').attr('hidden', false);
      }else{
         //Chore Description is NOT empty
         if(choreDescription.length > 150){
            //Chore Description is too long
            descriptionErr = true;

            $('#inpChoreDescription').addClass('is-invalid');
            $('#invChoreDescription').attr('hidden', false);
         }else{
            descriptionErr = false;

            $('#inpChoreDescription').removeClass('is-invalid');
            $('#invChoreDescription').attr('hidden', true);
         }
      }

      if(chorePenalty === ""){
         //Chore Penalty is empty
         penaltyErr = true;

         $('#inpChorePenalty').addClass('is-invalid');
         $('#invChorePenalty').attr('hidden', false);
      }else{
         //Chore Penalty is NOT empty

         if(isNaN(chorePenalty) === true){
            //Chore Penalty is NOT a valid number
            penaltyErr = true;

            $('#inpChorePenalty').addClass('is-invalid');
            $('#invChorePenalty').attr('hidden', false);
         }else{
            penaltyErr = false;

            $('#inpChorePenalty').removeClass('is-invalid');
            $('#invChorePenalty').attr('hidden', true);
         }
      }

      if(chorePoints === ""){
         //Chore Points is empty
         pointsErr = true;

         $('#inpChorePoints').addClass('is-invalid');
         $('#invChorePoints').attr('hidden', false);
      }else{
         //Chore Points is NOT empty

         if(isNaN(chorePoints) === true){
            //Chore Points is NOT a valid number
            pointsErr = true;

            $('#inpChorePoints').addClass('is-invalid');
            $('#invChorePoints').attr('hidden', false);
         }else{
            pointsErr = false;

            $('#inpChorePoints').removeClass('is-invalid');
            $('#invChorePoints').attr('hidden', true);
         }
      }

      //If there are no errors, POST data to server to be processed
      if(nameErr !== true && descriptionErr !== true && penaltyErr !== true && pointsErr !== true) {
         $.post("/BackToWork/src/controller/chores/addChore.php", {
            name: choreName,
            description: choreDescription,
            points: parseInt(chorePoints),
            penalty: parseInt(chorePenalty),
            groupID: getCookie('groupID')
         }, function(response){
            location.reload();
         });
      }
   });

   //Tidy up modal when closed
   $('#modalNewChore').on('hide.bs.modal', function(){
      $("#inpChoreName").val("");
      $("#inpChoreDescription").val("");
      $("#inpChorePoints").val("");

      $('#inpChoreName').removeClass('is-invalid');
      $('#invChoreName').attr('hidden', true);

      $('#inpChoreDescription').removeClass('is-invalid');
      $('#invChoreDescription').attr('hidden', true);

      $('#inpChorePoints').removeClass('is-invalid');
      $('#invChorePoints').attr('hidden', true);
   });
});