
      <form method="POST" id="blog-form" data-mode="<?=$formMode?>">
      <div class="modal-header">
        <h5 class="modal-title"><?=$formMode == 'edit' ? 'Редактирование записи' : 'Добавление записи'?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="alert alert-danger" id="error-block" style="display:none;"></div>
          <div class="form-group">
            <label>Заголовок</label>
            <input type="text" class="form-control" name="title" value="<?=$item['title']?>" required>
          </div>
          <div class="form-group">
            <label>Текст</label>
            <textarea name="content" class="form-control" rows="10" required><?=$item['content']?></textarea>
          </div>
          <div class="form-group">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="validatedCustomFile" onchange="$('label[for='+this.id+']').html(this.files[0].name)">
                <label class="custom-file-label" for="validatedCustomFile">Изображение</label>
                <div class="invalid-feedback">Неправильный файл</div>
              </div>
          </div>
          <?php
          if ($item['image']) {
             ?>
            <div class="form-check">
              <input class="form-check-input" name="image-remove" type="checkbox" value="1" id="image-remove">
              <label class="form-check-label" for="image-remove">
                Удалить изображение
              </label>
            </div>
             <?php
             $path = 'images/'.$item['image'];
             if (file_exists($path)) {
             	echo '<img src="'.$path.'" style="max-width:200px; margin-top:20px;" alt="" />';
             } else {
                echo '<br /><div class="alert alert-danger">Файл изображения не существует</div>';
             }
          }
          ?>
          <input type="hidden" name="id" value="<?=$item['id']?>">
          <input type="hidden" name="action" value="save">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
        <button type="submit" class="btn btn-primary btn-save">Сохранить</button>
      </div>
      </form>