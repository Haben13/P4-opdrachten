<?php
function getTitle()
{
    return "Fietsenwinkel";
}

function getHeader()
{
    return "Fietsenwinkel  2.0";
}



function getFooter()
{
    return "Copyright 2021 - Haben Sebhatu";
}

function getAside()
{
    return "aside tekst";
}




function getNav()

{

    $menu = "<a href='index.php'>Home</a>"; // Voor alle gebruikers zichtbaar

    if (checkRole(1)) { // alle ingelogde gebruikers mogen fietsen zien

        $menu .= "<a href='index.php?page=fietsen'>Fietsen</a>";
    }

    if (checkRole(2)) { // ALleen ingelogde klanten mogen bestellen

        $menu .= "<a href='index.php?page=bestellen'>Bestellen</a>";
    }

    if (checkRole(8)) { // ALleen beheerders mogen in het beheerders menu

        $menu .= "<a href='index.php?page=adminfietsen'>Adminfietsen</a>";
    }

    if (checkRole(9)) { // Alleen administrators mogen in het admin menu

        $menu .= "<a href='index.php?page=adminusers'>Admingebruikers</a>";
    }

    if (!$_SESSION['login']) {

        $menu .= "<a href='index.php?page=inloggen'>Inloggen</a>";
    } else {

        $menu .= "<a href='index.php?page=uitloggen'>Uitloggen</a>";
    }

    return $menu;
}



function getPage()
{
    if (isset($_GET['page'])) {

        $page = $_GET['page'];
    } else {

        $page = "home";
    }

    return $page;
}

function showFietsen(){
  $fietsen = getFietsen();
  $overzichtFietsen = "";
  foreach ($fietsen as $fiets){
    $overzichtFietsen .= $fiets['Merk']. "-". $fiets['Type'] ."<br>";
  }
  return $overzichtFietsen;
}

function adminFietsen(){
  if(!checkRole(8)){
    header('Refresh:2; url-index.php');
    return "U heeft hier geen rechten voor!";
  }
  if(checkRole(8)){ // ALLeen beheerders mogen in het beheerders menu
    $fietsen = getFietsen();
    $overzichtFietsen = "";
    foreach($fietsen as $fiets){
      $id = $fiets['Id'];
      $merk = $fiets['Merk'];
      $type = $fiets['Type'];
      $overzichtFietsen .= $merk. "- " . $type. "-";
      $overzichtFietsen .= "<a href='index.php?page=showFiets&Id=$id'>Show</a>". " ";
      $overzichtFietsen .= "<a href='index.php?page=editFiets&Id=$id''>Edit</a>" . " ";
      $overzichtFietsen .= "<a href='index.php?page=delFiets&Id=$id'>Del</a>";
      $overzichtFietsen .= "<br>";
    }
    $overzichtFietsen .= "<a href='index.php?page=addFiets'>Fietstoevoegen</a>". "<br>";
    return $overzichtFietsen;
    }
}

 function adminuser(){
    if (!checkRole(9)) {
        header('Refresh:2; url-index.php');
        return "U heeft hier geen rechten voor!";
    }
    if (checkRole(9)) { // ALLeen beheerders mogen in het beheerders menu
        $gebruik = getuser();
        $overzichtgebruikers = "";
        foreach ($gebruik as $gebruiks) {
            $id = $gebruiks['id'];
            $username = $gebruiks['username'];
            $password = $gebruiks['password'];
            // $role = $gebruiks['role'];

            $overzichtgebruikers .=  $username . "-";
            $overzichtgebruikers .= "<a href='index.php?page=showusers&Id=$id'>Show</a>" . " ";
            $overzichtgebruikers .= "<a href='index.php?page=editusers&Id=$id''>Edit</a>" . " ";
            $overzichtgebruikers .= "<a href='index.php?page=delusers&Id=$id'>Del</a>";
            $overzichtgebruikers .= "<br>";
        }
      
        return $overzichtgebruikers;
    }
}

 


