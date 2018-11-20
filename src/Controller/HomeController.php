<?php

namespace Grubitz\Controller;

class HomeController extends ShopBaseController
{
    public function show()
    {
        $this->render('home');
    }
}
