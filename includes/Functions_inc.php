<?php


class   Functions_inc
{


    public static function createHashCode($message): string
    {
        return hash("tiger192,3", $message);
    }

    function addRowRequests(): string
    {
        $req = self::$db->selectOrSearch('requestbook', [' * '], "state=0");
        $rows = "";
        $str = "";

        foreach ($req as $item) {
            $id = $item['id'];
            $id_book = $item['id_book'];
            $name = $item['name'];
            $family = $item['family'];
            $user = $item['username'];
            $email = $item['email'];
            $nameBook = $item['nameBook'];
            $author = $item['author'];

            $str .= '  <tr>' .

                '<td > ' . $id . '</td >' .
                '<td > ' . $id_book . '</td >' .
                '<td > ' . $name . '</td >' .
                '<td > ' . $family . ' </td >' .
                '<td > ' . $user . '</td >' .
                '<td > ' . $email . '</td >' .
                '<td > ' . $nameBook . '</td >' .
                '<td > ' . $author . '</td >' .
                "<td ><form class='pt-2' method = 'post' >" .
                '<button type = "submit" class="bg-danger mr-1" name="reject" value="0">' .
                '<i class="fa fa-times fa-lg  text-white"></i></button>' .
                '<button type="submit" name="accept" class="bg-success" value="' . $id_book . '">' .
                '<i class="fa fa-check  fa-lg  text-white"></i>' .
                '</button>
                </form>
            </td>
        </tr>';
        }
        return $str;
    }

    function addRow($db ,$is_req = true): string
    {

        $users = $db->selectOrSearch('books', [' * ']);
        $rows = "";
        foreach ($users as $item) {
            $req = $db->selectOrSearch('requestbook', [' * '], "nameBook");
            $id = $item['Id'];
            $name = $item['Name'];
            $printYear = $item['Year'];
            $author = $item['Author'];

//add table row for information book
            $rows .= " <tr class='text - center'>"
                . "<td>" . $id . "</td>"
                . "<td>" . $name . "</td>"
                . "<td>" . $author . "</td>"
                . "<td>" . $printYear . "</td>";
            if ($is_req) {
                $rows .= "<td class='text-center'>
  <a href='CreateOrEditBook.php?id={$id}' class='mr-1'><button  class='fa fa-pencil btn bg-transparent  p-1 '></button></a>
  <a href='login/DeleteBook.php?id ={$id}'><button  class='fa fa-trash btn bg-transparent p-1' ></button></a>
  </td></tr>";
            } else {

                $rows .= "
<td class='text-center p-2'>
<button class='btn btn-secondary'>
Request
</button>
  </td></tr>";

            }

        }
        return $rows;
    }

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $data
     * @param string $name_data_in_database
     * @param string $table a name that you want
     * @param string $condition for example : username=Jack2019 ...
     * @return bool
     */

    public static function unique(Config_inc $db,string $data, string $name_data_in_database, string $table, string $condition = ""): bool
    {
        $str = $name_data_in_database . "='" . Functions_inc::test_input($data) . "' ";
        if ($condition != "")
            $str .= " AND " . $condition;


        $result = $db->selectOrSearch($table, [$name_data_in_database], $str);

        if (count($result) > 0) return false;
        return true;
    }



    public static function isEmpty($list): bool
    {
        foreach ($list as $item)
            if (empty($item))
                return true;
        return false;
    }

    public static function test_input($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }


}





