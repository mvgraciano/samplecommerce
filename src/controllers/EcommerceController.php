<?php

namespace Source\Controllers;

use Pecee\Http\Request;
use Source\Core\View;
use Source\Models\JueriClient;

class EcommerceController
{

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

    public function getProducts()
    {
        $term = url()-> getParam('search');
        $products = (new JueriClient())->listProducts($term);
        return json_encode($products);
    }

    public function checkoutPage()
    {
        echo $this->view->render('checkout', []);
    }

    public function checkout()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $items = $data['items'];

        $sale = [
            "comprador" => [
                "tipo" => "jurídico",
                "nome" => "Maria Joaquina Silveira",
                "cpf_cnpj" => "475.007.330-03",
                "email" => "joaquina@email.com"
            ],
            "itens" => [],
            "forma_pagamento" => [
                "boleto" => [
                    "valor" => "",
                    "data_vencimento" => "",
                    "numero_boleto" => 1
                ]
            ]
        ];

        foreach ($items as $item) {
            array_push($sale['itens'], [
                "produto" => [
                    "codigo_barras" => $item['barCode']
                ],
                "quantidade" => $item['quantity'],
                "valor_unitario" => $item['price'],
                "fk_tipo_preco_id" => 1
            ]);
        }

        (new JueriClient())->checkout($sale);
    }
}
