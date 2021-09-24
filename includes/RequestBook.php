<?php


class RequestBook
{
    function changeStateRequest($id_book, $state)
    {
        self::$db->edit("requestbook", ['state' => $state],
            "id_book='" . $id_book . "'");

    }
}