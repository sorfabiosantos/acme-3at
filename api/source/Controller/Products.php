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

    public function insert (array $data): void
    {
        if(!isset($data["category_id"]) || !isset($data["name"]) || !isset($data["price"]) ||
            empty($data["category_id"]) || empty($data["name"]) || empty($data["price"])) {
            $this->call(
                400,
                "bad_request",
                "Os campos category_id, name e price são obrigatórios",
                "error"
            )->back();
            return;
        }

        $product = new Product(null,$data["category_id"],$data["name"],$data["price"]);
        $product->insert();
        $product = [
            "id" => $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "category_id" => $product->getCategoryId()
        ];
        $this->call("201","created","Produto inserido com sucesso","success")
            ->back($product);
    }

    public function update (array $data)
    {
        echo "Atualizar produto ";
        var_dump($data);
    }

    public function delete (array $data)
    {
        echo "Deletar produto ";
        var_dump($data);
    }

}