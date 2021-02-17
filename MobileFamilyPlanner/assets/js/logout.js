$(function(){
   $('#logout').click(function(){
       document.cookie = "userID=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
   });
});