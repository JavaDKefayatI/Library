<?php


class Version
{
    /**
     * @param Config_inc $db database
     * @param string $table_name
     * @param string $column_name
     * @return int
     */

    public static function lastVersionFromDatabase(Config_inc $db, string $table_name, string $column_name): int
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

    /**
     * @uses check_big_version
     * @param $decodeInformation
     * @return mixed
     */
    public static function lastVersionFromServer($decodeInformation)
    {
        //give first element for check with other
        $temp = $decodeInformation[0];
        for ($i = 1; $i < count($decodeInformation);
             $i++) {
            if ($temp < $decodeInformation[$i])
                $temp = $decodeInformation[$i];
        }
        return $temp;

    }


}