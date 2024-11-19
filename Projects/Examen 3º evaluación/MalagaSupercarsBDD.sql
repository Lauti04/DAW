CREATE DATABASE MalagaSupercars;
USE MalagaSupercars;

CREATE TABLE Coches (
    id_coche INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    año YEAR,
    precio DECIMAL(10, 2),
    descripcion TEXT,
    imagen VARCHAR(255)
);

CREATE TABLE Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255),
    telefono VARCHAR(15)
);

CREATE TABLE Empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    email VARCHAR(100),
    direccion VARCHAR(255),
    puesto VARCHAR(50),
    salario DECIMAL(10, 2)
);

CREATE TABLE Reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_coche INT,
    fecha_reserva DATETIME,
    estado ENUM('pendiente', 'confirmada', 'cancelada'),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_coche) REFERENCES Coches(id_coche)
);

INSERT INTO Coches (marca, modelo, año, precio, descripcion, imagen) VALUES 
    ('MCLAREN', 'P1', 2021, 1999900.00, 'McLaren P1 07/2021 - 900 KMS - 1 OF 375\n\nEste coche tiene el número de chasis n.º 001 de 375 P1 que se han producido.\n\nEste coche tiene placas del famoso piloto de Fórmula 1 Alain Prost con su logro con McLaren.\n\nVEHÍCULO COMPLETAMENTE NUEVO - COCHE DE COLECCIÓN.\n\n1 COLOR APAGADO PARA EL PROPIETARIO QUE SE UTILIZÓ EN ESTE COCHE Y SPEEDTAIL.\n\nPRIMER DUEÑO.\n\nPLACAS DE GIBRALTAR.\n\nPRECIO NETO.', 'assets/images/cars/coche1'),
    ('FERRARI', 'F8 Tributo', 2020, 319900.00, 'FERRARI F8 TRIBUTO 720CV - 07/2020 - 20.000 KMS\n\nFERRARI APPROVED +2 AÑOS\n\nROSSO CORSA.\n\nINTERIOR EN CUERO NERO.\n\nMOLDURAS EN CARBONO.\n\nVOLANTE EN CUERO NERO & FIBRA DE CARBONO.\n\nCOSTURAS ROJAS EN CONTRASTE.\n\nASIENTOS DEPORTIVOS EN CUERO/ALCANTARA.\n\nELEVADOR DE SUSPENSION EN EJE DELANTERO.\n\nSENSORES DE APARCAMIENTO 360º.\n\nCAMARA DE VISION TRASERA.\n\nPINZAS DE FRENO ROJAS.\n\nLLANTAS 20\" Diamond\".\n\nMATRICULA ESPAÑOLA.\n\nLIBRO DE REVISIONES FERRARI.\n\nIVA NO DEDUCIBLE.', 'assets/images/cars/coche2'),
    ('LAMBORGHINI', 'Sián Roadster', 2022, 3990000.00, 'LAMBORGHINI SIAN ROADSTER 819 CV - 10/2022 - 90 KMS\n\nLIMITED EDITION 1 OF 19\n\nLamborghini Sián Roadster, diseñada para el futuro una máquina de ensueño con más de 800 CV, pero además es un coche extremadamente tecnológico ya que incluye la primera aplicación de un "Supercondensador" en un coche descapotable e híbrido.\n\nGRIS (Grigio Estoque Grey).\n\nDETALLES EN NARANJA & CARBONO.\n\n- Plitter delantero, alerón trasero, difusor y enormes canalizaciones en fibra de carbono.\n\nINTERIOR EN ALCANTARA NEGRO, CUERO NARANJA & DETALLES EN FIBRA DE CARBONO.\n\nVOLANTE EN ALCANTARA & CARBONO.\n\nASIENTOS DEPORTIVOS SEMIBAQUETS.\n\nCLIMATIZADOR BI-ZONA.\n\nPANTALLA TACTIL.\n\nLIFT SUSPENSION EN EJE DELANTERO.\n\nNAVEGADOR.\n\nTLF / BLUETOOTH.\n\nPINZAS DE FRENO NARANJAS.\n\nLLANTAS 20\" & 21\".\n\nPRECIO NETO.', 'assets/images/cars/coche3'),
    ('PORSCHE', '911 4.0 GT3 RS PDK', 2016, 214900.00, 'PORSCHE 911 4.0 GT3 RS PDK 500CV - 09/2016 - 17.500 KMS\n\nNARANJA (Lava Orange)\n\nINTERIOR BITONO (Cuero Negro & Alcantara Naranja)\n\nAUTOMATICO PDK.\n\nVOLANTE EN ALCANTARA NEGRO & DETALLES NARANJA.\n\nCLIMATIZADOR BIZONA.\n\nASIENTOS ELECTRICOS.\n\nPAQUETE SPORT CHRONO.\n\nNAVEGADOR.\n\nTLF / BLUETOOTH.\n\nCONTROL DE VELOCIDAD.\n\nLECTOR CD.\n\nPDK SPORT.\n\nPIT SPEED.\n\nVALVULA DE APERTURA EN ESCAPE.\n\nLIFT SUSPENSION (Elevación en eje delantero)\n\nSOPORTE PARA BEBIDAS (Posavasos)\n\nFRENOS CARBO-CERAMICOS.\n\nLLANTAS 20\" MONOTUERCA.\n\nLIBRO DE REVISIONES EN CASA OFICIAL PORSCHE.\n\nMATRICULA ESPAÑOLA.\n\n2 LLAVES.', 'assets/images/cars/coche4'),
    ('ASTON MARTIN', 'ONE-77', 2011, 1000000.00, 'ASTON MARTIN ONE-77 V12 760CV - 12/2011 - 4.500 KMS\n\n71 of 77\n\nONE OFF COLOR.\n\nDETALLES EXTERIORES EN FIBRA DE CARBONO.\n\nINTERIOR EN CUERO EXCLUSIVO MARRON CHOCOLATE & BORDADOS MARRON CAMEL.\n\nSALPICADERO & CONSOLA CENTRAL MARRON CAMEL.\n\nREVESTIMIENTO DE PUERTAS EN FIBRA DE CARBONO.\n\nVOLANTE EN CUERO & ALCANTARA.\n\nVOLANTE MULTIFUNCION.\n\nASIENTOS ELECTRICOS CON MEMORIA.\n\nMOTOR EN FIBRA DE CARBONO.\n\nNAVEGADOR.\n\nTLF/BLUETOOTH.\n\nCAMARA DE VISION TRASERA.\n\nEQUIPO DE SONIDO PREMIUM "Bang & OLUFSEN".\n\nPINZAS DE FRENO "Gloss Orange"\n\nLLANTAS 20" "Gold Mat".\n\n\nMATRICULA GIBRALTAR.\n\nPRECIO NETO.\n\nUNICO PROPIETARIO.\n\nVEHICULO DE COLECCION.', 'assets/images/cars/coche5'),
    ('PORSCHE', 'Panamera 4 e-Hybrid', 2019, 89900.00, 'PORSCHE Panamera 4 e-Hybrid 462CV - 2019', 'assets/images/cars/coche6'),
    ('FERRARI', '812 SUPERFAST', 2020, 334900.00, 'FERRARI 812 SUPERFAST ZANASI EDITION 800CV - 02/2020 - 2.000 KMS\n\nZANASI EDITION +30.000€ :\n\n- Linea deportiva central "Nero & Giallo".\n\n- Nº 86 Exclusivo en puertas.\n\n- Escudo Ferrari serigrafiado.\n\n\nGRIS "Grigio Silverstone".\nPARTE DELANTERA DEL PARACHOQUES DELANTERO EN FIBRA DE CARBONO.\nPARACHOQUES LATERAL TRASERO EN FIBRA DE CARBONO.\nCUBIERTA BAJO PUERTA DE FIBRA DE CARBONO.\nMANIJA INTERIOR DE PUERTA DE FIBRA DE CARBONO.\nEXTRAS EXTERIOR EN CARBONO.\nASIENTOS DE CARRERA DE FIBRA DE CARBONO ASIENTOS DE GRAN TAMAÑO.\nINSERCIONES DE CUERO EN LOS LADOS DE LOS ASIENTOS.\nZONA CONDUCTOR DE FIBRA DE CARBONO+LEDS.\nCARCASA DEL BOTÓN F1 DE UN COLOR ÚNICO.\nGIALLO DREAMLINE MONOCOLOR EN PADEL F1.\nPUÑOS DE VENTILACIÓN DE AIRE NEGROS EN EL SALPICADERO.\nFILM ANTI ASTILLAS DE PIEDRAS.\nPANTALLA DEL PASAJERO.\nCAMARA TRASERA.\nNAVEGADOR.\nLIFT SUSPENSION EN EJE DELANTERO.\nRUEDAS DE CARRERAS FORJADAS DE 20" EN NEGRO MATE.\n\n\nPLACAS DE GIBRALTAR.\nPRECIO NETO.\nUNICO DUEÑO.', 'assets/images/cars/coche7'),
    ('AUDI', 'SQ8', 2020, 104900.00, 'AUDI SQ8 4.0 TDI quattro tiptronic 435CV - 02/2020 - 55.000 KMS\n\nGRIS MATE.\n\nINTERIOR EN CUERO & ALCANTARA NEGRO.\n\nASIENTOS DEPORTIVOS "Premium S-Line".\n\nASIENTOS ELECTRICOS.\n\nASIENTOS CALEFCTABLES & VENTILADOS.\n\nCLIMATIZADOR 4-ZONAS.\n\nPANTALLA TACTIL.\n\nNAVEGADOR.\n\nTLF/BLUETOOTH.\n\nAPPLE CARPLAY & ANDROID.\n\nCONTROL DE VELOCIDAD.\n\nSENSORES 360º & CAMARA DE VISION TRTASERA.\n\nLLANTAS 19".\n\n\nMATRICULA ESPAÑOLA.\n\nLIBRO DE REVISIONES.\n\n2 LLAVES.', 'assets/images/cars/coche8'),
    ('MERCEDES-BENZ', 'G 63 AMG 4Matic 9G-Tronic', 2019, 189990.00, 'MERCEDES-BENZ G-63 AMG 4MATIC 9G-TRONIC 585CV - 07/2019 - 41.500 KMS\n\nBLANCO (Polar White)\n\nINTERIOR EN CUERO BLANCO.\n\nVOLANTE MULTIFUNCION EN ALCANTARA.\n\nASIENTOS DEPORTIVOS ELECTRICOS CON FUNCION DE MEMORIA.\n\n- ASIENTOS DELANTEROS & TRASEROS CALEFACTABLES.\n\n- ASIENTOS CON ANCLAJE ISOFIX.\n\nTECHO PANORAMICO ABATIBLE.\n\nLUCES DE AMBIENTES.\n\nCLIMATIZADOR 4-ZONAS.\n\nSENSORES & CAMARA 360º.\n\nEQUIPO DE SONIDO "Burmester".\n\nAPPLE CARPLAY & ANDROID.\n\nNAVEGADOR.\n\nAPERTURA DE VALVULA EN ESCAPE.\n\nPINZAS DE FRENO AMG ROJAS.\n\nLLANTAS AMG 22".\n\n\nMATRICULA ESPAÑOLA.\n\nVEHICULO NACIONAL.\n\nLIBRO DE REVISIONES MERCEDES.\n\n2 LLAVES.\n\nIVA NO DEDUCIBLE.', 'assets/images/cars/coche9'),
    ('DODGE', 'VIPER Roadster SRT10', '2008', 77900.00, 'DODGE VIPER ROADSTER 506CV - 01/2008 - 65.000 KMS\n\nNEGRO.\n\nINTERIOR EN CUERO NEGRO.\n\nMANUAL 6 VEL.\n\nCLIMATIZADOR.\n\nVOLANTE EN CUERO NEGRO.\n\nASIENTOS DEPORTIVOS EN CUERO NEGRO.\n\nRETROVISORES ELECTRICOS.\n\nRADIO "ALPINE"\n\nTLF / BLUETOOTH.\n\nEQUIPO DE SONIDO "ALPINE"\n\nPINZAS DE FRENO ROJAS.\n\nLLANTAS 18".\n\nMATRICULA ESPAÑOLA.\n\nTOTALMENTE REVISADO.\n\n2 LLAVES.', 'assets/images/cars/coche10'),
    ('MASERATI', 'GranTurismo S', '2008', 49900.00, 'MASERATI GRANTURISMO S V8 440CV - 11/2008 - 97.000 KMS\n\nNACIONAL!!\n\nNEGRO METALIZADO.\n\nINTERIOR EN CUERO & ALCANTARA NEGRO.\n\nAUTOMATICO MC SPORTSHIFT.\n\nCLIMA BIZONA.\n\nVOLANTE MULTIFUNCION.\n\nASIENTOS EN ALCANTARA & CUERO NEGRO.\n\nASIENTOS ELECTRICOS CON MEMORIA.\n\nASIENTOS CALEFACTABLES.\n\nNAVEGADOR.\n\nTLF/BLUETOOTH.\n\nRADIO CD.\n\nSENSOR DE LUCES Y LLUVIA.\n\nLUCES XENON.\n\nCONTROL DE VELOCIDAD.\n\nCONTROL POR VOZ.\n\nSISTEMA DE SONIDO "BOSE".\n\nSENSORES DE APARCAMIENTO DELANTERO Y TRASERO.\n\nALERON CARBONO MC STRADALLE\n\nKIT MC STYLE: DIFUSOR, FRONTAL.\n\nPINZAS DE FRENO ROJAS.\n\nLLANTAS 20" TRIDENT.\n\n2 LLAVES.\n\nVEHICULO NACIONAL.\n\nLIBRO DE REVISIONES ORIGINALES "MASERATI".\n\n2 PROPIETARIOS.', 'assets/images/cars/coche11'),
    ('FERRARI', 'F430', '2007', 118900.00, 'FERRARI F430 SPIDER - 490CV - 06/2007 - 69.000 KMS\n\nROJO (Rooso Corsa)\n\nINTERIOR BEIGE CO SALPICADERO EN CUEO NEGRO & CARBONO.\n\nAUT. F1.\n\nVOLANTE EN CUERO NEGRO.\n\nCLIMATIZADOR.\n\nASIENTOS DEPORTIVOS ELECTRICOS & CALEFACTABLES.\n\nCAPOTA TELA NEGRA.\n\nFAROS XENON.\n\nPINZAS DE FRENO ROJO FERRARI.\n\nLLANTAS 19".\n\nMATRICULA ESPAÑOLA.\n\nHISTORIAL DE REVISIONES.\n\n2 LLAVES.', 'assets/images/cars/coche12'),
    ('MERCEDES-BENZ', 'GLE 63s AMG Coupé', '2021', 149900.00, 'Mercedes-Benz GLE 63s AMG Coupé 612CV - 08/2021 - 35.000 KMS\n\nNEGRO.\n\nINTERIOR EN CUERO NEGRO NAPA AMG.\n\nVOLANTE MULTIFUNCION CALEFACTADO.\n\nCLIMATIZADOR 4-ZONAS THERMOTRONIC.\n\nAUTO. AMG SPEEDSHIFT TCT 9G.\n\nASIENTOS AMG ELECTRICOS CON MEMORIA.\n\n- ASIENTOS CALEFACTABLES & VENTILADOS.\n\n- ASIENTOS DELANTEROS CON FUNCION DE MASAJE.\n\nCONTROL POR VOZ LINGUATRONIC.\n\nPortón trasero EASY-PACK (apertura y cierre automático)\n\nILUMINACION DE AMBIENTE 64 COLORES.\n\nMAGIC VISION CONTROL (limpiaparabrisas adaptativo con escobillas calefactadas)\n\nEQUIPO DE SONIDO "BURMESTER"\n\nNAVEGADOR.\n\nPANTALLA CENTRAL (12,3")\n\nAPPLE CarPlay & ANDROID.\n\nAVISO DE CAMBIO INVOLUNTARIO DE CARRIL.\n\nALERTA POR CANSANCIO (ATTENTION ASSIST).\n\nAMG Track Pace (toma de datos en pista)\n\nAsistente activo de distancia (DISTRONIC)\n\nSENSORES DE APARCAMIENTO & CAMARA DE VISION 360º.\n\nDYNAMIC SELECT (selección de programas de conducción)\n\nISOFIX.\n\nLLANTAS 22".\n\n2 LLAVES.\n\nMATRICULA ESPAÑOLA.\n\nLIBRO DE REVISIONES.', 'assets/images/cars/coche13'),
    ('BENTLEY', 'Continental Drophead Coupe', '1994', 129900.00, 'BBENTLEY CONTINENTAL DROPHEAD COUPE MULLINER PARK WARD 226CV - 05/1994 - 82.000 Millas - 131.000 KMS\n\n1 OF 421\n\nBLANCO "Arctic White".\n\nCAPOTA DE LONA BEIGE.\n\nINTERIOR EN CUERO BEIGE "Tan with Bone piping".\n\n- Color crema con interior de cuero Tan con ribetes Bone, alfombras Brown y capó convertible Bone Everflex.\n\nMOLDURAS EN MADERA DE NOGAL.\n\nAUTOMATICO.\n\nASIENTOS ELECTRICOS CON MEMORIA.\n\nASIENTOS CALEFACTABLES.\n\nRADIO "ECLIPSE".\n\nTLF/BLUETOOTH.\n\nCLIMATIZADOR.\n\nELEVALUNAS ELECTRICOS.\n\nLLANTAS 15".\n\nMATRICULA PAISES BAJOS.\n\nHISTORIAL DE MANTENIMIENTO.\n\n2 LLAVES.', 'assets/images/cars/coche14'),
    ('FERRARI', 'SF90 Spider', 2022, 569900.00, 'FERRARI SF90 SPIDER 1.001CV - 03/2022 - 300 KMS\n\nVehículo nuevo 0 kms en stock disponible para entrega inmediata.\n\nPrecio Neto!!\n\nROJO (Rosso Corsa) + PAQUETE EXTERIOR EN FIBRA DE CARBONO.\n\nINTERIOR EN CUERO NEGRO (Nero) CON COSTURAS ROJAS + PAQUETE INTERIOR EN FIBRA DE CARBONO.\n\nASIENTOS BAKETS EN CUERO NERO CON FRANJA ROSSO CORSA & CARBONO.\n\nCAVALINO BORDADO SOBRE REPOSACABEZAS EN COLOR ROSSO CORSA.\n\nVOLANTE MULTIFUNCION EN CUERO NERO & CARBONO.\n\nAUTOMATICO DOBLE EMBRAGUE 8 VELOCIDADES.\n\nCLIMATIZADOR BIZONA.\n\nFAROS INTELIGENTES LED MATRIX.\n\nPASSENGER DISPLAY.\n\nHEAD-UP DISPLAY.\n\nORDENADOR DE VIAJE CON NAVEGADOR.\n\nTLF/BLUETOOTH.\n\nCONTROL DE CRUCERO ADAPTATIVO.\n\nCAMARA DE VISION TRASERA CON PARKTRONIC 360º.\n\nLIFT SYSTEM.\n\nSISTEMA DE SONIDO HI-FI JBL.\n\nESCAPE DE TITANIO.\n\nFRENOS CARBONO-CERAMICOS.\n\nPINZAS DE FRENO ROSSO CORSA.\n\nLLANTAS EN CARBONO FORJADO.\n\n\nPRECIO NETO.', 'assets/images/cars/coche15'),
    ('PORSCHE', '997 GT2 RSR', 2008, 228900.00, 'PORSCHE 997 GT2 RSR 650CV - 01/2008 - 44.000 KMS\n\n- BLANCO SOLIDO.\n- INTERIOR EN CUERO Y ALCANTARA NEGRO/ROJO.\n- CAMBIO SECUENCIAL DE 6 VELOCIDADES.\n- PAQUETE "SPORT CHRONO".\n- ASIENTOS BUCKET DE FIBRA DE CARBONO.\n- CINTURONES DE 4 PUNTOS.\n- BARRAS ANTIVUELCO.\n- SISTEMA DE SONIDO "BOSE".\n- MOLDURAS INTERIORES EN CARBONO.\n- FRENOS CERAMICOS.\n- LLANTAS "BBS" 19".\n- SISTEMA DE ESCAPE DEPORTIVO.\n- EXTINTOR DE MANO.\n- LUCES DE XENON.\n- CONTROL DE VELOCIDAD.\n- RADIO BLUETOOTH "ALPINE".\n- CLIMATIZADOR.\n\n\n- MATRICULA ESPAÑOLA.\n- PREPARACION ORIGINAL GT2 RSR MOTORSPORT KIT SOBRE LA BASE DE UN 997 GT2.\n- TOTALMENTE HOMOLOGADO.\n- LIBRO DE MANTENIMIENTO SELLADO.\n- LIBROS ORIGINALES "PORSCHE".\n\n ESPECIFICACIONES\nMARCA: PORSCHE\nMODELO: 997 GT2 RSR\nPOTENCIA: 650 CV\nCOMBUSTIBLE: Gasolina\nCAMBIO: Secuencial\nAÑO: 2008\nCARROCERÍA: Coupe\nCOLOR EXTERIOR: Blanco\nCOLOR INTERIOR: Tela Negra/Alcantara Rojo', 'assets/images/cars/coche16'),
    ('MCLAREN', 'SENNA', 2019, 1290900.00, 'MCLAREN SENNA 800 CV 1 OF 500 - 1.500 KMS\n\nVEHICULO COMPLETAMENTE NUEVO A ESTRENAR - PRECIO NETO \n\n\nVEHICULO DE COLECCION.\n\n\n ESPECIFICACIONES\nMARCA: MCLAREN\nMODELO: Senna\nPOTENCIA: 800 CV\nCOMBUSTIBLE: Gasolina\nCAMBIO: Automatico\nAÑO: 2019\nCARROCERÍA: Coupe\nCOLOR EXTERIOR: Amarillo\nCOLOR INTERIOR: Negro', 'assets/images/cars/coche17'),
    ('LAMBORGHINI', 'COUNTACH LPI 800-4', 2022, 2595000.00, 'LAMBORGHINI COUNTACH LPI 800-4 814CV - 10/2022 -200 KMS\n\n1 OF 112\n\n\nBLANCO "Impact White".\n\nINTERIOR: Rosso Alala + Nero Ade.\n\nTAPICERIA EN CONTRASTE: Bianco Leda.\n\nDETALLES EN CARBONO.\n\nRADIO/TLF.\n\nNAVEGADOR.\n\nCAMARA DE VISION TRASERA.\n\nLIFT SUSPENSION EN EJE DELANTERO.\n\nASIENTOS CALEFACTABLES.\n\nSUPERCAP.\n\nPINZAS DE FRENO ROJAS "Rosso Alala".\n\nLLANTAS 20/21" CORTE DIAMANTE NEGRO BRILLANTE.\n\n\nPRECIO NETO.\n\nVEHICULO A ESTRENAR.\n\nPOSIBLE EXPORTACION MUNDIAL.\n\n ESPECIFICACIONES\nMARCA: LAMBORGHINI\nMODELO: Countach LPI 800-4\nPOTENCIA: 814 CV\nCOMBUSTIBLE: GASOLINA\nCAMBIO: AUT.\nAÑO: 2022\nCARROCERÍA: COUPE\nCOLOR EXTERIOR: "Impact White"\nCOLOR INTERIOR: Rosso Alala + Nero Ade', 'assets/images/cars/coche18'),
    ('BMW', 'M2 Competition', 2018, 61900.00, 'BMW M2 Competition 410CV - 10/2018 -16.500 KMS\n\nBLANCO.\n\nINTERIOR EN CUERO NEGRO CON COSTURAS EN CONTRASTE NARANJA.\n\nAUTOMATICO.\n\nVOLANTE MULTIFUNCION EN ALCANTARA & CARBONO.\n\nCLIMATIZADOR BIZONA.\n\nASIENTOS DEPORTIVOS CALEFACTABLES.\n\nNAVEGADOR.\n\nRADIO / CD.\n\nTLF / BLUETOOTH.\n\nApple CarPlay.\n\nCONTROL DE VELOCIDAD.\n\nSENSORES DE APARCAMIENTO.\n\nSUSPENSION CUSTOMIZADA "KW V4-3 Clubsport Coilovers"\n\nLLANTAS FORJADAS 19".\n\nMATRICULA ESPAÑOLA.\n\nESPECIFICACIONES\nMARCA: BMW\nMODELO: M2 Competition\nPOTENCIA: 410 CV\nCOMBUSTIBLE: GASOLINA\nCAMBIO: AUTOMATICO\nAÑO: 2018\nCARROCERÍA: COUPE\nCOLOR EXTERIOR: BLANCO\nCOLOR INTERIOR: CUERO NEGRO', 'assets/images/cars/coche19'),
    ('LAMBORGHINI', 'AVENTADOR ROADSTER LP700', 2014, 494900.00, 'LAMBORGHINI AVENTADOR ROADSTER HAMANN ZENTENARIO 800CV - 10/2014 - 20.297 KMS\n\nVEHICULO UNICO EN EL MUNDO CON ESTA CONFIGURACION, VEHICULO EXCLUSIVO - PREPARACION COMPLETA "HAMANN" CON PAQUETE PERFORMANCE - 1 DE 5\n\n- PINTURA ORIGINAL DE FABRICA: GIALLO ORION.\n- CARROCERIA COMPLETA HAMANN EN FIBRA DE CARBONO.\n- INTERIOR EN CUERO NEGRO Y COSTURAS AMARILLAS.\n- CAMBIO AUTOMATICO CON LEVAS.\n- NAVEGADOR.\n- SENSORES DE APARCAMIENTO CON CAMARA TRASERA.\n- SISTEMA DE SONIDO "SENSONUM".\n- ELEVADOR DEL EJE DELANTERO.\n- LLANTAS 20" NEGRAS.\n- PINZAS DE FRENO AMARILLAS.\n- SENSOR DE LUCES.\n- CONTROL DE VELOCIDAD.\n- VOLANTE MULTIFUNCION.\n- TLF BLUETOOTH.\n- RADIO CD.\n- CLIMATIZADOR.\n\n\n- 2 LLAVES.\n- IVA DEDUCIBLE.\n- PRECIO NETO.\n- LIBROS ORIGINALES "LAMBORGHINI".\n\nESPECIFICACIONES\nMARCA: LAMBORGHINI\nMODELO: AVENTADOR ROADSTER LP700\nPOTENCIA: 800 CV\nCOMBUSTIBLE: Gasolina\nCAMBIO: Automático\nAÑO: 2014\nCARROCERÍA: Cabrio\nCOLOR EXTERIOR: Fibra de Carbono Azul\nCOLOR INTERIOR: Cuero Negro', 'assets/images/cars/coche20');


