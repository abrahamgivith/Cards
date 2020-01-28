<?php
    
    session_start();
    // In case the user press a back button in browser do not let them again to logged in page again
    if(isset($_POST["logout"])){
        // Redirect to the index page
        
        // Destroy the session
        session_destroy();
        
        // Unset the cookie
        if(isset($_COOKIE['userLogin'])){
            setcookie('userLogin', "", time()-60*60);
            $_COOKIE['userLogin'] = "";
        
        }//End: isset $_COOKIE['userLogin']
         
        
    }//End: isset $_SESSION['ID']   
    
    else if(isset($_SESSION['ID'])){
        
        header('Location:login.php');
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="bootstrap.css">
        <style type="text/css">
            
            html{
                height:100%;
            }
            body{
                  
                background-image: url("images/homepage.jpg");
                height:100%;
                margin:0;
                background-repeat:no-repeat;
                background-size: cover;
            }
            
            h1{
                color: darkslategray;
            }
            
            p{
                color: darkslategray;
            }
            
            #welcome{
                
                text-align: center;
                margin: 0 auto;
                padding-top: 300px;
            }
            
            
            #registerLink{
                color: coral;
                text-decoration: none;
            }
            #registerLink:hover{
                text-decoration: underline;
                font-size: 110%;
                cursor:pointer;
            }
            
            #registerSuccessAlert{
                
                width:450px;
                margin:30px auto;
                border-radius: 10px;
                
            }
            
            #loginButton{
                
                transition: 1s ease-in-out;
                
            }
            
            #loginButton:hover{
                
                transform: scaleX(1.12);
            }
        
        </style>
    </head>
    <body>
        <!-- Jumbotron-->
        <div class="container" id= "welcome">
          <h1 class="display-4">Welcome to Notes</h1>
          <p class="lead">If you are a new user register  <span><a id="registerLink" data-toggle="modal" data-target="#registerModal"> here</a></span></p>
          <button type="button" id="loginButton" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal"  >Login </button>
        </div>
        
        
        
        
        
        <!--Login-->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="loginHeader">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                
              <!-- Message display -->
              <div id="message"></div>
              
              <div class="modal-body">
                <form id="loginForm" method="post">
                    
                  <!-- Email -->
                  <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="user@example.com" name="email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
                    
                  <!-- Password -->
                  <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                  </div>
                    
                  <!-- Check button -->
                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="loginCheck" name="loginCheck">
                    <label class="form-check-label" for="loginCheck">Keep me logged in</label>
                  </div>
                    
                    <!-- Close button -->
                    <div class="form-group modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                    <!-- Login button -->
                    <button type="submit" class="btn btn-primary" name="submitLogin" id="submitLogin">Login</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
        
        
        
        <!--Register-->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="loginHeader">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Message display -->
              <div id="registerMessage"></div>
            
                
              <!-- Modal body for register -->
              <div class="modal-body">
                <form id="registerForm" method="post" >
                  
                  <!-- Username -->
                  <div class="form-group">
                    <label for="userName">Username</label>
                    <input type="text" class="form-control" id="userName" aria-describedby="userNamehelp" placeholder="e.g. John Doe" name="userName">
                  </div>
                  
                  <!-- Email -->
                  <div class="form-group">
                    <label for="inputEmailRegister">Email address</label>
                    <input type="email" class="form-control" id="inputEmailRegister" aria-describedby="emailHelp" placeholder="user@example.com" name="emailRegister">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
                    
                  <!-- Password -->
                  <div class="form-group">
                    <label for="inputPasswordRegister">Password</label>
                    <input type="password" class="form-control" id="inputPasswordRegister" placeholder="Password" name="passwordRegister">
                  </div>
                    
                  <!-- Confirm password -->
                  <div class="form-group">
                    <label for="confirmPassword">Confirm password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" name="confirmPassword">
                  </div>
                    
                    <!-- Close button -->
                    <div class="form-group modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                    <!-- register button -->
                    <button type="submit" class="btn btn-primary" name="submitRegister" id="submitRegister"  >Register</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div> 
        
        <div id="registerSuccessAlert" class="alert alert-success " ><span id="registerSuccessmessage"></span>
            
            <button type="button" class="close hide-alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            
            
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
        <script type="text/javascript">
            
            // Clear off any error message that was displayed before.
            
            
            $("#loginButton").click(function(){
                $("#message").hide();
                
                // Clear the form
                document.getElementById("loginForm").reset();
                
            });
            

            // Make request to the server with the Login credentials
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                
                //check if the login check val is made
                var loginCheckVal = $("#loginCheck").prop('checked');
               
                //Make the sever request
                $.ajax({
                    type: "POST",
                    url: 'admin.php',
                    data: {
                            "typeFlag":"login",
                            "email": $("#inputEmail").val(),
                        
                            "password":$("#inputPassword").val(),
                            "loginCheck":loginCheckVal
                    },
                    success: function(response)
                    {
                        console.log(response)
                        var jsonData = JSON.parse(response);
                        console.log(jsonData)
                        // user is logged in successfully in the back-end
                        // let's redirect
                        if (jsonData.success == 1){
                          
                                location.href = 'login.php';
                   
                        
                        }else{
                            
                            // Failed to login
                            $("#message").show();
                            $("#message").html('<div class="alert alert-danger" role="alert"> <p><strong>There were error(s) in your form: </strong></p>'+jsonData.errorMessage+'</div>');
                        }//End: else
                   }//End:success function
               }); //End: Ajax
             });//End: Submit form


            $("#registerSuccessAlert").hide();
            
            // Clear off any error message that was displayed before.
            $("#registerLink").click(function(){
                $("#registerMessage").hide();
                //Clear the form
                document.getElementById("registerForm").reset();
            });
            
            
            // Make the alert message div hide and reappear
            $(function(){
                $(document).on('click','.hide-alert',function(){
                    $(this).parent().hide();
                });
            });
            
            
            // Make request to the server for registering a user
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: 'admin.php',
                    data: {
                            "typeFlag":"register",
                            
                            "username": $("#userName").val(),
                        
                            "email": $("#inputEmailRegister").val(),
                        
                            "password":$("#inputPasswordRegister").val(),
                            "confirmPassword":$("#confirmPassword").val()
                    },
                    success: function(response)
                    {
                        console.log(response)
                        var jsonData = JSON.parse(response);

                        // user is logged in successfully in the back-end
                        // let's redirect
                        if (jsonData.success == 1){
                            
                            
                            // Failed to login
                            $("#registerSuccessAlert").show();
                            $("#registerSuccessmessage").html('You are successfully registered Please Login again.');
                            $("#registerModal").modal('toggle');
                        
                        }else{
                            
                            // Failed to register
                            $("#registerMessage").show();
                            $("#registerMessage").html('<div class="alert alert-danger" role="alert"> <p><strong>There were error(s) in your form: </strong></p>'+jsonData.errorMessage+'</div>');
                        }//End: else
                   }//End:success function
               }); //End: Ajax

             });//End: Submit form

    
        </script>
    
    </body>
</html>