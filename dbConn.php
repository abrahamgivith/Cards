<?php
    

    session_start();
    /*
    if(isset($_SESSION['ID'])){
     
        header('location:index.php');
        session_destroy();
        setcookie('userLogin', "", time()-60*60);
        exit();
    }*/



   //=============| Login User |==============//

    if(isset($_POST['typeFlag']) && htmlspecialchars($_POST['typeFlag']) == "login"){
        
        // Copy data
        if(isset($_POST['email'])){
            $emailLogin = htmlspecialchars($_POST['email']);
        }
        if(isset($_POST['password'])){
            $pwdLogin = htmlspecialchars($_POST['password']);
        }
        if(isset($_POST['loginCheck'])){
            $checkLogin = htmlspecialchars($_POST['loginCheck']);
        }
        
        
        $errorMessage = "";
        $missingFields = "";
        // Validate the data
        if($emailLogin == ""){
            
            $missingFields .= "<p> Email </p>";
        }
        
        if($pwdLogin == ""){
            $missingFields .= "<p> Password </p>";
        }
           
        if($missingFields != ""){
            $errorMessage .= "<p> The following fields missing </p>".$missingFields;
        }
        
        // Validate email
        if($emailLogin && filter_var($emailLogin, FILTER_VALIDATE_EMAIL)==false){
            $errorMessage .= "Email address is invalid<br>";
        }
        
        // Send any error message to the front end
        if($errorMessage != ""){
            echo json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
            
            
        
        }else{
            // If all the fields are entered
            // Make a connection to database
            $conn = makeDbConnection();
            
            // Check the database for the User credentials
            
            $loginQuery = "SELECT * FROM `users` WHERE `Email` ='".mysqli_real_escape_string($conn,$emailLogin)."' LIMIT 1 ";
            
            if($result = mysqli_query($conn,$loginQuery)){
                $row = mysqli_fetch_array($result);
                
                // Verify the password
                if(password_verify($pwdLogin,$row['Password'])){
                    
                    //User verified. Login Success
                    
                    
                    // Set the session ID
                    //$_SESSION['ID'] = $row['ID'];
                    //$_SESSION['type'] = 'login';
                    //$_SESSION['Email'] = $row['Email'];
                    
                    
                    $errorMessage = "dbConn_Successful" ;
                    
                    
                    // Make cookie according to the logincheck boolean
                    if($checkLogin == true){
                        
                        // If login check is true, keep cookie for 1 day
                        setcookie('userLogin',ucfirst($row['User name']), time()+60*60*24);
                        
                        echo json_encode(array('success' =>  1, 'errorMessage' => $errorMessage));
                        exit(); 
                        header('Location:login.php');
                        
                        
                        
                    }else{
                        
                        // If login check is false, keep cookie for 1 hour
                        setcookie('userLogin',ucfirst($row['User name']), time()+60*60);
                        
                        echo json_encode(array('success' =>  1, 'errorMessage' => $errorMessage));
                        exit();
                        header('Location:login.php');
                        
                        
                    }//End: else $checkLogin == true
        
                
                }else{
                    
                    //Passwords do not  match.
                    $errorMessage .= "<p>Incorrect password. Try again</p>";
                    echo json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
                }//End: else $row['Password'] === $pwdLogin
                
            }else {
                //User does not exists
                $errorMessage .= "<p>Email not found. New User? Register <a href=\"#registerLink\"> Here</a> <p>";
                echo json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
                
            }//End else $result = mysqli_query($conn,$loginQuery)
            
        }// End: else of $errorMessage != ""
           
    }// End:'typeFlag' == "login"

//=============| End of Login User |==============//


