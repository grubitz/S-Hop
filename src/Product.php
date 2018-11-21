<?php

namespace Grubitz;

class Product
{
    public static function getProductsByCategoryId($categoryId)
    {
        $db = new Database();

        $statement = $db->prepare("SELECT * FROM products WHERE category_id=:categoryId");
        $statement->bindValue(':categoryId', $categoryId);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getById($productId)
    {
        $db = new Database();

        $statement = $db->prepare("SELECT * FROM products WHERE id=:productId");
        $statement->bindValue(':productId', $productId);
        $statement->execute();

        return $statement->fetch();
    }
}
