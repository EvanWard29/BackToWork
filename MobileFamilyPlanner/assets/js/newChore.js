$(function (){
   $("#btnAddChore").click(function(){
      let choreName = $("#inpChoreName").val();
      let choreDescription = $("#inpChoreDescription").val();

      $.post("/MobileFamilyPlanner/src/controller/addChore.php", {
         name: choreName,
         description: choreDescription
      });

      $.post("/MobileFamilyPlanner/src/controller/getNextChoreID.php",function(data){
         location.reload();
      })
   });
});