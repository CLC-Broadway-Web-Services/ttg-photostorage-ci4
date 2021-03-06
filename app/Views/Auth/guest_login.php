<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Login</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="/public/css/dashlite.css?ver=2.4.0">
    <link id="skin-default" rel="stylesheet" href="/public/css/theme.css?ver=2.4.0">
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs mt-5">
                        <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="/public/images/jsTree/TTG-Photo-Storage-Favicon.png" srcset="/public/images/jsTree/TTG-Photo-Storage-Favicon.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="/public/images/jsTree/TTG-Photo-Storage-Favicon.png" srcset="/public/images/jsTree/TTG-Photo-Storage-Favicon.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        <div class="nk-block-des">
                                            <p>Login to view details</p>
                                        </div>
                                    </div>
                                </div>
                                <form method="post">
                                    <input class="d-none" name="form_name" value="login_form">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Enter your email address">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="password" class="form-control form-control-lg is-shown valid" required="" id="password" placeholder="Enter your passcode" aria-invalid="false">
                                            <!-- <input type="password" class="form-control form-control-lg" placeholder="Enter your passcode"> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                                    </div>
                                </form>
                                <!-- <div class="form-note-s2 text-center pt-4"> Trouble signing in? <a href="">Reset Password</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="/public/js/bundle.js?ver=2.4.0"></script>
    <script src="/public/js/scripts.js?ver=2.4.0"></script>
</body>

</html>