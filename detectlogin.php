<html>
    <head>
        <style>
            #userdetails {
            font-family: "Raleway", sans-serif;
            padding: 2px;
            padding-right: 50px;
            float: right;
            display: flex;
            align-items: center;
            }

            #img {
            width: 20px;
            height:20px;
            
            }
        </style>
    </head>
    <body>
        <?php 
            session_start();

            //if the session user id $_SESSION['userid'] is set (i.e. if the user has logged in successfully)
            if(isset($_SESSION['userid']) and isset($_SESSION['usertype']))
            {
                $user = $_SESSION['userid'];
                $userType = $_SESSION['usertype'];

                //display first name and surname on the right hand-side, right under the navigation bar
                echo "<span id='userdetails'> 
                    <img id='img' src=images/user.png>
                    <p id='userdetails'>$user | User type: $userType</p>
                </span>";
            }
        ?> 
    </body>
</html>


