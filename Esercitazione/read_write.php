<?php
    
    // Reading the file form which we get the urls. --------------------------------------------------------------------
    function fileReader() 
    {
        $data = [
            ["https://www.google.com/", "https"],
            ["https://www.itiscuneo.gov.it/", "https"],
            ["https://meet.google.com/","https"]
        ];
        
        return $data;
        //fclose($myfile);
    }

    // Linking the DB to the code ------------------------------------------------------------------------------------
    function connect(){
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbName = "UrlsDB";
        $charset = "utf8mb4";
        try{

            //$db = "sqlite:host=$server;dbname=$dbName;charset=$charset";
            $db = "mysql:host=$server;dbname=$dbName;charset=$charset";
            $pdo = new PDO($db,$username,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $pdo;

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

    }


    // Storing the file in the DB table called "UrlTable"----------------------------------------------------------------
    
    function storeFileinDBTable()
    {   
        /* This is how the Data vector should be looking like 
        $data =[
            [$url, $protocol],
            [$url, $protocol]
        ];

        */

        $data = fileReader();
        $pdo = connect();
        $stmt = $pdo->prepare("INSERT INTO `UrlTable`(`url`, `protocol`) VALUES (?,?)");
        //$stmt->execute(["https://www.google.com/", "https"]);
        try 
        {
            
            $pdo->beginTransaction();

            foreach ($data as $row)
            {
                //echo $row;
                $stmt->execute($row);
            }
            $pdo->commit();

            retriveLinks();

        }catch(PDOException $e){
            $pdo->rollback();
            echo "Error in storing data". $e->getMessage();
        }
        
        $pdo->close();
    }

    // Retriving the URLS one by one and scrape the link in each given URLS -----------------------------------------------
    
    function retriveLinks()
    {
        $pdo = connect();
        echo "Retrieving". "<br>";
        try
        {
            $urlArray = $pdo->query("SELECT `url` FROM `UrlTable`;");
            while ($row = $urlArray->fetch()) {
                echo $row['url'];
            }

        }catch(PDOException $e){
            echo "Query failed" .$e->getMessage();
        }


    }

    // Writing on a new file the Original URL and the links associated with it .---------------------------------------------

    function writeOnNewFile(){
        // Code
    }
    
?>