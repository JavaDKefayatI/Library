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
     * @param $decodeInformation
     * @return mixed
     * @uses check_big_version
     */
    public static function lastVersionFromServer($decodeInformation)
    {
        //give first element for check with other
        $temp = $decodeInformation[0]->nameVersion;
        for ($i = 1; $i < count($decodeInformation);
             $i++) {
            if ($temp < $decodeInformation[$i]->nameVersion)
                $temp = $decodeInformation[$i]->nameVersion;
        }
        return $temp;

    }

    /**
     * @param Config_inc $connect database
     * @param string $url =>for example:'https://www.server.com/api.php'
     * @param int $current_version current version from database
     * @return bool has new version or hasn't
     */

    public static function checkVersion(Config_inc $connect, string $url, int $current_version): bool
    {
        // get information from server
        // Initialize a CURL session.
        $ch = curl_init();
        // Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);
        $server_information = curl_exec($ch);

        //create array from json
        $array_versions = json_decode($server_information);
        //max version from server
        $maxVersion = Version::lastVersionFromServer($array_versions);

        //check current version with the version from server
        if ($current_version < $maxVersion)
            return true;
        else
            return false;

    }
}