<?php
    $mysql_connection = null;
    $mysql_connection = array();
    $mysql_status = "";
    session_start();
    mysqlConnect();

    //Connect mysql database
    function mysqlConnect()
    {
        global $mysql_connection, $mysql_response;

        //make a new mysql connection
        $mysql_connection = new mysqli("localhost","rnutz995_admin","er4685an1105!","rnutz995_ICAs");
        //if theres a connection error
        if($mysql_connection->connect_error)
        {
            //then display a connection error
            $mysql_response[] = 'Connect Error('.
                        $mysql_connection->connect_errno . 
                        ')' . $mysql_connection->connect_error;
            echo json_encode($mysql_response);
            die();
        }
    }

    //checks and confirms your query before it will use it
    function mysqlQuery($query)
    {
        global $mysql_connection, $mysql_response, $mysql_status;
        
        $results = false;
        //check if there is a connection
        if($mysql_connection == null)
        {
            echo "No Connection!";
            $mysql_status = " No active database connection.";
            return $results;
        }

        //check if the query has an error in it
        if(!($results = $mysql_connection->query($query)))
        {
            $mysql_response[] = "Query Error {$mysql_connection->errno} : " . "{$mysql_connection->error}";

            echo json_encode($mysql_response);
            die();
        }
        //passes both checks, return
        return $results;

    }
?>