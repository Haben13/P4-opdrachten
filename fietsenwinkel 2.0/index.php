<?php

session_start();



require_once ("include/dbfunctions.php");

$value = dBConnect();

require_once("include/formfunctions.php");

require_once("include/pagefunctions.php");

require_once("include/userfunctions.php");

require_once("include/fietsfunctions.php");


require ("include/layout.php");

?>