function editFiets($id){
  if(!checkRole(8)){ // Test of gebruiker juiste rechten heeft
   header ('Refresh:2; url=index.php');
    return "U heeft hier geen rechten voor!";
  }
 if(!isset ($_POST['wijzigen'])){ // Haal alle info op zodat ze in het formulier ingevuld kunnen worden.
    $fiets = getFiets($id);
    
    $id = $fiets['Id'];
    $merk = $fiets['Merk'];
    $type = $fiets['Type'];
    $prijs = $fiets['Prijs'];
    $info = $fiets['info'];
  
    include("include/html/fiets/edit.html"); // Login form
  }elseif (isset($_POST['annuleren'])){
   header ('Refresh:2; url=index.php?page=adminfietsen');
  }else{ //wijzigingen uit formulier doorvoeren
    $merk = $_POST['merk'];
    $type = $_POST['type'];
    $prijs = $_POST['prijs'];
    $info = $_POST['info'];
    $role = $_POST['role'];
     $conn=dBConnect ();
    $stmt = $conn->prepare("UPDATE fietsen
                            SET Merk='$merk', Type='$type', Prijs='$prijs', info='$info'
                            WHERE Id=$id");
                         
        $stmt->execute();
        $conn = NULL;
        echo "Wijziging doorgevoerd";
        header('Refresh:2; url=index.php?page%=adminfietsen');
    }
}
function editusers($id)
{
    if (!checkRole(9)) { // Test of gebruiker juiste rechten heeft
        header('Refresh:2; url=index.php');
        return "U heeft hier geen rechten voor!";
    }
    if (!isset($_POST['wijzigen'])) { // Haal alle info op zodat ze in het formulier ingevuld kunnen worden.
        $gebruik = getgebruiker($id);
        $username= $gebruik['username'];
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


function delFiets($Id){

    if (!checkRole(8)){
        header('Refresh:2; url-index.php');
        return "U heeft hier geen rechten voor!";
    }
    {
        $conn = dBConnect();
        $sql = "DELETE FROM fietsen WHERE Id= $Id";
        $conn->exec($sql);
        echo "Account verwijderd";
        header('Refresh:2; url-index.php?page-adminfietsen');
    }
      
}

function delusers($Id)
{

    if (!checkRole(8)) {
        header('Refresh:2; url-index.php');
        return "U heeft hier geen rechten voor!";
    } {
        $conn = dBConnect();
        $sql = "DELETE FROM gebruikers WHERE Id= $Id";
        $conn->exec($sql);
        echo "Fiets verwijderd";
        header('Refresh:2; url-index.php?page-adminfietsen');
    }
}

function showFiets($id){
  $fiets = getFiets ($id);
  $overzichtfiets = "Id: ". $fiets['Id']. "<br>";
  $overzichtfiets .= "Merk: ".$fiets['Merk']. "<br>";
  $overzichtfiets .= "Type: ". $fiets['Type']. "<br>";
  $overzichtfiets .= "Prijs: ". $fiets['Prijs']. " Euro<br>";
  $overzichtfiets .= "info: ". $fiets['info']. "<br><br>";
  $overzichtfiets .="<a href=index.php?page=adminfietsen>terug naar adminmenu</a>";
  return $overzichtfiets;
}

function showusers($id)
{
    $gebruik = getgebruiker($id);
    $overzichtgebruikers = "Id: " . $gebruik['id'] . "<br>";
    $overzichtgebruikers .= "username: " . $gebruik['username'] . "<br>";
    $overzichtgebruikers .= "password: " . $gebruik['password'] . "<br>";
    $overzichtgebruikers .= "role: " . $gebruik['role'] . "<br>";

    $overzichtgebruikers .= "<a href=index.php?page=adminusers>terug naar adminmenu</a>";
    return $overzichtgebruikers;
}

function getFiets($id)
{
    $conn = dBConnect();
    $query = "SELECT * FROM fietsen WHERE Id=$id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fietsen = $stmt->fetchAll();
    foreach ($fietsen as $fiets) { // het is een array met 1 element
        return $fiets;
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

function checkUserPassword($username, $password){ // test of user / password combinatie bestaat.
  if(($username <> "") && ($password <> "")){
    $conn=dBConnect();
    $sql = "SELECT * FROM gebruikers WHERE username='$username'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode (PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll();
    foreach($users as $user){ // wordt overgeslagen bij leeg array.
      $passwordHash=$user['password'];
      if(password_verify($password, $passwordHash)){
        $_SESSION['login'] = true;
        $_SESSION['username']=$user['username'];
        $_SESSION['role']=$user['role'];
        return true; // user en password ok.
       }
        else {
        return false; // fout password
        }
    }
    $conn=NULL;
  }

  else{
      return false;
  }
}

function login(){
   if(isset($_POST['inloggen'])){
  $username = check_input ($_POST['username']);
  $password = check_input ($_POST['password']);
  if(checkUserPassword($username, $password)){
   echo "U bent ingelogd.";
   header ('Refresh:2; url=index.php');
   } 
   else{
   echo "Er is iets fout gegaan tijdens het inloggen.";
   header ('Refresh:2; url=index.php?page=inloggen');
}
}

else{
  include("include/html/user/login.html"); // Login form
}
}

function checkUser($username){ // Test of user bestaat
  if($username <> ""){
    $conn=dBConnect();
    $sql = "SELECT * FROM gebruikers WHERE username='$username'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode (PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll();
    foreach($users as $user){ // wordt overgeslagen bij Leeg array.
      if($username == $user['username']){
        return true; // user bestaat
       } 
       else {
        return false; // user bestaat niet
  }
}
  }
  else {
    return false; // onvoldoende invoer
}
 }



function register(){
     // Op basis van form in include/htmL/user/register.html
if(isset($_POST['register'])){ // gebruiker heeft op registreren geklikt
  $username = check_input ($_POST['username']);
  if(checkUser ($username)){ // Test of user al bestaat.
    echo "Gebruiker bestaat al.";
    header ('Refresh:5; url-index.php?page%=registreren');
   }
   else{ // registreren gebruiker
    $conn=dBConnect();
    $stmt = $conn->prepare("INSERT INTO gebruikers (username, password, role)  VALUES (:username, :password, :role)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $passwordHash);
    $stmt->bindParam(':role', $role);
    $username = check_input ($_POST['username']);
    $password = check_input ($_POST[ 'password']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $role = 8; // nieuwe gebruiker is altijd: role=1
    $stmt->execute();
    echo "Gebruiker aangemaakt";
    header ('Refresh:2; url-index.php?page-inloggen');
    $conn=NULL;
}
}
else {
    include("include/html/user/register.html");
}
}

function addFiets()
{
    if (!checkRole(8)){
        header('Refresh:2; url-index.php');
        return "U heeft hier geen rechten voor!";
    }
        if (isset($_POST['toevoegen'])) { // gebruiker heeft op toevoegen gekl
            $merk = check_input($_POST['merk']);
            $type = check_input($_POST['type']);
            $prijs = check_input($_POST['prijs']);
            $info = check_input($_POST['info']);
            $conn = dBConnect();
            $stmt = $conn->prepare("INSERT INTO fietsen (Merk, Type, Prijs, info)
    VALUES (:Merk, :Type, :Prijs, :info)");
            $stmt->bindParam(':Merk', $merk);
            $stmt->bindParam(':Type', $type);
            $stmt->bindParam(':Prijs', $prijs);
            $stmt->bindParam(':info', $info);

            $stmt->execute();

            echo "Fiets toegevoegd";
            header('Refresh:2; url=index.php?page=adminfietsen');
            $conn = NULL;
        } else {
            if (isset($_POST['annuleren'])) {
                echo "Geannuleerd";
                header('Refresh:2; url=index.php?page=adminfietsen');
            } else {
                include("include/html/fiets/add.html"); // toevoegen for
            }
        }
    }
function loguit(){

    header('Refresh:2; url=index.php?page=inloggen');

}

function getSection()
{
    $page = getPage();
    $section = "";
    switch ($page) {
        case "home":
            $section = "Dit is de inhoud van home page.
    <br><br><br>Wlelkom
    <br><br><br>Welkom
    <br><br><br>Wlelkom";
            break;

        case "fietsen":
            $section = showFietsen();
            break;
        case "adminfietsen":
            $section = adminFietsen();
            break;
        case "adminusers":
            $section = adminuser();
            break;
        case "showFiets":
            $id = $_GET['Id'];
            $section = showfiets($id);
            break;
        case "editFiets":
            $id = $_GET['Id'];
            $section = editFiets($id);
            break;

        case "delFiets":
            $id = $_GET['Id'];
            $section = delFiets($id);
            break;
        case "addFiets":
            $section = addFiets();
            break;
        case "showusers":
            $id = $_GET['Id'];
            $section = showusers($id);
            break;
        case "editusers":
            $id = $_GET['Id'];
            $section = editusers($id);
            break;
        case "delusers":
            $id = $_GET['Id'];
            $section = delusers($id);
            break;
        case "inloggen":
            $section = login();
            break;
        case "uitloggen":
            $section = loguit();
            break;
        case "registreren":
            $section = register();
            break;

        case "bestellen":
            include("include/html/bestellen.html");
            break;
        case "test":
            include("include/html/test.html");
            break;
        default:
            $section = "Deze pagina bestaat (nog) niet.";
    }
    return  $section;
}
