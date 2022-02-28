<?php 

namespace Dao\Mnt;

use Dao\Table;
class Pagos extends Table
{
    public static function obtenerTodos()
    {
       $sqlstr = "select * from pagos; ";
       return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    public static function obtenerPorPagoId($idPago)
    {
        $sqlstr = "select * from pagos where idPago=:idPago; ";
        return self::obtenerUnRegistro(
             $sqlstr,
             array("idPago"=>$idPago)
        );
    }   
    
    public static function nuevoPago(
        $pagoCliente, 
        $pagoMonto, 
        $pagoFechaVen, 
        $pagoEst){
        $sqlstr = "INSERT INTO pagos (pagoFecha, pagoCliente, pagoMonto, pagoFechaVen, pagoEst) 
        VALUES (date(now()), :pagoCliente, :pagoMonto, :pagoFechaVen, :pagoEst);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "pagoCliente"=>$pagoCliente,
                "pagoMonto"=>$pagoMonto,
                "pagoFechaVen"=>$pagoFechaVen,
                "pagoEst"=>$pagoEst
            )
        );
    }

    public static function actualizarPago(
        $pagoCliente, 
        $pagoMonto, 
        $pagoFechaVen, 
        $pagoEst, 
        $idPago){
        $sqlstr = "UPDATE pagos set pagoCliente=:pagoCliente, 
        pagoMonto=:pagoMonto, pagoFechaVen=:pagoFechaVen, pagoEst=:pagoEst where idPago=:idPago;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "pagoCliente"=>$pagoCliente,
                "pagoMonto"=>$pagoMonto,
                "pagoFechaVen"=>$pagoFechaVen,
                "pagoEst"=>$pagoEst, 
                "idPago"=>$idPago
            )
        );
    }

    public static function eliminarPago($idPago){
        $sqlstr = "DELETE FROM pagos where idPago=:idPago;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "idPago"=>$idPago
            )
        );
    }
}

?>