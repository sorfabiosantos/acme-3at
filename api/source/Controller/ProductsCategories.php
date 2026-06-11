<?php

namespace Source\Controller;

use Source\Controller\Api;
use Source\Models\ProductCategory;

class ProductsCategories extends Api
{
    public function productsCategoryList ()
    {
        $productsCategories = new ProductCategory();
        $this->call(200,"success","Lista de Categorias de Produtos","success")->back($productsCategories->listAll());
    }
}