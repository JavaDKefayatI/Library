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

    /**
     * @param string $url
     * @return bool|string
     */
    public static function getSite(string $url){
        // Initialize a CURL session.
        $ch = curl_init();
        // Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);

        return curl_exec($ch);
    }

}