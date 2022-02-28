<?php 

namespace Controllers\Mnt\Pagos;

use Controllers\PublicController;
use PhpParser\Node\Stmt\Switch_;
use Views\Renderer;

class Pago extends PublicController{
    private $_modeStrings = array(
        "INS" => "Nuevo Pago",
        "UPD" => "Editar %s (%s)",
        "DSP" => "Detalle de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_pagoOptions = array(
        "ENV" => "Enviado",
        "PGD" => "Pagado",
        "CNL" => "Cancelado",
        "ERR" => "Eroor"
    );
    private $_viewData = array(
        "mode" => "INS",
        "idPago" => 0,
        "pagoFecha" =>"",
        "pagoCliente" =>0,
        "pagoMonto" =>0,
        "pagoFechaVen"=>"",
        "pagoEst"=>"ENV",
        "readonly" => false,
        "isInsert" => false,
        "pagoOptions"=>[], 
        "crsxToken"=>""
    );

    private function init(){
        if(isset($_GET["mode"])){
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if(isset($_GET["idPago"])){
            $this->_viewData["idPago"] = $_GET["idPago"];
        }
        if(!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log($this->toString()." Modo no valido".$this->_viewData["mode"],0);
            \Utilities\Site::redirectToWithMsg('index.php?page=mnt.pagos.pagos', 
            'Sucedio un error al cargar la pagina.'); 
        }
        if($this->_viewData["mode"]!=="INS" && intval($this->_viewData["idPago"], 10)!==0){
            $this->_viewData["mode"]!=="DSP";
        }
    }

    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if(!isset($_SESSION["pago_crsxToken"]) 
        || $_SESSION["pago_crsxToken"]!== $this->_viewData["crsxToken"])
        {
            unset($_SESSION["pago_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.pagos.pagos', 
                'Ocurrio un error, no se puede procesar el formulario'
            );
        }
        $this->_viewData["idPago"] = intval($this->_viewData["idPago"], 10);
        if(!\Utilities\Validators::isMatch($this->_viewData["pagoEst"], "/^(ENV)|(PGD)|(CNL)|(ERR)$/")){
            $this->_viewData["errors"][] = "Pago debe de ser ENV, PGN, CNL Y ERR";
        }

        if(isset($this->_viewData["errors"]) && count($this->_viewData["errors"])>0){
            
        }else{
            unset($_SESSION["pago_crsxToken"]);
            switch ($this->_viewData["mode"]){
            case 'INS':
                $result = \Dao\Mnt\Pagos::nuevoPago(
                    $this->_viewData["pagoCliente"],
                    $this->_viewData["pagoMonto"],
                    $this->_viewData["pagoFechaVen"],
                    $this->_viewData["pagoEst"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.pagos.pagos',
                        "Pago guardada correctamente"
                    );
                }
            break; 
            case 'UPD':
                $result = \Dao\Mnt\Pagos::actualizarPago(
                    $this->_viewData["pagoCliente"],
                    $this->_viewData["pagoMonto"],
                    $this->_viewData["pagoFechaVen"],
                    $this->_viewData["pagoEst"], 
                    $this->_viewData["idPago"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.pagos.pagos",
                        "Pago modificada correctamente"
                    );
                }
            break;  
            case 'DEL':
                $result = \Dao\Mnt\Pagos::eliminarPago(
                    $this->_viewData["idPago"]
                );
                if($result){
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt.pagos.pagos",
                        "Pago eliminado correctamente"
                    );
                }
            break; 
            
            default :

            break;
            }
        }      
    }

    private function prepareViewData(){
        if($this->_viewData["mode"] == "INS"){
            $this->_viewData["modeDsc"] = 
                $this->_modeStrings[$this->_viewData["mode"]];
        }else{
            $tmpPago = \Dao\Mnt\Pagos::obtenerPorPagoId(intval($this->_viewData["idPago"], 10));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpPago, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                    $this->_viewData["pagoCliente"],
                    $this->_viewData["idPago"],
                    $this->_viewData["pagoFecha"],
                    $this->_viewData["pagoMonto"],
                    $this->_viewData["pagoFechaVen"],
                    $this->_viewData["pagoEst"]
            );
        }
        $this->_viewData["pagoOptions"] = 
        \Utilities\ArrUtils::toOptionsArray(
            $this->_pagoOptions,
            'value',
            'text',
            'select',
            $this->_viewData['pagoEst']
        );
        $this->_viewData["crsxToken"] = md5(time()."pago");
        $_SESSION["pago_crsxToken"] = $this->_viewData["crsxToken"];
    }

    public function run(): void{
        
        $this->init();
        if($this->isPostBack()){
            $this->handlePost();
        }
        $this-> prepareViewData();
        Renderer::render('mnt/Pago', $this->_viewData);
    }
}

?>