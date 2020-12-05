<?php
    require_once "dbUtility.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ICA06 - REST Insert & Delete</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='ica2.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='settings.js'></script>
    
</head>
    <div id="hdr"><?php echo "ICA06 - Settings : {$_SESSION["username"]}"; ?></div>
    <a href="https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/icas.html"> Back to ICAs Page</a><br>
<body>
    
    <div class="section">
        
        <label for="username">UserName: </label>
        <input type="text" name="username" id="username" placeholder="Supply a username">
        <label for="username" style="text-align:left; padding-left:10px;"></label>

        <label for="password">Password: </label>
        <input type="text" name="password" id="password" placeholder="Supply your password">
        <label for="username" style="text-align:left; padding-left:10px;"></label>
        <input type="submit" name="submit" id="btnAddUser" value="Add User">
        

        

    </div>
    <div class="section">
        <table id="tblUsers">
            <thead>
                <th>Op</th>
                <th>userID</th>
                <th>UserName</th>
                <th>Encrypted Password</th>
            </thead>
            <tbody></tbody>
        </table>
        <div></div>
        <div></div>
        <div></div>
        <div><input type="button" id="btnBack" value="Go Back" style="width: 300%;"></div>
    </div>
    
    <div id="status">Page Status: <?php ?></div>

    

    <div class="footer">&copy;2019 by Ryan Nutzenberger
        <br>Last Modified: <span id="lastMod"></span>
        <script>
            document.getElementById("lastMod").innerHTML = document.lastModified;
        </script>
    </div>
    

</body>
</html>