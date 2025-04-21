<?php
require_once("config.php");
require_once("modules/database.php");
require_once("modules/page.php");

$page = new Page("templates/index.tpl");
echo $page->render(["title" => "Главная", "content" => "Добро пожаловать!"]);
