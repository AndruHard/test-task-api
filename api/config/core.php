<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

$home_url="http://test-task/api/";

// страница указана в параметре URL, страница по умолчанию одна
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

// установка количества записей на странице
$records_per_page = 10;

// расчёт для запроса предела записей
$from_record_num = ($records_per_page * $page) - $records_per_page;
