<?php

function getFietsen(){
  $conn=dBConnect();
  $query = "SELECT * FROM fietsen";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->setFetchMode (PDO::FETCH_ASSOC);
  $fietsen = $stmt->fetchAll();

  return $fietsen;
  echo
  $fietsen;
}

?>