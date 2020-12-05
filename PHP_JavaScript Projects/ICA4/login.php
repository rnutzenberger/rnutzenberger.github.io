<?php
    require_once 'functions.php';
    require_once 'dbUtility.php';
    //if the POST is set and the value is logout 
    if(isset($_POST["submit"]) && $_POST["submit"] == "Logout")
    {
        //end the session and set the location to login page
        session_unset();
        session_destroy();
        header("Location:login.php");
        die();
    }

    //if the POST is set and the value is login and both username and password have values
    if(isset($_POST["submit"]) && $_POST["submit"] == "Login" 
        && isset($_POST["username"]) && strlen($_POST["username"])>0
        && isset($_POST["password"]) && strlen($_POST["password"])>0)
    {
        //echo $_POST["username"];
        //strip any tags that come to ensure you are getting the bare value
        $user = strip_tags($_POST["username"]);
        $pass = strip_tags($_POST["password"]);
        $validate = array();
       // echo $user;
       //set up the array to validate
        $validate["username"] = $user;
        $validate["password"] = $pass;
        $validate["response"] = "";
        $validate["status"] = false;

        //pass the array into the Validate() function
        $validate = Validate($validate);
        $pageStatus = $validate["response"];
        //if the status is true
        if($validate['status'])
        {  
            //set the session user name to the user name and change page to the index
            session_start();
            $_SESSION["username"] = $validate["username"];
            //echo $_SESSION['username'];
            header(("Location: index.php"));
            die();
        }

        
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ICA04 - mySQL Insert & Delete</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='ica2.css'>
    <script src='main.js'></script>
</head>
    <div id="hdr">ICA04 - Login</div>
    <a href="https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/icas.html"> Back to ICAs Page</a><br>
<body>
    
    <div class="section">
        <form action="#" method="POST" name="myForm">
            <label for="username">UserName: </label>
            <input type="text" name="username" id="username" placeholder="Supply a username">
            <label for="username" style="text-align:left; padding-left:10px;"></label>

            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="Supply your password">
            <label for="username" style="text-align:left; padding-left:10px;"></label>
            <input type="submit" name="submit" id="btnSubmit" value="Login">
        </form>

        

    </div>
    <div id="status">Page Status: <?php echo $pageStatus ?></div>

    

    <div class="footer">&copy;2019 by Ryan Nutzenberger
        <br>Last Modified: <span id="lastMod"></span>
        <script>
            document.getElementById("lastMod").innerHTML = document.lastModified;
        </script>
    </div>
    

</body>
</html>