//=============| Register new User |==============//

    else if(isset($_POST['typeFlag']) && htmlspecialchars($_POST['typeFlag']) == "register"){
        
        // Copy data
        if(isset($_POST['username'])){
            $username = htmlspecialchars($_POST['username']);
        }
        if(isset($_POST['email'])){
            $emailLogin = htmlspecialchars($_POST['email']);
        }
        if(isset($_POST['password'])){
            $pwdLogin = htmlspecialchars($_POST['password']);
        }
        if(isset($_POST['confirmPassword'])){
            $confirmPwd = htmlspecialchars($_POST['confirmPassword']);
        }
        
        
        
        $errorMessage = "";
        $missingFields = "";
        
        // Validate the data
        //If user name is missing raise error
        if($username == ""){
            
            $missingFields .= "<p> Username </p>";
        }
        
        //If email is missing raise error
        if($emailLogin == ""){
            
            $missingFields .= "<p> Email </p>";
        }
        
        //If Password is missing raise error
        if($pwdLogin == ""){
            $missingFields .= "<p> Password </p>";
        }
        
        //If confirm password is missing raise error
        if($confirmPwd == ""){
            $missingFields .= "<p> Confirm Password </p>";
        }
         
        // If there are any missing fields, update error message
        if($missingFields != ""){
            $errorMessage .= "<p> The following fields missing </p>".$missingFields;
        }
        
        // If password and confirm password do not match
        if($pwdLogin != $confirmPwd){
            $errorMessage .= "<p>Passwords do not match</p>";
        }
        
        // Validate email
        if($emailLogin && filter_var($emailLogin, FILTER_VALIDATE_EMAIL)==false){
            $errorMessage .= "Email address is invalid<br>";
        }
        
        // Send any error message to the front end
        if($errorMessage != ""){
            echo json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
        
        }else{
            // If there are no Validation errors
            // Make a connection to database
            $conn = makeDbConnection();
            
            //Check if the email address is already registered
            
            $searchExistingUserQuery = "SELECT `id` from `users` WHERE email = '".mysqli_real_escape_string($conn,$emailLogin)."'";
            
            $queryResult = mysqli_query($conn,$searchExistingUserQuery);
            
            // If the query result have some valid rows the user already exists
            if(mysqli_num_rows($queryResult) > 0){
                $errorMessage .= "<p>Email address already exists. Try logging in. </p>";
                echo json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
            }else{
                
                // If the user does not exist, create a new user into the database
                
                // Secure the password
                
                $hashedPw = password_hash($pwdLogin, PASSWORD_DEFAULT);

                $newUserQuery = "INSERT INTO `users` (`User name`, `Email`, `Password`) VALUES('".mysqli_real_escape_string($conn,$username)."','".mysqli_real_escape_string($conn,$emailLogin)."','".mysqli_real_escape_string($conn,$hashedPw)."')";
                
                if(mysqli_query($conn,$newUserQuery)){
                    

                    
                    // If it was successful in registering the new user
                    echo json_encode(array('success' =>  1, 'errorMessage' => $errorMessage));
                
                }else{
                    
                    // If there are any errors in registering  to database
                    $errorMessage .= "<p> Unable to register you now. Please Try again later </p>";
                    
                    echo json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
                
                }// End: else mysqli_query($conn,$newUserQuery)
                   
            }// End: else mysqli_num_rows($queryResult)>0)
        
        }//End:else $errorMessage != ""
        
    }// End:'typeFlag' == "register" 


//=============| End of Register User |==============//


    /*if($checkLogin){
        // Set cookie to 60 seconds
    }else{
        // Set cookie to 30 seconds
    }
    */

    function makeDbConnection(){
        // Make a connection to database
        $host = "localhost";
        $user = "root";
        $pw   = "";
        $db   = "giv_loginsystem";
        $link = mysqli_connect($host,$user,$pw,$db);
        //cardSysAdminIS7W8Lh3GGXnAnYw
        if(mysqli_connect_error()){

            die("Connect error(".mysqli_connect_errno().")".mysqli_connect_error());
        }else{
            return $link;

        }
    }


    
    /*
    $user = serialize($_POST);
    setcookie('userCookie',$user,time()+60);
    header('location: login.php');
    */


?>

