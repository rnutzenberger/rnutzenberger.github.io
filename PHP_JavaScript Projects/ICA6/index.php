<?php
        require_once 'functions.php';


        //if the logout is clicked
        if(isset($_POST["submit"]) && $_POST["submit"] == "Logout")
        {

            //end the session and set the location to login page
            session_unset();
            session_destroy();
            header("Location:login.php");
            die();
        }

       // if ( !isset($_SESSION['username'] ) )
   // {
      //  header("Location:login.php");
      //  die();
   // }
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ICA06 - REST Insert & Delete</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='ica2.css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src='main.js'></script>
</head>
    <div id="hdr"> <?php echo "ICA06 - Index - Welcome, {$_SESSION['username']}"; ?> </div>
    <a href="https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/icas.html"> Back to ICAs Page</a><br>
<body>
    
    <div class="indexSection">
        <div>
            <a href="settings.php">Settings</a>
        </div>
        <div>
            <a href="messages.php">Messages</a>
        </div>
        <div>
            <a href="settings.php">Tag Admin</a>
        </div>
        <div>
            <a href="settings.php">RealTime Monitor</a>
        </div>
        <form action="login.php" method="post">
            <input type="submit" name="submit" value="Logout"style="grid-column:1/3;">
        </form>
    </div>
    <div id="status">Page Status: </div>
    

    <div class="footer">&copy;2019 by Ryan Nutzenberger
        <br>Last Modified: <span id="lastMod"></span>
        <script>
            document.getElementById("lastMod").innerHTML = document.lastModified;
        </script>
    </div>
    

</body>
</html>