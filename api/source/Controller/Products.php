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

        if(!filter_var($data["productId"], FILTER_VALIDATE_INT))      {
            $this->call(
                400,
                "bad_request",
                "ID do produto é obrigatório e deve ser um número inteiro",
                "error"
            )->back();
            return;
        }
        $product = new Product();
        $response = $product->selectById($data["productId"]);
        //var_dump($response);
        if(!$response){
            $this->call(
                404,
                "not_found",
                "Produto não encontrado",
                "error"
            )->back();
            return;
        }
        $this->call("200","success","Produto encontrado","success")
            ->back($response);
    }

}