INSERT INTO Usuarios (nombre, email, password, telefono) VALUES
    ('Juan Pérez', 'juanperez@example.com', 'contraseña123', '1234567890'),
    ('María García', 'mariagarcia@example.com', 'maria123', '2345678901'),
    ('Pedro Rodríguez', 'pedrorodriguez@example.com', 'pedrito456', '3456789012'),
    ('Ana Martínez', 'anamartinez@example.com', 'anita789', '4567890123'),
    ('Luis Sánchez', 'luissanchez@example.com', 'luisito123', '5678901234'),
    ('Laura Fernández', 'laurafernandez@example.com', 'laurita456', '6789012345'),
    ('Carlos Gómez', 'carlosgomez@example.com', 'carlitos789', '7890123456'),
    ('Sofía López', 'sofialopez@example.com', 'sofi123', '8901234567'),
    ('Javier Ruiz', 'javierruiz@example.com', 'javier456', '9012345678'),
    ('Elena Castro', 'elenacastro@example.com', 'elenita789', '0123456789'),
    ('David Navarro', 'davidnavarro@example.com', 'david123', '1111111111'),
    ('Carmen Jiménez', 'carmenjimenez@example.com', 'carmencita456', '2222222222'),
    ('Pablo Díaz', 'pablodiaz@example.com', 'pablito789', '3333333333'),
    ('Silvia Romero', 'silviaromero@example.com', 'silvia123', '4444444444'),
    ('Jorge Vázquez', 'jorgevazquez@example.com', 'jorgito456', '5555555555'),
    ('Rosa Pérez', 'rosaperez@example.com', 'rosita789', '6666666666'),
    ('Mario Gutiérrez', 'mariogutierrez@example.com', 'mario123', '7777777777'),
    ('Eva Martín', 'evamartin@example.com', 'eva456', '8888888888'),
    ('Antonio Muñoz', 'antoniomunoz@example.com', 'antonito789', '9999999999'),
    ('Cristina Álvarez', 'cristinaalvarez@example.com', 'cristinita123', '0000000000');

