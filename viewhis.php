<?php

session_start();

$counter = 0;
$dbc = mysqli_connect("localhost", "root", "root", "PAA_system", 8889);
$subCode = $_SESSION["subID"];
$query = "SELECT * FROM students where sub_code = '$subCode' ";
$subjeCard = array();
if ($r = mysqli_query($dbc, $query)) { // Run the query.
// Retrieve and print every record:

    while ($row = mysqli_fetch_array($r)) {

        $name = $row['Sname'];
        $Sid = $row['Sid'];
        $subjeCard[$counter] = "<form action='viewsthis.php' method='POST'>
        <input type='hidden' name='id' value='$Sid'>
        <input type='hidden' name='name' value='$name '>
        <button type='submit' class='feed' > 
      
      
            <p class='desc'> اسم الطالب $name    
            </p>
         
            <p class='dessub'> رقمه الدراسي($Sid)    
            </p>
            <img class='icon'
            src='https://e7.pngegg.com/pngimages/347/575/png-clipart-computer-icons-arrow-forward-button-blue-text.png'></img>
            </button>
       
            </form> 
      
      ";
        $counter++;
    }
} else { // Query didn't run.
    print '<p style="color: red;">Could not retrieve the data
because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run
was: ' . $query . '</p>';
} // End of query IF.


?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./assets/styles/bootstrap.css" />

    <style>
  
input:checked {
  background-color: green;
}
        input[type="radio"] {
            height: 25px;
            width: 25px;
        }
        input[type="radio"]:checked {
            background-color: green;
        }

        .btn-outline-danger:focus {
            background-color: red;
            color: white;
        }

        .btn-success {
            background-color: white;
            color: green;


        }

        .btn-success:focus {
            background-color: green;
            color: white;

        }

        .buttons {
            position: absolute;
            left: 5%;
            top: 25%;

        }

        body {

            background-color: #FFFBEB;

        }




        a p#about {
            text-decoration: none;
            color: rgb(49, 49, 95);
        }

        a {
            text-decoration: none;
            color: rgb(57, 57, 82);
        }

        .avatar {
            position: relative;
            top: 5%;
            left: 92.5%;
            width: 70px;
            height: 70px;
            transition: box-shadow .3s;
            border-radius: 50%;
            background-image: url(./assets/images/logo.png);
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: center;
        }

        .avatar:hover {
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }

        .logout {
            position: absolute;
            left: 2%;
            bottom: 0%;
            top: 3%;

            width: 70px;
            height: 70px;
            transition: box-shadow .3s;
            border-radius: 50%;
            background-image: url(https://www.nicepng.com/png/full/266-2660273_expand-slideshow-white-back-icon-png.png);
            /* background-color: rgb(125, 125, 177); */
            background-size: 50%;
            background-repeat: no-repeat;
            background-position: center;
        }


        @font-face {
            font-family: cairo;
            src: url(./assets/fonts/DS-DIGIT.ttf);


        }

        .title {
            position: absolute;

            /* bottom: 5%; */
            top: 0;
            left: 25%;
            color: white;
            width: 50%;
            height: 70px;
            font-family: 'cairo';
            font-size: 200%;
            font-weight: 600;
            text-align: center;
        }

        .feed {
            position: relative;
            /* margin: 10px 5px; */
            margin-top: 20px;
            margin-left: 10px;
            padding-bottom: 60px;
            background-color: whitesmoke;
            color: white;
            height: 11vh;
            width: 99%;
            color:#495579;
            border-radius: 25px;
border: 10px solid #495579;
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }

        aside {
            position: absolute;
            left: 72%;
            top: 13%;

            margin: 20px 20px;
            padding: 1%;
            width: 20%;
            height: fit-content;
            border-radius: 20px;

        }

        nav {
            padding: 3%;
            width: fit-content;
            background-color: #495579;
            height: fit-content;
            border-radius: 20px;
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }
.card{
    background-color: #495579;
            height: fit-content;
            border-radius: 20px;
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
}


        p.navTitle {
            color: white;
            font-family: 'cairo';
            TEXT-ALIGN: CENTER;

            font-size: 180%;
            font-weight: 600;
        }

        p.navContent {
            position: relative;
            left: 10%;
            margin: 10% 0%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 150%;
            font-weight: 500;
        }

        .userAvatar {
            position: absolute;
            right: 2%;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            /* background-image: url(); */
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: center;
        }


        p.desc {
            width: 30%;
            position: absolute;
            margin-top: 10px;

            right: 2%;
            /* background-color: red; */

            font-family: 'cairo';
            font-size: 180%;
            font-weight: normal;
            text-align: right;
        }

        p.dessub {
            width: 24%;
            position: absolute;
            margin-top: 10px;

            left: 35%;
            /* background-color: red; */

            font-family: 'cairo';
            font-size: 180%;
            font-weight: normal;
            text-align:  center;
        }

        .icon {
            position: absolute;
            left: 2%;
            width: 80px;
            height: 60px;
            border-radius: 50%;
            /* background-image: url(); */
            background-size: 60%;
            background-repeat: no-repeat;
            background-position: center;
            transform: rotate(180deg);
        }



        .header {
            width: 100%;
            padding: 1% 0%;
            background-color: #495579;
            margin: none;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 150%;
            /* border-radius: 50px; */
            box-shadow: 0 0 13px rgba(33, 33, 33, .2);
        }


        /* This for form */


        input[type=text],
        input[type=email],
        input[type=password] {
            width: 19vw;
            height: 2.5vw;
            padding: 12px 20px;
            margin: 2px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 20px;
            box-sizing: border-box;
            text-align: right;
            font-family: cairo;
            font-size: 15px;
        }

        .butnSubj {
            margin: 0 0 0 38%;
            padding: 2% 5% 2% 5%;
            width: fit-content;
            height: fit-content;
            color: #495579;
            font-size: 100%;
            font-weight: 600;
            font-family: cairo;
            background: white;
            border: none;
            outline: none;
            cursor: pointer;
            border-radius: 25px;
            /* box-shadow: 2px 2px 5px #495579; */
        }
.btn-primary{
    font-family: cairo;
    color: #495579;
    background: white;
    width: fit-content;
            height: fit-content;
            margin: 0 0 0 38%;
            padding: 2% 5% 2% 5%;
}
        .buttnCard {



            width: 70%;



            cursor: pointer;
            border-radius: 25px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="avatar"></div>
        <a href="home.php">
            <div class="logout"></div>
        </a>
        <p class="title">
            سجلات الحضور والغياب لكل طالب
        </p>
    </div>


        <?php

        foreach ($subjeCard as $scard) {

            echo $scard;


        }
        ?>
      
  <br>
  <br>



  
</body>
<html>