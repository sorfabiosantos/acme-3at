<?php

namespace Source\Controller;

use Source\Controller\Api;
use Source\Models\Store\Product;

class Products extends Api
{
    public function listById(array $data): void
    {
        /*$product = new Product();
        $product->selectById($data["product_id"]);
        echo $product->getName();
        var_dump($product);*/

        if(!isset($data["product_id"]) || empty($data["product_id"]) || !filter_var($data["product_id"], FILTER_VALIDATE_INT)) {
            $this->call(
                400,
                "bad_request",
                "ID do produto é obrigatório e deve ser um número inteiro",
                "error"
            )->back(null);
            return;
        }

        $product = new Product();
        if(!$product->selectById($data["product_id"])) {
            $this->call(
                404,
                "not_found",
                "Produto não encontrado",
                "error"
            )->back(null);
            return;
        }

        $response = [
            "id" => $product->getId(),
            "category_id" => $product->getCategoryId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "active" => $product->getActive()
        ];

        $this->call(200,"success","Produto encontrado","success")->back($response);

    }

    public function listAll (array $data): void
    {
        $products = new Product();
        // com filtro
        $this->call(200,"success","Lista de Produtos","success")
            ->back($products->selectAll(['category_id = 2']));
        // sem filtro
        // $this->call(200,"success","Lista de Produtos","success")->back($products->selectAll());
    }

    public function listPaginator (array $data): void
    {
        if(!isset($data["page"]) || !isset($data["per_page"]) ||
            empty($data["page"]) || empty($data["per_page"]) ||
            !filter_var($data["page"], FILTER_VALIDATE_INT) ||
            !filter_var($data["per_page"], FILTER_VALIDATE_INT)) {
            $this->call(
                400,
                "bad_request",
                "Os campos page e per_page são obrigatórios, devem ser números inteiros e maiores que zero",
                "error"
            )->back(null);
            return;
        }

        $products  = new Product();
        $response = $products->selectPaginator($data["page"], $data["per_page"], [], 'id', 'ASC');
        $this->call(200,"success","Lista de Produtos com Paginação","success")->back($response);
    }

    public function insert (array $data): void
    {
        if(!$this->authToken (1)){
            $this->call(
                401,
                "unauthorized",
                "Usuário não está autenticado (sem token ou token inválido).",
                "error")->back();
            return;
        }

        if(!$this->validate($data)){
            $this->call(
                400,
                "bad_request",
                "Os campos category_id, name e price são obrigatórios",
                "error"
            )->back();
            return;
        }

        $product = new Product(
            null,
            $data["category_id"],
            $data["name"],
            $data["price"]
        );

        if(!$product->insert()){
            $this->call(500, "internal_server_error", $product->getErrorMessage(), "error")->back();
            return;
        }
        $response = [
            "id" => $product->getId(),
            "category_id" => $product->getCategoryId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "active" => $product->getActive()
        ];

        $this->call(201,"success","Produto inserido com sucesso","success")->back($response);

    }

    public function update (array $data): void
    {
        if(!$this->authToken (1)){
            $this->call(
                401,
                "unauthorized",
                "Usuário não está autenticado (sem token ou token inválido).",
                "error")->back();
            return;
        }

        if(!filter_var($data["product_id"], FILTER_VALIDATE_INT)) {
            $this->call(
                400,
                "bad_request",
                "ID do produto é obrigatório e deve ser um número inteiro",
                "error"
            )->back();
            return;
        }

        if(!$this->validate($data)){
            $this->call(
                400,
                "bad_request",
                "Os campos category_id, name e price são obrigatórios",
                "error"
            )->back();
            return;
        }

        $product = new Product(
            null,
            $data["category_id"],
            $data["name"],
            $data["price"]
        );

        if(!$product->updateById($data["product_id"])){
            $this->call(500, "internal_server_error", $product->getErrorMessage(), "error")->back();
            return;
        }
        $response = [
            "id" => $product->getId(),
            "category_id" => $product->getCategoryId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "active" => $product->getActive()
        ];

        $this->call(200,"success","Produto atualizado com sucesso","success")->back($response);
    }

    public function delete (array $data): void
    {
        if(!filter_var($data["product_id"], FILTER_VALIDATE_INT)) {
            $this->call(
                400,
                "bad_request",
                "ID do produto é obrigatório e deve ser um número inteiro",
                "error"
            )->back();
            return;
        }

        $product = new Product();
        // hard delete
        //if(!$product->deleteById($data["product_id"])){
        // soft delete
        if(!$product->softDeleteById($data["product_id"])){
            $this->call(500, "internal_server_error", $product->getErrorMessage(), "error")->back();
            return;
        }

        $this->call(200,"success","Produto excluído com sucesso","success")->back();
    }

    public function validate (array $data): bool
    {
        if(!isset($data["category_id"]) || !isset($data["name"]) || !isset($data["price"]) ||
            empty($data["category_id"]) || empty($data["name"]) || empty($data["price"]) ||
           !filter_var($data["category_id"], FILTER_VALIDATE_INT) || !filter_var($data["price"], FILTER_VALIDATE_FLOAT)) {
            return false;
        }
        return true;
    }
}