-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2019 a las 20:06:10
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `auditoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `Almacen` char(18) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `EntreCalles` varchar(30) DEFAULT NULL,
  `Colonia` varchar(50) DEFAULT NULL,
  `Poblacion` varchar(50) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Pais` varchar(50) DEFAULT NULL,
  `CodigoPostal` varchar(50) DEFAULT NULL,
  `Encargado` varchar(50) DEFAULT NULL,
  `Telefonos` varchar(20) DEFAULT NULL,
  `Grupo` varchar(50) DEFAULT NULL,
  `Categoria` varchar(50) DEFAULT NULL,
  `Estatus` varchar(20) DEFAULT NULL,
  `Sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`Almacen`, `Nombre`, `Direccion`, `EntreCalles`, `Colonia`, `Poblacion`, `Estado`, `Pais`, `CodigoPostal`, `Encargado`, `Telefonos`, `Grupo`, `Categoria`, `Estatus`, `Sucursal`) VALUES
('1', 'Alm. Aluminio Suc. Circuito', 'Calle 30 Nº 178 B Depto. 1', '13 y 15', 'Garcia Gineres', 'Mérida', 'Yucatán', 'México', '97070', 'Elda Chan Chale', '999 9204545', 'Aluminio', 'COMPRAS', 'ALTA', 2),
('10', 'Alm. Aluminio Suc. Playa Ejido', 'Av.Diagonal Lote 25 Mza 187', '6 y 8 Norte', 'Ejidal', 'Solidaridad', 'Q. Roo', 'Mexico', '', 'Luis Chooc Cohuo', '984 8592061', 'Aluminio', 'COMPRAS', 'ALTA', 1),
('10H', 'Alm. Herrajes Suc. Playa Ejido', 'Av. diagonal Lote 25 Mza 187', '6 y 8 Norte', 'Ejidal', 'Solidaridad', 'Q. Roo', 'Mexico', NULL, 'Luis Chooc Cohuo', '984 8592061', 'Herrajes', 'COMPRAS', 'ALTA', 2),
('10ME', 'Alm. Mal Estado Suc. Playa Ejido', 'Av. Diagonal Lote 25 Mza 187', '6 y 8 Norte', 'Ejidal', 'Solidaridad', 'Q. Roo', 'Mexico', NULL, 'Luis Chooc Cohuo', '984 8592061', 'Mal Estado', NULL, 'ALTA', 3),
('10V', 'Alm. Vidrio Suc. Playa Ejido', 'Av. diagonal Lote 25 Mza 187', '6 y 8 Norte', 'Ejidal', 'Solidaridad', 'Q. Roo', 'Mexico', NULL, NULL, NULL, 'Aluminio', 'CEDIS', 'ALTA', 1),
('11', 'Alm. Aluminio Suc. Motul', 'Calle 28 No 296 C', '25 y 27', 'CENTRO', 'MOTUL', 'YUCATAN', 'Mexico', '97432', '', '991-9152505', 'Aluminio', 'COMPRAS', 'ALTA', 2),
('11ME', 'Alm. Mal Estado Suc. Motul', 'Calle 28 No 296 C', '25 y 27', 'CENTRO', 'MOTUL', 'YUCATAN', 'Mexico', '97432', NULL, '991-9152505', 'Mal Estado', NULL, 'ALTA', 3),
('12', 'Alm Suc. Progreso', 'Calle 80 No 250 B', ' Entre 39 y 41', NULL, 'Progreso', 'YUCATAN', 'Mexico', '97320', NULL, NULL, 'Aluminio', 'COMPRAS', 'ALTA', 1),
('12ME', 'Alm. Mal Estado Suc.Progreso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mal Estado', NULL, 'ALTA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `Articulo` char(20) NOT NULL,
  `Descripcion1` varchar(100) NOT NULL,
  `Descripcion2` varchar(255) NOT NULL,
  `ClaveFabricante` varchar(50) NOT NULL,
  `Impuesto1` float(8,0) NOT NULL,
  `Factor` varchar(50) NOT NULL,
  `Unidad` varchar(50) NOT NULL,
  `UnidadCompra` varchar(50) NOT NULL,
  `UnidadTraspaso` varchar(50) NOT NULL,
  `UnidadCantidad` float(8,0) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `MonedaCosto` char(10) NOT NULL,
  `PrecioLista` decimal(10,0) NOT NULL,
  `Estatus` char(15) NOT NULL,
  `Precio2` decimal(10,0) NOT NULL,
  `Precio3` decimal(10,0) NOT NULL,
  `Precio4` decimal(10,0) NOT NULL,
  `Precio5` decimal(10,0) NOT NULL,
  `Precio6` decimal(10,0) NOT NULL,
  `Precio7` decimal(10,0) NOT NULL,
  `Precio8` decimal(10,0) NOT NULL,
  `Precio9` decimal(10,0) NOT NULL,
  `Precio10` decimal(10,0) NOT NULL,
  `CodigoAlterno` varchar(50) NOT NULL,
  `IdCategoria` int(11) DEFAULT NULL,
  `IdRama` int(11) DEFAULT NULL,
  `IdFamilia` int(11) DEFAULT NULL,
  `IdGrupo` int(11) DEFAULT NULL,
  `IdProveedor` int(11) DEFAULT NULL,
  `IdFabricante` int(11) DEFAULT NULL,
  `IdLinea` int(11) DEFAULT NULL,
  `Sucursal` int(11) NOT NULL,
  `Almacen` char(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`Articulo`, `Descripcion1`, `Descripcion2`, `ClaveFabricante`, `Impuesto1`, `Factor`, `Unidad`, `UnidadCompra`, `UnidadTraspaso`, `UnidadCantidad`, `Tipo`, `MonedaCosto`, `PrecioLista`, `Estatus`, `Precio2`, `Precio3`, `Precio4`, `Precio5`, `Precio6`, `Precio7`, `Precio8`, `Precio9`, `Precio10`, `CodigoAlterno`, `IdCategoria`, `IdRama`, `IdFamilia`, `IdGrupo`, `IdProveedor`, `IdFabricante`, `IdLinea`, `Sucursal`, `Almacen`) VALUES
(' K5120/127', 'MOTOR SPEED AUTOMATICO CABEZAL T-COMERCIAL VDS', '', '', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '27778', 'ALTA', '29167', '27778', '27778', '27778', '27778', '0', '0', '0', '0', ' K5120/127', 11, 2, 11, 11, 11, 11, 12, 2, '1'),
('00001770', 'BARRA CABEZAL 4.5 TEJIDO 1.70M BCO', '', '', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '2765', 'ALTA', '2765', '2668', '2765', '2765', '2682', '0', '0', '0', '1735', '', 12, 1, 12, 4, 11, 12, 13, 3, '10'),
('00002770', 'BARRA CABEZAL 4.5 TEJIDO 2.50M BCO', '', '', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '3169', 'ALTA', '3169', '3058', '3169', '3169', '3074', '0', '0', '0', '1763', '', 12, 1, 12, 4, 11, 12, 13, 3, '10'),
('000043', 'PALETA 4 LT', '', '', 16, '', 'PIEZA', 'PIEZA', 'PIEZA', 1, 'NORMAL', 'Pesos', '0', 'ALTA', '0', '0', '0', '1', '0', '0', '0', '0', '0', '', 13, 3, 14, 12, 12, 13, NULL, 4, '10v'),
('00005770', 'KIT ACCESORIOS MOS. ENROLL. DO', '', '', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '195', 'ALTA', '195', '0', '0', '0', '0', '0', '0', '0', '0', '', 15, 2, 13, 11, 11, 12, 14, 2, '1'),
('000060', 'DESTAPADOR DE GALON', '', '', 16, '', 'PIEZA', 'PIEZA', 'PIEZA', 1, 'NORMAL', 'Pesos', '0', 'ALTA', '0', '0', '0', '1', '0', '0', '0', '0', '0', '', 13, 3, 14, 12, 12, 13, NULL, 4, '10V'),
('0001', 'ABRAZADERA DE UÑA DE 1.', '', '1', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '1', 'ALTA', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', 18, 4, NULL, NULL, 17, NULL, NULL, 5, '10ME'),
('0002', 'ABRAZADERA DE UÑA DE 1/2.', '', '2', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '1', 'ALTA', '1', '0', '0', '0', '0', '0', '0', '0', '0', '2', 18, 4, NULL, NULL, 17, NULL, NULL, 5, '10ME'),
('0003', 'ABRAZADERA DE UÑA DE 3/4.', '', '3', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '1', 'ALTA', '1', '1', '1', '0', '0', '0', '0', '0', '0', '3', 18, 4, NULL, NULL, 17, NULL, NULL, 5, '10ME'),
('0017-4', 'TRANSITO AMARILLA 4 LTS', '', '', 16, '', 'Galon', 'Galon', 'Galon', 1, 'NORMAL', 'Pesos', '586', 'ALTA', '617', '522', '617', '511', '0', '0', '0', '0', '0', '', 14, 3, 15, 13, 12, 13, 15, 4, '10V'),
('0017-5', 'TRANSITO AMARILLA 19 LTS', '', '', 16, '', 'Cubeta', 'Cubeta', 'Cubeta', 1, 'NORMAL', 'Pesos', '2580', 'ALTA', '2716', '2296', '2716', '2247', '0', '0', '0', '0', '0', '', 14, 3, 15, 13, 12, 13, 15, 4, '10v'),
('0102260N41', 'Jaladera Niquel Rayado Brillante C-C 12.80cm 2267BF Fincsa', '', '0102260N41', 16, '', 'pza', 'pza', 'pza', 1, 'NORMAL', 'Pesos', '32', 'ALTA', '32', '0', '0', '22', '0', '0', '0', '0', '0', '0102260N41', 17, 2, 17, 11, 15, 15, 17, 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `CategoriaMaestra` varchar(50) DEFAULT NULL,
  `ValidarPresupuestoCompra` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Categoria`, `CategoriaMaestra`, `ValidarPresupuestoCompra`) VALUES
