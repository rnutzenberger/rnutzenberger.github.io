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

//will be called to insert a user into a table
function TestInsert( $username, $password )
{  
    //make an encrypted password
    $encryptedPass = password_hash($password,PASSWORD_DEFAULT);
    //develop a query to insert a tbale with the username and password being passed
    $query = "INSERT INTO prj_users (username, password)";
    $query .= " VALUES('$username','$encryptedPass')";
    //return number of rows
    return $numRows = mysqlNonQuery($query);
}

//will be called to delete a user from the table
function DeleteUser($userID)
{

    //build the query using the userID to delete
    $query = "DELETE FROM prj_users WHERE userID = $userID";
    $numRows = mysqlNonQuery($query);
    
    return $numRows;
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
    usleep(500000);
}

//if the action was calling GetUsers, then get the users in the DB
if(isset($_GET['action']) && $_GET["action"] == "GetUsers")
{
    
    GetUsers();
}

//if the statements are met, then get the username and password from the textboxes(POST) and call the TestInsert function
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST['action']) && $_POST["action"] == "AddUser")
{
    //call the test insert function
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $rows = TestInsert($username,$password);
    $status = "User added successfully.";
    
}

//(POST[userID] is the delete button value), if statement is met, then call the DeleteUser function
if(isset($_POST['action']) && $_POST['action'] == "DeleteUser" && $_SESSION['userID'] != $_POST['userID'])
{
    //call the delete user function
    $userID = strip_tags($_POST['userID']);
    $rows = DeleteUser($userID);
    $status = "$rows row(s) deleted.";

}
//test to make you not delete yourself
else if(isset($_POST['action']) && $_POST['action'] == "DeleteUser" && $_SESSION['userID'] == $_POST['userID'])
{
    $status= "Error: Cannot delete yourself.";
    
}



//call done
Done();

?>