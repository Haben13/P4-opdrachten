<?php
function  checkRole($role){
   if($_SESSION['role'] >= $role){
 return true;
}
else{
 return false;
}
}

if(!isset($_SESSION['login'])){ // Nog geen gebruiker ingelogd.
 // set default SESSION variabelen
 $_SESSION[ 'login']=false; // default op false
 $_SESSION[ 'username']=""; //default empty
 $_SESSION[ 'role']=0; //default 0 = guest
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

function editusers($id)
{
  if (!checkRole(9)) { // Test of gebruiker juiste rechten heeft
    header('Refresh:2; url=index.php');
    return "U heeft hier geen rechten voor!";
  }
  if (!isset($_POST['wijzigen'])) { // Haal alle info op zodat ze in het formulier ingevuld kunnen worden.
    $gebruik = getgebruiker($id);
    $username = $gebruik['username'];
    $password = $gebruik['password'];
    $role = $gebruik['role'];


    include("include/html/fiets/editgb.html"); // Login form
  } elseif (isset($_POST['annuleren'])) {
    header('Refresh:2; url=index.php?page=adminusers');
  } else { //wijzigingen uit formulier doorvoeren
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $conn = dBConnect();

    $stmt = $conn->prepare("UPDATE gebruikers
                            SET role= '$role', username= '$username', password = '$password'
                            WHERE Id=$id");
    $stmt->execute();
    $conn = NULL;
    echo "Wijziging doorgevoerd";
    header('Refresh:2; url=index.php?page%=adminusers');
  }
}




function getgebruiker($id)
{
  $conn = dBConnect();
  $query = "SELECT * FROM gebruikers WHERE Id=$id";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $gebruik = $stmt->fetchAll();
  foreach ($gebruik as $gebruikers) { // het is een array met 1 element
    return $gebruikers;
  }
}


?>

