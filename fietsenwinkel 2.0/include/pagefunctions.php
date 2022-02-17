<?php
function getTitle(){
    return "Fietsenwinkel";
}

function getHeader(){
    return "Fietsenwinkel  2.0";
}


  
  

function getFooter(){
    return "Copyright 2021 - Haben Sebhatu";
}

function getAside(){
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

        $menu .= "<a href='index.php?page=Dadminfietsen'>Admin fietsen</a>";
    }

    if (checkRole(9)) { // Alleen administrators mogen in het admin menu

        $menu .= "<a href='index.php?page=adminusers'>Admin gebruikers</a>";
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
?>
