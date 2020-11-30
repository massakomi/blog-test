

    <button class="btn btn-outline-info btn-add">Создать новую запись</button>

    <?php
    if (!$blogs) {
        echo '<div class="alert alert-danger">В этом блоге еще нет записей</div>';
    }
    ?>

    <div class="posts">
    <?php
    foreach ($blogs as $item) {
        $item['content'] = preg_replace('~[\r\n]+~i', '</p>$0<p>', $item['content']);
        ?>
        <div class="post" data-id="<?=$item['id']?>">
            <div class="post-title"><?=$item['title']?></div>
            <span class="post-date">
                <?=date('Y-m-d H:i:s', strtotime($item['updated_at']))?>
                &nbsp;
                <button class="btn btn-outline-danger btn-sm btn-delete">Удалить</button>
                <button class="btn btn-outline-warning btn-sm btn-edit">Редактировать</button>
            </span>
            <p><?=$item['content']?></p>
            <?php
            if ($item['image'] && file_exists('images/'.$item['image'])) {
            	echo '<img src="images/'.$item['image'].'" style="max-width:200px; margin-bottom:20px;" alt="" />';
            }
            ?>
        </div>
        <?php
    }
    ?>
    </div>

    <?php
    echo $pagination;
    ?>