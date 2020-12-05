

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ICA 1 - PHP Intro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='ica2.css'>
    <script src='main.js'></script>
</head>
    <div id="hdr">ICA02 - PHP Authorization</div>
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

    

    <div class="footer">&copy;2019 by Ryan Nutzenberger
        <br>Last Modified: <span id="lastMod"></span>
        <script>
            document.getElementById("lastMod").innerHTML = document.lastModified;
        </script>
    </div>
    

</body>
</html>