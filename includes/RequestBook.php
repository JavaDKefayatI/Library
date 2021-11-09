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
        //this statement changed status (available or wait to wait )
        $db->edit("books",['status'=>'1'],"Id = ".$id_book);
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


}