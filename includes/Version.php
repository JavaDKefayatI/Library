<?php


class Version
{
    public function lastVersion(Config_inc $db, string $table_name, string $column_name): int
    {
        try {
            $query = "SELECT MAX(" . $column_name . ") FROM " . $table_name;

            $statement = $db->connect->query($query);
            // get and send all publishers
            return $statement->fetchAll(PDO::FETCH_ASSOC)[0]["MAX(" . $column_name . ")"];

        } catch (PDOException $e) {
            throw $e;
        }

    }



}