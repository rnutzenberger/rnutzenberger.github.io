<?php
// Put your other needed requires here
require_once 'abstractRestAPI.php';  // include our base abstract class
require_once '../dbUtility.php';
//require_once '../webservice.php';

class ConcreteAPI extends AbstractAPI
{
    //test URLs:
        //for get message: https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/ICA5/svc/messages
        //with filter: https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/ICA5/svc/messages/five

        //for post message:

    // Since we don't allow CORS, we don't need to check Key Tokens
    // We will ensure that the user has logged in using our SESSION authentication
    // Constructor - use to verify our authentication, uses _response
    public function __construct($request, $origin)
    {
        parent::__construct($request);

        // Uncomment for authentication verification with your session
        //    if (!isset($_SESSION["userID"]))
        //      return $this->_response("Get Lost", 403);
    }

    /**
     * Example of an Endpoint/MethodName 
     * - ie tags, messages, whatever sub-service we want
     */
    protected function test()
    {
        // TEST BLOCK - comment out once validation to here is verified
        $resp["method"] = $this->method;
        $resp["request"] = $this->request;
        $resp["putfile"] = $this->file;
        $resp["verb"] = $this->verb;
        $resp["args"] = $this->args;
        //return $resp;
        // END TEST BLOCK
        if ($this->method == 'GET') {
            //return $this->verb;       // For testing if-else ladder
            return testGetHandler($this->verb, $this->args);  // Invoke your handler here
        } elseif ($this->method == 'POST') {
            return testPostHandler($this->args); // Invoke your handler here
        } elseif ($this->method == 'DELETE' && count($this->args) == 1) {
            return $this->args[1]; // ID of delete request
        } else {
            return $resp; // DEBUG usage, help determine why failure occurred
            return "Invalid requests";
        }
    }

    protected function messages()
    {
        // TEST BLOCK - comment out once validation to here is verified
        $resp["method"] = $this->method;
        $resp["request"] = $this->request;
        $resp["putfile"] = $this->file;
        $resp["verb"] = $this->verb;
        $resp["args"] = $this->args;
        //return $resp;

        // END TEST BLOCK
        if ($this->method == 'GET') {
            //return $this->verb;       // For testing if-else ladder
            return GetMessages($this->verb);  // Invoke your handler here
        } elseif ($this->method == 'POST') {
            return PostMessages($this->request); // Invoke your handler here
        } elseif ($this->method == 'DELETE' && count($this->args) == 1) {
            return DeleteMessage($this->args[0]); // ID of delete request
        } else {
            return $resp; // DEBUG usage, help determine why failure occurred
            return "Invalid requests";
        }
    }
}


// The actual functionality block here
try {
    // Construct instance of our derived handler here
    $API = new ConcreteAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    // invoke our dynamic method, should find the endpoint requested.
    echo $API->processAPI();
} catch (Exception $e) {   // OOPs - we have a problem
    echo json_encode(array('error' => $e->getMessage()));
}


function testGetHandler($verb, $args)
{

    return $verb . ", args: " . $args[0] . " " . $args[1];
}

function testPostHandler($args)
{
    return PHPInfo();
}

function GetMessages($verb)
{
    $response = array();
    $response['data'] = array();
    $response['status'] = "no records found";

    $query = "SELECT * FROM prj_messages pm JOIN prj_users pu on pm.userID = pu.userID where msg like '%".$verb."%' OR username like '%".$verb."%'";

    if ($results = mysqlQuery($query)) {
        //continually push the rows into an array
        while ($row = $results->fetch_assoc()) {
            $temp = array();

            $temp["msgID"] = $row["msgID"];
            $temp['username'] = $row["username"];
            $temp["msg"] = $row["msg"];
            $temp["stamp"] = $row["stamp"];

            array_push($response['data'], $temp);
        }

        //show how many rows were returned in the status
        $response['status'] = $results->num_rows . " rows returned";
    }

    return $response;
}

function PostMessages($postData)
{
    global $mysql_connection;

    $timestamp = date('Y-m-d H:i:s');
    $query = "INSERT INTO prj_messages(userID, msg, stamp)";
    $query.= " VALUES('".$_SESSION['userID']."', '".$postData['message']."', '".$timestamp."')";
    $numRows = mysqlNonQuery($query);

    $response = array();
    $response['status'] = "$numRows message added.";
    return $response;
}

function DeleteMessage($keyID)
{
    $query = "DELETE FROM prj_messages where msgID = $keyID";
    $numRows = mysqlNonQuery($query);
    $response = array();
    $response['status'] = "$numRows message deleted.";
    return $response;
}


