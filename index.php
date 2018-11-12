<?php
require 'vendor/autoload.php';

$db = new PDO('mysql:dbname=s_hop;host=localhost', 'debian-sys-maint', '0S2cpSOspNd1gBUC');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

$tree = createTree($catgoriesByParentID, $rootCategories);

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

// print_r($tree);

function printTree($branch)
{
    echo '<ul>';
    foreach ($branch as $twig) {
        echo '<li>';
        if (count($twig['children'])) {
            echo '<a class="arrow"></a>';
        }
        echo $twig['name'];
        if (count($twig['children'])) {
            printTree($twig['children']);
        }
        echo '</li>';
    }
    echo '</ul>';
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>S-hop</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
  <?php
    printTree($tree);
  ?>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="index.js"></script>
  </body>
</html>
