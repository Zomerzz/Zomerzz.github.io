<?php 
    include "includes\ConnectSQLite.php"; 
    /*
    try {
    // Connect to SQLite database
    $db = new PDO('sqlite:C:\xampp\htdocs\test\db\DATABASE\SUHSI.db');

    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully"; 
    echo "<br>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage(); 
        echo "<br>";
    }
    */
    $db_name =  "aresu5a"; /// fornisco il db dove trovare i dati sugli utenti
    $tab_nome ="Users"; /// fornisco la tabella utenti
    $User = $_GET["User"];
    $password = $_GET["password"];
    /// anti injection
    $User = stripslashes($User);
    $password = stripcslashes($password);
    $password5 = md5($password);
    /// query
    $query = "SELECT * FROM " . $tab_nome .  " WHERE username= '" . $User . "' AND password= '" . $password."'";
    $result = $db->query($query);
    // Fetch the results
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($rows !== null) {
        $numRows = count($rows);
    
        if ($numRows == 1) {
            // Redirect to Sushi.php
            header("Location: Sushi.php");
            exit();
        } else {
            // Display a message or perform other actions if needed
            echo 'Login Failed, torna al login <b><a href="login.html">  log in</a></b>';
        }
    }

