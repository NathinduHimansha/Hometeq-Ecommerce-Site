<?php
session_start();
include("db.php");
$pagename="Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.php"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page


//Capture the 7 inputs entered in the 7 fields of the form using the $_POST superglobal variable
//Store these details into a set of 7 new local variables
$fname =  $_POST["fname"];
$lname =  $_POST["lname"];
$address =  $_POST["address"];
$postalcode =  $_POST["postalcode"];
$tel =  $_POST["tel"];
$email =  $_POST["email"];
$password =  $_POST["password"];
$conpassword =  $_POST["conpassword"];



//if the mandatory fields in the form (all fields) are not empty (hint: use the empty function)
if(!(empty($fname) or empty($lname) or empty($address) or empty($postalcode) or empty($tel) or empty($email) or empty($password) or empty($conpassword)))
{
    //if the 2 entered passwords do not match
    if($password != $conpassword)
    {
        //Display error passwords not matching message
        //Display a link back to register page
        echo "<b>Your sign-up failed!</b><br><br>";
        echo "Entered password is not matched <br> "; 
        echo "Go back to <a href='signup.php'>sign up</a>";
    }
    else
    {
        //define regular expression
        //if email matches the regular expression (hint: use preg_match)
        if (filter_var($email, FILTER_VALIDATE_EMAIL))     
        {
            //Write SQL query to insert a new user into users table and execute SQL query
            //Execute INSERT INTO SQL query
            //Return the SQL execution error number using the error detector (hint: use mysqli_errno($conn))

            $SQL="INSERT INTO Users (userFName, userSName,userAddress,userPostCode,userTelNo,userEmail,userPassword) 
            VALUES ('$fname',' $lname', '$address','$postalcode', '$tel', '$email','$password')";
            $exeSQL=mysqli_query($conn, $SQL);
            $exeError=mysqli_errno($conn);
           
            //Execute the INSERT INTO SQL query
            //if the error detector returns the number 0, everything is fine
            if($exeError=="0")
            {
                echo "<b>Sign-up Complete!</b><br><br>";
                echo "Go to Log in Page:  <a href='login.php'>Log In</a>";
            }
            //else, which means if the error detector does not return the number 0, there is a problem
            else
            {
                //Display generic error message
                //if error detector returned number 1062 i.e. unique constraint on the email is breached
                //(meaning that the user entered an email which already existed)
                if($exeError=="1062")
                {
                //Display email already taken error message & display a link back to signup page
                echo "<b>Your sign-up failed!</b><br><br>";
                echo "Entered email is already used <br> "; 
                echo "Go back to <a href='signup.php'>sign up</a>";
                }
                //if error detector returned number 1064 i.e. invalid characters such as ' and \ have been entered
                else if($exeError=="1064")
                {
                    //Display invalid characters error message & display a link back to signup page
                    echo "<b>Your sign-up failed!</b><br><br>";
                    echo "Display invalid characters <br> "; 
                    echo "Go back to <a href='signup.php'>sign up</a>";
                }
            }
        }
        else
        {
            echo "<b>Your sign-up failed!</b><br><br>";
            echo "Entered email is invalid <br> "; 
            echo "Go back to <a href='signup.php'>sign up</a>";
        }
    }
}
else
{
    echo "<b>Your sign-up failed!</b><br><br>";
    echo "all mandatory fields need to be filled in <br> "; 
    echo "Go back to <a href='signup.php'>sign up</a>";
}


include("footfile.html"); //include head layout
echo "</body>";
?>