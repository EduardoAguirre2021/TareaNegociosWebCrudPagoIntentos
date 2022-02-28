<?php

namespace Controllers\Clientes;//nombre de la carpeta

use Controllers\PublicController;
use Views\Renderer;

//nombre de la clase nombre del archivo
class Clientes extends PublicController{
    //al extender se ejecutara cuando se llama la url
    public function run(): void{
        $viewData = array();
        $viewData["titulo"] = "Manejo de Clientes";
        $viewData["clientes"] = array(
            "Orlando",
            "Josue",
            "Adriana",
            "Carlos",
            "Eduardo"
        );
        Renderer::Render('Clientes/clientes', $viewData);
    }
}


?>