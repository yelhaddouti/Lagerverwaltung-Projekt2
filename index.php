<!--
/**
* @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
*/
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>L A G E R V E R W A L T U N G  - einloggen </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<style>


    body {
        background: url("production/images/warehouse.jpg") no-repeat;
        background-size : cover;
        height: 800px;
        opacity: 0.9;

    }

    .wrapper {
        margin-top: 80px;
        margin-bottom: 80px;
    }

    .form-signin {
        max-width: 380px;
        padding: 15px 35px 45px;
        margin: 0 auto;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,0.1);

    .form-signin-heading,
    .checkbox {
        margin-bottom: 30px;
    }

    .checkbox {
        font-weight: normal;
    }

    .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
    @include box-sizing(border-box);

    &:focus {
         z-index: 2;
     }
    }

    input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    input[type="password"] {
        margin-bottom: 20px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    }



</style>
</head>
<body>
<div class="wrapper" >
    <form class="form-signin" action="production/authentication/check_login.php" method="post">
        <h2 class="form-signin-heading" style="margin-bottom: 20px">Einloggen</h2>
        <input type="text" class="form-control" name="username" placeholder="Benutzername" required="" style="margin-bottom:15px">
        <input type="password" class="form-control" name="password" placeholder="Passwort" required="" style="margin-bottom: 15px;">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Einloggen</button>
    </form>
</div>
</body>
</html>