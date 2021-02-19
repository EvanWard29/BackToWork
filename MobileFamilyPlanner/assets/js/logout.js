$(function(){
   $('#logout').click(function(){
       document.cookie = "userID=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
       document.cookie = "familyID=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
       document.cookie = "accountType=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
   });
});