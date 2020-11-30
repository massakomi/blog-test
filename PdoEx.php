<?php
class PdoEx {

    public function onError()
    {
        $this->error = $this->connection->errorInfo()[2];
        if ($this->error) {
        	//echo '<p style="color:red">'.$this->connection->errorInfo()[2].'</p>';
        }
    }

    public function get($user, $password, $db)
    {
        static $pdo;
        if (!isset($pdo)) {
        	$pdo = new PdoEx();
            $pdo->mysql($user, $password, $db);
        }
        return $pdo;
    }

    function mysql($user, $password, $db, $server='localhost')
    {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
        );

        try {
            $dsn = 'mysql:host='.$server.';dbname='.$db.'';
            $this->connection = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            $this->error = 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    // Выполнения

	public function exec($sql)
    {
        $res = $this->connection->exec($sql);
        if (!$res) {
            $this->onError();
        }
        return $res;
	}

    public function execPrepared($sql, $data)
    {
        $sth = $this->connection->prepare($sql);
        if (!$sth) {
            $this->onError();
            return false;
        }
        if (!$res = $sth->execute($data)) {
            $this->onError();
            return false;
        }
        return $res;
    }



    // Выборка данных

    public function fetchAll($sql)
    {
        $st = $this->connection->query($sql, PDO::FETCH_ASSOC);
        if (!$st) {
            $this->onError();
            return [];
        }
        return $st->fetchAll($mode);
    }

    public function fetchOne($sql)
    {
        $st = $this->connection->query($sql, PDO::FETCH_ASSOC);
        if (!$st) {
            $this->onError();
            return [];
        }
        return $st->fetch($mode);
    }

    public function fetchColumn($sql, $index=0)
    {
        $st = $this->connection->query($sql, PDO::FETCH_COLUMN, $index);
        if (!$st) {
            $this->onError();
            return [];
        }
        return $st->fetchAll($mode);
    }

    /*
    $sql = 'SELECT * FROM clients WHERE name = ?';
    $red = $db->fetchPrepared($sql, array('Andrew'));
    */
    public function fetchPrepared($sql, $data)
    {
        $res = $this->execPrepared($sql, $data);
        if ($res) {
            return $res->fetchAll($sql, $data);
        }
        return [];
    }



    // Вставка

    public function insert($table, $data)
    {
        if (!$data) {
            $this->error = 'Пустые данные для insert';
            return false;
        }
        $q = [];
        for ($i = 0; $i < count($data); $i ++) {
        	$q []= '?';
        }
        $sql = 'INSERT INTO `'.$table.'` (`'.implode('`, `', array_keys($data)).'`) VALUES ('.implode(', ', $q).')';
        return $this->execPrepared($sql, array_values($data));
    }

    // Удаление

    function deleteById($table, $id)
    {
        $id = (int)$id;
        $this->exec('delete from '.$table.' where id='.$id);
    }


    // Обновление

    public function update($table, $data, $where='')
    {
        if (!$data) {
            $this->error = 'Пустые данные для update';
            return false;
        }
        $q = [];
        foreach ($data as $field => $v) {
            $q []= '`'.$field.'`=?';
        }
        $sql = 'UPDATE `'.$table.'` SET '.implode(', ', $q);
        if ($where) {
        	$sql .= ' WHERE '.$where;
        }
        return $this->execPrepared($sql, array_values($data));
    }

}