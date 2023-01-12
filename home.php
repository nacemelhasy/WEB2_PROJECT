<?php

session_start();


$_SESSION["subId"] = '';
$_SESSION["subName"] = '';
$dbc = mysqli_connect("localhost", "root", "root", "PAA_system", 8889);
$query = 'SELECT * FROM subjects ';
$subjeCard = array();
if ($r = mysqli_query($dbc, $query)) { // Run the query.
// Retrieve and print every record:
    $counter = 0;
    while ($row = mysqli_fetch_array($r)) {

        $name = $row['Sname'];
        $code = $row['Scode'];
        $subjeCard[$counter] = "<form action='view.php' method='POST'>
        <input type='hidden' name='subID' value='$code'>
        <input type='hidden' name='subName' value='$name'>
        <button type='submit' class='feed' > 
        <div >
            <img class='userAvatar'
                src='./assets/images/next.png'></img>
       
            <p class='desc'> $name ($code)
            </p>
         
        </div>
        </button>
    </form> ";
    $counter++;
    }
} else { // Query didn't run.
    print '<p style="color: red;">Could not retrieve the data
because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run
was: ' . $query . '</p>';
} // End of query IF.

$sname = $scode = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sname = htmlentities($_POST['subjectName']);
    $scode = htmlentities($_POST['subjectCode']);
    $id = $_SESSION["loginUser"];


    $query = "INSERT INTO subjects (Scode,Sname,D_id) VALUES ('$scode', '$sname','$id')";

    if ((mysqli_query($dbc, $query))) {
        $self = $_SERVER['PHP_SELF'];
        header("location:  $self");
    }

    mysqli_close($dbc);

}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="utf-8" />


    <style>
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
            background-image: url(./assets/images/logout.png);
            /* background-color: rgb(125, 125, 177); */
            background-size: 70%;
            background-repeat: no-repeat;
            background-position: center;
        }

    
        @font-face {
            font-family: cairo;
            src: url(./assets/fonts/DS-DIGIT.ttf);


        }

        .title {
            position: absolute;
            right: 10%;
            bottom: 0%;
            top: 1.5%;
            color: white;
            width: 140px;
            height: 70px;
            font-family: 'cairo';
            font-size: 105%;
            font-weight: 600;
        }

        .feed {
            position: relative;
            /* margin: 10px 5px; */
            margin-top: 20px;
            margin-left: 10px;
            padding-bottom: 60px;
            background-color: #495579;
            color: white;
            height: 11vh;
            width: 70%;
            border-radius: 25px;
            cursor: pointer;
            border: 5px solid white;
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
            background-color: #495579;
            height: fit-content;
            border-radius: 20px;
            box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        }

        .aboutNav {
            position: relative;
            margin: 10% 0%;

            padding: 1%;
            background-color: rgb(105, 105, 136);



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
            width: 100%;
            position: absolute;
            margin-top: 6px;
            padding-left: 2%;
            /* background-color: red; */

            font-family: 'cairo';
            font-size: 180%;
            font-weight: normal;
            text-align: left;
        }



        .header {
            width: 100%;
            padding: 1% 0%;
            background-color: #495579;
            margin: none;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 150%;
            border-radius: 50px;
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
        .buttnCard{
           
         
           
           width: 70%;
            
  
          
            cursor: pointer;
            border-radius: 25px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="avatar"></div>
        <a href="login.php" >
            <div class="logout"></div>
        </a>
        <p class="title">كلية الهندسة</p>
    </div>
   

 <?php
 foreach ($subjeCard as $scard) {
 
     echo $scard;
   
   
    }
?>

  
    <aside>
        <nav>
            <p class="navTitle">إضافة مادة</p>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="container">
                    <input  class="mail" type="Text" placeholder="إسم المادة" name="subjectName" required><br>
                    <br>
                    <input class="pwd" type="Text" placeholder="كود المادة" name="subjectCode" required><br>
                    <br>

                    <button type="submit" class="butnSubj">إضافة</button>
                    <br>
                    <br>
                    </a>
                </div>

            </form>





        </nav>

    </aside>


</body>
<html>