<?php

namespace Source\Controller;

use Source\Controller\Api;
use Source\Models\Faqs\FaqCategory;

class FaqsCategories extends Api
{
    public function listAll(array $data): void
    {
        $category = new FaqCategory();
        $this->call(200, "success", "Lista de Categorias de FAQs", "success")
            ->back($category->selectAll(["active = 1"]));
    }

    public function listById(array $data): void
    {
        if (!isset($data["categoryId"]) || empty($data["categoryId"]) || !filter_var($data["categoryId"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID da categoria é obrigatório e deve ser um número inteiro", "error")->back();
            return;
        }

        $category = new FaqCategory();
        if (!$category->selectById((int)$data["categoryId"])) {
            $this->call(404, "not_found", "Categoria não encontrada", "error")->back();
            return;
        }

        $response = [
            "id" => $category->getId(),
            "name" => $category->getName(),
            "active" => $category->getActive()
        ];

        $this->call(200, "success", "Categoria encontrada", "success")->back($response);
    }

    public function insert(array $data): void
    {
        if (!$this->authToken(1)) {
            $this->call(401, "unauthorized", "Usuário não está autenticado (sem token ou token inválido).", "error")->back();
            return;
        }

        if (!isset($data["name"]) || empty(trim($data["name"]))) {
            $this->call(400, "bad_request", "O campo name é obrigatório", "error")->back();
            return;
        }

        $category = new FaqCategory(null, $data["name"], 1);
        if (!$category->insert()) {
            $this->call(500, "internal_server_error", $category->getErrorMessage(), "error")->back();
            return;
        }

        $response = [
            "id" => $category->getId(),
            "name" => $category->getName(),
            "active" => $category->getActive()
        ];

        $this->call(201, "created", "Categoria criada com sucesso", "success")->back($response);
    }

    public function update(array $data): void
    {
        if (!$this->authToken(1)) {
            $this->call(401, "unauthorized", "Usuário não está autenticado (sem token ou token inválido).", "error")->back();
            return;
        }

        if (!isset($data["categoryId"]) || !filter_var($data["categoryId"], FILTER_VALIDATE_INT) ||
            !isset($data["name"]) || empty(trim($data["name"]))) {
            $this->call(400, "bad_request", "Os campos name e categoryId são obrigatórios. O campo categoryId deve ser um número inteiro", "error")->back();
            return;
        }

        $category = new FaqCategory();
        if (!$category->selectById((int)$data["categoryId"])) {
            $this->call(404, "not_found", "Categoria não encontrada", "error")->back();
            return;
        }

        $category->setName($data["name"]);
        if (!$category->updateById((int)$data["categoryId"])) {
            $this->call(500, "internal_server_error", $category->getErrorMessage(), "error")->back();
            return;
        }

        $response = [
            "id" => $category->getId(),
            "name" => $category->getName(),
            "active" => $category->getActive()
        ];

        $this->call(200, "success", "Categoria atualizada com sucesso", "success")->back($response);
    }

    public function delete(array $data): void
    {
        if (!$this->authToken(1)) {
            $this->call(401, "unauthorized", "Usuário não está autenticado (sem token ou token inválido).", "error")->back();
            return;
        }

        if (!isset($data["categoryId"]) || !filter_var($data["categoryId"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID da categoria é obrigatório e deve ser um número inteiro", "error")->back();
            return;
        }

        $category = new FaqCategory();
        if (!$category->softDeleteById((int)$data["categoryId"])) {
            $this->call(404, "not_found", "Categoria não encontrada ou já inativa", "error")->back();
            return;
        }

        $this->call(200, "success", "Categoria removida com sucesso", "success")->back();
    }
}
