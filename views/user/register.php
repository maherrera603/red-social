<div class="principal">
    <form class="form" method="post" action="<?=URL."user/create"?>">
        <div class="icon-user">
            <i class="fa-solid fa-user"></i>
        </div>
        <h3>Registro de usuario</h3>

        <?php include_once "./views/includes/alert.php"; ?>
        
        <div class="form-control">
            <input type="text" name="name" id="name" placeholder="Nombres">
        </div>

        <div class="form-control">
            <input type="text" name="lastname" id="lastname" placeholder="Apellidos">
        </div>

        <div class="form-control">
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-control">
            <input type="password" name="password" id="password" placeholder="Password">
        </div>

        <div class="form-control">
            <input type="password" name="pass" id="pass" placeholder="Confirmar contraseña">
        </div>
        
        <div class="form-action">
            <button type="submit" class="btn">Ingresar</button>
        </div>

        <?=Helper::clearSession("message")?>
    </form>
    <a href="<?=URL?>" class="login">Iniciar Sesion</a>
</div>
