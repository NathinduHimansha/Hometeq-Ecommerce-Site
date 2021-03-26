<?php
include("db.php");
session_start();

$pagename="Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.php"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

if(isset($_POST["del_prodid"])){
    $delprodid= $_POST["del_prodid"];
    unset($_SESSION['basket'][$delprodid]);


    echo "1 item removed from the basket";

}




$newprodid =  $_POST["h_prodid"];
// echo $newprodid;
$reququantity = $_POST["p_quantity"];
// echo $reququantity;


//create a new cell in the basket session array. Index this cell with the new product id.
//Inside the cell store the required product quantity
$_SESSION['basket'][$newprodid]=$reququantity;
// echo $_SESSION['basket'][1];

echo "<table id='checkouttable' style='width:50%'>
    <tr>
        <th>Product Name</th>
        <th>Price</th> 
        <th>Selected Quantity</th>
        <th>Subtotal</th>
         <th>Remove Product</th>
    </tr>";


    if(isset($_SESSION['basket']))
    {
        $total=0.00;

        foreach($_SESSION['basket'] as $index => $value)
        {

            if(trim($_SESSION['basket'][$index]!=""))
            {
                //create a $SQL variable and populate it with a SQL statement that retrieves product details
                $SQL="select prodName,prodPrice from Product where prodId='$index'";
            
                //run SQL query for connected DB or exit and display error message
                $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
        

                $arrayp=mysqli_fetch_array($exeSQL);  

                $subtotal = $arrayp['prodPrice']*$value;
                $total += $subtotal;

                echo "<tr> 
                        <td> $arrayp[prodName] </td> 
                        <td> $arrayp[prodPrice] </td> 
                        <td> $value </td>
                        <td> $subtotal </td>";
                    echo "<td>";
                    
                        echo "<form action='basket.php' method=post>";

                            echo "<button type='submit'>Remove </button>" ;
                        
                            //pass the product id to this page basket.php as a hidden value
                            echo "<input type=hidden name=del_prodid value=$index>";
                        echo "</form>";

                    echo "</td>
                </tr>";

            }
        }

        echo "<tr>
            <td colspan=4> TOTAL </td>
            <td>$total</td>
        </tr>";
    }
    else{
        echo "Basket is Empty";
    }
echo "</table>";



echo "<br> <a href='clearbasket.php'> CLEAR BASKET </a> <br><br>";


//if the session user id $_SESSION['userid'] is set (i.e. if the user has logged in successfully)
if(isset($_SESSION['userId']) and isset($_SESSION['usertype']) and $total!=0 )
{
    //display a Checkout anchor to link to checkout.php
    echo "to finalise your order: <a href='checkout.php'>Checkout</a>";
}

elseif (!(isset($_SESSION['userId']) and isset($_SESSION['usertype']) ))
{
    //display a Signup anchor for new customers to link to signup.php
    //display a Login anchor for returning customers to link to login.php
    echo "New hometeq Customers: <a href='signup.php'>Sign Up</a><br><br>
    Returning hometeq Customers: <a href=' login.php '> Log In</a>";
}
else{
    echo "Continue shopping for <a href='index.php'>Home Tech </a><br>";
}


include("footfile.html"); //include head layout
echo "</body>";
?>