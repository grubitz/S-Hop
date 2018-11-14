<?php
require 'vendor/autoload.php';

use Grubitz\Database;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$db = new Database();

$faker = Faker\Factory::create();

$db->query("SET FOREIGN_KEY_CHECKS=0");
$db->query("TRUNCATE TABLE categories");
$db->query("TRUNCATE TABLE products");
$db->query("SET FOREIGN_KEY_CHECKS=1");


for ($i = 0; $i < 10; $i++) {
    $companyName = $faker->company;
    $query = "INSERT INTO categories (name) VALUES (:name)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $companyName);
    $statement->execute();
}


for ($i = 0; $i < 100; $i++) {
    $randID = mt_rand(1, 9);
    $companyName = $faker->company;
    $query = "INSERT INTO categories (name, parent_category_id) VALUES (:name, :parentID)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $companyName);
    $statement->bindValue(':parentID', $randID);
    $statement->execute();
}

for ($i = 0; $i < 100; $i++) {
    $randID = mt_rand(11, 100);
    $companyName = $faker->company;
    $query = "INSERT INTO categories (name, parent_category_id) VALUES (:name, :parentID)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $companyName);
    $statement->bindValue(':parentID', $randID);
    $statement->execute();
}

$categoryIds = $db->query("SELECT id FROM categories")->fetchAll();

for ($i = 0; $i < 5000; $i++) {
    $productName = $faker->name;
    $productPrice = mt_rand(5, 200000);
    $productCode = $faker->isbn10;
    $productCategoryId = $categoryIds[mt_rand(0, count($categoryIds)-1)]['id'];

    $query = "INSERT INTO products (name, price, product_code, category_id) VALUES (:name, :price, :product_code, :category_id)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $productName);
    $statement->bindValue(':price', $productPrice);
    $statement->bindValue(':product_code', $productCode);
    $statement->bindValue(':category_id', $productCategoryId);
    $statement->execute();
}
