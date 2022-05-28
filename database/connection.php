<?php
const DB_SERVER = "phpshop";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "userlist";

$mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$mysqli->query("SELECT DATABASE()");
$mysqli->set_charset("utf8");


