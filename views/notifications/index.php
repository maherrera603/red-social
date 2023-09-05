<div class="request">
    <section>
        <div class="section-header">
            <h3>Notificaciones (<?=Helper::countNotifications()?>)</h3>
        </div>
        <?php if(Helper::countNotifications() < 1): ?>
            <div class="alert alert-info">
                No tienens notificaciones
            </div>
        <?php endif; ?>
       <div class="section-body">
            <?php include_once "./views/includes/alert.php" ?>
            <ul>
                <?php while($notification = $data["notifications"]->fetch_object()): ?>
                    <li>
                        <img src="<?=URL.$notification->profile_image?>" alt="image user">
                        <p><?=$notification->name. " ". $notification->lastname . " ". $notification->notification?></p>
                        <div class="actions">
                            <a href="<?=URL."notification/delete&notification=".$notification->id?>">Eliminar</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
       </div>
       <?=Helper::clearSession("message")?>
    </section>

</div>