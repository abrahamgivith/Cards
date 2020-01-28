<?php
    session_start();
    //$cookieActive = false;
    //$username = "";
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    //$_SESSION['ID']  = "givy";
    if(array_key_exists('userLogin',$_COOKIE)){
       $_SESSION['ID'] = $_COOKIE['userLogin'];
        
        
        //$data = unserialize($_COOKIE['userCookie']);
        //$cookieActive = true;
        //$username = explode("@",$data['email'])[0] ;
    }
    
    
    if((array_key_exists('ID', $_SESSION))){ 
                               
       //href='index.php?logout=1'
                               
    } else{
        
        header("Location:index.php");
        exit();
    }
        
/*
    if(!(array_key_exists('ID', $_SESSION))){
        print_r($_SESSION);
        unset($_SESSION);
        header("Location:index.php");
        
    }
    */
    //echo $_COOKIE['userLogin'];


    
?>

<!doctype html>
<html>
    <head>
        <title>
            Login page
        </title>
        <link rel="stylesheet" href="bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        
        <style type="text/css">
            
            body{
                width:100vw;
                height: 100vh;
                font-family: 'Open Sans',  sans-serif;
            }
            
            #navbar{
                padding-top: 20px;
                height: 120px;
                width:100%
            }
            
            #ulnav{
                padding-left: 40px;
            }
            
            #navbarbrand{
                padding-left: 40px;
            }
            #accountdropdown{
                
                margin-right: 15px;
            }
            .clear{
                clear:both;
            }
            
            #displayname{
                padding-left: 10px;
                color:darkseagreen;
            }
            
            #addCard.hover{
                cursor:pointer;
            }
            
            #cardForm{
                padding-top: 30px;
            }
            
            .textboxmodal{
                border: none;
                border-radius: 10px;
                
            }
            
            #NewCardModal{
                position: relative;
                top:140px;
            }
            #confirmClose{
                position: relative;
                top:140px;
            }
            
            #refreshButtonDiv{
                margin-top: 30px;
                
            }
      
            #cardDisplayDiv{
                margin: 30px auto;
                background-color:white;
                border-left: 0.5px #e8e8e8 solid;
                border-right: 0.5px #e8e8e8 solid;
                border-radius: 10px;
                min-height: 100vh;
                padding-top: 20px;
                padding-bottom: 20px;

            }
            
            #pageFooter{
                width:100vw;
                height:100px;
                background-color: #737d85;
            }
            
            #copyright{
                text-align: center;
                padding-top: 20px;
            }  
            
            #confirmClose {
                visibility:hidden;
            }

           
            #confirmClose.active{
                visibility:visible;
            }
            
            .cardStyling{
                float: none;
                margin: 30px auto;
                font-family: 'Open Sans',  sans-serif;
                padding:3px;
                background-color:#fffcfa;
                border-radius: 10px;
                
            }
            
            .noCardsMessage{
                padding:15px;
                padding-left: 75px !important;
            }


        </style>
    </head>
    <body>
    
        <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a  id="navbarbrand" class="navbar-brand " href="#"><h2 >Welcome <span id="displayname"></span></h2></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul id="ulnav" class="navbar-nav">
                        <li class="nav-item active">
                            <!--
                            <a id="addCard" class="nav-link" data-toggle="modal" data-target="#NewCardModal" ><h4 class="text-muted">Add card <span class="sr-only">(current)</span></h4></a>
                        </li> -->
                    </ul>

                </div>

                <div id="accountdropdown" class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <span id="accdisplayname" class="dropdown-item-text text-muted"></span>
                            <form method="post" action="index.php">
                            <input class="dropdown-item" type="submit" id="logout" name="logout" value="Log out">
                            </form>
                   
                                
                        </div>
                </div>
            </div>
        </nav>
        
        <div class="clear"></div>
        
        <div id="successMessageDiv" class="alert alert-success"><span id="successMessage"></span>
            <button type="button" class="close hide-alert">&times;</button>
        </div>
        
        <div id="failureMessageDiv" class="alert alert-danger " role="alert"><span id="failureMessage"></span>
        
            <button type="button" class="close hide-alert"  aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div id="NewCardModal" class="modal " tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="cardForm" method="post">
                        <div class="modal-header">
                            <input id="cardTitle" class="modal-title form-control textboxmodal" placeholder="Your title goes here">
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control textboxmodal" id="cardText" placeholder="Your thoughts goes here"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button id="closeCardModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="saveCard" type="submit"  class="btn btn-primary" >Save changes</button>
                        </div>
                    </form>
                </div>
 
            </div>
        </div>
        

        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div id="refreshButtonDiv">
                        <button id="addCard"  data-toggle="modal" data-target="#NewCardModal" class="btn btn-outline-secondary btn-lg" role="button" name="addButton">Add card</button>
                        <button id="refreshButton" class="btn btn-outline-secondary btn-lg" role="button" name="refreshButton"> Reload cards</button>
                    </div>
                </div>
            </div>
        </div>
        
         <div class="clear"></div>
        
        <div class="container " id="cardDisplayDiv"></div>
        
        <div class="clear"></div>
        
        
        <div id="pageFooter">
            <p id="copyright">&copy;Copyright</p>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        
        <script type="text/javascript">
            var timerVal = 60;
            
            window.history.forward(-1);
            // Hide the message divs
            $("#successMessageDiv").hide();
            $("#failureMessageDiv").hide();
            $("#confirmClose").hide();
            
            
            // Make the alert message div hide and reappear
            $(function(){
                $(document).on('click','.hide-alert',function(){
                    $(this).parent().hide();
                });
            });
            
            
            //=========Load Cards===========//
            
            loadCardData();
            function loadCardData(){
                $.ajax({
                       url:"loadCards.php",
                       type:"post",
                       data:{
                           "loadCard":true
                       },
                       success:function(response){
                           console.log("Ajax Load card")
                           var jsonData = JSON.parse(response);
                    
                           if(jsonData.success == 1){
                               arrangeCards(jsonData.cardData);
                           }else{
                               $("#failureMessageDiv").show();
                                $("#failureMessage").html("<p> Cards could not be loaded. Try Reloading </p>");

                           }//End: elsejsonData.success == 1
                       }//End: success function 
               });// End Ajax
            }// End:Function loadCardData

            
            //=========Extract Cookie data===========//
            
            //Extract the user name from the cookie
            var cookieActive = getCookie('userLogin');
            // replace any + characters with white space in  the username 
            username = cookieActive.replace('+', " ");
            //Display the user name in the welcome note
            document.getElementById("displayname").innerHTML = username ;
            document.getElementById("accdisplayname").innerHTML = username ;
            
              console.log("cookie data")
           console.log(username) 
            
 
            // Function to extract the cookie value 
            function getCookie(cname) {
              var name = cname + "=";
              var ca = document.cookie.split(';');
              for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
              }
              return "";
            }
            
            
            //===========Add Card===============//
            
            
            
            // On 
            $("#addCard").on('click',function(){
                
                $("#cardForm").trigger('reset');
                
            });//End: #addCard on click function
            
            //If the close button is clicked before saving, raise a warning dialogue box
            $("#closeCardModal").on('click',function(e){
               e.preventDefault();
             
                var c =confirm("Changes may not be saved! Click Ok if you still wan to leave!");
                if(c){
                    return 'Close';
                }else{
                    return false;
                }
 
            });//End:#closeCardModal function
            
            // If the card is submitted save it to the database
            $("#cardForm").on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:"loadCards.php",
                    type:"post",
                    data:{
                        "card": true,
                        "cardtitle": $("#cardTitle").val(),
                        "cardtext":$("#cardText").val()
                    },
                    
                    success:function(response){

                        var jsonData = JSON.parse(response);
                        
                        if(jsonData.success == 1){
                           
                            $("#successMessageDiv").show();
                            $("#successMessage").html(" Card saved ");
                           
                        }
                        else{
                            
                            $("#failureMessageDiv").show();
                            $("#failureMessage").html("Card not saved ");
                 
                        }//End:else jsonData.success== 1
                    },// End success function
                    
                    error:function(){
                        console.log("There was an error in save card ajax call")
                    }//End: error: function
                    
                    
                });//End Ajax
                $('#NewCardModal').modal('toggle');
                return false;
                
            });//End submit function
            
            //===========End Add Card===============//
            
            
            // Refresh the page to load newly added cards
            
            $("#refreshButton").on('click',function(e){
                e.preventDefault();
                loadCardData();
            });//End: On 'click',function(e)
            
            
            function arrangeCards(jsonData){
                
                var cardHtml = "";
                
                if(jsonData  == "No data"){
                    
                    cardHtml += "<div class=\"cardStyling noCardsMessage\"><p>No cards to show. Add some cards</p></div>";
                }else{
                
                    for(var i=(jsonData.length-1); i>=0 ;i--){
                        

                        cardHtml += "<div class=\"card cardStyling\" style=\"width: 30rem;\"><div class=\"card-header\"><strong><h5 class=\"card-title\">"+jsonData[i]['title']+"</h5></strong></div><div class=\"card-body\"><p class=\"card-text\">"+jsonData[i]['text']+"</p><h6 class=\"card-subtitle mb-2 text-muted\">"+jsonData[i]['date']+"</h6></div></div>";

                    }//End for loop
                }
                
                $("#cardDisplayDiv").html(cardHtml);
                
            }//End: function arrangeCards
            
            
            
           
             /*
            
            // Action on clicking logout button
            $("#logout").on('click',function(e){
                e.preventDefault();
                $.ajax({
                    url:"serverLoginpage.php",
                    type:"post",
                    data:{
                        "logout": true
                    },
                    success:function(response){
                        var jsonData = JSON.parse(response);
                        
                        if(jsonData.success == 1){
                            // Logout successful
                            
                            location.href= "index.php";
                        
                        }else{
                            // Failed to logout
                            $("#failureMessageDiv").show();
                            $("#failureMessage").html('<p> Failed to logout. try again later</p>');
                        }//End: else jsonData.success == 1
  
                    },//End: success: function
                    
                    error:function(){
                        console.log("There was an error in logging out ajax call")
                    }//End: error: function
                    
                });//End: Ajax
            });//End: logout button click
            
            */
          
        </script>
    </body>

</html>