<div class="profile">
    <?php include "./views/includes/alert.php"; ?>

    <div class="images">
        <img src="<?=URL.$data["user"]->cover_image?>" alt="" class="cover-image">
        <img src="<?=URL.$data["user"]->profile_image?>" alt="" class="profile-image">
    </div>

    <div class="information">
       <div class="information_header">
            <h2>Datos personales</h2>
            <?php if(isset($_SESSION["user"]) && $_SESSION["user"]->id === $data["user"]->id ): ?>
                <a id="edit">Editar <i class="fa-solid fa-pen-to-square"></i></a>
            <?php elseif(!Helper::requestSent($data["user"]->id)): ?>
                <a href="<?=URL."friend/addFriend&friend=".$data["user"]->id?>"><i class="fa-solid fa-user-plus"></i> Añadir a amigos</a>
            <?php else: ?>
                <a href="<?=URL."friend/cancelRequest&friend=".$data['user']->id?>">Cancelar <i class="fa-solid fa-user-minus"></i></a>
            <?php endif; ?>
        </div>
        <hr>

        <div class="form-control">
            <label for="name">Nombres</label>
            <p><?=$data["user"]->name?></p>
        </div>
        <div class="form-control">
            <label for="lastname">Apellidos</label>
            <p><?=$data["user"]->lastname?></p>
        </div>
        <div class="form-control">
            <label for="phone">Telefono</label>
            <p><?=$data["user"]->phone?></p>
        </div>
        <div class="form-control">
            <label for="email">Correo Electronico</label>
            <p><?=$data["user"]->email?></p>
        </div>

    </div>

    <div class="publications">
        <h2>Publicaciones</h2>
        <hr>

        <div class="publications_body">
            <?php include "./views/includes/publications.php"; ?>
        </div>
    </div>
    <?php if(isset($_SESSION["user"])): ?>
        <div class="overlay">
            <div class="popup">

                <div class="popup_header">
                    <h3>Actualizar Datos</h3>
                    <div class="close" id="close">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>

                <form action="<?=URL."social/update"?>" method="POST" enctype="multipart/form-data">
                    <div class="form-control">
                        <label for="name">Nombres</label>
                        <input type="text" name="name" id="name" value="<?=$data["user"]->name?>">
                    </div>
                    <div class="form-control">
                        <label for="lastname">Apellidos</label>
                        <input type="text" name="lastname" id="lastname" value="<?=$data["user"]->lastname?>">
                    </div>

                    <div class="form-control">
                        <label for="phone">Telefono</label>
                        <input type="tel" name="phone" id="phone" value="<?=$data["user"]->phone?>">
                    </div>
                    <div class="form-control">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?=$data["user"]->email?>">
                    </div>

                    <div class="form-control">
                        <label for="profile">Imagen de perfil</label>
                        <input type="file" name="profile" id="profile">
                    </div>

                    <div class="form-control">
                        <label for="cover">Imagen de portada</label>
                        <input type="file" name="cover" id="cover">
                    </div>
                    <div class="form-action">
                        <button type="submit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?=Helper::clearSession("message")?>
</div>

<script src="<?=URL."assets/js/profile.js"?>"></script>