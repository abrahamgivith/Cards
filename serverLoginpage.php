<?php
    session_start();
    
    /*
    // Routine for logging out a user
    if(isset($_POST['logout'])){

        unset($_SESSION);
        // Unset the cookie
        setcookie('userLogin', "", time()-60*60);
        
        
        // Return ajax success
        echo json_encode(array('success' =>  1,'err' => "logout"));
        //header('location:index.php');
        exit();

    }// End:isset($_POST['logout']
    
    */

    //if(isset($_SESSION['ID'])){
     
        //header('location:index.php');
        //session_destroy();
        //setcookie('userLogin', "", time()-60*60);
        //exit();
   // }

    /*
    // Check if the session ID is valid or not. If not valid, logout the user
    $message = "";


    if(isset($_SESSION['ID'])){
        
        if(isset($_SESSION['type']) && $_SESSION['type'] == 'login'){
            $message .= "<";
        
        
        //=================================//
        $errorMessage = "serverLoginpage_setsessionidsessiontype".$_SESSION['Email'].$_COOKIE['userLogin'];
        
        echo json_encode(array('success' =>  1,'err' => $errorMessage));
        exit();
        
        
        //=================================//
        }//End:isset($_SESSION['type']) && $_SESSION['type']

    }else{
        
        //header('Location:dbConn.php');
        
    }//End: else isset($_SESSION['ID'])
    
    
    */


    function makeDbConnection(){
        // Make a connection to database
        $host = "localhost";
        $user = "root";
        $pw   = "";
        $db   = "giv_loginsystem";
        $link = mysqli_connect($host,$user,$pw,$db);

        if(mysqli_connect_error()){
            
            die("Connect error(".mysqli_connect_errno().")".mysqli_connect_error());
        }else{
            return $link;

        }
    }// End: function
        

    function makeCard($cardtitle,$cardtext){
        

        $email = $_SESSION['Email'];

        //Get the server time zone
        $timezone = date_default_timezone_get();
        // Set the default time zone
        date_default_timezone_set($timezone);

        // get the current time
        $date = date('h:i:s a d/m/Y ', time());

        //Make a database connection
        $conn = makeDbConnection();

        $cardEntryQuery  = "INSERT INTO `cards` (`email`,`title`,`text`,`date`) VALUES('".mysqli_real_escape_string($conn,$email)."','".mysqli_real_escape_string($conn,$cardtitle)."','".mysqli_real_escape_string($conn,$cardtext)."','".mysqli_real_escape_string($conn,$date)."')";

        if(mysqli_query($conn,$cardEntryQuery)){

            $errorMessage ="card Saved";

            // If it was successful in registering the new user
            return json_encode(array('success' =>  1, 'errorMessage' => $errorMessage));
            

        }else{

            // If there are any errors in registering  to database
            $errorMessage = "<p> Unable to Save the card. Please Try again later </p>";

            return json_encode(array('success' =>  0, 'errorMessage' => $errorMessage));
            

        }// End: else mysqli_query($conn,$cardEntryQuery)
        
    }// End: function makeCard





    //===Function to return the card data from          database===//

    function loadCardData($conn,$email){
        
        // Make the query
        $readCardQuery = "SELECT `title`,`text`,`date` FROM `cards` WHERE `email`='".mysqli_real_escape_string($conn,$email)."'";
        //Execute the query
        if($result = mysqli_query($conn, $readCardQuery)){
            
            if (mysqli_num_rows($result) == 0) {
                
                //If there are no entries in the table
                $message = "No data";
                
                //return the No data message
                return json_encode(array('success' =>  1, 'cardData' => $message));;
                
            }else{
                
                // Read all rows, and make it in a JSON format to return
                $cards = [];
                
                // Read all the rows
                while($readRow = mysqli_fetch_array($result)){
                        
                    // Make an array of rows
                    array_push($cards,$readRow);
                }
                return json_encode(array('success' =>  1, 'cardData' => $cards));

            }//End: else mysqli_num_rows($result) ==0
        }//End: $result = mysqli_query
        
        else{
            
            return "Error fetching data";
        }

    }//End: function
                    

?>