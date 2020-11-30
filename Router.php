<?php

class Router {

	public $allowed = [
        'GET' => ['index', 'editform'],
        'POST' => ['delete', 'save']
    ];

    public function __construct()
    {
        $this->pdo = PdoEx::get(DB_USER, DB_PASSWORD, DB_NAME, DB_SERVER);
        if ($this->pdo->error) {
            $this->display('error', [
                'msg' => $this->pdo->error
            ]);
            exit;
        }
    }

    /**
     * Определяем действие и выполняем метод
     */
    public function route()
    {
        $action = $_REQUEST['action'];
        if (!$action) {
        	$action = 'index';
        }
        $method = 'action'.ucfirst($action);
        if (method_exists($this, $method)) {
            if ($this->methodAllowed($action, $_SERVER['REQUEST_METHOD'])) {
            	$this->$method();
            } else {
                $this->display('error', [
                    'msg' => 'Действие не разрешено: '.$action
                ]);
            }
        } else {
            $this->display('error', [
                'msg' => 'Неизвестное действие '.$action
            ]);
        }
    }

    /**
     * Отображаем представление внутри общего лейаута
     */
    public function display($view, $vars=[])
    {
        $viewFile = 'views/'.$view.'.php';
        if (!file_exists($viewFile)) {
        	exit('Не найдено представление '.$viewFile);
        }
        extract($vars);
        include_once 'views/layout.php';
    }

    /**
     * Проверяем разрешено ли выполнять это действие этим методом
     */
    public function methodAllowed($action, $httpMethod)
    {
        if (!isset($this->allowed[$httpMethod]) || !is_array($this->allowed[$httpMethod])) {
            return false;
        }
        return in_array($action, $this->allowed[$httpMethod]);
    }

	public function actionIndex()
    {
        $limit = 2;
        $start = (int)$_GET['start'];
        $countAll = $this->pdo->fetchOne('select count(*) as c from blog')['c'];

        $blogs = $this->pdo->fetchAll('select * from blog order by id desc limit '.$start.', '.$limit.'');
        if ($this->pdo->error) {
            $this->display('error', [
                'msg' => $this->pdo->error
            ]);
        } else {
            $pagination = Utils::generatePagesLinks($limit, $start, $countAll, $floatLimit=50);
            $this->display('blog', [
                'blogs' => $blogs,
                'pagination' => $pagination
            ]);
        }
	}

	public function actionDelete()
    {
        $this->pdo->deleteById('blog', $_POST['id']);
	}

    public function actionEditform()
    {
        $id = (int)$_GET['id'];
        if ($id) {
            $item = $this->pdo->fetchOne('select * from blog where id='.$id);
            $formMode = 'edit';
        } else {
            $item = [];
            $formMode = 'add';
        }
        include_once 'views/form.php';
    }

    public function actionSave()
    {
        $blog = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($_POST['image-remove'] && $_POST['id']) {
            $id = (int)$_POST['id'];
            $item = $this->pdo->fetchOne('select * from blog where id='.$id);
            if ($item['image']) {
                $path = 'images/'.$item['image'];
                if (file_exists($path)) {
                    unlink($path);
                }
            	$this->pdo->update('blog', ['image' => null], 'id='.$id);
            }
        }

        if ($_FILES['image'] && $_FILES['image']['tmp_name']) {
            $file = $_FILES['image'];
            $name = $file['name'];
            if ($file['error']) {
            	exit('Ошибка загрузки изображения');
            }
           	$name_explode = explode('.', $name);
        	$extension = strtolower($name_explode[count($name_explode) - 1]);
            if (!in_array($extension, array('jpg', 'jpeg', 'png', 'gif', 'png'))) {
                exit('Файл "'.$name.'" - не картинка');
            }
            $dir = 'images';
            if (!file_exists($dir)) {
                mkdir($dir, 0755);
            }
            $path = $dir.'/'.$name;
            if (move_uploaded_file($file['tmp_name'], $path)) {
            	$blog ['image'] = $name;
            } else {
                exit('Ошибка сохранения изображения ('.$path.')');
            }
        }

        if ($_POST['id']) {
            $id = (int)$_POST['id'];
        	$this->pdo->update('blog', $blog, 'id='.$id);
        } else {
            $this->pdo->insert('blog', $blog);
        }


        if ($this->pdo->error) {
        	echo $this->pdo->error;
        }
    }
}