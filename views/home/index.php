<div class="container-index">
    <section class="user">
        <ul>
            <li>
                <a href="<?=URL."social/profile"?>">
                    <p class="active"></p><?=$_SESSION["user"]->name?> <?=$_SESSION["user"]->lastname?>
                </a> 
            </li>
            <li>
                <a href="<?=URL."notification/index"?>"><i class="fa-solid fa-bell"></i> Notificaciones (<?=Helper::countNotifications()?>)</a>
            </li>
            <?php if(Helper::countFriendsRequest() > 0 ): ?>
                <li>
                    <a href="<?=URL."friend/request"?>"><i class="fa-solid fa-user-plus"></i> Solicitudes de amistad (<?=Helper::countFriendsRequest()?>)</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?=URL."friend/friends"?>"><i class="fa-solid fa-user-group"></i> Agregar Amigos</a>
            </li>
        </ul>
    </section>
    
    <article>
        <form>
            <div class="form-control">
                <input type="search" name="search" id="search" placeholder="Buscar...">
            </div>
            <button class="add-publication" type="button"><i class="fa-solid fa-plus"></i></button>
        </form>
        <?php include "./views/includes/alert.php"; ?>
        <?=Helper::clearSession("message")?>
        <?php include "./views/includes/publications.php"; ?>
    </article>
    
    <section class="contact">
        <h3>Contactos</h3>

        <ul>
            <?php while($friend = $data["friends"]->fetch_object()): ?>
                <?php if($friend->id === $_SESSION["user"]->id): ?>
                    <?php else: ?>
                        <li>
                            <a href=""><p class="<?=$friend->status === "Activado" ? "active" : "deactivate"; ?>"></p><?=$friend->name." ".$friend->lastname ?></a>
                        </li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    </section>

    <div class="overlay">
        <div class="popup">
            <div class="popup_header">
                <h3>Agregar publicacion</h3>
                <div class="close" id="close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <form action="<?=URL."home/savePublications"?>" method="post" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="image">Imagen</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form-control">
                    <label for="description">Descripcion</label>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
                </div>

                <div class="form-action">
                    <button type="submit">Publicar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="<?=URL."assets/js/home.js"?>"></script>
</div>