<?php

namespace Source\Controller;

use Source\Models\Address;

class Addresses extends Api
{
    public function register(array $data): void
    {
        if(!$this->authToken(2)){
            $this->call(401,
                "unauthorized",
                "Token de autenticação inválido ou expirado.",
                "error")->back();
            return;
        }

        $address = new Address(null,$this->userAuthId,$data["street"],$data["number"]);
        if(!$address->insert()){
            $this->call(500,
                "internal_server_error",
                $address->getErrorMessage(),
                "error")->back();
            return;
        }
        $this->call(201, "success","Endereço cadastrado com sucesso!" , "success")->back();
    }

    public function update(array $data): void
    {
        // persistencia
        if(!$this->authToken(2)){ // usuário comum standard
            $this->call(401,
                "unauthorized",
                "Token de autenticação inválido ou expirado.",
                "error")->back();
            return;
        }

        $address = new Address(null, $this->userAuthId, $data["street"], $data["number"]);

        if(!$address->updateById($data["id"])){
            $this->call(500,
                "internal_server_error",
                $address->getErrorMessage(),
                "error")->back();
            return;
        }

        $this->call(200, "success","Endereço atualizado com sucesso!" , "success")->back();
    }

    public function getAddressByUserId (): void
    {
        if(!$this->authToken(2)){
            $this->call(401,
                "unauthorized",
                "Token de autenticação inválido ou expirado.",
                "error")->back();
            return;
        }
        $address = new Address();
        $this->call(200, "success","Endereço encontrado!" , "success")
            ->back($address->selectByUserId($this->userAuthId));
    }

}