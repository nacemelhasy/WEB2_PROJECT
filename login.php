<?php

session_start();
session_destroy();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="./assets/styles/bootstrap.css" />


    <style>
        @font-face {
            font-family: cairo;
            src: url(./assets/fonts/DS-DIGIT.ttf);


        }

        small{
            font-size: 10px;
           
        }

        body {
            direction: rtl;
            font-family: cairo;
        }

        footer {
            background: #495579;
        }

        .button-style {
            border: 1px solid #495579;
            background-color: #495579;
            color: white;
            padding: 0.5rem 2rem;
            border-radius: 20rem;
            transition: all 0.5s;
        }

        .button-style:hover {
            background-color: white;
            color: #495579;
        }

        .c1 {
            box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.25);
            background: #495579;
            width: 300px;
            height: 300px;
            opacity: 1;
            border-radius: 20%;
            position: fixed;
            left: -120px;
            bottom: -50px;
            transform: rotate(35deg);
        }

        .c2 {
            box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.25);
            background: #495579;
            width: 300px;
            height: 300px;
            opacity: 1;
            border-radius: 20%;
            position: fixed;
            right: -120px;
            top: -50px;
            transform: rotate(35deg);
        }

        .error {
            color: red;
          font-size: 10px;
        }

        .errolog {
            color: white;
            width: 30vw;
            height: 2.5vw;
            background-color: red;
            border-radius: 25px;
            display: inline-block;
            text-align: center;
            font-family: cairo;
            font-size: 20px;
        }
    </style>
</head>
<?php
session_start();

if (isset($_SESSION["loginUser"])) {
    header('location:home.php');
} else {

}
$emailErr = $passErr = '';
$email = $pass = '';
$tryLog = '';
$oky = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlentities($_POST['mail']);
    $password = htmlentities($_POST['psw']);
    if (empty($email)) {
        $emailErr = "<p style='color:red' id='emailHelp' class=' error'>الرجاء إدخال البريد الكتروني !</p>";
        $oky = false;
    }

    if (empty($password)) {
        $passErr = "<p id='emailHelp' class=' error' >الرجاء ادخال كلمة المرور</p>";
        $oky = false;
    }
    if ($oky) {



        $dbc = mysqli_connect("localhost", "root", "root", "PAA_system", 8889);
        $query = "select * from users where email = '$email' and password = '$password'";
        if (($r = mysqli_query($dbc, $query))) {
            $user = mysqli_fetch_array($r);
            if ($user == []) {

                $tryLog = '<span class="errolog">أسم المستخدم او كلمة المرور غير صحيحة</span>';
            } else {



                $_SESSION["loginUser"] = $user['ID'];
                // print $_SESSION['loginUser'];
                header('location:home.php');
            }
        }
        mysqli_close($dbc);
    }
}



?>

<body>

    <div class="c1 d-lg-block d-none"></div>
    <div class="c2 d-lg-block d-none"></div>

    <div class="container text-center py-5 ">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-lg-6 col-md-8 col-10">
                <img src="assets/images/logo.png" class="mb-5" width="150">
                <p class="h3 mb-5">إنشاء حساب</p>
                <form class="text-right" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

                    <div class="form-group">
                        <label for="fullName">اسم المستخدم او البريد الالكتروني</label>
                        <input type="email" class="form-control" id="fullName" type="email" placeholder="البريد الالكتروني" name="mail" >
                        <?php echo $emailErr; ?>

                    </div>
                    <div class="form-group">
                        <label for="fullName">كلمة المرور</label>
                        <input type="password" class="form-control" id="fullName" placeholder="كلمة المرور" name="psw" >
                        <?php echo $passErr; ?>

                    </div>

                    <button type="submit" class="mt-2 button-style">تسجيل</button>
                    <p style="  font-family: cairo;" class="text-center mt-4"> لا تمتلك حساب ؟ <a href="register.php">أضغط
                            هنا</a></p>
                </form>
            </div>

        </div>
    </div>

    <footer class="text-center py-3 text-white">
        ©2022-2022 مركز الاتقان الرقمي. جميع الحقوق محفوظة.
    </footer>
</body>
<!-- 
<body>

    <Header>
        <title>Login</title>
        <a href="./index.html">
            <div id="logo" align="center"></div>
        </a>
    </Header>
    <div class="centered">
        <div class="title">تسجيل الدخول</div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" novalidate>
            <div class="container">
                <input class="mail" type="email" placeholder="البريد الالكتروني" name="mail" required><br>
                <span class="error"><?php echo $emailErr; ?></span></p>
                <input class="pwd" type="password" placeholder="كلمة المرور" name="psw" required><br>
                <span class="error"><?php echo $passErr; ?></span></p>
                <?php echo $tryLog ?><br>
                <button type="submit">دخول</button>
               
                    <p style=" margin :3% 0 0 18% ; font-family: cairo;">لا تمتلك حساب ؟ <a href="register.php">أضغط
                            هنا</a></p>

                </a>
            </div>

        </form>

    </div>
    <div class="c1"></div>
    <div class="c2"></div>
    <footer>
        <p>
            ©2022-2022 مركز الاتقان الرقمي. جميع الحقوق محفوظة.
        </p>
    </footer>

</body> -->
<html>