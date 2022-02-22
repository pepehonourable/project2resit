<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheet.css">
    <title>Search</title>
</head>
<body>
<div class="header">
    <div class="headerGrid">
        <div class="headerTitle">
            <li>NHL WEBSHOP</li>
        </div>
        <div class="search">
           <div class="searchbox">
               <form action = "#" method = "POST">
                   <input type="text" class = "form-control"  id = "live_search" autocomplete = "off" placeholder = "Search product"/> 
               </form>
               <div id ="searchresult"></div>  
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
               <script type="text/javascript">    //// using this id we will display our data will come from .php page
                   $(document).ready(function (){ 

                       $("#live_search").keyup(function(){   //using this id we will perform an event on this input type
                           var input = $(this).val();     //
                           //alert(input);                 //when a user type any value or releases any key then that value will be srored in a variable called input and will be shown using alert function 
                           
                           if(input != ""){
                               $.ajax({
                                   url: "livesearch.php",
                                   type: "POST",
                                   data:{"input" : input}, // if this code is not empty then using ajax method page redirects to file .php with the data input 

                                   success:function(data){
                                       $("#searchresult").html(data);  
                                       console.log('success'); // after success functioin data will be shown in the div section with an id search result 
                                   },
                                   error: function(){ console.log('request failed');
                                   }
                               });
                           }else{
                            $("#livesearchresult").css("display", "none"); // if input is empty then this section will be hidden
                           }
                       });  

                   });
               </script>
             </div>
        </div>
        <nav>
            <li><a href ="MainPage.php">Home</a></li>
            <li><a href ="Register.php">Login</li>
            <li><a href ="orderUser.php">Orders</a></li>
            <li>Cart</li>
        </nav>
        </div>
    </div>
</div>
</html>
