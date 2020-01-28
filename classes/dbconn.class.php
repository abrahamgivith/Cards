<?php
    
    class Dbconn{
        
        private $host = "localhost";
        private $user = "cardSysAdmin";
        private $password = "IS7W8Lh3GGXnAnYw";
        private $db = "giv_loginsystem";
        
        protected function makeConnection(){
            //cardSysAdminIS7W8Lh3GGXnAnYw
            
            $link = mysqli_connect($this->host,$this->user,$this->password,$this->db);
            
            if(mysqli_connect_error()){

                die("Connect error(".mysqli_connect_errno().")".mysqli_connect_error());
            }else{
                
                return $link;

            }
        }
    }
?>