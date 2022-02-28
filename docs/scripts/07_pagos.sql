CREATE TABLE `pagos` (
  `idPago` bigint(8) NOT NULL AUTO_INCREMENT,
  `pagoFecha` DATE DEFAULT NULL,
  `pagoCliente` VARCHAR(128) DEFAULT NULL,
  `pagoMonto` NUMERIC(13,2) DEFAULT NULL,
  `pagoFechaVen` date DEFAULT NULL,
  `pagoEst` ENUM('ENV', 'PGD', 'CNL', 'ERR') DEFAULT NULL,
  PRIMARY KEY (`idPago`)
);