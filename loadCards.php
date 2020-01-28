<?php
    
    //session_start();
    
    include('serverLoginpage.php');

    if(isset($_POST['loadCard']) && $_POST['loadCard'] == true){
         
         $conn = makeDbConnection();
         $email = $_SESSION['Email'];
         $cardData = loadCardData($conn,$email);

         //$testData = "{\"success\":1,\"cardData\":{\"0\":\"aaa\"}}";

         echo $cardData;
         exit();


    }//End: isset($_POST['loadCard']

        
    if(isset($_POST['card'])){
        
        $cardtitle = htmlentities($_POST['cardtitle']);
        $cardtext = htmlentities($_POST['cardtext']);

        $cardData = makeCard($cardtitle,$cardtext);

        echo $cardData;
        exit();
        
        
    }//End: isset($_POST['card']
    

?>