INSERT INTO Empleados (nombre, apellido, email, direccion, puesto, salario) VALUES
    ('Juan', 'Perez', 'juan.perez@example.com', 'Calle Falsa 123', 'Gerente de Ventas', 50000.00),
    ('María', 'Rodriguez', 'maria.rodriguez@example.com', 'Avenida Principal 456', 'Analista de Marketing', 40000.00),
    ('Carlos', 'Sánchez', 'carlos.sanchez@example.com', 'Paseo del Sol 789', 'Desarrollador Web', 45000.00),
    ('Laura', 'González', 'laura.gonzalez@example.com', 'Boulevard Central 987', 'Contador', 42000.00),
    ('Pedro', 'Martínez', 'pedro.martinez@example.com', 'Camino Real 321', 'Diseñador Gráfico', 38000.00),
    ('Ana', 'López', 'ana.lopez@example.com', 'Callejón de los Sueños 654', 'Analista de Sistemas', 47000.00),
    ('Miguel', 'Hernández', 'miguel.hernandez@example.com', 'Avenida de la Esperanza 876', 'Gerente de Recursos Humanos', 52000.00),
    ('Sofía', 'García', 'sofia.garcia@example.com', 'Plaza Mayor 234', 'Asistente Administrativo', 35000.00),
    ('Diego', 'Ruiz', 'diego.ruiz@example.com', 'Avenida de los Ángeles 543', 'Especialista en Ventas', 39000.00),
    ('Valentina', 'Vargas', 'valentina.vargas@example.com', 'Paseo de la Victoria 678', 'Ingeniero de Software', 48000.00),
    ('Ricardo', 'Castro', 'ricardo.castro@example.com', 'Avenida Libertad 987', 'Analista de Datos', 46000.00),
    ('Isabella', 'Rojas', 'isabella.rojas@example.com', 'Calle Principal 876', 'Gerente de Proyectos', 51000.00),
    ('Emilio', 'Gómez', 'emilio.gomez@example.com', 'Avenida del Sol 654', 'Especialista en Marketing', 41000.00),
    ('Luisa', 'Herrera', 'luisa.herrera@example.com', 'Paseo de los Pájaros 432', 'Diseñadora UX/UI', 43000.00),
    ('Andrés', 'Díaz', 'andres.diaz@example.com', 'Camino de las Flores 321', 'Consultor Financiero', 49000.00),
    ('Fernanda', 'Ramos', 'fernanda.ramos@example.com', 'Calle del Bosque 876', 'Especialista en RRHH', 44000.00),
    ('Roberto', 'Torres', 'roberto.torres@example.com', 'Avenida del Río 543', 'Desarrollador Full Stack', 46000.00),
    ('Camila', 'López', 'camila.lopez@example.com', 'Boulevard de los Suspiros 210', 'Analista de Calidad', 42000.00),
    ('Daniel', 'Martínez', 'daniel.martinez@example.com', 'Paseo de la Montaña 789', 'Gerente de Marketing', 50000.00),
    ('Lucía', 'Fernández', 'lucia.fernandez@example.com', 'Plaza del Sol 456', 'Asistente de Ventas', 35000.00);

