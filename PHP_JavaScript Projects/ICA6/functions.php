<?php
    require_once "dbUtility.php";
    session_start();
    
    

    //validates the array being passed
    function Validate($array)
    {
        //write a query
        $query = "select * from prj_users";
        //check if the query is okay
        if($results = mysqlQuery($query))
        {
            
            //cycle through the query rows
            while($row = $results->fetch_assoc())
            {
                
                //if the username passed is the same as the username in the query
                if($array["username"] == $row["username"])
                {
                    //go and verify the password between the two
                    if(password_verify($array["password"], $row["password"]))
                    {
                        //assign the username and id to the session
                        $_SESSION["username"] = $array["username"];
                        $_SESSION['userID'] = $row["userID"];
                        //show a response and flip status to true
                        $array["response"] = "Welcome , " . $array["username"] . " !";
                        $array["status"] = true;
            
                        
                        return $array;
                    }
                    else
                    {
                        //password doesn't work, don't go through
                        $array["response"] = "Login unsuccesful";
                        $array["status"] = false;

                        return $array;
                    }
                }
            }
        }

        //
        $array["response"] = "Incorrect password, try again";
        $array["status"] = false;
        return $array;
    }
?>