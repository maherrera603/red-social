<div class="request">
    <section>
       <div class="section-header">
            <h3>Solicitudes de amistad (<?=Helper::countFriendsRequest()?>)</h3>
       </div>
       <div class="section-body">
            <?php include_once "./views/includes/alert.php" ?>
            <ul>
                <?php while($friend = $data["friends"]->fetch_object()): ?>
                    <li>
                        <img src="<?=URL.$friend->profile_image?>" alt="image user">
                        <p><?=$friend->name. " ". $friend->lastname?></p>
                        <div class="actions">
                            <a href="<?=URL."friend/confirmRequest&friend=".$friend->id?>">Confirmar</a>
                            <a href="<?=URL."friend/requestCancel&friend=".$friend->id?>">Eliminar</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
       </div>
    </section>

</div>