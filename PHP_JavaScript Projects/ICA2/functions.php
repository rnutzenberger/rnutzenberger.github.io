<?php
    session_start();
    $userTable = array();
    $userTable['admin'] = password_hash('god', PASSWORD_DEFAULT);
    $userTable['germf'] = password_hash('new123', PASSWORD_DEFAULT);
    

    //validates the array being passed
    function Validate($array)
    {
        //make the userTable global
        global $userTable;
        //if the username is not in the table
        if(!isset($userTable[$array["username"]]))
        {
            //give the array an error that the username is not found and a status of false
            $array["response"] = "Login Unsuccessful - Failed to find " . $array["username"] .", try again";
            $array["status"] = false;
            
            return $array;
        }
        //if the password is correct
        if(password_verify($array["password"],$userTable["admin"]) || password_verify($array["password"],$userTable["germf"]))
        {
            //echo $array['username'];
            //set the session username to the array username, give it a response and set the status to true
            $_SESSION["username"] = $array["username"];
            $array["response"] = "Welcome , " . $array["username"] . " !";
            $array["status"] = true;
            
            
            return $array;
        }

        //if it doesn't pass the pw verify, then it is incorrect, give appropriate response and status false
        $array["response"] = "Incorrect password, try again";
        $array["status"] = false;
        return $array;
    }
?>