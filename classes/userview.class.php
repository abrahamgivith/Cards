<?php

    
    class Userview extends User{
        
        public function loginUser($email,$password, $checkLogin){
            
            
            $errorMessage = "";
            $missingFields = "";
            
            // Validate the data
            if($email == ""){

                $missingFields .= "<p> Email </p>";
            }

            if($password == ""){
                $missingFields .= "<p> Password </p>";
            }

            if($missingFields != ""){
                $errorMessage .= "<p> The following fields missing </p>".$missingFields;
            }

            // Validate email
            if($email && filter_var($email, FILTER_VALIDATE_EMAIL)==false){
                $errorMessage .= "Email address is invalid<br>";
            }

            // Send any error message to the front end
            if($errorMessage != ""){
                return json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));

            }else{
                
                // If there are no errors
                
                $credentialCheck = $this->checkLoginCredentials($email,$password);
                
                if ($credentialCheck === "NO_USER_EXISTS"){
                    
                    // User  not found
                    $errorMessage = " Email not found. Register for an account";
                    
                    
                    return json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
        
                    
                } else if($credentialCheck == false){
                    
                    //Invalid password
                    
                    $errorMessage = " Invalid password";
                    
                    return json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
        
                    
                } else if($credentialCheck == true){
                    
                    // Email and password match
                    //echo
                    //Check for 'Keep me logged in'
                    if($checkLogin === 'true'){

                        // If login check is true, make a cookie for 1 day
                       
                        $errorMessage = "";
                        setcookie('userLogin',ucfirst($_SESSION['user']), time()+60*60*24);
                            
                        return json_encode(array('success' =>  1, 'errorMessage' => $errorMessage));

                    }else if($checkLogin === 'false'){
                        
                        //Log in user, but set no cookies
                        
                        $errorMessage = "";
                        return json_encode(array('success' =>  1, 'errorMessage' => $errorMessage));
                        
                    }// End: else $checkLogin == true
                }// End: else if $credentialCheck == true
            }//End: else $errorMessage != ""
        }// End: function loginUser
        
        
    }

?>