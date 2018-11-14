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

        function createTree(&$list, $parent)
        {
            $tree = [];
            foreach ($parent as $category) {
                $category['children'] = [];
                if (isset($list[$category['id']])) {
                    $category['children'] = createTree($list, $list[$category['id']]);
                }
                $tree[] = $category;
            }
            return $tree;
        }

        return createTree($catgoriesByParentID, $rootCategories);
    }

    public static function getById($categoryId)
    {
        $db = new Database();

        $statement = $db->prepare("SELECT id, name FROM categories WHERE id=:categoryId");
        $statement->bindValue(':categoryId', $categoryId);
        $statement->execute();

        return $statement->fetch();
    }
}
