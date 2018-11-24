<?php

namespace Grubitz;

class ViewHelper
{
    public static function printTree($categories, $expandedIds = [])
    {
        echo '<ul>';
        foreach ($categories as $category) {
            echo "<li data-category-id='{$category['id']}'".(in_array($category['id'], $expandedIds) ? " class='expanded'" : "").">";
            $classes = [];
            $classes[] = 'category-toggle';
            $classes[] = count($category['children']) ? 'arrow' : 'diamond';
            echo '<a class="' . implode(' ', $classes) . '"></a>';
            echo "<a href='/c/{$category['id']}'>{$category['name']} ({$category['product_count']})</a>";
            if (count($category['children'])) {
                self::printTree($category['children'], $expandedIds);
            }
            echo '</li>';
        }
        echo "</ul>\n";
    }
}
