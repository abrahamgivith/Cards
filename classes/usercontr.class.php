<?php

    class Usercontr extends User{
        
        
        /*---------------------------------------------*/
        // Function to get data from front end and     //
        // provide data to the protected register      //
        // new user class                              //
        // params: username                            //
        //         email                               //
        //         password                            //
        //         confirm password                    //
        // return: success/error messages              //
        /*---------------------------------------------*/
        
        public function getNewUserData($username, $email, $password, $confirmPwd){
            
            $errorMessage= "";
            $missingFields = "";
        
            // Validate the data
            //If user name is missing raise error
            if($username == ""){

                $missingFields .= "<p> Username </p>";
            }

            //If email is missing raise error
            if($email == ""){

                $missingFields .= "<p> Email </p>";
            }

            //If Password is missing raise error
            if($password == ""){
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
            if($password != $confirmPwd){
                $errorMessage .= "<p>Passwords do not match</p>";
            }

            // Validate email
            if($email && filter_var($email, FILTER_VALIDATE_EMAIL)==false){
                $errorMessage .= "Email address is invalid<br>";
            }
            
            //Check if the email already exists
            if($this->emailExists($email)){
                
                $errorMessage .= "<p>Email address already exists. Try logging in. </p>";
            }

            
            if($errorMessage != ""){
                
                // Send any error message to the front end
                return $errorMessage;
            
            } else{
                
                // If there are no error messages, hash the password
                $hashedPw = password_hash($password, PASSWORD_DEFAULT);

                // Register the user
                if($this->registerUser($username,$email,$hashedPw)){
                    
                    $errorMessage = "";
                    return $errorMessage;
                    
                } else{
                    
                    $errorMessage .= "<p>Unable to register you now. Please try again later</p>";
                    return $errorMessage;
                }
                
            }//End: else $errorMessage != ""
 
        }//End: function getNewUserData
    
    } //End: class Usercontr

?>