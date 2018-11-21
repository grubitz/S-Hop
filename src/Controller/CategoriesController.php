<?php

namespace Grubitz\Controller;

use Grubitz\Category;
use Grubitz\Product;

class CategoriesController extends ShopBaseController
{
    public function show()
    {
        $categoryId = $this->routeInfo[1];
        $this->variables['products'] = Product::getProductsByCategoryId($categoryId);
        $this->variables['category'] = Category::getById($categoryId);
        $this->variables['selectedCategoryAncestry'] = Category::getAncestorsAndSelfIds($categoryId);

        $this->render('category');
    }
}
