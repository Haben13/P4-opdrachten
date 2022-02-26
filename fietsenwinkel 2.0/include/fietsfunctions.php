<?php

function getFietsen(){
  $conn=dBConnect();
  $query = "SELECT * FROM fietsen";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->setFetchMode (PDO::FETCH_ASSOC);
  $fietsen = $stmt->fetchAll();

  return $fietsen;
  
}

function getuser()
{
  $conn = dBConnect();
  $query = "SELECT * FROM gebruikers";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $fietsen = $stmt->fetchAll();

  return $fietsen;
}

?>