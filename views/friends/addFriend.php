<div class="request">
    <section>
       <div class="section-header">
            <h3>Añadir amigos</h3>
       </div>

    
       <div class="section-body">
            <?php include_once "./views/includes/alert.php" ?>
            <ul>
                <?php if($data["users"]->num_rows < 1): ?>
                    <div class="alert alert-info">
                        No se encontraron resultados
                    </div>
                <?php else: ?>
                    <?php while($friend = $data["users"]->fetch_object()): ?>
                        
                        <li>
                            <img src="<?=URL.$friend->profile_image?>" alt="image user">
                            <p><?=$friend->name. " ". $friend->lastname?></p>
                            <div class="actions">
                                <a href="<?=URL."friend/addFriend&friend=".$friend->id?>">Enviar</a>
                                <a href="<?=URL."friend/requestCancel&friend=".$friend->id?>">Eliminar</a>
                            </div>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
       </div>
    </section>

</div>