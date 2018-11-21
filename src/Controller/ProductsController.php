<?php

namespace Grubitz\Controller;

use Grubitz\Category;
use Grubitz\Product;

class ProductsController extends ShopBaseController
{
    public function show()
    {
        $productId = $this->routeInfo[1];
        $this->variables['product'] = Product::getById($productId);
        $categoryId = $this->variables['product']['category_id'];
        $this->variables['category'] = Category::getById($categoryId);
        $this->variables['selectedCategoryAncestry'] = Category::getAncestorsAndSelfIds($categoryId);

        $this->render('product');
    }
}
