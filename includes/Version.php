<?php


class Version
{
    private string $lastVersionInDatabase;
    private string $lastNewNameVersion;


    /**
     * @param Config_inc $db database
     * @param string $table_name
     * @param string $column_name
     */

    public function setLastVersionFromDatabase(Config_inc $db, string $table_name, string $column_name)
    {
        try {
            $query = "SELECT MAX(" . $column_name . ") FROM " . $table_name;

            $statement = $db->connect->query($query);
            // get and send all publishers
            $this->lastVersionInDatabase = $statement->fetchAll(PDO::FETCH_ASSOC)[0]["MAX(" . $column_name . ")"];

        } catch (PDOException $e) {
            throw $e;
        }

    }

    /**
     * @param $decodeInformation
     * @param bool $want_index
     * @return mixed
     * @uses check_big_version
     */
    public function lastVersionFromServer($decodeInformation, bool $want_index=false)
    {
        //give max version or index it  for check with other
        $max = $decodeInformation[0]->nameVersion;
        $index_max = 0;
        for ($i = 1; $i < count($decodeInformation);
             $i++) {
            if ($max < $decodeInformation[$i]->nameVersion) {
                $max = $decodeInformation[$i]->nameVersion;
                $index_max = $i;
            }
        }
        if ($want_index == true)
            return $index_max;
        return $max;

    }

    /**
     * @param string $url =>for example:'https://www.server.com/api.php'
     * @param int $current_version current version from database
     * @return bool has new version or hasn't
     */

    public function checkVersion(int $current_version, array $array_versions): bool
    {

        //max version from server
        $maxVersion = $this->lastVersionFromServer($array_versions);

        //check current version with the version from server
        if ($current_version < $maxVersion)
            return true;
        else
            return false;
    }

    /**
     * @param string $url
     * @return array
     */
    public function versions(string $url): array
    {
        // Initialize a CURL session.
        $ch = curl_init();
        // Return Page contents.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //grab URL and pass it to the variable.
        curl_setopt($ch, CURLOPT_URL, $url);
        $server_information = curl_exec($ch);

        //create array from json and return
        return json_decode($server_information);

    }

    public function setInformationInDatabase(Config_inc $connect, array $array_of_versions)
    {
        //give last version index from database
        $max_index = $this->lastVersionFromServer($array_of_versions, true);
        //give information of version
        $version = $array_of_versions[$max_index]->nameVersion;
        $name = $array_of_versions[$max_index]->nameFile;
        $describe = $array_of_versions[$max_index]->describe;
        //set in database
        $connect->insert("version", ['numberVersion', '`describe`', 'name'], [$version, $describe, $name]);
        $this->lastNewNameVersion = $name;
    }

    /**
     * @return string
     */
    public function getLastVersionInDatabase(): string
    {
        return $this->lastVersionInDatabase;
    }

    /**
     * @return string
     */
    public function getLastNewNameVersion(): string
    {
        return $this->lastNewNameVersion;
    }


}