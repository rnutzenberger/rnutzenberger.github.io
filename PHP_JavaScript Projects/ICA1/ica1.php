<?php
    require_once 'utility.php';

    //reset the status and output
    $status = "";
    $output = "";

    //if the Name and Hobby textboxes are not null, continue with the following
    if(!is_null(filter_input(INPUT_GET, 'Name')) && strlen(filter_input(INPUT_GET,'Name')) > 0
     && !is_null(filter_input(INPUT_GET, 'Hobby')) && strlen(filter_input(INPUT_GET, 'Hobby')) > 0)
    {
        
        //assign the GET contents to variables
        $name = strip_tags($_GET['Name']);
        $hobby = strip_tags($_GET['Hobby']);
        $howMuch = strip_tags($_GET['HowMuch']);
        $output = "";

        //concatenate the output with the contents of name, howmuch, and finally hobby and update the status
        $output .= $name;
        for($i=0; $i < $howMuch; ++$i)
        {
            $output .= " really";
        }
        $output .= " likes " . $hobby;
        $status .= "+ProcessForm";

    }

    //if the submit in GET has a value and both name and hobby are null,
    //echo an error response
    if(isset($_GET["Submit"]) && is_null($name) && is_null($hobby))
    {
       
        echo "You must type values in for both Name and Hobby texboxes";
        die();
        
    }
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ICA 1 - PHP Intro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='ica1.css'>
    <script src='main.js'></script>
</head>
    <div id="hdr">ICA01 - PHP INTRO</div>
    <a href="https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/icas.html"> Back to ICAs Page</a><br>
<body>
    
    <div class="section">
        <div class="sectionHDR">Part I: Server Info</div>
        <div>Your IP Address is:</div>
        <div>
            <?php 
            //Echo the IP address
                echo $_SERVER['REMOTE_ADDR'];
                $status .= "+ServerInfo";  
            ?>
        </div>
        <div>$_GET Evaluation:</div>
        <!-- Echo both GET and POST counts in their array -->
        <div><?php echo "Found: " . count($_GET) . " entry in the \$_GET";?></div>
        <div>$_POST Evaluation:</div>
        <div><?php echo "Found: " . count($_POST) . " entry in the \$_POST";?></div>
    </div>

    <div class="section">
        <div class="sectionHDR">Part II: Form Processing</div>
        <div>$_GET Contents:</div>
        <div>
        <!-- Echo each GET array value by using a foreach -->
            <?php
                foreach($_GET as $value)
                {
                    echo "<li>$value</li>";
                }
                $status .= "+GETData";
            ?>
        </div>
        
    </div>

    <div class="section">
        <div class="sectionHDR">Part III: Array Generation</div>
        <div>Array Generated</div>
        <div>
         <!-- Echo the function generated array list -->
            <?php
                $newArr = GenerateNumbers();
                echo MakeList($newArr);
                $status .= "+ShowArray";
            ?>
        </div>
    </div>


    <div class="section">
        <div class="sectionHDR">Part IV: Form Processing</div>
        <form action="#" method="GET" name="myForm">
            <label for="Name">Name : </label>
            <input type="text" name="Name" id="Name">
            <label for="Hobby">Hobby : </label>
            <input type="text" name="Hobby" id="Hobby">
            <label for="rngHowMuch">How Much I Like It: </label>
            <input type="range" name="HowMuch" id="rngHowMuch" min="1" max="13" value="7">

            <input type="submit" name="Submit" id="btnSubmit" value="Go Now!" style="width:200%; margin-top:10px;">
        </form>
        
    </div>

    <div class="section">
        <div  style="text-align: center;grid-column: 1/3;">
            <!-- Echo the output from the form -->
            <?php
                if(isset($output))
                {
                    echo " " . $output;
                }
            ?>
        </div>
    </div>

    <div class="section">
        <div  style="text-align: center;grid-column: 1/3;">
            <!-- Echo the status update -->
            <?php
                echo "Status: " . $status;
            ?>
        </div>
    </div>

    <div class="footer">&copy;2019 by Ryan Nutzenberger
        <br>Last Modified: <span id="lastMod"></span>
        <script>
            document.getElementById("lastMod").innerHTML = document.lastModified;
        </script>
    </div>
    

</body>
</html>