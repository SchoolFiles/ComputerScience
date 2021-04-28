<?php
    try{
        $myfile = fopen("output.csv", "w") or die("Unable to open file! ");
        fwrite($myfile, "Topolino");
        fclose($myfile);
        echo $myfile;

    } catch(Exception $e){

    }

?>