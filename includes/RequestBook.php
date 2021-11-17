<?php


class RequestBook
{
    function changeStateRequest($id_book, $state)
    {
        self::$db->edit("requestbook", ['state' => $state],
            "id_book='" . $id_book . "'");

    }

    /**
     * @param Config_inc $db
     * @param string $id_user
     * @param string $id_book
     */
    public function setRequest(Config_inc $db, string $id_user, string $id_book): void
    {

        //set data to request table
        $db->insert("requestbook", ["id_user", "id_book"], [$id_user, $id_book]);
    }

    /**
     * @param Config_inc $db database
     * @param string $id_user
     * @param string $id_book
     * @return bool return true if not exist this id(book and user)
     */

    public function isRequest(Config_inc $db, string $id_user, string $id_book): bool
    {

        $req = $db->selectOrSearch("requestbook", ["id"], "id_user=" . $id_user . " and id_book =" . $id_book);

        if (count($req) == 0) return false;
        return true;
    }

    /**
     * @param Config_inc $db
     * @param string $id_request
     * @return bool
     */

    public function checkReturn(Config_inc $db, string $id_request): bool
    {
        $is_return = $db->selectOrSearch("requestbook", ["is_return"], "id =" . $id_request)[0]["is_accept"];
        if ($is_return != "0") return false;
        return true;

    }

    /**
     * @param Config_inc $db
     * @param string $id
     */

    public function setReturned(Config_inc $db, string $id)
    {
        // edit request and set time return and is_accept=1
        $db->edit("requestbook", ["is_return" => "1"], "id =" . $id);
        $db->setCurrentTime("requestbook", "is_return", "id =" . $id);

        $id_book = $db->selectOrSearch("requestbook", ["id_book"], "id= " . $id)[0]["id_book"];
        $db->edit("books", ["status" => "0"], "Id = " . $id_book);
    }


}