(1, 'ACRILICOS', NULL, 'No'),
(2, 'BISAGRAS', NULL, 'No'),
(3, 'Angulos, Tee y Solera', NULL, 'No'),
(4, 'AUTOMATIZACIONES', NULL, 'No'),
(5, 'BALANCIN PARA GUILLOTINA', NULL, 'No'),
(6, 'BAÑOS', NULL, 'No'),
(7, 'BAÑOS (HERRAJES)', NULL, 'No'),
(8, 'BARANDALES', NULL, 'No'),
(9, 'BARRAS ANTIPANICO Y EMPUJE', NULL, 'No'),
(10, 'BATIENTES', NULL, 'No'),
(11, 'AUTOMATIZACIONES', NULL, NULL),
(12, 'MOSQUITEROS', NULL, NULL),
(13, 'PINTURAS BEREL VARIOS', NULL, NULL),
(14, 'Acabados', NULL, NULL),
(15, 'VARIOS (HERRAJES)', NULL, NULL),
(16, 'TORNILLERIA', NULL, NULL),
(17, 'HERRAJES VIDRIO', NULL, NULL),
(18, 'ABRAZADERAS', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `ClaveEmpresa` varchar(20) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Prefijo` char(10) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Delegacion` varchar(50) DEFAULT NULL,
  `Colonia` varchar(50) DEFAULT NULL,
  `Poblacion` varchar(30) NOT NULL,
  `Estado` varchar(20) NOT NULL,
  `Pais` varchar(20) DEFAULT NULL,
  `CodigoPostal` char(10) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Region` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`ClaveEmpresa`, `Nombre`, `Prefijo`, `Direccion`, `Delegacion`, `Colonia`, `Poblacion`, `Estado`, `Pais`, `CodigoPostal`, `Telefono`, `Region`) VALUES
('ALUM01', 'ALUMAYAB', 'ALUM', 'CALLE ', 'YUCATAN', 'GARCIA GINERES', 'MERIDA', 'YUCATAN', 'MEXICO', '97000', '9992547916', 'SURESTE'),
('BER02', 'BEREL', 'BREL', 'CALLE ', 'YUCATAN', 'GARCIA GINERES', 'MERIDA', 'YUCATAN', 'MEXICO', '97000', '9992547916', 'SURESTE'),
('HER03', 'HERRAMAX', 'HMAX', 'CALLE ', 'YUCATAN', 'GARCIA GINERES', 'MERIDA', 'YUCATAN', 'MEXICO', '97000', '9992547916', 'SURESTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabricante`
--

CREATE TABLE `fabricante` (
  `IdFabricante` int(11) NOT NULL,
  `Fabricante` varchar(50) NOT NULL,
  `Telefono` varbinary(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fabricante`
--

INSERT INTO `fabricante` (`IdFabricante`, `Fabricante`, `Telefono`) VALUES
(1, 'ACCESORIOS VILLA', NULL),
(2, 'BRALO', NULL),
(3, 'AGUILAR', NULL),
(4, 'AKSI', NULL),
(5, 'ALTECH', NULL),
(6, 'ANSA', NULL),
(7, 'ANUDAL', NULL),
(8, 'ARBI', NULL),
(9, 'ASTROFIL', NULL),
(10, 'ATLAS', NULL),
(11, 'VDS', NULL),
(12, 'NEVALUZ', NULL),
(13, 'BEREL', NULL),
(14, 'DMT', NULL),
(15, 'FINCSA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `IdFamilia` int(11) NOT NULL,
  `Familia` varchar(50) NOT NULL,
  `FamiliaMaestra` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`IdFamilia`, `Familia`, `FamiliaMaestra`) VALUES
(1, '.61 x 1.22 2mm', NULL),
(2, '5 MM', NULL),
(3, '.61 x 1.22 3mm', NULL),
(4, '.70 x 1.80', NULL),
(5, '.80 x 1.80', NULL),
(6, '1.00 x 1.80', NULL),
(7, '1.20 x 1.80', NULL),
(8, '10 MM', NULL),
(9, '3 MM', NULL),
(10, '4 MM', NULL),
(11, 'AUTOMATIZACIONES', NULL),
(12, 'Aluminio', NULL),
(13, 'VARIOS', NULL),
(14, 'ACCESORIOS', NULL),
(15, 'hule clorado', NULL),
(16, 'DMT', NULL),
(17, 'FINCSA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `IdGrupo` int(11) NOT NULL,
  `Grupo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`IdGrupo`, `Grupo`) VALUES
(1, 'AZUL'),
(2, 'CHAMPAGNE MATE'),
(3, 'BEIGE'),
(4, 'BLANCO'),
(5, 'BONOS'),
(6, 'BRONCE'),
(7, 'BRONCE OSCURO'),
(8, 'CAFE 8014'),
(9, 'CHAMPAGNE'),
(10, 'CHAMPAGNE IND'),
(11, 'HERRAJES'),
(12, 'PROMOS'),
(13, 'BASE SOLVENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `IdLinea` int(11) NOT NULL,
  `Linea` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`IdLinea`, `Linea`) VALUES
(1, ' S-80,S4600,S4000'),
(2, 'S-80,4600,4000'),
(3, '1.20 X 1.80'),
(4, 'L-3\"'),
(5, '.70 X 1.80'),
(6, '.75 X 1.75'),
(7, '.75 X 1.80'),
(8, '.80 X 1.80'),
(9, '.90 X 1.80'),
(10, '1.00 x 1.80'),
(11, '1.00 X 3.05'),
(12, 'MOTOR'),
(13, 'Europea'),
(14, 'KIT MOSQ.'),
(15, 'TRANSITO'),
(16, 'KIT MOSQ.'),
(17, 'JALADERAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `IdPerfil` int(11) NOT NULL,
  `Perfil` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`IdPerfil`, `Perfil`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'AUDITOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `IdProveedor` int(11) NOT NULL,
  `Proveedor` char(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `NombreCorto` varchar(50) DEFAULT NULL,
  `Direccion` varchar(100) NOT NULL,
  `DireccionNumero` varchar(20) DEFAULT NULL,
  `DireccionNumeroInt` varchar(20) DEFAULT NULL,
  `EntreCalles` varchar(100) DEFAULT NULL,
  `Delegacion` varchar(100) DEFAULT NULL,
  `Colonia` varchar(100) DEFAULT NULL,
  `Poblacion` varchar(100) DEFAULT NULL,
  `Estado` varchar(50) NOT NULL,
  `Pais` varchar(30) DEFAULT NULL,
  `CodigoPostal` varchar(20) DEFAULT NULL,
  `Telefonos` varchar(50) DEFAULT NULL,
  `Fax` varchar(50) DEFAULT NULL,
  `DirInternet` varchar(100) DEFAULT NULL,
  `eMail1` varchar(50) NOT NULL,
  `RFC` varchar(50) NOT NULL,
  `CURP` varchar(50) DEFAULT NULL,
  `Categoria` varchar(50) DEFAULT NULL,
  `Familia` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`IdProveedor`, `Proveedor`, `Nombre`, `NombreCorto`, `Direccion`, `DireccionNumero`, `DireccionNumeroInt`, `EntreCalles`, `Delegacion`, `Colonia`, `Poblacion`, `Estado`, `Pais`, `CodigoPostal`, `Telefonos`, `Fax`, `DirInternet`, `eMail1`, `RFC`, `CURP`, `Categoria`, `Familia`) VALUES
(1, '1134', 'SISTEMAS Y SERVICIOS TECNOLOGICOS ESPECIALIZADOS DE MERIDA SA DE CV', 'SISTEMAS', 'CALLE 60', '345', '21', 'X 37', NULL, 'CENTRO', 'MERIDA', 'YUCATAN', 'Mexico', '97000', NULL, NULL, NULL, '', 'SST8412195Z6', NULL, NULL, 'Proveedores Mercancia'),
(2, '1172', 'TIENDAS CUPRUM SA DE CV', 'TIENDAS CUPRUM SA DE', 'AV. DIEGO DIAZ DE BERLANGA 95-A', NULL, NULL, NULL, NULL, 'INDUTRIAL NOGALAR', 'SAN NICOLAS', 'NUEVO LEON', 'Mexico', '66484', NULL, NULL, NULL, '', 'TCU101221G61', '', 'ALUMINIO', 'Proveedores Mercancia'),
(3, '1269', 'ESCALUMEX SA DE CV', 'ESCALUMEX SA DE CV', 'CALZADA AZCAPOTZALCO LA VILLA   1257', NULL, NULL, NULL, 'GUSTAVO A MADERO', 'CHURUBUSCO TEPEYAC', 'ECATEPEC DE MORELOS', 'Ciudad de México', 'Mexico', '7730', '(01 55) 57-52-12-69 Y 55-86-57-92', '55-86-94-80', NULL, 'ventas@escalumex.com', 'ESC910207225', NULL, 'HERRAJES', 'Proveedores Mercancia'),
(4, '128', 'PRODUCTOS PENNSYLVANIA S.A. DE C.V.', 'PENNSYLVANIA', 'CAMINO A SAN JOSE No. 1', NULL, NULL, NULL, NULL, 'FRACC. PARQUES INDUSTRIALES', 'SANTIAGO DE QUERETARO', 'QUERETARO', 'Mexico', '76169', '01 442 217 32 32  Y  01 442 217 36 46', NULL, 'www.pennsylvania.com.mx', '', 'PPE490224HI0', NULL, 'HERRAJES', 'Proveedores Mercancia'),
(5, '135', 'ACRILICOS PLASTITEC S.A. DE C.V.', 'PLASTI TEC', 'AV.DEL SABINO # 24 ESQ.18 DE MARZO BO NATIVITAS', NULL, NULL, NULL, NULL, '', 'NATIVITAS TULTITLAN', 'MEXICO', 'Mexico', '54900', '5888-0431-5888-0439', NULL, NULL, 'apldf@prodigy.net.mx', 'APL920424PD5', NULL, 'ALUMINIO', 'Proveedores Mercancia'),
(6, '1350', 'LETICIA CIAU SANCHEZ', 'LETICIA CIAU SANCHEZ', '90 AV. SUR BIS LOTE 8 PRIV. ADOLFO ROSADO SALAS', NULL, NULL, 'Y 1 ERA SUR', NULL, 'CHENTUK', 'COZUMEL', 'QUINTANA ROO', 'Mexico', '77645', '19878693678', NULL, NULL, 'perfilesyvidrioscozumel@hotmail.com', 'CISL720308NV3', 'CISL720308MQRXNT05', 'HERRAJES', 'Proveedores Mercancia'),
(7, '1354', 'APHERMAQ, S.A.DE C.V.', NULL, 'Los angeles #44 Capilla de Guadalupe, Jalisco', NULL, NULL, NULL, NULL, NULL, NULL, 'JALISCO', 'Mexico', '47700', NULL, '13787120918', '', '', 'APH0401154XA', NULL, 'HERRAJES', 'Proveedores Mercancia'),
(8, '137', 'CANCELERIA DE ALUMINIOS Y VIDRIOS S.A.', 'CANCELES DE ALUMINIO', 'MZA.355 C 68 LOTE 18', NULL, NULL, 'POR 20 Y 25', NULL, 'LUIS DONALDO COLOSIO', 'PLAYA DEL CARMEN', 'QUINTANA ROO', 'Mexico', NULL, NULL, NULL, NULL, '', 'AUSR8411193D4', 'AUSR841119HYNGRF05', NULL, 'Proveedores Mercancia'),
(9, '1382', 'DORMA MEXICO S DE RL', 'SUR 110  63', '', NULL, NULL, NULL, 'ALVARO OBREGON', 'TOLTECA', NULL, 'Ciudad de México', 'Mexico', '1150', NULL, NULL, NULL, '', 'DME000128FG0', NULL, 'HERRAJES', 'Proveedores Mercancia'),
(10, '1413', 'PROV DUPLICADO', 'DIEGO DIAZ DE BERLANGA', '', '95-A', NULL, NULL, '', 'NOGALAR', 'SAN NICOLAS DE LOS GARZA', 'NUEVO LEON', 'Mexico', '66480', NULL, NULL, NULL, '', 'CUP870529UG7', NULL, 'HERRAJES', 'Proveedores Mercancia'),
(11, '70', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(12, '1257', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(13, '1211', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(14, '46', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(15, '1123', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(16, '7', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(17, '821', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(18, '22', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rama`
--

CREATE TABLE `rama` (
  `IdRama` int(11) NOT NULL,
  `Cuenta` char(20) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rama`
--

INSERT INTO `rama` (`IdRama`, `Cuenta`, `Nombre`) VALUES
(1, 'ALUMINIO', 'ALUMINIO'),
(2, 'HERRAJES', 'HERRAJES'),
(3, 'PINTURA', 'PINTURA'),
(4, 'FERRETERIA', 'FERRETERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `Sucursal` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Prefijo` varchar(10) DEFAULT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Delegacion` varchar(50) NOT NULL,
  `Colonia` varchar(50) DEFAULT NULL,
  `Poblacion` varchar(50) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Pais` varchar(20) DEFAULT NULL,
  `CodigoPostal` varchar(10) DEFAULT NULL,
  `Telefonos` varchar(20) DEFAULT NULL,
  `Estatus` varchar(20) DEFAULT NULL,
  `RFC` varchar(50) NOT NULL,
  `Encargado` varchar(20) NOT NULL,
  `Region` varchar(50) DEFAULT NULL,
  `Grupo` varchar(50) DEFAULT NULL,
  `ClaveEmpresa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`Sucursal`, `Nombre`, `Prefijo`, `Direccion`, `Delegacion`, `Colonia`, `Poblacion`, `Estado`, `Pais`, `CodigoPostal`, `Telefonos`, `Estatus`, `RFC`, `Encargado`, `Region`, `Grupo`, `ClaveEmpresa`) VALUES
(1, 'Oficina Matriz', NULL, 'Calle 30 x 13 y 15 Nº 178 B Depto. 1', 'Mérida', 'Garcia Gineres', 'Mérida', 'Yucatán', 'México', '97070', '999 9204545', 'ALTA', 'DAM970619481', 'ECampos', 'Yucatan', 'Merida', 'ALUM01'),
(2, 'Suc. Circuito', 'CTO', 'Calle 30 x 13 y 15 Nº 178 B Depto. 1', 'Mérida', 'Garcia Gineres', 'Mérida', 'Yucatán', 'México', '97070', '999 9204545', 'ALTA', 'DAM970619481', 'HMartinez', 'Yucatan', 'Merida', 'BER02'),
(3, 'Suc. Oriente', 'OTE', 'Calle 4 x 21 y 25 Nº 409 Lote 5', 'Mérida', 'Lázaro Cárdenas Ote', 'Mérida', 'Yucatán', 'México', '97157', '999225030', 'ALTA', 'DAM970619481', 'HMartinez', 'Yucatan', 'Merida', 'HER03'),
(4, 'Suc. Centro', 'CEN', 'Calle 44 x 63 Nº 504 E', 'Mérida', 'Merida Centro', 'Mérida', 'Yucatán', 'México', '97000', '9999234946', 'ALTA', 'DAM970619481', 'ECampos', 'Yucatan', 'Merida', 'BER02'),
(5, 'Suc. Itzaes', 'ITZ', 'Calle 81 A Av. Itzaes x 92 y 94 Nº 558 A', 'Mérida', 'Obrera', 'Mérida', 'Yucatán', 'México', '97260', '9999844226', 'ALTA', 'DAM970619481', 'ECampos', 'Yucatan', 'Merida', 'ALUM01'),
(6, 'Suc. Sur', 'SUR', 'Calle 111 x 50 A y 52 Nº 435 B', 'Mérida', 'Dolores Otero', 'Mérida', 'Yucatán', 'México', '97270', '9991310384', 'ALTA', 'DAM970619481', 'ECampos', 'Yucatan', 'Merida', 'HER03'),
(7, 'Suc. Turquesa', 'TUR', 'Calle 6 x 13 y 15 Nº 390 Depto. 3', 'Mérida', 'Diaz Ordaz', 'Mérida', 'Yucatán', 'México', '97130', '9991960396', 'ALTA', 'DAM970619481', 'HMartinez', 'Yucatan', 'Merida', 'ALUM01'),
(8, 'Suc. Talleres', 'TAL', 'Region 90 Lote 8 Manzana 51 x 49 y 53', 'Benito Juárez', 'Región 90', 'Cancún', 'Quintana Roo', 'México', '77510', '9988919840', 'ALTA', 'DAM970619481', 'ECampos', 'Quintana Roo', 'Cancun', 'ALUM01'),
(9, 'Suc. Portillo', 'POR', 'Av. Lopez Portillo Mza 38 Lote 8 x Av. Comalcalco y Calle Bacabchen', 'Benito Juárez', 'Supermanzana 58', 'Cancún', 'Quintana Roo', 'México', '77515', '9988865996 y 9882068', 'ALTA', 'DAM970619481', 'ECampos', 'Quintana Roo', 'Cancun', 'BER02'),
(10, 'Suc. Playa del Carmen', 'PYA', 'Av. 30 M-43 x C-2 y 4 Norte', 'Solidaridad', 'Playa del Carmen Centro', 'Playa del Carmen', 'Quintana Roo', 'México', '77710', '9848794461', 'ALTA', 'DAM970619481', 'ECampos', 'Quintana Roo', 'Playa del Carmen', 'HER03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `Nombres` varchar(50) DEFAULT NULL,
  `ApellidoPaterno` varchar(30) DEFAULT NULL,
  `ApellidoMaterno` varchar(30) DEFAULT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contrasenia` varchar(50) NOT NULL,
  `ClaveEmpresa` varchar(20) NOT NULL,
  `IdPerfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nombres`, `ApellidoPaterno`, `ApellidoMaterno`, `Usuario`, `Contrasenia`, `ClaveEmpresa`, `IdPerfil`) VALUES
(1, 'MARIO RAFAEL', 'AVILA', 'HU', 'MAVILA', '123', 'ALUM01', 1),
(2, 'SANTOS', 'CHAC', 'CANTE', 'SCHAC', '1234', 'ALUM01', 2),
(3, 'ASDASD', 'ADAS', 'ASDASDFFFFFFF', 'ASD', 'ASDASD', 'HER03', 1),
(4, 'ASD', 'ASD', 'ASDASD', 'ASD', 'ADSDA', 'ALUM01', 2),
(5, 'ASD', 'ASD', 'ASDYYYYYYY', 'ADSPPP', 'ADSFFFF', 'ALUM01', 2),
(12, 'ASD', 'ASD', 'ASDASD', 'ASD', 'ADSDAADDD', 'ALUM01', 2),
(13, 'ASD', 'ASD', 'ASDASD', 'ASD', 'ADSDA', 'ALUM01', 1),
(14, 'ASD', 'ASDSAD', 'ASDSAD', 'SADSA', 'DSAD', 'ALUM01', 2),
(15, 'ASD', 'ASD', 'DASD', 'ASD', 'ASD', 'ALUM01', 2),
(16, 'GJHG', 'JLJKJ', 'HGJJH', 'JHGJ', 'JGHJJ', 'ALUM01', 2),
(17, 'FGHGFH', 'FGH', 'HGFHG', 'HFGH', 'GFHGFH', 'ALUM01', 2),
(18, 'ASD', 'ASD', 'ADSDAS', 'ASDD', 'ASD', 'ALUM01', 2),
(19, 'ASDSAD', 'SDSD', 'ASDASD', 'ASDAS', 'DSADASD', 'ALUM01', 2),
(20, 'SDFSD', 'FD', 'DSFDSF', 'FSDF', 'SDFSDF', 'BER02', 2),
(21, 'DAD', 'ASDSAD', 'SDADSA', 'ASD', 'ASDASD', 'ALUM01', 2),
(22, 'DAD', 'ASDSAD', 'SDADSA', 'ASD', 'ASDASD', 'ALUM01', 2),
(23, 'DAD', 'ASDSAD', 'SDADSA', 'ASD', 'ASDASD', 'ALUM01', 2),
(24, 'DAD', 'ASDSAD', 'SDADSA', 'ASD', 'ASDASD', 'ALUM01', 2),
(25, 'DAD', 'ASDSAD', 'SDADSA', 'ASD', 'ASDASD', 'ALUM01', 2),
(26, 'DAD', 'ASDSAD', 'SDADSA', 'ASD', 'ASDASD', 'ALUM01', 2),
(27, 'ADS', 'AS', 'DASD', 'MAVILA', '123', 'ALUM01', 2),
(28, 'BRYANT', 'PAZ', 'LOEZA', 'BPAZ', '123', 'BER02', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`Almacen`),
  ADD KEY `RefSucursal28` (`Sucursal`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`Articulo`),
  ADD KEY `RefAlmacen3` (`Almacen`),
  ADD KEY `RefLinea22` (`IdLinea`),
  ADD KEY `RefSucursal2` (`Sucursal`),
  ADD KEY `RefCategoria16` (`IdCategoria`),
  ADD KEY `RefFabricante21` (`IdFabricante`),
  ADD KEY `RefFamilia18` (`IdFamilia`),
  ADD KEY `RefGrupo19` (`IdGrupo`),
  ADD KEY `RefProveedor20` (`IdProveedor`),
  ADD KEY `RefRama29` (`IdRama`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`ClaveEmpresa`);

--
-- Indices de la tabla `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`IdFabricante`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`IdFamilia`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`IdGrupo`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`IdLinea`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`IdPerfil`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`IdProveedor`);

--
-- Indices de la tabla `rama`
--
ALTER TABLE `rama`
  ADD PRIMARY KEY (`IdRama`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`Sucursal`),
  ADD KEY `RefEmpresa23` (`ClaveEmpresa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `RefEmpresa26` (`ClaveEmpresa`),
  ADD KEY `RefPerfil27` (`IdPerfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `IdFabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `IdFamilia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `IdGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `IdLinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `IdPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `IdProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `rama`
--
ALTER TABLE `rama`
  MODIFY `IdRama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `Sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `RefSucursal28` FOREIGN KEY (`Sucursal`) REFERENCES `sucursal` (`Sucursal`);

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `RefAlmacen3` FOREIGN KEY (`Almacen`) REFERENCES `almacen` (`Almacen`),
  ADD CONSTRAINT `RefCategoria16` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`),
  ADD CONSTRAINT `RefFabricante21` FOREIGN KEY (`IdFabricante`) REFERENCES `fabricante` (`IdFabricante`),
  ADD CONSTRAINT `RefFamilia18` FOREIGN KEY (`IdFamilia`) REFERENCES `familia` (`IdFamilia`),
  ADD CONSTRAINT `RefGrupo19` FOREIGN KEY (`IdGrupo`) REFERENCES `grupo` (`IdGrupo`),
  ADD CONSTRAINT `RefLinea22` FOREIGN KEY (`IdLinea`) REFERENCES `linea` (`IdLinea`),
  ADD CONSTRAINT `RefProveedor20` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`IdProveedor`),
  ADD CONSTRAINT `RefRama29` FOREIGN KEY (`IdRama`) REFERENCES `rama` (`IdRama`),
  ADD CONSTRAINT `RefSucursal2` FOREIGN KEY (`Sucursal`) REFERENCES `sucursal` (`Sucursal`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `RefEmpresa23` FOREIGN KEY (`ClaveEmpresa`) REFERENCES `empresa` (`ClaveEmpresa`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `RefEmpresa26` FOREIGN KEY (`ClaveEmpresa`) REFERENCES `empresa` (`ClaveEmpresa`),
  ADD CONSTRAINT `RefPerfil27` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
