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

    public function insert (array $data): void
    {
        //echo "Olá, a rota está funcionando!";
        //var_dump($data["name"], $data["price"], $data["category_id"]);

        if(!isset($data["name"]) || !isset($data["price"]) || !isset($data["category_id"]) ||
            empty($data["name"]) || empty($data["price"]) || empty($data["category_id"])) {
            $this->call(
                400,
                "bad_request",
                "Os campos name, price e category_id são obrigatórios",
                "error"
            )->back();
            return;
        }

        $product = new Product(null, $data["category_id"], $data["name"], $data["price"]);

        if(!$product->insert()){

        }

        $response = [
            "id" => $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "category_id" => $product->getCategoryId()
        ];
        $this->call("201","created","Produto cadastrado com sucesso","success")
            ->back($response);
    }

}