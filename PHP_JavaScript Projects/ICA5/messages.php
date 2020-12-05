<?php
    require_once "dbUtility.php";
    //require_once "svc/api.php";
    global $status;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ICA05 - REST Intro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='ica2.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='messages.js'></script>
    
</head>
    <div id="hdr"><?php echo "ICA05 - Messages : {$_SESSION["username"]}"; ?></div>
    <a href="https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/icas.html"> Back to ICAs Page</a><br>
<body>
    
    <div class="section">
        
        <label for="username">Filter By User: </label>
        <input type="text" name="filter" id="filter" placeholder="Supply a filter" style="height:25px"><div></div>
        <input type="button" type="button" name="search" id="btnSearch" value="Search" class="buttons"><div></div><div></div>

        <label for="message">Message: </label>
        <input type="text" name="message" id="message" placeholder="Enter a message to share"style="height:25px"><div></div>
        
        <input type="submit" name="send" id="btnSend" value="Send" class="buttons">
        
        
        

        

    </div>
    <div class="section">
        <table id="tblUsers">
            <thead>
                <th>Op</th>
                <th>msgID</th>
                <th>User</th>
                <th>Message</th>
                <th>Timestamp</th>
            </thead>
            <tbody></tbody>
        </table>
        <div></div>
        <div></div>
        <div></div>
        <div><input type="button" id="btnBack" value="Go Back" class="buttons"></div>
    </div>
    
    <div id="status">Page Status: <?php $status?></div>

    

    <div class="footer">&copy;2019 by Ryan Nutzenberger
        <br>Last Modified: <span id="lastMod"></span>
        <script>
            document.getElementById("lastMod").innerHTML = document.lastModified;
        </script>
    </div>
    

</body>
</html>