<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <?= view('globals/headermeta') ?>
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
    <?= view('globals/scripts') ?>
    <?= $this->renderSection('javascript') ?>
</body>

</html>