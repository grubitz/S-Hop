<?php
require 'vendor/autoload.php';

use Grubitz\Database;
use Symfony\Component\Dotenv\Dotenv;
use Grubitz\Category;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$db = new Database();

$tree = Category::getTree();

function printTree($branch)
{
    echo '<ul>';
    foreach ($branch as $twig) {
        echo '<li data-category-id="' . $twig['id'] . '">';
        echo '<a class="category-toggle ' . (count($twig['children']) ? 'arrow' : 'diamond') . '"></a>';
        echo "<a href='/c/{$twig['id']}'>{$twig['name']}</a>";
        if (count($twig['children'])) {
            printTree($twig['children']);
        }
        echo '</li>';
    }
    echo "</ul>\n";
}

// / - strona glowna
// /c/:category_id


if (preg_match('#^/c/([1-9][0-9]*)$#', $_SERVER['REQUEST_URI'], $matches)) {
    $categoryId=$matches[1];
    $statement = $db->prepare("SELECT * FROM products WHERE category_id=:categoryId");
    $statement->bindValue(':categoryId', $categoryId);
    $statement->execute();
    $products = $statement->fetchAll();

    $statement = $db->prepare("SELECT id, name FROM categories WHERE id=:categoryId");
    $statement->bindValue(':categoryId', $categoryId);
    $statement->execute();
    $category = $statement->fetch();
} elseif (preg_match('#^/$#', $_SERVER['REQUEST_URI'])) {
    //strona glowna
} else {
    header('Content-type: text/plain', true, 404);
    die('error 404 not found');
}

// print_r($dupa);
// print_r($_SERVER);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>S-hop</title>
    <link href="/style.css" rel="stylesheet">
    <?php
        if (isset($products)) {
            echo "<meta name='category-id' content='{$category['id']}'/>";
        }
    ?>
  </head>
  <body>
  <?php
    printTree($tree);
    if (isset($products)) {
        echo "<h1>{$category['name']}</h1>";
        echo "<table>";
        foreach ($products as $index => $product) {
            echo "<tr>";
            echo "<td>" . ($index+1) . "</td>";
            echo "<td>{$product['name']}</td>";
            echo "<td> $" . number_format($product['price'] / 100, 2) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h1>Welcome to S-hop</h1>";
    }
  ?>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="/index.js"></script>
  </body>
</html>
