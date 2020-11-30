
$(document).ready(function(){

    $(document).ajaxStart(function() {
        $('#loader').show();
    });

    $(document).ajaxStop(function() {
        $('#loader').hide();
    });

    // Выполнение сохранения данных
    $('#modal').delegate('#blog-form', 'submit', function() {
        var formData = new FormData(this);
        $.ajax({
            url : '',
            type : 'POST',
            data : formData,
            processData: false,
            contentType: false,
            success : function(data) {
                if (data) {
                	$('#error-block').html(data).show()
                } else {
                    if ($('#blog-form').data('mode') == 'add') {
                        var info = 'Успешно добавлено!';
                    } else {
                        var info = 'Успешно изменено!';
                    }
                    $('#error-block').hide()
                    $('#blog-form .modal-footer').hide()
                    $('#blog-form .modal-body').html('<div class="alert alert-success">'+info+'</div>')
                    setTimeout(function() {
                        $('#modal').modal('hide')
                        location.reload()
                    }, 1000);
                }
            }
        });
        return false;
    })

    // Форма создания записи
    $('.btn-add').click(function() {
        $.get('?action=editform', function(data) {
            $('#modal .modal-content').html(data)
            $('#modal').modal('show')
        });
    })

    // Форма редактирования
    $('.btn-edit').click(function() {
        var post = $(this).parents('.post');
        var id = post.data('id')
        $.get('?action=editform&id='+id, function(data) {
            $('#modal .modal-content').html(data)
            $('#modal').modal('show')
        });
    })

    // Удаление записей
    $('.posts .post .btn-delete').click(function() {
        if (!confirm('Удалить эту запись?')) {
            return false;
        }
        var post = $(this).parents('.post');
        var id = post.data('id')
        $.post('', 'action=delete&id='+id, $.proxy(function(data) {
            if (data != '') {
                alert(data)
            } else {
                $(this).parents('.post').slideUp()
            }
        }, this));
    })
});