<?php

class Admin
{
    /**
     * @param Config_inc $db
     * @param string $id_request
     */

    public function setAccept(Config_inc $db, string $id_request)
    {

        $db->edit("requestbook", ["is_accept" => "1"], "id=" . $id_request);
        $id_book = $db->selectOrSearch("requestbook", ["id_book"], "id=" . $id_request)[0]["id_book"];
        //reject another request
        $db->edit("requestbook", ["is_accept" => "-1"], "id_book=" . $id_book . " and is_accept=0");
        //change status book
        $db->edit("books", ["status" => "2"], "Id =" . $id_book);

    }

    /**
     * @param Config_inc $db
     * @param string $id_req
     * @return bool
     */
    public function checkAccept(Config_inc $db, string $id_req): bool
    {
        $is_accept = $db->selectOrSearch("requestbook", ["is_accept"], "id=" . $id_req)[0]["is_accept"];
        if ($is_accept == "1" || $is_accept == "-1") return false;
        return true;
    }

    /**
     * @param Config_inc $db
     * @param string $id_request
     */
    public function reject(Config_inc $db, string $id_request)
    {
        $db->edit("requestbook", ["is_accept" => "-1"], "id=" . $id_request);
        $id_book = $db->selectOrSearch("requestbook", ["id_book"], "id=" . $id_request)[0]["id_book"];
        $anotherExist = $db->isExist("requestbook", ["id"], "id_book=" . $id_book . " and is_accept=0");

        if (!$anotherExist)
            $db->edit("books", ["status" => "0"], "Id =" . $id_book);

    }


}
