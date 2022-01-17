<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title><?= APP_NAME ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="/public/css/dashlite.css?ver=2.4.0">
    <link id="skin-default" rel="stylesheet" href="/public/css/theme.css?ver=2.4.0">
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- content @s -->
                <div class="nk-content">
                    <?=  $this->renderSection('content') ?>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="/public/js/bundle.js?ver=2.4.0"></script>
    <script src="/public/js/scripts.js?ver=2.4.0"></script>
    <script src="/public/js/charts/chart-analytics.js?ver=2.4.0"></script>
    <script src="/public/js/libs/jqvmap.js?ver=2.4.0"></script>
    <script src="/public/js/charts/chart-ecommerce.js?ver=2.4.0"></script>
    <script src="/public/js/charts/chart-sales.js?ver=2.4.0"></script>
    <?= $this->renderSection('javascript') ?>
</body>

</html>