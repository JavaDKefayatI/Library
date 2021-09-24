<?php

class Users
{
    // information for user
    private string $name = "", $family = "", $user = "", $pass = "", $email = "", $phone = "", $key_log = "";


    /**
     * @param Config_inc $db use for connect to data base
     * @param string $keyHash this parameter must give from cookie or session
     * @throws Exception
     */

    public function setInformationUser(Config_inc $db, string $keyHash)
    {
        $user = $db->selectOrSearch("users", ['*'], "key_log='" . $keyHash . "'");

        if (count($user) > 0) {
            $this->name = $user[0]["name"];
            $this->family = $user[0]["family"];
            $this->user = $user[0]["username"];
            $this->pass = $user[0]["password"];
            $this->phone = $user[0]["phone"];
            $this->key_log = $user[0]["key_log"];
        } else
            throw new Exception("username not found");

    }

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $name Give from user
     * @param string $family Give from user
     * @param string $user Give from user
     * @param string $pass1 Give from user
     * @param string $pass2 Give from user
     * @param string $email Give from user
     * @param string $phone Give from user
     * @return string if sign up hasn't any alert is true
     */
    public static function signUp(Config_inc $db, string $name, string $family, string $user, string $pass1,
                                  string $pass2, string $email, string $phone): string
    {
        $name = Functions_inc::test_input($name);
        $family = Functions_inc::test_input($family);
        $user = Functions_inc::test_input($user);
        $pass1 = Functions_inc::test_input($pass1);
        $pass2 = Functions_inc::test_input($pass2);
        $email = Functions_inc::test_input($email);
        $phone = Functions_inc::test_input($phone);

        $message = "";

        $uniqueUser = Functions_inc::unique($db, $user, "username", "users");
        $uniqueEmail = Functions_inc::unique($db, $email, "email", "users");

        if (!$uniqueUser)
            $message = "Username already registered<br>";
        if (!$uniqueEmail)
            $message .= "Email already registered";


        if ($message == "" && self::formatEmail($email) && self::formatPhone($phone)
            && self::compareTowPass($pass1, $pass2) &&
            !Functions_inc::isEmpty([[$name, $family, $user, $pass1, $pass2, $email, $phone]])) {
            //convert $pass to hashCode
            $hash_pass = Functions_inc::createHashCode($user . $pass1 . "Mohammad1234");

            $key_log = Functions_inc::createHashCode($user . $pass1 . "javad1234");

            $db->insert("users", ['name', "family", "username", "password", "email", "phone", "key_log"],
                [(string)$name, (string)$family, (string)$user, (string)$hash_pass, (string)$email, (string)$phone, (string)$key_log]);

            return $message;
        }
        return $message;
    }

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $name
     * @param string $pass
     * @return bool
     */

    public static function checkUser(Config_inc $db, string $name, string $pass): bool
    {

        $user = Functions_inc::test_input($name);
        $pass = Functions_inc::test_input($pass);

        $list = [$user, $pass];

        if (!Functions_inc::isEmpty($list)) {
            $hash_pass = Functions_inc::createHashCode($user . $pass . "Mohammad1234");
            $is_information = !Functions_inc::unique($db, $user, "username", "users", "password ='" . $hash_pass . "'");
            $key_log = Functions_inc::createHashCode($user . $pass . "javad1234");

            if ($is_information) {
                setcookie("-jk-", $key_log, time() + (9000 * 10000), "/");
                return true;
            } else
                return false;

        } else
            return false;

    }

    /**
     * @param string $email
     * @return bool
     */

    public static function formatEmail(string $email): bool
    {
        return preg_match("/^\S+@\S+\.com$/", $email);

    }

    public static function showMessage($checkPost, $unique, $message)
    {
        if ($checkPost)
            if (!$unique)
                echo $message;
    }

    public function editProfile($db, $name, $family, $phone): bool
    {

        $name_post = Functions_inc::test_input($name);
        $family_post = Functions_inc::test_input($family);
        $phone_post = Functions_inc::test_input($phone);

        $list_of_info = [$name_post, $family_post, $phone_post];

        if (!Functions_inc::isEmpty($list_of_info) && $this->formatPhone($phone_post)) {
            $db->edit("users", ['name' => $name, "family" => $family, "phone" => $phone],
                "username='" . $this->user . "'");

            $this->name = $name_post;
            $this->family = $family_post;
            $this->phone = $phone_post;
            return true;
        }
        return false;

    }

    public static function formatPhone($phone): bool
    {
        return is_numeric($phone) && (strlen($phone) == 11);
    }

    public static function compareTowPass($pass1, $pass2): bool
    {
        return $pass1 == $pass2;
    }

    public static function isLogOut(): bool
    {
        if (isset($_COOKIE['-jk-'])) {
            return true;
        }
        return false;
    }

    /**
     * @param Config_inc $db use for connect to data base
     * @return bool
     * @throws Exception
     */
    public function isLogIn(Config_inc $db): bool
    {

        if (isset($_COOKIE['-jk-'])) {
            $key = $_COOKIE['-jk-'];
            $this->setInformationUser($db, $key);

            $key_log = $this->getKeyLog();

            if ($key_log != $_COOKIE['-jk-'])
                return true;

            return false;

        }
        return true;

    }

    /**
     * @param Config_inc $db use for connect to data base
     * @param string $name the name that give from client
     * @param string $family the family that give from client
     * @param string $phone the phone that give from client
     * @return string
     */

    public function checkProfile(Config_inc $db,string $name,string $family,string $phone): string
    {
        $name = Functions_inc::test_input($name);
        $family = Functions_inc::test_input($family);
        $phone = Functions_inc::test_input($phone);

        if ($name == $this->getName() &&
            $family == $this->getFamily() && $phone == $this->getPhone()) {

            return "Your information has not change";
        } else {

            if ($this->editProfile($db, $name, $family, $phone)) {
                return "Your information was successfully registered";

            } else {
                return "Your information was not successfully registered";
            }
        }
    }

    /**
     * @return string
     */
    public
    function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public
    function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public
    function getFamily(): string
    {
        return $this->family;
    }

    /**
     * @return string
     */
    public
    function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public
    function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public
    function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public
    function getKeyLog(): string
    {
        return $this->key_log;
    }

}