INSERT INTO Reservas (id_usuario, id_coche, fecha_reserva, estado) VALUES
    (1, 1, '2024-05-01 10:00:00', 'pendiente'),
    (2, 2, '2024-05-02 11:00:00', 'pendiente'),
    (3, 3, '2024-05-03 12:00:00', 'confirmada'),
    (4, 4, '2024-05-04 13:00:00', 'pendiente'),
    (5, 5, '2024-05-05 14:00:00', 'pendiente'),
    (6, 6, '2024-05-06 15:00:00', 'confirmada'),
    (7, 7, '2024-05-07 16:00:00', 'pendiente'),
    (8, 8, '2024-05-08 17:00:00', 'pendiente'),
    (9, 9, '2024-05-09 18:00:00', 'pendiente'),
    (10, 10, '2024-05-10 19:00:00', 'confirmada'),
    (11, 11, '2024-05-11 20:00:00', 'pendiente'),
    (12, 12, '2024-05-12 21:00:00', 'pendiente'),
    (13, 13, '2024-05-13 22:00:00', 'pendiente'),
    (14, 14, '2024-05-14 23:00:00', 'pendiente'),
    (15, 15, '2024-05-15 00:00:00', 'confirmada'),
    (16, 16, '2024-05-16 01:00:00', 'pendiente'),
    (17, 17, '2024-05-17 02:00:00', 'pendiente'),
    (18, 18, '2024-05-18 03:00:00', 'pendiente'),
    (19, 19, '2024-05-19 04:00:00', 'confirmada'),
    (20, 20, '2024-05-20 05:00:00', 'pendiente');

