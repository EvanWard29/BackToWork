$(function(){
    //Function for removing all cookies if user logs out.
   $('#logout').click(function(){
       document.cookie = "userID=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
       document.cookie = "groupID=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
       document.cookie = "accountType=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
       document.cookie = "points=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC";
   });
});