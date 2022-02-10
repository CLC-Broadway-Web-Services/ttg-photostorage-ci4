<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <?= view('globals/headermeta') ?>
    <?= $this->renderSection('css') ?>
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap ">
                <div class="nk-content">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>
    <?= view('globals/scripts') ?>
    <?= $this->renderSection('javascript') ?>
</body>

</html>