-- Procedimiento para Iniciar Sesión
DELIMITER //

CREATE PROCEDURE ConsultarUsuario(
    IN p_email VARCHAR(100),
    IN p_password VARCHAR(255)
)
BEGIN
    SELECT * FROM MalagaSupercars.Usuarios
    WHERE email = p_email AND password = p_password;
END //

DELIMITER ;

-- Procedimiento para Registrarse
DELIMITER //

CREATE PROCEDURE InsertarUsuario(
    IN p_nombre VARCHAR(100),
    IN p_email VARCHAR(100),
    IN p_password VARCHAR(255),
    IN p_telefono VARCHAR(15)
)
BEGIN
    INSERT INTO MalagaSupercars.Usuarios (nombre, email, password, telefono) 
    VALUES (p_nombre, p_email, p_password, p_telefono);
END //

DELIMITER ;




-- Procedimiento para filtrar coches
DELIMITER $$

CREATE PROCEDURE mostrar_coches_filtrados(
    IN marca_param VARCHAR(50),
    IN modelo_param VARCHAR(50),
    IN precio_max_param DECIMAL(10, 2),
    IN anio_param YEAR
)
BEGIN
    IF marca_param = '' THEN
        SET marca_param = NULL;
    END IF;
    IF modelo_param = '' THEN
        SET modelo_param = NULL;
    END IF;
    IF precio_max_param = 0 THEN
        SET precio_max_param = NULL;
    END IF;
    IF anio_param = 0000 THEN
        SET anio_param = NULL;
    END IF;

    SELECT * 
    FROM Coches 
    WHERE (marca = marca_param OR marca_param IS NULL) 
      AND (modelo = modelo_param OR modelo_param IS NULL)
      AND (precio <= precio_max_param OR precio_max_param IS NULL)
      AND (año = anio_param OR anio_param IS NULL);

