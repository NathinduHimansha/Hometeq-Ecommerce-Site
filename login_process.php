<?php
session_start();
include("db.php");

$pagename="“Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.php"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//Capture the 2 inputs entered in the form (email and password) using the $_POST superglobal variable
//Assign these values to 2 new local variables $email and $password
//Display the content of these 2 variables to ensure that the values have been posted properly
$email =  $_POST["email"];
$password =  $_POST["password"];

//if either mandatory email or password fields in the form are empty (hint: use the empty function)
if((empty($email) or empty($password)))
{
    //Display error "Both email and password fields need to be filled in" message and link to login page
    echo "<b>Logn failed!</b><br><br>";
    echo "Login form incomplete<br>";
    echo "Make sure you provide all the required details<br><br>";
    echo "Go back to <a href='login.php'>login</a>";

}
else
{
    //SQL query to retrieve the record from the users table for which the email matches login email (in form)
    //execute the SQL query & fetch results of the execution of the SQL query and store them in $arrayu
    //also capture the number of records retrieved by the SQL query using function mysqli_num_rows and store it
    //in a variable called $nbrecs
    $SQL="select userId,userEmail,userType,userPassword,userFName,userSName from Users where userEmail='$email'";
    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
    $arrayu=mysqli_fetch_array($exeSQL);
    $nbrecs=mysqli_num_rows($exeSQL);

    //if the number of records is 0 (i.e. email retrieved from the DB does not match $email login email in form
    if($nbrecs=='0')
    {
        //display error message "Email not recognised, login again"
        echo "<b>Logn failed!</b><br><br>";
        echo "Email not recognised<br>";
        echo "Go back to <a href='login.php'>login</a>. ";
        echo "To register <a href='signup.php'>sign up</a>";
    }
    else
    {
        //if password retrieved from the database (in arrayu) does not match $password
        if($arrayu['userPassword']!=$password)
        {
            //display error message "Password not recognised, login again"
            echo "<b>Login failed!</b><br><br>";
            echo "Incorrect password<br>";
            echo "Go back to <a href='login.php'>login</a>";  
        }
        else
        {
            //display login success message and store user id, user type, name into 4 session variables i.e.
            //create $_SESSION['userid'], $_SESSION['usertype'], $_SESSION['fname'], $_SESSION['sname'],
            //Greet the user by displaying their name using $_SESSION['fname'] and $_SESSION['sname']
            //Welcome them as a customer by using $_SESSION['usertype ']

            

            echo "<strong>Login success!!</strong><br>";
            echo "Welcome, " .$arrayu['userFName']."<br>";
            echo "User type: " .$arrayu['userType']."<br><br>";

            echo "Continue shopping for <a href='index.php'>Home Tech </a><br>";
            echo "View your <a href='basket.php'>Smart Basket</a>";

            $_SESSION['userName']=$arrayu['userFName'].$arrayu['userSName']; 
            $_SESSION['userId']=$arrayu['userId'];
            $_SESSION['usertype']=$arrayu['userType'];            
        }
    }
}
include("footfile.html"); //include head layout
echo "</body>";
?>