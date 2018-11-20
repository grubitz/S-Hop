<?php

namespace Grubitz\Controller;

use Grubitz\Category;

abstract class ShopBaseController extends AbstractController
{
    protected function initCommonVariables()
    {
        $this->variables['categoryTree'] = Category::getTree();
    }
}
