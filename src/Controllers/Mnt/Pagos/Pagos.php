<?php 

namespace Controllers\Mnt\Pagos;

use Controllers\PublicController;
use Views\Renderer;
/*
`pagos` (
  `idPago` bigint(8) NOT NULL AUTO_INCREMENT,
  `pagoFecha` DATE DEFAULT NULL,
  `pagoCliente` VARCHAR(128) DEFAULT NULL,
  `pagoMonto` NUMERIC(13,2) DEFAULT NULL,
  `pagoFechaVen` date DEFAULT NULL,
  `pagoEst` ENUM('ENV', 'PGD', 'CNL', 'ERR') DEFAULT NULL
*/
class Pagos extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["pagos"] 
                        = \Dao\Mnt\Pagos::obtenerTodos();
        Renderer::render('mnt/pagos', $viewData);
    }
}
?>