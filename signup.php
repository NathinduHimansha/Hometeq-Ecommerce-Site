<?php
$pagename="Sign Up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

echo "<form class='signupform'  action='login_process.php'>
    <table>
        <tr >
            <td><label  for='fname'>First name:</label> </td>
            <td> <input  type='text' id='fname' value=''><br> </td>
        </tr>

        <tr >
            <td><label for='lname'>Lat name:</label> </td>
            <td> <input type='text' id='lname' value=''><br> </td>
        </tr>

        <tr >
            <td><label for='address'>Address:</label></td>
            <td> <input type='text' id='address' value=''><br> </td>
        </tr>

        <tr >
            <td> <label for='tel'>Tel No:</label> </td>
            <td> <input type='text' id='tel' value=''><br> </td>
        </tr>

        <tr >
            <td><label for='email'>Email address:</label> </td>
            <td> <input type='text' id='email' value=''><br></td>
        </tr>

        <tr >
            <td><label for='password'>Password:</label></td>
            <td> <input type='text' id='password' value=''><br></td>
        </tr>

        <tr >
            <td><label for='conpassword'>Confirm Password:</label> </td>
            <td> <input type='text' id='conpassword' value=''><br> </td>
        </tr>

        <tr >
            <td><input class='btn' type='submit' value='SignUp'></td>
            <td> <input class='btn' type='reset' value='Clear'><br> </td>
        </tr>
    </table>
</form>";







include("footfile.html"); //include head layout
echo "</body>";
?>