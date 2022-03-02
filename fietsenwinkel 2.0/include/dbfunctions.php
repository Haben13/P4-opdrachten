<?php
// Selecteer server en database
if ( $_SERVER[ 'SERVER_NAME'] == "localhost" ) {
  // Zet databasegegevens op Lokaal
  DEFINE("USER", "root");
  DEFINE("PASSWORD", "");
  DEFINE("HOST", "localhost");
  DEFINE("DBNAME", "fietsenwinkel");
  
} 

else {
  // Zet databasegegevens op ao-alkmaar.nl
  DEFINE("USER", "s138872_fietsenwinkel");
  DEFINE("PASSWORD", "123");
  DEFINE("HOST", "localhost");
  DEFINE("DBNAME", "s138872_fietsenwinkel"
  );
  
}


 


  


function dBConnect()
{


    try {
        $connString = "mysql:host=". HOST . ";dbname=" . DBNAME;
        $conn = new PDO( "$connString", USER, PASSWORD );
        $conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        echo "Verbinding gelukt.<br>";

        return $conn;   


     } catch( PDOException $e ) {
        echo $e->getMessage ();
        echo "Kon geen verbinding maken.";
     }
}
    
    
?>
