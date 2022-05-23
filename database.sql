/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Apoyos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudadano` int(11) NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ciudadano` (`ciudadano`),
  KEY `area` (`area`),
  CONSTRAINT `Apoyos_ibfk_1` FOREIGN KEY (`ciudadano`) REFERENCES `Ciudadanos` (`id`),
  CONSTRAINT `Apoyos_ibfk_2` FOREIGN KEY (`area`) REFERENCES `Areas_Apoyos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Areas_Apoyos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ciudadanos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_pat` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_mat` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruta_credencial_frente` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta_credencial_reverso` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
