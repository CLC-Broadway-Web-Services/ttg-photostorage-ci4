<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url(images/bg2.jpg);
        }

        .login {
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%;
            position: relative;
            max-width: 440px;
            width: calc(100% - 40px);
            padding: 20px;
            background-color: rgba(24, 65, 108, 0.3);
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            min-width: 320px;
            min-height: 338px;
            overflow: hidden;
            text-align: left;
        }

        .login:hover {
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%;
            position: relative;
            max-width: 440px;
            width: calc(100% - 40px);
            padding: 20px;
            background-color: rgba(24, 65, 108, 0.3);
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
            min-width: 320px;
            min-height: 338px;
            overflow: hidden;
            text-align: left;
        }

        input[type=text],
        input[type=password] {

            width: 100%;
            padding: 12px 5px;
            margin: 8px 0;
            display: inline-block;
            box-sizing: border-box;
            border-width: 0 0 2px;
            border-bottom-color: #000000;
            border-radius: 0;
            -webkit-border-radius: 0;

        }

        input:focus {
            border-bottom-color: #c6c6f4;
        }

        .imgcontainer {
            text-align: center;
            margin: 4px 0 12px 0;
            position: relative;
        }

        .avatar {
            width: 20%;
            padding-bottom: 20px;
            border: 1px solid blue;
        }
    </style>
</head>

<body>



    <div class="login">
        <div class="imgcontainer">
            <img src="images/company_logo.png" class="avatar" />
        </div>
        <form method="post" action="">

            <input type="text" name="login" value="" placeholder="Type your Email">

            <input type="password" name="password" value="" placeholder="Type Your Password">

            <?php

            if ($message) {
                echo "<ul class= 'errorMessages' ><b>ERROR:</b>" . $message . "</ul>";
            }
            ?>

            <label>
                <input type="checkbox" name="remember_me" id="remember_me">
                Remember me on this device.
            </label>

            <p class="submit"><input type="submit" name="commit" value="Login" class="outbtn"></p>
        </form>
    </div>

</body>

</html>