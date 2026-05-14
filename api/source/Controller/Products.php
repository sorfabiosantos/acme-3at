<?php

namespace source\Controller;

use Source\Controller\Api;
use Source\Models\Product;

class Products extends Api
{

    public function productsList (array $data)
    {
        $product = new Product();
        $response = $product->listAll();

        $this->call("200","success","Lista de produtos","success"
        )->back($response);
    }

    public function productsListById (array $data): void
    {
        //var_dump($data);
        if(!filter_var($data["productId"], FILTER_VALIDATE_INT)) {
            $this->call(
                400,
                "bad_request",
                "ID do produto é obrigatório e deve ser um número inteiro",
                "error"
            )
                ->back(null);
            return;
        }

        $product = new Product();
        /*$this->call("200","success","Produto encontrado","success")
            ->back();*/
        $product = $product->listById($data["productId"]);
        if(!$product) {
            $this->call(
                404,
                "not_found",
                "Produto não encontrado",
                "error"
            )->back(null);
            return;
        }

        $this->call("200","success","Produto encontrado","success")
            ->back($product);
    }

}