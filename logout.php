<?php
session_start();

$pagename="LOGOUT"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.php"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//display random text

//Display thank you message
$user = $_SESSION['userid'];


echo "Thankyou .$user. <br>";
//unset the session
unset($_SESSION['userid']);
unset($_SESSION['usertype']);

//destroy the session
session_destroy();
//Display a log out confirmation message
echo "You are now logged out.";



include("footfile.html"); //include head layout
echo "</body>";
?>