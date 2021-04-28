<?php
    // Just importing alla the external files 
    include_once "read_write.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write in a file </title>
</head>
<body>
    <h1>Let's fill a DB with the email file!</h1>

    <div class="form-block" style="background-color : gray;"> 
        <form method="post" action="#">
            <label for="myfile">Select the file:</label>
            <input type ="file" name="upload"><br><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>


    <?php



        storeFileinDBTable();
        

        
    ?>
</body>
</html>