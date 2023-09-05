<?php if(isset($_SESSION["message"]["error"])): ?>
    <div class="alert alert-danger"><?=$_SESSION["message"]["error"]?></div>
<?php elseif(isset($_SESSION["message"]["success"])): ?>
    <div class="alert alert-success"><?=$_SESSION["message"]["success"]?></div>
<?php endif; ?>