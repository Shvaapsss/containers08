<?php
require_once("testframework.php");
require_once("config.php");
require_once("modules/database.php");
require_once("modules/page.php");

$passed = 0;
$total = 0;

function testCreateAndRead() {
    global $config;
    $db = new Database($config["db"]["path"]);
    $id = $db->Create("page", ["title" => "Test", "content" => "Hello"]);
    $item = $db->Read("page", $id);
    return assertExpression($item["title"] == "Test", "Create & Read works", "Create & Read failed");
}

function testUpdate() {
    global $config;
    $db = new Database($config["db"]["path"]);
    $id = $db->Create("page", ["title" => "UpdateMe", "content" => "Old"]);
    $db->Update("page", $id, ["title" => "Updated"]);
    $item = $db->Read("page", $id);
    return assertExpression($item["title"] == "Updated", "Update works", "Update failed");
}

function testDelete() {
    global $config;
    $db = new Database($config["db"]["path"]);
    $id = $db->Create("page", ["title" => "DeleteMe", "content" => "Bye"]);
    $db->Delete("page", $id);
    $item = $db->Read("page", $id);
    return assertExpression($item === null, "Delete works", "Delete failed");
}

function testPageRender() {
    $page = new Page("templates/index.tpl");
    $html = $page->render(["title" => "Test", "content" => "Page"]);
    return assertExpression(strpos($html, "<h1>Test</h1>") !== false, "Render works", "Render failed");
}

$tests = ["testCreateAndRead", "testUpdate", "testDelete", "testPageRender"];
foreach ($tests as $test) {
    $total++;
    if ($test()) $passed++;
}

echo "\n$passed/$total tests passed.\n";
