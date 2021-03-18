<?php
$pagename="Log In"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.php"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//display random text

echo "<div class='formStyle'>
    <form action='login_process.php' method='post'>     
        <label for='email'>Email address:</label> </td>
        <input class='element' type='text' name='email' value=''><br>
     
        <label for='password'>Password:</label>
        <input class='element' type='text' name='password' value=''><br>

        
        <input class='btn' type='reset' value='Clear Form'>
        <input class='btn' type='submit' value='Log In'>

        
        
    </form>
</div>";


include("footfile.html"); //include head layout
echo "</body>";
?>