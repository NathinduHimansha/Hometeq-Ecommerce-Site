<?php
$pagename="Sign Up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.php"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page


echo "<div class='formStyle'>
    <form action='signup_process.php' method='post'>
        <label  for='fname'>First name:</label> 
        <input class='element'  type='text' name='fname' value=''><br>

        <td><label for='lname'>Lat name:</label> </td>
        <td> <input class='element' type='text' name='lname' value=''><br>
        
        <label for='address'>Address:</label>
        <input class='element' type='text' name='address' value=''><br>

        <label for='postalcode'>Postal Code:</label>
        <input class='element' type='text' name='postalcode' value=''><br>
         
        <label for='tel'>Tel No:</label> 
        <input class='element' type='text' name='tel' value=''><br>
       
        <label for='email'>Email address:</label> </td>
        <input class='element' type='text' name='email' value=''><br>
     
        <label for='password'>Password:</label>
        <input class='element' type='text' name='password' value=''><br>

        <label for='conpassword'>Confirm Password:</label> </td>
        <input class='element' type='text' name='conpassword' value=''><br>
       
        <input class='btn' type='submit' value='SignUp'>
        <input class='btn' type='reset' value='Clear'><br> 
    </form>
</div>";



include("footfile.html"); //include head layout
echo "</body>";
?>