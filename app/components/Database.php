<?php /** @noinspection PhpComposerExtensionStubsInspection */

namespace App\components;

use PDO;

class Database
{
    private $pdo;

    /**
     * Database constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }



    /**
     * Возвращает все строки из таблицы $table
     * Также можно отсортировать полученные строки по возрастанию
     *
     *
     * @example SELECT * FROM news
     * @example SELECT * FROM leader ORDER by id DESC
     * @param string $table таблица
     * @param null $isDesc сортировка
     * @return array все строки
     */
    public function getAll($table, $isDesc = NULL)
    {
        $desc = ($isDesc) ? 'ORDER by `id` DESC' : NULL;
        $query = $this->pdo->prepare("SELECT * FROM $table $desc");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает строку из таблицы $table по $id
     *
     * @example SELECT * FROM news WHERE id = 20
     * @example SELECT * FROM specialties WHERE code = 09.02.03
     * @param $table
     * @param int $id ID
     * @param string $idName значение ID по умолчанию.
     * @return mixed строка
     */
    public function getRow($table, $id, $idName = "id")
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $idName = :id");
        $params = [
            ':id' => $id
        ];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает первые или последние $rows строк из таблицы $table
     *
     * @example SELECT * FROM news ORDER BY id LIMIT 5
     * @example SELECT * FROM leaders ORDER BY id DESC LIMIT 15
     * @param $table
     * @param $rows
     * @param null $isDesc
     * @return array
     */
    public function getFirstLastRows($table, $rows, $isDesc = NULL)
    {
        $desc = ($isDesc) ? 'DESC' : NULL;
        $query = $this->pdo->prepare("SELECT * FROM $table ORDER BY `id` $desc LIMIT $rows");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает несколько строк из таблицы $table, которые находятся на позициях $pos
     *
     *
     * @example SELECT * FROM news WHERE id IN (1,2,3)
     * @param string $table таблица
     * @param string $pos
     * @return array
     */
    public function getSomeRows($table, $pos)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE `id` IN ($pos)");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает количество строк в таблице $table
     *
     * @example SELECT COUNT(*) as count FROM news
     * @param string $table
     * @return mixed
     */
    public function getCount($table)
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) as count FROM $table");
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает первую или последнюю стркоу из таблицы $table в зависимости от $isDesc
     * По умолчанию возвращает первую строчку
     *
     * @example SELECT * FROM news ORDER BY id LIMIT 1
     * @example SELECT * FROM leaders ORDER BY id DESC LIMIT 1
     * @param $table
     * @param null $isDesc
     * @return mixed
     */
    public function getFirstLastRow($table, $isDesc = NULL)
    {
        $desc = ($isDesc) ? 'DESC' : NULL;
        $query = $this->pdo->prepare("SELECT * FROM $table ORDER BY id $desc LIMIT 1");
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает строку удовлетворяющий условию
     *
     * @example SELECT * FROM news WHERE email = 'parviz23.10@inbox.ru' LIMIT 1
     * @param $table
     * @param $column
     * @param $value
     * @return mixed
     */
    public function getRowCondition($table, $column, $value)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $column = :value LIMIT 1");
        $params = [
            'value' => $value
        ];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * * Возвращает строки удовлетворяющие условию $column = $value
     *
     * @example SELECT * FROM news WHERE lname = 'Abdulloev'
     * @param $table
     * @param $column
     * @param $value
     * @return array
     */
    public function getAllCondition($table, $column, $value)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $column = :value");
        $params = [
            'value' => $value
        ];
        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Добавляет строку в таблицу $table
     *
     * @example INSERT INTO news (title, text) VALUES ('Заголовок', 'Текст новости')
     * @param $table
     * @param $data
     */
    public function store($table, $data)
    {
        $keys = array_keys($data);
        $stringOfKeys = implode(',', $keys);
        $values = ":" . implode(', :', $keys);

        $query = $this->pdo->prepare("INSERT INTO $table ($stringOfKeys) VALUES ($values)");

        $query->execute($data);
    }



    /**
     * Изменяет строку $id из таблицы $table данными $data
     *
     * @param $table
     * @param $id
     * @param $data
     * @param string $idName имя столбца (первичного ключа). По умолчанию 'id'
     */
    public function update($table, $id, $data, $idName = "id")
    {
        $fields = "";
        $data[$idName] = $id;
        foreach($data as $key => $value)
        {
            $fields .= $key . "=:" . $key . ",";
        }

        $fields = rtrim($fields, ',');

        $query = $this->pdo->prepare("UPDATE $table SET $fields WHERE $idName = :" . $idName);

        $query->execute($data);
    }



    /**
     * Удаляет строку из таблицы $table
     *
     * @param $table
     * @param $id
     * @param string $idName имя столбца (первичного ключа). По умолчанию 'id'
     */
    public function delete($table, $id, $idName = "id")
    {
        $query = $this->pdo->prepare("DELETE FROM $table WHERE $idName = :id");
        $params = [
            ":id" => $id
        ];

        $query->execute($params);
    }


    /**`
     * Возвращает строки по результату сиимметричного соединения (INNER JOIN) двух таблиц ($fromTable, $joinTable)
     * по полям ($fromTableColumn, $joinTableColumn)
     *
     * @param $fromTable
     * @param $joinTable
     * @param $fromTableColumn
     * @param $joinTableColumn
     * @param string $type тип соединения (INNER, LEFT, RIGHT) JOIN
     * @return array
     */
    public function getAllJoinTables($fromTable, $joinTable, $fromTableColumn, $joinTableColumn, $type = "INNER")
    {
        $query = $this->pdo->prepare("SELECT * 
                                                 FROM $fromTable 
                                                      $type JOIN $joinTable on $fromTable.$fromTableColumn = $joinTable.$joinTableColumn");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Возвращает строку по результату $type (INNER, LEFT или RIGHT) соединения двух таблиц ($fromTable, $joinTable)
     * по полям ($fromTableColumn, $joinTableColumn)
     *
     *
     * @param $fromTable
     * @param $joinTable
     * @param $fromTableColumn
     * @param $joinTableColumn
     * @param $id
     * @param string $idName название столбца
     * @param string $type тип соединения (INNER, LEFT, RIGHT) JOIN
     * @return mixed
     */
    public function getRowJoinTables($fromTable, $joinTable, $fromTableColumn, $joinTableColumn, $id, $idName = "id", $type = "INNER")
    {
        $query = $this->pdo->prepare("SELECT * 
                                                 FROM $fromTable 
                                                      $type JOIN $joinTable on $fromTable.$fromTableColumn = $joinTable.$joinTableColumn 
                                                 WHERE $fromTable.$idName = :id LIMIT 1");
        $params = [
            'id' => $id
        ];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_OBJ);
    }


    /**
     * Возвращает сеансы
     *
     * @param $idFilm
     * @param $idCinema
     * @return array
     */
    public function getSessionsForCinema($idFilm, $idCinema)
    {
        $query = $this->pdo->prepare("SELECT *
                                                       FROM sessions
                                                            INNER JOIN halls on sessions.id_hall = halls.id
                                                       WHERE `id_film` = :idFilm AND halls.id_cinema = :idCinema");
        $params = [
            'idFilm' => $idFilm,
            'idCinema' => $idCinema
        ];
        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Возвращает кинотеатры, где на прокате есть текущие фильмы
     *
     * @param $idFilm
     * @return array
     */
    public function getCinemaWhereExistFilms($idFilm)
    {
        $query = $this->pdo->prepare("SELECT * FROM getCinemaWhereExistFilms WHERE `id_film` = :idFilm");
        $params = [
            "idFilm" => $idFilm
        ];
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     *
     *
     * @param $idFilm
     * @param $date
     * @param $time
     * @return mixed
     */
    public function getSession($idFilm, $date, $time)
    {
        $query = $this->pdo->prepare("SELECT * FROM sessions
                                                         WHERE `id_film` = :idFilm AND `date` = :date_ AND `time` = :time_ 
                                                         LIMIT 1");
        $params = [
            'idFilm' => $idFilm,
            'date_' => date("Y-m-d", strtotime($date)),
            'time_' => date("H:i:s", strtotime($time))
        ];
        $query->execute($params);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getCinemaWithHalls($id_cinema, $id_hall)
    {
        $query = $this->pdo->prepare("SELECT * FROM getCinemaWithHalls
                                                         WHERE `id_cinema` = :id_cinema AND `hall_id` = :id_hall ");
        $params = [
            'id_cinema' => $id_cinema,
            'id_hall' => $id_hall
        ];
        $query->execute($params);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}