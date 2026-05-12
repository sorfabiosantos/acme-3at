<?php

namespace source\Controller;

use Source\Controller\Api;
use Source\Models\Product;

class Products extends Api
{

    public function productsList ()
    {
        $product = new Product();
        $response = $product->listAll();

        $this->call("200","success","Lista de produtos","success"
        )->back($response);
    }

    public function productListById (array $data): void
    {
        $product = new Product();
        $response = $product->selectById($data["productId"]);
        $this->call("200","success","Produto encontrado","success")
            ->back($response);
    }

}