<?php

class Admin
{
    /**
     * @param Config_inc $db
     * @param string $id_request
     */

    public function setAccept(Config_inc $db, string $id_request)
    {

        $db->edit("requestbook", ["status" => "1"], "id=" . $id_request);
        $db->setCurrentTime("requestbook", "time_check", "id=" . $id_request);

        $id_book = $db->selectOrSearch("requestbook", ["id_book"], "id=" . $id_request)[0]["id_book"];
        //reject another request
        $db->edit("requestbook", ["status" => "-1"], "id_book=" . $id_book . " and status=0");
        $db->setCurrentTime("requestbook", "time_check", "id_book=" . $id_book . " and status=0");

        //change status book
        $db->edit("books", ["status" => "2"], "Id =" . $id_book);

    }

    /**
     * @param Config_inc $db
     * @param string $id_req
     * @return bool
     */
    public function checkRequest(Config_inc $db, string $id_req): bool
    {
        $status = $db->selectOrSearch("requestbook", ["status"], "id=" . $id_req)[0]["status"];
        if ($status == "1" || $status == "-1" || $status == "2") return false;
        return true;
    }

    /**
     * @param Config_inc $db
     * @param string $id_request
     */
    public function reject(Config_inc $db, string $id_request)
    {
        $db->edit("requestbook", ["status" => "-1"], "id=" . $id_request);
        $db->setCurrentTime("requestbook", "time_check", "id=" . $id_request);

        $id_book = $db->selectOrSearch("requestbook", ["id_book"], "id=" . $id_request)[0]["id_book"];
        $anotherExist = $db->isExist("requestbook", ["id"], "id_book=" . $id_book . " and status=0");

        if (!$anotherExist)
            $db->edit("books", ["status" => "0"], "Id =" . $id_book);

    }

    public function createApi($db)
    {
        try {
            $query = "SELECT
                requestbook.id,
                books.Name,
                requestbook.id_user ,
                books.Author,
                requestbook.id_book ,
                requestbook.status,
                requestbook.time_check,
                requestbook.time_request,
                requestbook.time_return,
                users.username
                FROM((requestbook
                INNER JOIN users ON users.id = requestbook.id_user)
                INNER JOIN books ON books.Id = requestbook.id_book);";

            $statement = $db->connect->query($query);

            // get and send all publishers
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw $e;
        }
    }


}
