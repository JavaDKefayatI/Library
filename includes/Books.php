<?php

class Books
{
    // information for book
    private string $name_book = "", $author = "", $year = "";

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $id for book
     * @throws Exception
     */
    public function setInformationBook(Config_inc $db, string $id)
    {
        $books = $db->selectOrSearch("books", ['*'], "id='" . $id . "'");

        if (count($books) > 0) {
            $this->name_book = $books[0]["Name"];
            $this->year = $books[0]["Year"];
            $this->author = $books[0]["Author"];

        } else
            throw new Exception("id not found");
    }

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $name the name for book
     * @param string $author the author who write book
     * @param string $year the year that print
     * @return bool
     */
    function createBook(Config_inc $db, string $name, string $author, string $year): bool
    {
        $name = Functions_inc::test_input($name);
        $author = Functions_inc::test_input($author);
        $year = Functions_inc::test_input($year);

        $list_of_info = [$name, $author, $year];

        if (!Functions_inc::isEmpty($list_of_info)) {

            $db->insert("books", ["Name", "Year", "Author"],
                [(string)$name, (string)$year, (string)$author]);

            return true;
        } else
            return false;

    }

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $name the name for book
     * @param string $author the author who write book
     * @param string $year the year that print
     * @param string $id the id for book
     * @return bool
     */
    public function doEdit(Config_inc $db, string $name, string $author, string $year, string $id): bool
    {
        $name = Functions_inc::test_input($name);
        $author = Functions_inc::test_input($author);
        $year = Functions_inc::test_input($year);

        $list_of_info = [$name, $author, $year];

        if (!empty($list_of_info)) {

            $db->edit("books", ['Name' => $name, "Year" => $year, "Author" => $author],
                "id='" . $id . "'");

            $this->name_book = $name;
            $this->author = $author;
            $this->year = $year;
            return true;
        }
        return false;
    }

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $name a name that give from user
     * @param string $author a author that give from user
     * @param string $year a year that give from user
     * @param string $id the id use for set information
     * @return string for error or direct
     */
    public function editBook(Config_inc $db, string $name, string $author, string $year, string $id): string
    {
        $error = "";
        if ($name == $this->getNameBook() && $author == $this->getAuthor()
            && $year == $this->getYear()) {
            $error = "Your information has not change<br>";
        } else {
            if ($this->doEdit($db, $name, $author, $year, $id)) {
                return $error;
            } else {
                $error = "Your information was not successfully registered<br>";
            }
        }
        return $error;
    }


    /**
     * @param Config_inc $db
     * @param string $id_book
     * @return string status of input id
     */

    public function getStatus(Config_inc $db ,string $id_book):string{

        return $db->selectOrSearch("books",["status"],"Id=".$id_book)[0]["status"];

    }

    /**
     * @return string
     */
    public
    function getNameBook(): string
    {
        return $this->name_book;
    }

    /**
     * @return string
     */
    public
    function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public
    function getYear(): string
    {
        return $this->year;
    }


}