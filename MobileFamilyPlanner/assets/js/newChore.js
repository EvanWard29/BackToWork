$(function (){
   $("#btnAddChore").click(function(){
      let choreName = $("#inpChoreName").val();
      let choreDescription = $("#inpChoreDescription").val();

      $.post("/MobileFamilyPlanner/src/model/addChore.php", {
         name: choreName,
         description: choreDescription
      });

      $('#available tr:last').after('<tr><td>' + choreName + '</td></tr>');

   });
});