<?php while($publication = $data["publications"]->fetch_object()): ?>
    <div class="publication">
        <div class="publication_header">
            <img src="<?=URL.$publication->profile_image?>" alt="">
            <a href="<?=URL."social/profile&id=$publication->user_id"?>">
                <?=$publication->name?>
                <?=$publication->lastname?>
            </a>
        </div>
        <div class="publication_body">
            <p>
                <?=$publication->description?>
            </p>
            <img src="<?=URL.$publication->image?>" alt="">
        </div>
        <div class="publication_footer">
            <?php if(Helper::likeOrDislike($publication->id)): ?>
                <a href="<?=URL."like/dislike&id=$publication->id"?>">No me gusta (<?=Helper::getLikes($publication->id)?>)</a>
            <?php else: ?>
                <a href="<?=URL."publication/like&id=$publication->id"?>">Me gusta (<?=Helper::getLikes($publication->id)?>)</a>
            <?php endif; ?>
        </div>
    </div>
<?php endwhile; ?>