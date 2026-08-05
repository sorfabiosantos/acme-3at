<?php

namespace Source\Controller;

use Source\Controller\Api;
use Source\Models\Faqs\Faq;

class Faqs extends Api
{
    public function listAll(array $data): void
    {
        $faq = new Faq();
        $this->call(200, "success", "Lista de Perguntas Frequentes", "success")
            ->back($faq->selectAll(["active = 1"]));
    }

    public function listById(array $data): void
    {
        if (!isset($data["faqId"]) || empty($data["faqId"]) || !filter_var($data["faqId"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID da FAQ é obrigatório e deve ser um número inteiro", "error")->back();
            return;
        }

        $faq = new Faq();
        if (!$faq->selectById((int)$data["faqId"])) {
            $this->call(404, "not_found", "FAQ não encontrada", "error")->back();
            return;
        }

        $response = [
            "id" => $faq->getId(),
            "faqs_category_id" => $faq->getFaqsCategoryId(),
            "question" => $faq->getQuestion(),
            "answer" => $faq->getAnswer(),
            "active" => $faq->getActive()
        ];

        $this->call(200, "success", "FAQ encontrada", "success")->back($response);
    }

    public function listByCategory(array $data): void
    {
        if (!isset($data["categoryId"]) || empty($data["categoryId"]) || !filter_var($data["categoryId"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID da categoria é obrigatório e deve ser um número inteiro", "error")->back();
            return;
        }

        $faq = new Faq();
        $categoryId = (int)$data["categoryId"];
        $this->call(200, "success", "Lista de FAQs por categoria", "success")
            ->back($faq->selectAll(["active = 1", "faqs_category_id = {$categoryId}"]));
    }

    public function insert(array $data): void
    {
        if (!$this->authToken(1)) {
            $this->call(401, "unauthorized", "Usuário não está autenticado (sem token ou token inválido).", "error")->back();
            return;
        }

        if (!isset($data["faqs_category_id"]) || empty($data["faqs_category_id"]) || !filter_var($data["faqs_category_id"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "O campo faqs_category_id é obrigatório e deve ser um número inteiro", "error")->back();
            return;
        }

        if (!isset($data["question"]) || empty(trim($data["question"]))) {
            $this->call(400, "bad_request", "O campo question é obrigatório", "error")->back();
            return;
        }

        if (!isset($data["answer"]) || empty(trim($data["answer"]))) {
            $this->call(400, "bad_request", "O campo answer é obrigatório", "error")->back();
            return;
        }

        $faq = new Faq(null, (int)$data["faqs_category_id"], $data["question"], $data["answer"], 1);
        if (!$faq->insert()) {
            $this->call(500, "internal_server_error", $faq->getErrorMessage(), "error")->back();
            return;
        }

        $response = [
            "id" => $faq->getId(),
            "faqs_category_id" => $faq->getFaqsCategoryId(),
            "question" => $faq->getQuestion(),
            "answer" => $faq->getAnswer(),
            "active" => $faq->getActive()
        ];

        $this->call(201, "created", "FAQ criada com sucesso", "success")->back($response);
    }

    public function update(array $data): void
    {
        if (!$this->authToken(1)) {
            $this->call(401, "unauthorized", "Usuário não está autenticado (sem token ou token inválido).", "error")->back();
            return;
        }

        if (!isset($data["faqId"]) || !filter_var($data["faqId"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "O campo faqId é obrigatório e deve ser um número inteiro", "error")->back();
            return;
        }

        $faq = new Faq();
        if (!$faq->selectById((int)$data["faqId"])) {
            $this->call(404, "not_found", "FAQ não encontrada", "error")->back();
            return;
        }

        if (isset($data["faqs_category_id"]) && !empty($data["faqs_category_id"])) {
            if (!filter_var($data["faqs_category_id"], FILTER_VALIDATE_INT)) {
                $this->call(400, "bad_request", "O campo faqs_category_id deve ser um número inteiro", "error")->back();
                return;
            }
            $faq->setFaqsCategoryId((int)$data["faqs_category_id"]);
        }

        if (isset($data["question"]) && !empty(trim($data["question"]))) {
            $faq->setQuestion($data["question"]);
        }

        if (isset($data["answer"]) && !empty(trim($data["answer"]))) {
            $faq->setAnswer($data["answer"]);
        }

        if (!$faq->updateById((int)$data["faqId"])) {
            $this->call(500, "internal_server_error", $faq->getErrorMessage(), "error")->back();
            return;
        }

        $response = [
            "id" => $faq->getId(),
            "faqs_category_id" => $faq->getFaqsCategoryId(),
            "question" => $faq->getQuestion(),
            "answer" => $faq->getAnswer(),
            "active" => $faq->getActive()
        ];

        $this->call(200, "success", "FAQ atualizada com sucesso", "success")->back($response);
    }

    public function delete(array $data): void
    {
        if (!$this->authToken(1)) {
            $this->call(401, "unauthorized", "Usuário não está autenticado (sem token ou token inválido).", "error")->back();
            return;
        }

        if (!isset($data["faqId"]) || !filter_var($data["faqId"], FILTER_VALIDATE_INT)) {
            $this->call(400, "bad_request", "ID da FAQ é obrigatório e deve ser um número inteiro", "error")->back();
            return;
        }

        $faq = new Faq();
        if (!$faq->softDeleteById((int)$data["faqId"])) {
            $this->call(404, "not_found", "FAQ não encontrada ou já inativa", "error")->back();
            return;
        }

        $this->call(200, "success", "FAQ removida com sucesso", "success")->back();
    }
}
