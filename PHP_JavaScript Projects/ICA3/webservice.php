<?php
require_once 'dbUtility.php';
require_once "functions.php";

global $data;
global $status;
session_start();

//check if the we are logging out
if(isset($_POST["submit"]) && $_POST["submit"] == "Logout")
{
    //end the session and set the location to login page
    session_unset();
    session_destroy();
    header("Location:login.php");
    die();
}



$data = array();
$status = "Fail : Action failed to match";

//will testing incoming requests
function Done()
{
    global $data;
    global $status;

    $response = array();
    $response['data'] = $data;
    $response['status'] = $status;

    echo json_encode($response);
    die();
}

//Gets the users to push into an array
function GetUsers()
{
    
    global $data;
    global $status;

    //create a query to get all users
    $query = "select * from prj_users";

    //if the query is ok
    if($results = mysqlQuery($query))
    {
        //continually push the rows into an array
        while($row = $results->fetch_assoc())
        {
            $temp = array();
            
            $temp["userID"] = $row["userID"];
            $temp['username'] = $row["username"];
            $temp["password"] = $row["password"];

            array_push($data,$temp);

            
        }

        //show how many rows were returned in the status
        $status = $results->num_rows . " rows returned";
    }
}


//if the action was calling GetUsers, then get the users in the DB
if(isset($_GET['action']) && $_GET["action"] == "GetUsers")
{
    GetUsers();
}

//call done
Done();
?>