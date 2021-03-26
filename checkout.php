<?php
    session_start();
    include("db.php");
    $pagename="Checkout"; //Create and populate a variable called $pagename
    echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
    echo "<title>".$pagename."</title>"; //display name of the page as window title

    echo "<body>";
        include ("headfile.php"); //include header layout file
        include ("detectlogin.php");
        echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

        //store the current date and time in a local variable $currentdatetime
        //use the date PHP function with the 'Y-m-d H:i:s' parameters to make it compatible with the MySQL format.
        $currentDateTime=date('Y-m-d H:i:s');
        $userId = $_SESSION['userId'];


        //write a SQL query to insert a new record in the Orders table to generate a new order.
        //insert the id of the user who is placing the order $_SESSION ['userId']
        //insert the current date and time for the date and time when the order has been placed
        //insert the word ‘Placed’ for the order status to indicate that the order has now been placed.
        $SQL="INSERT INTO Orders (userId, orderDateTime,orderStatus) 
                    VALUES ('$userId', '$currentDateTime', 'Placed')";
                    
        //Run the SQL query.
        $exeSQL=mysqli_query($conn, $SQL);
        $exeError=mysqli_errno($conn);


        //if no database error is returned and the database error code is 0 i.e. if the new order was inserted correctly
        if($exeError=="0")
        {
            //SQL SELECT query to retrieve max order number for current user (for which id matches the id in the session)
            //to retrieve the order number of most recent order placed by current user
            $SQL="select MAX(orderNo) AS latestOrderNumber from Orders where userId='$userId'";

            //execute SQL query
            $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

            //fetch the result of the execution of the SQL statement and store it in an array arrayord
            $arrayord=mysqli_fetch_array($exeSQL);

            //store the value of this order number in a local variable
            $orderNumber=$arrayord['latestOrderNumber'];

            //display message to confirm that order has been placed successfully and display the order number.
            echo"<br>";
            echo "The order has been placed successfully. the order number is: <b> $orderNumber </b><br>";

            echo "<table id='checkouttable' style='width:50%'>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th> 
                    <th>Selected Quantity</th>
                    <th>Subtotal</th>
                </tr>";


                //as for basket.php, display a table header for product name, price, quantity and subtotal
                //as for basket.php, FOREACH loop through basket session array & split value from index for every cell
                foreach($_SESSION['basket'] as $index => $value)
                {
                    //SQL query to retrieve product id, name and price from product table for every index in FOREACH loop
                    //execute SQL query, fetch the records and store them in an array of records $arrayb.
                    //Calculate subtotal
                    //Note: these 3 instructions are the same as in basket.php
                    if(trim($_SESSION['basket'][$index]!=""))
                    {
                        //create a $SQL variable and populate it with a SQL statement that retrieves product details
                        $SQL="select prodName,prodPrice from Product where prodId='$index'";
                        
                        //run SQL query for connected DB or exit and display error message
                        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
                    
                        $arrayp=mysqli_fetch_array($exeSQL);  

                        $subtotal = $arrayp['prodPrice']*$value;
                        $total += $subtotal;

                        //display the product name, price, ordered quantity and subtotal (same as for basket.php)
                        echo "<tr> 
                            <td> $arrayp[prodName] </td> 
                            <td> $arrayp[prodPrice] </td> 
                            <td> $value </td>
                            <td> $subtotal </td>   
                        </tr>";


                        //SQL INSERT query to store details of ordered items in Order_line table in the DB i.e. order number,
                        //product id (index), ordered quantity (content of the session array) and subtotal. Execute query.

                        $SQL="INSERT INTO Order_Line (orderNo, prodId,quantityOrdered,subTotal) 
                            VALUES ('$orderNumber','$index','$value', '$subtotal')";
                        
                        //Run the SQL query.
                        $exeSQL=mysqli_query($conn, $SQL);
                        $exeError=mysqli_errno($conn);
                    }
                }
                    
                //increment total (same as for basket.php)
                //create a new table row to display the total (same as for basket.php)
                echo "<tr>
                    <td colspan=3> TOTAL </td>
                    <td>$total</td>
                </tr>
            </table>";

            //SQL UPDATE query to update the total value in the order table for this specific order
            $SQL="UPDATE Orders SET orderTotal=$total  where userId='$userId'";

            //execute SQL query
            $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
            $exeError=mysqli_errno($conn);

            //execute SQL query and display logout link.
        
            echo "<br>Done for today ?.<a href='logout.php'>Log Out</a>"; 
        }

        else //i.e. if a database error is returned, display an order error message
        {
            //Display an error message that indicates that there has been an error with placing the order
            echo "<br><br>Something went wrong while placing order<br>";  
            echo "Done for today ?.<a href='logout.php'>Log Out</a>"; 
        }

        //Unset the basket session array
        unset($_SESSION['basket']);

        include("footfile.html"); //include head layout
    echo "</body>";
?>