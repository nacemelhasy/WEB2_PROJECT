<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./assets/styles/styles.css" />
    <link rel="stylesheet" href="./assets/styles/bootstrap.css" />
    <style>
         @font-face {
            font-family: cairo;
            src: url(./assets/fonts/DS-DIGIT.ttf);


        }
        
        .error {
            color: red;
          font-size: 10px;
        }
        small{
            font-size: 10px;
            color: red;
        }
        body {
            direction: rtl;
            font-family:cairo ;
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
        .c1{
            box-shadow: 8px 8px 0px rgba(0, 0, 0, 0.25);
            background: #495579;
            width: 300px;
            height:300px;
            opacity: 1;
            border-radius: 20%;
            position: fixed;
            left: -120px;
            bottom: -50px;
            transform: rotate(35deg); 
        }
        .c2{
            box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.25);
            background: #495579;
            width: 300px;
            height:300px;
            opacity: 1;
            border-radius: 20%;
            position: fixed;
            right: -120px;
            top: -50px;
            transform: rotate(35deg); 
        }
    </style>
    <!-- <style>
        .error{
            color: red;
            width: 30vw;
            height: 0.5vw;
            display: inline-block;
            text-align: right;
            font-family: cairo;
            font-size: 15px;
        }
        .sucess{
            color: white;
            width: 30vw;
            height: 2.5vw;
            background-color: green;
            border-radius: 25px;
            display: inline-block;
            text-align: center;
            font-family: cairo;
            font-size: 20px;
        }
    </style> -->
</head>
<?php
$emailErr = $passErr = $ConfiErr = $matchErr = $fnameErr = $unameErr = "";
$email = $password = $confirm = $fname = $uname = "";
$sucess = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = htmlentities($_POST['mail']);
    $password =  htmlentities($_POST['psw']);
    $confirm =  htmlentities($_POST['vpsw']);
    $uname =  htmlentities($_POST['uname']);
    $fname =  htmlentities($_POST['fname']);
    $oky = true;

    if (empty($email)) {
        $emailErr = "<p style='color:red' id='emailHelp' class=' error'>الرجاء إدخال بريد الكتروني صحيح!</p> ";
        $oky = false;
    }

    if (empty($password)) {
        $passErr ="<p style='color:red' id='emailHelp' class=' error'>الرجاء ادخال كلمة مرور صحيحة</p>";
        $oky = false;
    }
    if (empty($confirm)) {
        $ConfiErr = "<p style='color:red' id='emailHelp' class=' error'>الرجاء تأكيد كلمة المرور </p>";
        $oky = false;
    }
    if ($password != $confirm) {
        $matchErr = "<p style='color:red' id='emailHelp' class=' error'>كلمة المرور غير متطابقة</p>";
        $oky = false;
    }

    if (empty($uname)) {
        $unameErr = "<p style='color:red' id='emailHelp' class=' error'>الرجاء إدخال أٍسم صحيح!</p>";
        $oky = false;
    }


    if (empty($fname)) {
        $fnameErr = "<p style='color:red' id='emailHelp' class=' error'>الرجاء إدخال ألاسم الكامل!</p>";
        $oky = false;
    }



    if ($oky) {
        $sucess = '<pre><span class="sucess">تم التسجيل بنجاح   '.'<a href="login.php">   تسجيل دخول</a></span></pre>';
      
        $dbc = mysqli_connect("localhost", "root", "root", "PAA_system", 8889);
        $query = "INSERT INTO users (Fname,userName,email,password) VALUES ('$fname', '$uname','$email','$password')";
        if (( mysqli_query($dbc, $query))) {
           
        } 
        mysqli_close($dbc);
    }
}


?>

<body>

    <div class="c1 d-lg-block d-none"></div>
    <div class="c2 d-lg-block d-none"></div>

    <div class="container text-center py-5 " >
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-lg-6 col-md-8 col-10">
                <img src="assets/images/logo.png" class="mb-5" width="150">
                <p class="h3 mb-5">إنشاء حساب</p>
                <form class="text-right"  action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="fullName">الاسم الكامل</label>
                        <input type="text" class="form-control" id="fullName" required placeholder="الاسم الكامل" name="fname" >
                        <?php echo $fnameErr;?>

                        </div>
                        <div class="form-group col-md-6">
                        <label for="userName">اسم المستخدم</label>
                        <input type="text" class="form-control" id="userName" required placeholder="اسم المستخدم" name="uname">
                        <?php echo $unameErr;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emai">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="email" required placeholder="البريد الالكتروني"  name="mail">
                        <?php echo $emailErr;?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="password">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" required placeholder="كلمة المرور" name="psw">
                        <?php echo $passErr;?>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="confirmPassword">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" id="confirmPassword" required placeholder="تأكيد كلمة المرور" name="vpsw">
                        <?php echo $ConfiErr;?>
                        </div>
                    </div>
                    <button type="submit" class="mt-2 button-style">تسجيل</button>
                    <p style="  font-family: cairo;" class="text-center mt-4"> تمتلك حساب ؟ <a href="login.php">أضغط هنا</a></p>
                </form>
            </div>
            
        </div>
    </div>

    <footer class="text-center py-3 text-white">
        ©2022-2022 مركز الاتقان الرقمي. جميع الحقوق محفوظة.
    </footer>












    <Header class="d-none">
        <title>Register an Account</title>
        <a href="./index.html">
            <div id="logo" align="center"></div>
        </a>
    </Header>
    <div class="regCentered d-none">
        <div class="title">إنشاء حساب</div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" novalidate>
            
        <div class="regFields">
            <?php echo $sucess?>
                <input class="user" type="text" placeholder="الاسم الكامل" name="fname" required><br>
                <span class="error"><?php echo $fnameErr;?></span></p>
                <input class="user" type="text" placeholder="اسم المستخدم" name="uname" required><br>
                <span class="error"><?php echo $unameErr;?></span></p>
                <input class="mail" type="email" placeholder="البريد الالكتروني" name="mail" required><br>
                <span class="error"><?php echo $emailErr;?></span></p>
                <input class="pwd" type="password" placeholder="كلمة المرور" name="psw" required><br>
                <span class="error"><?php echo $passErr;?></span></p>
                <input class="pwd" type="password" placeholder="تأكيد كلمة المرور" name="vpsw" required><br>
                <span class="error"><?php echo $ConfiErr.$matchErr;?></span></p>
                <button type="submit">تسجيل</button><br>
                <br>
                <br>
                <p style=" margin :3% 0 0 20% ;font-family: cairo;"> تمتلك حساب ؟ <a href="login.php">أضغط هنا</a></p>
                <br>
<br>
<br>
<br>
<br>
            </div>

        </form>

    </div>
    
</body>
<html>