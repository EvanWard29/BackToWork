$(function (){
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

   $("#btnAddChore").click(function(){
      let nameErr = false;
      let descriptionErr = false;
      let pointsErr = false;

      let choreName = $("#inpChoreName").val();
      let choreDescription = $("#inpChoreDescription").val();
      let chorePoints = $("#inpChorePoints").val();

      if(choreName === ""){
         //Chore Name is empty
         nameErr = true;

         $('#inpChoreName').addClass('is-invalid');
         $('#invChoreName').attr('hidden', false);
      }else{
         //Chore Name is NOT empty
         nameErr = false;

         $('#inpChoreName').removeClass('is-invalid');
         $('#invChoreName').attr('hidden', true);
      }

      if(choreDescription === ""){
         //Chore Description is empty
         descriptionErr = true;

         $('#inpChoreDescription').addClass('is-invalid');
         $('#invChoreDescription').attr('hidden', false);
      }else{
         //Chore Description is NOT empty
         descriptionErr = false;

         $('#inpChoreDescription').removeClass('is-invalid');
         $('#invChoreDescription').attr('hidden', true);
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

      if(nameErr !== true && descriptionErr !== true && pointsErr !== true) {
         $.post("/MobileFamilyPlanner/src/controller/addChore.php", {
            name: choreName,
            description: choreDescription,
            points: parseInt(chorePoints)
         }, function(response){
            location.reload();
         });
      }
   });
});