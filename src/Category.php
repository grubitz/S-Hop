<?php

namespace Grubitz;

class Category
{
    public static function getTree()
    {
        $db = new Database();

        $result = $db->query("SELECT * FROM categories ORDER BY parent_category_id, name");

        $categories = $result->fetchAll();

        $catgoriesByParentID = [];
        $rootCategories = [];
        foreach ($categories as $category) {
            if (!isset($category['parent_category_id'])) {
                $rootCategories[] = $category;
            } else {
                $catgoriesByParentID[$category['parent_category_id']][] = $category;
            }
        }

        return self::createTree($catgoriesByParentID, $rootCategories);
    }

    public static function getById($categoryId)
    {
        $db = new Database();

        $statement = $db->prepare("SELECT id, name FROM categories WHERE id=:categoryId");
        $statement->bindValue(':categoryId', $categoryId);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAncestorsAndSelfIds($categoryId)
    {
        $db = new Database();

        $nextId = $categoryId;
        $parentIds = [];

        while (isset($nextId)) {
            $parentIds[] = (int)$nextId;
            $statement = $db->prepare("SELECT parent_category_id FROM categories WHERE id=:categoryId");
            $statement->bindValue(':categoryId', $nextId);
            $statement->execute();

            $nextId = $statement->fetchColumn();
        }
        return $parentIds;
    }

    private static function createTree(&$list, $parent)
    {
        $tree = [];
        foreach ($parent as $category) {
            $category['children'] = [];
            if (isset($list[$category['id']])) {
                $category['children'] = self::createTree($list, $list[$category['id']]);
            }
            $tree[] = $category;
        }
        return $tree;
    }
}
