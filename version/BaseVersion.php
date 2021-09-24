<?php
include "../includes/Config_inc.php";

// Create table version
$db->createTable('version',
    ["numberVersion int(6) NOT NULL",
        "TimeOfSet datetime(6) NOT NULL DEFAULT current_timestamp(6)"]);

$db->insert("version",['numberVersion'],[1]);


// Create table books

$db->createTable('books',
    [" Id int(5) NOT NULL AUTO_INCREMENT ",
        "PRIMARY KEY (`Id`)",
        "Name varchar(35) NOT NULL ",
        "Year date NOT NULL ",
        "Author varchar(35) NOT NULL "]);

$db->insert("books", ['Name', 'Year', 'Author'], ['David', '2021-08-30', 'Jalal']);
$db->insert("books", ['Name', 'Year', 'Author'], ['Good bye party', '1380-02-01', 'jafar']);
$db->insert("books", ['Name', 'Year', 'Author'], ['Kazem', '1230-02-01', 'ba']);
$db->insert("books", ['Name', 'Year', 'Author'], ['ebram', '1300-01-02', 'hadi']);

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
        "id_book int(20) NOT NULL",
        "name varchar(200) NOT NULL",
        "family varchar(200) NOT NULL",
        "username varchar(200) NOT NULL",
        "email varchar(100) NOT NULL",
        "nameBook varchar(100) NOT NULL",
        "author varchar(100) NOT NULL",
        "status int(10) NOT NULL"]);

