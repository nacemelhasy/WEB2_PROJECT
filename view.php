<?php

session_start();

$dbc = mysqli_connect("localhost", "root", "root", "PAA_system", 8889);
$subCode = $_SESSION["subID"];
$query = "SELECT * FROM students where sub_code = '$subCode' ";
$subjeCard = array();
$counter = 0;
if ($r = mysqli_query($dbc, $query)) { // Run the query.
// Retrieve and print every record:

    while ($row = mysqli_fetch_array($r)) {

        $name = $row['Sname'];
        $Sid = $row['Sid'];
        $subjeCard[$counter] = "
        <div class='feed'>
        <div class = 'buttons' name='div$counter''>
        <input type='radio' class='btn ' name=\"$counter\" value='0&$Sid' checked> حاضر </button>
        <input type='radio' class='btn ' name=\"$counter\" value='1&$Sid' > غائب </button>
        </div>
            <p class='desc'> $name  ($Sid) 
            </p>
         
        </div>
      ";
        $counter++;
    }
} else { // Query didn't run.
    print '<p style="color: red;">Could not retrieve the data
because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run
was: ' . $query . '</p>';
} // End of query IF.

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
    for ($i = 0; $i < $counter; $i++) {
        $param = $_GET["$i"];

 
        $args = explode("&", $param);

        $state = (int) $args['0'];
        $Sid = (int) $args['1'];
        $subCode = $_SESSION['subID'];
        // $date = date("Y-m-d");
        $date = "2023-02-20";
     
        if($Sid !=0 && $subCode!=0){
    
         
          $query = "INSERT INTO precensestate (Sid, state, subCode,todayDate) VALUES ('$Sid', '$state', '$subCode','$date')";
        
        }
    

        if ($r = mysqli_query($dbc, $query) && $i == $counter) {
            $self = $_SERVER['PHP_SELF'];
            header("location:  $self");
        } else {

        }



    }

    mysqli_close($dbc);

}

$sname = $scode = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  header('location:view.php');
    $Stname = htmlentities($_POST['stName']);
    $Stid = htmlentities($_POST['stCode']);

    if (empty($Stname) && empty($Stid)) {
        $_SESSION["subID"] = $_POST['subID'];
        $_SESSION["subName"] = $_POST['subName'];
    }
    if (!empty($Stname) || empty($Stid)) {
        $subCode = $_SESSION['subID'];
        $query = "INSERT INTO students (Sid,Sname,sub_code) VALUES ('$Stid', '$Stname',  '$subCode')";

        if ((mysqli_query($dbc, $query))) {
            $self = $_SERVER['PHP_SELF'];
            header("location: home.php");
        }

        mysqli_close($dbc);

    }
}



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
            width: 70%;
            color: #495579;
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

        .card {
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
            width: 60%;
            position: absolute;
            margin-top: 10px;

            right: 5%;
            /* background-color: red; */

            font-family: 'cairo';
            font-size: 180%;
            font-weight: normal;
            text-align: right;
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

        .btn-primary {
            font-family: cairo;
            color: #495579;
            background: white;
            width: fit-content;
            height: fit-content;
            margin: 0 0 0 38%;
            padding: 2% 5% 2% 5%;
        }
        .btn-primaryS {
            position: relative;
            font-family: cairo;
            color: #495579;
            background: white;
            width: 30%;
            height: 70px;
            margin: 0 0 0 38%;
      right: 280px;

     
        }
        
        .buttnCard {
            
            
            
            width: 70%;
            
            
            
            cursor: pointer;
            border-radius: 25px;
        }
        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");

/* ---------------Animation---------------- */

.slit-in-vertical {
	-webkit-animation: slit-in-vertical 0.45s ease-out both;
	        animation: slit-in-vertical 0.45s ease-out both;
}

@-webkit-keyframes slit-in-vertical {
  0% {
    -webkit-transform: translateZ(-800px) rotateY(90deg);
            transform: translateZ(-800px) rotateY(90deg);
    opacity: 0;
  }
  54% {
    -webkit-transform: translateZ(-160px) rotateY(87deg);
            transform: translateZ(-160px) rotateY(87deg);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateZ(0) rotateY(0);
            transform: translateZ(0) rotateY(0);
  }
}
@keyframes slit-in-vertical {
  0% {
    -webkit-transform: translateZ(-800px) rotateY(90deg);
            transform: translateZ(-800px) rotateY(90deg);
    opacity: 0;
  }
  54% {
    -webkit-transform: translateZ(-160px) rotateY(87deg);
            transform: translateZ(-160px) rotateY(87deg);
    opacity: 1;
  }
  100% {
    -webkit-transform: translateZ(0) rotateY(0);
            transform: translateZ(0) rotateY(0);
  }
}

/*---------------#region Alert--------------- */

#dialogoverlay{
  display: none;
  opacity: .8;
  position: fixed;
  top: 0px;
  left: 0px;
  background: #707070;
  width: 100%;
  z-index: 10;
}

