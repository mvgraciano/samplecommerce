<?php

namespace Source\Controllers;
use Source\Core\View;
use Source\Models\JueriClient;
class EcommerceController {

    private $view;

    public function __construct()
    {
        $this->view = new View(CONF_VIEW_PATH);
    }
    
    public function home()
    {
        $products = (new JueriClient())->listProducts();

        echo $this->view->render('home', [
            'products' => $products
        ]);
    }

}