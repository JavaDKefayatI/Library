<?php
include "../includes/Config_inc.php";
/**
 * this part is version1
 */

// Create connect for database
$db = new Config_inc("library2");

// Create table version
$db->createTable('version',
    ["numberVersion int(6) NOT NULL",
        "TimeOfSet datetime(6) NOT NULL DEFAULT current_timestamp(6)"]);


$db->alter("version", "`describe` TEXT NOT NULL", "TimeOfSet");
$db->alter("version", "name varchar(35) NOT NULL ", "`describe`");

$db->insert("version", ['numberVersion', '`describe`', 'name'], [1,'this base version','BaseVersion.php']);


// Create table books

$db->createTable('books',
    [" Id int(5) NOT NULL AUTO_INCREMENT ",
        "PRIMARY KEY (`Id`)",
        "Name varchar(35) NOT NULL ",
        "Year date NOT NULL ",
        "Author varchar(35) NOT NULL "]);

$db->alter("books","status int(5) default 0","Author");

$db->insert("books", ['Name', 'Year', 'Author'], ['David', '2021-08-30', 'Jalal']);
$db->insert("books", ['Name', 'Year', 'Author'], ['Good bye party', '1380-02-01', 'jafar']);
$db->insert("books", ['Name', 'Year', 'Author'], ['Kazem', '1230-02-01', 'ba']);
$db->insert("books", ['Name', 'Year', 'Author'], ['kamal', '1300-01-02', 'hadi']);
$db->insert("books", ['Name', 'Year', 'Author'], ['kazem', '1300-01-02', 'royah']);
$db->insert("books", ['Name', 'Year', 'Author'], ['kashan', '1300-01-02', 'rahmani']);
$db->insert("books", ['Name', 'Year', 'Author'], ['reza', '1300-01-02', 'karimi']);
$db->insert("books", ['Name', 'Year', 'Author'], ['reza', '1300-01-02', 'karimi']);
$db->insert("books", ['Name', 'Year', 'Author'], ['gholam', '1300-01-02', 'kabiri']);

// Create table users

$db->createTable('users',
    ["id int(5) NOT NULL AUTO_INCREMENT",
        "PRIMARY KEY (`id`)",
        "name varchar(20) NOT NULL",
        "family varchar(20) NOT NULL",
        "username varchar(20) NOT NULL",
        "password varchar(200) NOT NULL",
        "email varchar(200) default NULL",
        "phone varchar(250) NOT NULL",
        "key_log varchar(200) NOT NULL"]);

$db->insert("users",
    ['name', 'family', 'username', 'password', 'email', 'phone', 'key_log'],
    ['Javad', 'Kefayati', 'javad936', 'b9b337867d62a2678655ba45f0ea30bd04dc65ef40425040', 'javad936807@gmail.com',
        '09368075504', 'f60a4d9103b2b1bae6b3b4e5fadb88d8a58f712216ff65f0']);


// Create table request book

$db->createTable('requestbook',
    [" id int(20) NOT NULL AUTO_INCREMENT",
        "PRIMARY KEY (`id`)",
        "id_user int(20) NOT NULL",
        "id_book int(20) NOT NULL",
        "time_request datetime(6) NOT NULL DEFAULT current_timestamp(6)",
        "time_check datetime(6)   NULL DEFAULT NULL",
        "time_return datetime(6)   NULL DEFAULT NULL",
        "is_accept int(20) default 0",
        "is_return int(20) default 0",]);





