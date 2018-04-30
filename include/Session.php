<?php 

session_start();

function ErrorMessage(){

    if(isset($_SESSION["ErrorMessage"])){
            
            $output=htmlentities($_SESSION["ErrorMessage"]);
            
            $_SESSION["ErrorMessage"]=null;

            return $output;

    }

}

function SuccessMessage(){
    
        if(isset($_SESSION["SuccessMessage"])){
               
                $output=htmlentities($_SESSION["SuccessMessage"]);
    
                $_SESSION["SuccessMessage"]=null;
    
                return $output;
    
        }
    
    }



?>