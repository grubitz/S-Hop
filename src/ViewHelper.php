<?php

namespace Grubitz;

class ViewHelper
{
    public static function printTree($branch)
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
}
