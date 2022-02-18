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

function showFietsen(){
  $fietsen = getFietsen();
  $overzichtFietsen = "";
  foreach ($fietsen as $fiets){
    $overzichtFietsen .= $fiets['Merk']. "-". $fiets['Type'] ."<br>";
  }
  return $overzichtFietsen;
}

function adminFietsen()
{
    return "adminfietsen";
}

function showfiets()
{
    return "adminfietsen";
}

function editFiets($id)
{
    return "adminfietsen";
}

function delFiets($id)
{
    return "adminfietsen";
}

function addFiets()
{
    return "adminfietsen";
}

function login()
{
    return "adminfietsen";
}
function register()
{
    return "adminfietsen";
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
        case "showFiets":
            $id = $_GET['id'];
            $section = showfiets($id);
            break;
        case "editFiets":
            $id = $_GET['id'];
            $section = editFiets($id);
            break;
        case "delFiets":
            $id = $_GET['id'];
            $section = delFiets($id);
            break;
        case "addFiets":
            $section = addFiets();
            break;
        case "inloggen":
            $section = login();
            break;
        case "registreren":
            $section = register();
            break;

        case "bestellen":
            include("include/html/bestellen.htm1");
            break;
        case "test":
            include("include/html/test.html");
            break;
        default:
            $section = "Deze pagina bestaat (nog) niet.";
    }
    return  $section;
}
