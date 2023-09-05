<div class="principal">
    <form action="<?=URL."user/loguearse"?>" method="POST">
        <div class="icon-user">
            <i class="fa-solid fa-user"></i>
        </div>
        <?php include_once "./views/includes/alert.php"; ?>
        <h3>Iniciar Sesion</h3>
        <div class="form-control">
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-control">
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        
        <div class="form-action">
            <button type="submit" class="btn">Ingresar</button>
            <a href="<?=URL."user/register"?>">Registrarse</a>
        </div>
        <?=Helper::clearSession("message")?>
    </form>

</div>