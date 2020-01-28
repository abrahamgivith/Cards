<?php
        
    session_start();
    include 'includes/autoloader.inc.php';

    
    
    //============= Register a new User =============//
    if(isset($_POST['typeFlag']) && htmlspecialchars($_POST['typeFlag']) == "register"){
        
        // Make a new object of User Control class
        $registerUserObj = new Usercontr();
        
        // Call the member function getNewUserData whhich does the validation and interaction with User Model
        // Get the result message from the function 
        $message = $registerUserObj->getNewUserData(htmlspecialchars($_POST['username']),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['password']),htmlspecialchars($_POST['confirmPassword']));
        
        // If the message is empty, the registration is successful
        if($message == ""){
            
            // Send out the success AJAX response
            echo json_encode(array('success' =>  1, 'errorMessage' => ""));
            exit();
            
        }else{
            
            // Send out the failure AJAX response
            echo json_encode(array('success' =>  0, 'errorMessage' => $message));
            exit();
        }
        
    }//End: typeFlag == register

    //========= End Register a new User =========//



    //=============== Login A user ===============//

    elseif(isset($_POST['typeFlag']) && htmlspecialchars($_POST['typeFlag']) == "login"){
        
        //Create a new object for user view class
        $loginUserObj = new Userview();
        
    
        // Call the user View function
        $returnJsonLogin = $loginUserObj->loginUser(htmlspecialchars($_POST['email']),htmlspecialchars($_POST['password']),htmlspecialchars($_POST['loginCheck']));
        
        echo $returnJsonLogin;
        exit();
        
        
    }//End: typeFlag = login

    //============== End Login A user ==============//

?>
