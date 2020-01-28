<?php
    

    class User extends Dbconn{
        
        /*---------------------------------------------*/
        // Function to register a user into datbase    //
        // params: username                            //
        //         password                            //
        //         email                               //
        // return: true/false                          //
        /*---------------------------------------------*/
        
        protected function registerUser(string $username, string $email, string $password){
            
            // Make a connection to database
            $conn = $this->makeConnection();
            
            $registerQuery =  "INSERT INTO `users` (`User name`, `Email`, `Password`) VALUES('".mysqli_real_escape_string($conn,$username)."','".mysqli_real_escape_string($conn,$email)."','".mysqli_real_escape_string($conn,$password)."')";
            
            if(mysqli_query($conn,$registerQuery)){
                    
                // If it was successful in registering the new user
                return true;
                
            }else{
                    
                // If there are any errors in registering  to database
                return false;

            }// End: else mysqli_query($conn,$newUserQuery)
        }//End: function registerUser
        
        
        
        /*---------------------------------------------*/
        // Function to check if a email is already     //
        // registerd                                   //
        // params: email                            //
        // return: true/false                          //
        /*---------------------------------------------*/
        
        protected function emailExists($email){
            
            // Make a connection to database
            $conn = $this->makeConnection();
            
            $searchExistingUserQuery = "SELECT `id` from `users` WHERE email = '".mysqli_real_escape_string($conn,$email)."'";
            
            $queryResult = mysqli_query($conn,$searchExistingUserQuery);
            
            // If the query result have some valid rows the user already exists
            if(mysqli_num_rows($queryResult) > 0){
               
                // Return a true value to notify the existing email
                return true;
            
            }else{
                
                // No user exists with this email
                return false;
            }
            
        }//End: function emailExists
        
        
        
        /*---------------------------------------------*/
        // Function to check login credentials of user //
        // params: email                               //
        //         password                            //
        // return: true/false                          //
        /*---------------------------------------------*/
        
        protected function checkLoginCredentials(string $email, string $password){
            
            // Make a connection to database
            $conn = $this->makeConnection();
            
            
            $loginQuery = "SELECT * FROM `users` WHERE `Email` ='".mysqli_real_escape_string($conn,$email)."' LIMIT 1 ";
            
            // Run the query 
            if($result = mysqli_query($conn,$loginQuery)){
                
                // Fetch the array of data
                $row = mysqli_fetch_array($result);

                // Verify the password
                if(password_verify($password,$row['Password'])){

                    //User verified
                    // Set the session ID
                    $_SESSION['ID'] = $row['ID'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['user'] = $row['User name'];
                    
                    // Return successful credential check
                    return true;
               
                } else{
                    
                    // Return failure in credential check
                    return false;
                
                }//End: else password_verify
                
            } else{
                
                // No user exists
                return "NO_USER_EXISTS";
           
            }// End: else mysqli_query
       
        }//End: function checkLoginCredentials
        
        
        
        
        
    }// End: Class User

?>