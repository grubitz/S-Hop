<?php
require 'vendor/autoload.php';

$faker = Faker\Factory::create();


$db = new PDO('mysql:dbname=s_hop;host=localhost', 'debian-sys-maint', '0S2cpSOspNd1gBUC');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->query("TRUNCATE TABLE categories");

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