#dialogbox{
  display: none;
  position: absolute;
  background: rgb(0, 47, 43);
  border-radius:7px; 
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.575);
  transition: 0.3s;
  width: 40%;
  z-index: 10;
  top:0;
  left: 0;
  right: 0;
  margin: auto;
}

#dialogbox:hover {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.911);
}

.container {
  padding: 2px 16px;
}

.pure-material-button-contained {
  position: relative;
  display: inline-block;
  box-sizing: border-box;
  border: none;
  border-radius: 4px;
  padding: 0 16px;
  min-width: 64px;
  height: 36px;
  vertical-align: middle;
  text-align: center;
  text-overflow: ellipsis;
  text-transform: uppercase;
  color: rgb(var(--pure-material-onprimary-rgb, 255, 255, 255));
  background-color: rgb(var(--pure-material-primary-rgb, 0, 77, 70));
  /* background-color: rgb(1, 47, 61) */
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
  font-family: var(--pure-material-font, "Roboto", "Segoe UI", BlinkMacSystemFont, system-ui, -apple-system);
  font-size: 14px;
  font-weight: 500;
  line-height: 36px;
  overflow: hidden;
  outline: none;
  cursor: pointer;
  transition: box-shadow 0.2s;
}

.pure-material-button-contained::-moz-focus-inner {
  border: none;
}

/* ---------------Overlay--------------- */

.pure-material-button-contained::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgb(var(--pure-material-onprimary-rgb, 255, 255, 255));
  opacity: 0;
  transition: opacity 0.2s;
}

/* Ripple */
.pure-material-button-contained::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  border-radius: 50%;
  padding: 50%;
  width: 32px; /* Safari */
  height: 32px; /* Safari */
  background-color: white;
  opacity: 0;
  transform: translate(-50%, -50%) scale(1);
  transition: opacity 1s, transform 0.5s;
}

/* Hover, Focus */
.pure-material-button-contained:hover,
.pure-material-button-contained:focus {
  box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12);
}

.pure-material-button-contained:hover::before {
  opacity: 0.08;
}

.pure-material-button-contained:focus::before {
  opacity: 0.24;
}

.pure-material-button-contained:hover:focus::before {
  opacity: 0.3;
}

/* Active */
.pure-material-button-contained:active {
  box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2), 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
}

.pure-material-button-contained:active::after {
  opacity: 0.32;
  transform: translate(-50%, -50%) scale(0);
  transition: transform 0s;
}

/* Disabled */
.pure-material-button-contained:disabled {
  color: rgba(var(--pure-material-onsurface-rgb, 0, 0, 0), 0.38);
  background-color: rgba(var(--pure-material-onsurface-rgb, 0, 0, 0), 0.12);
  box-shadow: none;
  cursor: initial;
}

.pure-material-button-contained:disabled::before {
  opacity: 0;
}

.pure-material-button-contained:disabled::after {
  opacity: 0;
}

#dialogbox > div{ 
  background:#495579; 
  margin:8px; 
}

#dialogbox > div > #dialogboxhead{ 
  background: #495579; 
  font-size:19px; 
  padding:10px; 
  color:rgb(255, 255, 255); 
  font-family: Verdana, Geneva, Tahoma, sans-serif ;
}

#dialogbox > div > #dialogboxbody{ 
  background:#495579; 
  padding:20px; 
  color:#FFF; 
  text-align: right;
  font-family: cairo;
}

#dialogbox > div > #dialogboxfoot{ 
  background: #495579; 
  padding:10px; 
  text-align:right; 
}
/*#endregion Alert*/
        </style>

</head>

      
<body>

    <div class="header">
        <div class="avatar"></div>
        <a href="temp.php">
            <div class="logout"></div>
        </a>
        <p class="title">
            <?php echo $_SESSION["subName"] ?>
        </p>
    </div>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="GET">

  
        <?php

        foreach ($subjeCard as $scard) {

            echo $scard;


        }
        ?>

        <br>


     
      
        <button type='submit' name='submit'  class='btn  btn-primaryS  text-center' style=' color: white; background: #495579;' > حفظ</button>
  
      </form> 
  
    <aside>
        <nav>
            <p class="navTitle text-center">إضافة طالب</p>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="container">
                    <input class="mail" type="Text" placeholder="إسم الطالب" name="stName" required><br>
                    <br>
                    <input class="pwd" type="Text" placeholder="الرقم الدراسي" name="stCode" required><br>
                    <br>
                    <input type='hidden' name='subID' value='<?php echo $_POST['subID'];?>'>
                    <button type="submit" class=" btn btn-primary  ">إضافة</button>
                    <br>
                    <br>
                    </a>
                </div>

            </form>





        </nav>
        <div class="card " style="width: 21.5rem; margin-top: 2%;">
            <div class="card-body ">
                <p class="navTitle text-center">سجلات الحضور والغياب</p>
                <a href="viewhis.php" class="btn btn-primary"> عرض </a>
            </div>
        </div>
    </aside>


</body>
<html>