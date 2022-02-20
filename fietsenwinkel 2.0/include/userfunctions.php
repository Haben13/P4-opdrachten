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
?>

