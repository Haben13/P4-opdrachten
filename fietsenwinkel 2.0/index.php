<?php

session_start();



require_once ("include/dbfunctions.php");

require_once("include/formfunctions.php");

require_once("include/pagefunctions.php");

require_once("include/userfunctions.php");

require_once("include/fietsfunctions.php");



$content = "Dit is de content";

require ("include/layout.php");