END$$

DELIMITER ;

-- Procedimientos para insertar y eliminar coches
DELIMITER //

CREATE PROCEDURE InsertarCoche(
    IN p_marca VARCHAR(50),
    IN p_modelo VARCHAR(50),
    IN p_ano YEAR,
    IN p_precio DECIMAL(10, 2),
    IN p_descripcion TEXT,
    IN p_imagen VARCHAR(255)
)
BEGIN
    INSERT INTO Coches (marca, modelo, año, precio, descripcion, imagen)
    VALUES (p_marca, p_modelo, p_ano, p_precio, p_descripcion, p_imagen);
END //

CREATE PROCEDURE EliminarCoche(
    IN p_marca VARCHAR(50),
    IN p_modelo VARCHAR(50)
)
BEGIN
    DECLARE v_id_coche INT;
    SELECT id_coche INTO v_id_coche FROM Coches WHERE marca = p_marca AND modelo = p_modelo;
    IF v_id_coche IS NOT NULL THEN
        DELETE FROM Reservas WHERE id_coche = v_id_coche;
        DELETE FROM Coches WHERE id_coche = v_id_coche;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se encontró ningún coche con la marca y modelo proporcionados.';
    END IF;
END //

DELIMITER ;

-- Usuario para insertar y borrar datos
CREATE USER 'insert_delete_user'@'localhost' IDENTIFIED BY '1234';
GRANT INSERT, DELETE ON MalagaSupercars.* TO 'insert_delete_user'@'localhost';
GRANT EXECUTE ON PROCEDURE MalagaSupercars.InsertarUsuario TO 'insert_delete_user'@'localhost';
GRANT SELECT ON malagasupercars.Usuarios TO 'insert_delete_user'@'localhost';
GRANT EXECUTE ON PROCEDURE MalagaSupercars.InsertarCoche TO 'insert_delete_user'@'localhost';
GRANT EXECUTE ON PROCEDURE MalagaSupercars.EliminarCoche TO 'insert_delete_user'@'localhost';
GRANT SELECT ON MalagaSupercars.Coches TO 'insert_delete_user'@'localhost';
FLUSH PRIVILEGES;

-- Usuario para consultar la tabla de productos
CREATE USER 'select_user'@'localhost' IDENTIFIED BY '1234';
GRANT SELECT ON MalagaSupercars.Coches TO 'select_user'@'localhost';
GRANT EXECUTE ON PROCEDURE MalagaSupercars.mostrar_coches_filtrados TO 'select_user'@'localhost';
GRANT EXECUTE ON PROCEDURE MalagaSupercars.ConsultarUsuario TO 'select_user'@'localhost';


-- Trigger que asegura que no se inserten coches con un precio menor o igual a cero.
DELIMITER //
CREATE TRIGGER before_insert_coche
BEFORE INSERT ON Coches
FOR EACH ROW
BEGIN
    IF NEW.precio <= 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El precio del coche debe ser mayor que cero';
    END IF;
END;
//
DELIMITER ;