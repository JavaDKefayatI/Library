<?php

class Config_inc
{
    public PDO $connect;
    private static string $server = "http://localhost:80/";

    /**
     * Connect constructor.
     * @param $name_database : the name of the database you want to connect to
     */

    public function __construct($name_database)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $this->connect = new PDO("mysql:host=$servername;dbname=$name_database", $username, $password);
            // set the PDO error mode to exception
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * @param string $name_table
     * @param array $query for example for query is
     * id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     * firstname VARCHAR(30) NOT NULL,
     * lastname VARCHAR(30) NOT NULL,
     * email VARCHAR(50),
     * reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
     */

    function createTable(string $name_table, array $query): bool
    {
        try {

            $final_query = " CREATE TABLE " . $name_table . "(" . implode(",", $query) . ")";

            $this->connect->exec($final_query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param string $table_name
     * @param array $list_of_title for example for this input is [id , name ,family,...]
     * @param array $list_of_values for example [2,'javad' ,'kefayati',...]
     */

    function insert(string $table_name, array $list_of_title, array $list_of_values): void
    {

        try {
            $list_of_values = self::setBool($list_of_values);

            //create query in this three line
            $query = "INSERT INTO " . $table_name;
            $query .= "(" . implode(",", $list_of_title) . ")";
            $query .= "VALUES (" . self::createImplode($list_of_values) . ")";

            $this->connect->query($query);
        } catch (PDOException $e) {
            throw $e;
        }

    }

    /**
     * @param string $name_table
     * @param array $array_of_you_want usually [*] and some cases [column_name ,column_id...]
     * @param string|null $condition format must be id=number and/or lastname='anything' and/or...
     * @return array This is a presentation of the items you searched for.
     */

    function selectOrSearch(string $name_table, array $array_of_you_want, string $condition = null): array
    {
        try {
            $query = "SELECT " . implode(' , ', $array_of_you_want) . "  FROM " . $name_table;

            if ($condition != null)
                $query .= " WHERE " . $condition;


            $statement = $this->connect->query($query);
            // get and send all publishers
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * @param string $name_table
     * @param array $array_of_you_want usually [*] and some cases [column_name,...]
     * @param string $column_name for example is firstname or id or...
     * @param bool $is_DESC determines whether it is ascending or descending and it is optional
     * @return array
     */

    function order(string $name_table, array $array_of_you_want, string $column_name, bool $is_DESC = false): array
    {
        try {
            //create query with arrays and...
            $query = "SELECT " . implode(' , ', $array_of_you_want) . "  FROM " . $name_table;
            $query .= " ORDER BY " . $column_name;

            if ($is_DESC == false)
                $query .= " ASC";

            else
                $query .= " DESC";
            print_r($query);

            $stmt = $this->connect->prepare($query);
            $stmt->execute();

            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * @param string $table_name the name from table
     * @return bool
     */
    function checkEmpty(string $table_name): bool
    {
        $result = $this->selectOrSearch($table_name, ["*"]);

        if (count($result) == 0) return true;
        return false;
    }


    /**
     * @param string $table_name
     * @param string $condition : format must be firstname='anything' and/or lastname='anything' and/or...
     * @return void  because it's just be delete
     */

    function delete(string $table_name, string $condition): bool
    {
        try {
            $query = "DELETE FROM " . $table_name . " WHERE " . $condition;

            $this->connect->query($query);
            return true;

        } catch (PDOException $e) {
            return false;
        }

    }

    /**
     * @param array $statement_for_change : format for it is ['id'=>number,'lastname='anything']
     * @param string $condition : format must be id = number and/or lastname='anything' and/or...
     * @return void because it's just be edit
     */

    function edit(string $table_name, array $statement_for_change, string $condition): void
    {
        try {

            //create base form query
            $query = "UPDATE " . $table_name . " SET ";
            //add statement  for  change in database
            $query .= self::format($statement_for_change);
            //add condition  for  select in database
            $query .= " WHERE " . $condition;

            $this->connect->exec($query);

        } catch (PDOException $e) {
            throw $e;
        }
    }


    /**
     * @param array $state The input format must be similar to ['firstname'=>'jack', ... ]
     * @return string The output format is similar to name='jack' or id=2
     */

    private static function format(array $state): string
    {
        $index = 0;
        $query = '';
        foreach ($state as $s => $s_value) {

            if ($index != count($state) - 1) {
                $query .= " $s = ";
                if (!is_int($s_value))
                    $query .= "'$s_value' , ";
                else
                    $query .= "$s_value , ";

            } else {
                $query .= " $s = ";
                if (!is_int($s_value))
                    $query .= "'$s_value'  ";
                else
                    $query .= "$s_value  ";

            }
            $index++;
        }

        return $query;
    }

    /**
     * @param string $tableName the table you want remove
     */
    public function removeColumn(string $tableName): bool
    {
        try {

            $final_query = " DROP TABLE " . $tableName;
            $this->connect->exec($final_query);

            return true;

        } catch (PDOException $e) {
            return false;
        }

    }

    /**
     * @param string $tableName the table you want add column
     * @param string $query for example Name VARCHAR(26) or Age INT(4) NOT NULL
     * @param string $afterName what table you want next it add column?
     * @return bool
     *
     */

    public function alter(string $tableName, string $query, string $afterName): bool
    {
        try {

            $final_query = " ALTER TABLE " . $tableName .
                " ADD " . $query . " AFTER " . $afterName . ";";
            $this->connect->exec($final_query);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    /**
     * @param string $table
     * @param string $column
     * @param string $as
     */

    public function max(string $table, string $column, string $as = "max")
    {

        try {
            $query = "SELECT MAX(" . $column . ") AS " . $as . "
                        FROM " . $table;

            $statement = $this->connect->query($query);
            // get and send all publishers
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * @param string $table
     * @param string $column
     * @param string $condition
     */

    public function setCurrentTime(string $table, string $column, string $condition)
    {
        try {

            //create base form query
            $query = "UPDATE " . $table . " SET " . $column . "= now() WHERE " . $condition;
            $this->connect->exec($query);

        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function InnerJoin(array $array_of_column, string $continue_FROM)
    {
        try {
            $query = "SELECT " . implode(' , ', $array_of_column) . "  FROM " . $firstTable .
                "  INNER JOIN " . $secondTable . " on ";

            $statement = $this->connect->query($query);

            // get and send all publishers
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw $e;
        }


    }

    /**
     * @param string $name_table
     * @param array $array_of_you_want
     * @param string|null $condition
     * @return bool
     */
    public function isExist(string $name_table, array $array_of_you_want, string $condition = null): bool
    {
        $result = $this->selectOrSearch($name_table, $array_of_you_want, $condition);

        if (count($result) == 0) return false;
        return true;
    }


    /**
     * @param $arr
     * @return mixed
     * @uses convert [1,'name',true/false] to [1,'name',1/0]
     */

    private static function setBool($arr)
    {

        for ($i = 0; $i < count($arr); $i++) {

            if (is_bool($arr[$i]))
                $arr[$i] = ($arr[$i] == true) ? 1 : 0;
        }
        return $arr;
    }

    private static function createImplode($arr): string
    {
        $str = "";

        if (!is_int($arr[0]))
            $str .= "'";

        for ($i = 0; $i < count($arr); $i++) {

            if (is_int($arr[$i])) {
                $str .= $arr[$i];
                if ($i != count($arr) - 1) {
                    if (!is_int($arr[$i + 1]))
                        $str .= ",'";
                    else
                        $str .= ",";
                } else
                    $str .= "";

            } else {
                $str .= $arr[$i];
                if ($i != count($arr) - 1) {
                    if (!is_int($arr[$i + 1]))
                        $str .= "','";
                    else
                        $str .= "',";
                } else
                    $str .= "'";

            }
        }
        return $str;
    }

    /**
     * @return string
     */
    public static function getServer(): string
    {
        return self::$server;
    }

}
