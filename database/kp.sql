-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: kp_baru
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `nip` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Agung','agung','komplek','081373517899','1999-11-12','m.agungmahardhika@gmail.com'),(2,'adib','adib','adib','081373517899','2021-03-23','adib@gmail.com'),(3,'nayla','nayla','nayla','081373517899','2021-03-23','nayla@gmail.com'),(4,'dio','dio','dio','081373517899','2021-03-23','dio@gmail.com'),(9,'k','k','k','081373517899','2021-03-23','k@gmail.com'),(10,'l','l','l','081373517899','2021-03-23','l@gmail.com'),(12,'a','kl','','','2021-03-23',''),(123,'Yulia','yulia','yulia','081373517899','0099-08-07','Yulia@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang` (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `id_jenis_barang` int DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_jenis_barang_idx` (`id_jenis_barang`),
  CONSTRAINT `id_jenis_barang` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barang` (`id_jenis_barang`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=730 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES (1,'Aminofillin 150 mg Tablet',7),(2,'Amlodipin tablet 10 mg',7),(3,'Amoksisillin 500 mg',7),(4,'Amoksisillin syrup kering 250 mg/ 5 ml',7),(5,'Antasida DOEN Tablet kunyah, komb : Aluminium Hidroksida 200 mg Magnesium Hidroksida 200 mg',7),(6,'Anti Bakteri Salep ( Bacitrasin Polymixin B )',7),(7,'Aqua Pro Injeksi',7),(8,'Asam Askorbat tablet 50 mg',7),(9,'Asam Mefenamat kaplet 500 mg',7),(10,'Attapulgit tablet 600 mg ( New Diagon )',7),(11,'Deksametason Tablet 0,5 mg',7),(12,'Diazepam 5 Mg Tablet',7),(13,'Digoksin tablet 0,25 mg',7),(14,'Dimenhidrinat tablet 50 mg',7),(15,'Domperidon tablet 10 mg',7),(16,'Epinefrin Injeksi',7),(17,'Eritromisin kaplet 250 mg',7),(18,'Eritromisin kaplet 500 mg',7),(19,'Eritromisin sirup 200 mg/5 ml',7),(20,'Fenobarbital tablet 30 mg',7),(21,'Furosemid Tablet 40 mg',7),(22,'Gentamisin Tetes Mata 0,3%',7),(23,'Glibenclamid',7),(24,'Glukosa larutan infus 5 %',7),(25,'Griseofulvin tablet 125 mg',7),(26,'Haldol Decanoat Injeksi 50 mg/ml',7),(27,'Hidrokortison krim 2,5 %',7),(28,'Isosorbid Dinitrat tablet sublingual 5 mg',7),(29,'Kaptopril tablet 12.5 mg',7),(30,'Ketokonazol tablet 200 mg',7),(31,'Klindamisin 150 mg Kapsul',7),(32,'Kloramfenikol 250 mg Kapsul',7),(33,'Kloramfenikol Salep Mata',7),(34,'Klorfeniramin Maleat (CTM) tablet 4 mg',7),(36,'Kotrimoksazol Forte kombinasi',7),(37,'Lansoprazol Tablet',7),(38,'Levofloxacin 750 mg',7),(39,'Lidocain Comp inj 2 %',7),(40,'Metformin 500 mg',7),(41,'Metronidazol 500 mg',7),(42,'Metoklopramid',7),(43,'Natrium Klorida larutan Infus 0,9 %',7),(44,'Nystatin 100.000 IU TAV',7),(45,'Parasetamol 500 mg tablet',7),(46,'Parasetamol syrup 120 mg / 5 ml',7),(47,'Pirantel tablet score (base) 125 mg',7),(48,'Piridoksin ( vitamin B6 ) tablet 10 mg',7),(49,'Propanolol 10 mg Tablet',7),(50,'Ringer Laktat',7),(51,'Salbutamol tablet 2 mg (sebagai Sulfat)',7),(52,'Simvastatin 10 mg tablet',7),(53,'Thiamin HCl ( Vit B1 ) Tablet 50 mg',7),(54,'Oxytetracyclin 1% Salep Mata',7),(55,'Retinol 200.000 IU',7),(56,'Zinc Syrup',7),(57,'Zinc Tablet',7),(58,'Handschoon Steril No.6,5',5),(59,'Kassa Pembalut Hidrofil 4m x 5 cm',5),(60,'Kassa Pembalut Hidrofil 4m x 10cm',5),(61,'Kassa Pembalut Hidrofil 4m x 15cm',5),(62,'Kassa Steril 16cm x 16 cm',5),(63,'Lampu bunsen',5),(64,'Pot Sputum',5),(65,'Spuit 3 ml',5),(66,'Spuit 5 ml',5),(67,'Aminofilina Injeksi 24 mg/ml',7),(68,'Aminofilina Tab 200 mg',7),(69,'Amoksisilin Tab 500 mg',7),(70,'Aqua Pro Injeksi steril, bebas pirogen',7),(71,'Asam Askorbat 50 mg tablet',7),(72,'Atropin sulfat inj 0,25 mg',7),(73,'Betametason Cream',7),(74,'Cefotaxime inj 1 gr',7),(76,'Cetirizine 10 mg tablet',7),(77,'Chlorpheniramine Maleate Tablet',7),(78,'Deksametason injeksi i.v 5 mg/ml',7),(79,'Difenhidramin HCl inj 10 mg/ml-1 ml',7),(80,'Fenobarbital injeksi 50 mg/ml',7),(81,'Fenobarbital Tablet',7),(82,'Fitomenadion Tablet',7),(83,'Fitomenadion ( Vitamin K 1 ) inj 10 mg/ml (i.m)',7),(85,'Glibenclamid 5 mg tablet',7),(86,'Griseofulvin tab 125 mg',7),(87,'Hidrochlortiazid ( HCT ) 25 mg',7),(88,'Hydrocortisone krim 2.5%',7),(89,'Isosorbid Dinitrat tablet sublingual',7),(90,'Kaptoril tablet 12,5 mg',7),(91,'Ketamin inj 50 mg/ml',7),(92,'Klindamisin kapsul 150 mg',7),(93,'Kotrimoksazol ( anak ) kombinsai tiap 5 ml suspensi : sulfametoksazol 200mg + trimetoprim 40 mg',7),(94,'Natrium Chlorida 0,9 % ( Cairan Infus NaCl )',7),(95,'Parasetamol Syrup',7),(97,'Povidon Iodida 10 % 30 ml',7),(98,'Povidon Iodida 10 % 300 ml',7),(99,'Prednison tablet 5 mg',7),(100,'Ringer Laktat ( Cairan Infus RL )',7),(101,'Salap 2 -4 Kombinasi : Asam Salisilat 2% + Belerang Endap 4%',7),(102,'Tetrasiklin HCl 500mg kapsul',7),(103,'Vitamin B Komplek',7),(104,'Vitamin B12 Injeksi 500 mcg',7),(105,'Dextrose 5% Infus',7),(106,'Vitamin B1 Tab',7),(107,'Salbutamol 2 mg',7),(108,'Vitamin B6 10 mg',7),(109,'Natrium diklofenat 25 mg',7),(111,'Lidocain Comp Injeksi',7),(112,'Cotrimoksazol 480 mg tab',7),(113,'Epinefrin inj 1 mg',7),(114,'Etanol 70%',7),(115,'Asam Askorbat 250 mg tablet',7),(116,'Antasida Doen 500 Tab',7),(117,'Antihemorroid sup',7),(118,'Allopurinol 100 mg Tab',7),(119,'Cat Gut Chromic 2/0 + Jarum ( Onemed )',5),(122,'IV Cath 20 G',5),(123,'IV Cath 24 G',5),(124,'Kapas Pembalut ( Absorben ) 250 gr',5),(125,'Kasa Pembalut 4m x 15 cm',5),(126,'Kasa Pembalut 4m x 3 cm',5),(127,'Sarung Tangan Steril 7,5',5),(128,'Silk 3/0 + Jarum 1/2GT 35 mm',5),(129,'Spuit 1 cc ( Stera )',5),(130,'Spuit 2.5 cc ( Stera )',5),(131,'Spuit 5 cc ( Stera )',5),(132,'Urine bag',5),(133,'Sarung tangan steril 7',5),(134,'Amitrpitilin 25 mg tab',7),(135,'Clobazam 10 mg tablet',7),(137,'Haloperidol tablet 5 mg',7),(138,'Karbamazepin 200 mg tablet',7),(139,'Klorpromazine 100 mg tablet',7),(140,'Trifluoperazine 2 mg tablet',7),(141,'Triheksifenidil 2 mg tablet',7),(142,'Chlorpromazin inj 25 mg/ml',7),(143,'Diazepam inj 5 mg/ml',7),(144,'Risperidon 2 mg Tab',7),(145,'Oralit',7),(147,'AED ( Physio Control - USA )',7),(148,'Alat Ukur Gula darah',5),(149,'Alkes Pengukuran faktor resiko PTM',5),(150,'ECG ( Fukuda Denshi - RRC )',5),(151,'Peakflow Meter',5),(152,'Spirometer ( MIR - Italy )',5),(153,'Tensimeter Digital+Tas ( Merk Omron )',5),(154,'Lansia Kit',5),(155,'Anascopy ( Yamaco ) Pakistan',5),(156,'Biomereux',5),(157,'D1 Anti HIV ( Merk Focus )',5),(158,'DBS Collection Kit ( Lasec )',5),(159,'Diagnostar DS HIV 1/2 One Step Rapid Test',5),(160,'Kertas pH indikator, range pH 3,8 - 5,4',5),(161,'KHB Diagnostik Kit For HIV ( 1 + 2 )',5),(162,'Kondom',5),(163,'Lubricant',5),(164,'Mikropipet ( Dragon One Med Mikropipet Adjustable 10 = 100 ML )',5),(165,'Pima Bead Stat device kontrol ( reagen CD 4 kontrol )',5),(166,'Rapid Test HIV 1 ( SD, INC/SD Bioline HIV½/ Korea)',5),(167,'Reagen CD 4',5),(168,'Rotator ( Digisistem Laboratory Instrumen ) Taiwan',5),(169,'RPR Sipilis ( Merk Focus )',5),(170,'Syphilis Ab Test (STANDART q Syphilis Ab test, SD Biosensor)',5),(172,'FACS Count CD4 Reagen Kit',5),(173,'Masker',5),(174,'Reagen Viral Load Kuantitatif (abbot)',6),(175,'Abacavir 300 mg',7),(176,'Atripla ( Triple FDC )',7),(177,'Benzatin benzyl Penisilina 2,4 juta',7),(178,'Duviral ( Zidovudine 300 + Lamivudine 150 )',7),(179,'Efavirenz 200 mg',7),(180,'Efavirenz 600 mg',7),(181,'Emtriva ( Tenofovir + Emtricitabine )',7),(182,'Endurant ( Rilvipirine 24 mg )',7),(183,'Fluconazole',7),(184,'Lamivudine 150 mg ( Hiviral )',7),(185,'Lopinavir 200 + Ritonavir 50 mg ( Aluvia )',7),(186,'Neviraphine 200 mg ( Neviral )',7),(187,'Reviral (zidovudine 100mg)',7),(188,'Tenofovir 300 mg',7),(189,'Vitamin B6 25 mg',7),(190,'Zidovudine/Lamivudine/Neviraphine ( Merk Lain )',7),(191,'Cotrimoksazol tab 960',7),(192,'Alkohol Swab',5),(193,'RDT SD HBs Ag ( multi )',6),(194,'Reagen Hepatitis ( HBIg)',6),(195,'Sarung Tangan Steril',5),(196,'Table Top Centrifuge PCL 05',7),(197,'Vaksin Hepatitis B Rekombinan Dewasa',15),(198,'Sound Timer',5),(199,'Asam ascorbat 500 mg',7),(200,'Multivitamin (Sivit-Zink KSS)',7),(201,'Entomologi kit',5),(202,'Mesin Fogging',5),(203,'Spraycan(Hansen ML-12)',5),(204,'ULV Portabel',5),(205,'Giemsa',5),(206,'Mikroskop Binokuler Olympus',5),(207,'Mikroskop Stereo',5),(208,'RDT Malaria ( Carestart HRP2/pLDH)Combo',6),(209,'Reagensia dan Bahan Alat Laboratorium Malaria',6),(210,'Artesunate Inj',7),(211,'Dehydro Artemisin ( Darplex ) Tablet (OAM)',7),(212,'Kina Tablet',7),(213,'Primakuine Tablet',7),(214,'Albendazole 400 mg',7),(215,'Albendazole syrup 200 mg/5 ml',7),(216,'Dietilkarbamazin sitrat',7),(217,'Lamprene 100mg (clopazimine)',7),(218,'Sandoz MB Blister Anak ( Child )',7),(219,'Sandoz MB Blister Dewasa ( Adult )',7),(220,'Sandoz PB Blister Dewasa ( Adult )',7),(222,'Lanset',5),(223,'Box Slide',5),(224,'Cartridge Gen Expert',5),(225,'Etanol Absolut',5),(226,'Kaca slide',5),(228,'PPDRT (tuberkulin)',5),(229,'Reagen ZN',6),(230,'INH ( Isonoazid 100 mg )',7),(231,'FDC Anak',7),(232,'FDC I',7),(233,'FDC II',7),(234,'FDC Kombipak Kat I',7),(235,'Bedaquiline 100 mg tablet',7),(236,'Clofazimine (LAMPRENE)',7),(237,'Cycloserin 100 mg',7),(238,'Delamanid 50 mg',7),(239,'Etambutol 400 mg',7),(240,'Ethionamide 250 mg',7),(242,'Kanamycin Inj 1 gr',7),(243,'Levofloxacin',7),(244,'Linezolid 600 mg',7),(245,'Moxifloxacin tab 400 mg ( Avelox )',7),(246,'PAS Acid 5,52 g',7),(247,'Pyrazinamida 500 mg',7),(248,'Pyrazinamida 400 mg',7),(249,'Vitamin B6 100mg',7),(250,'Levofloxacin 100 mg.',7),(251,'Isoniazid 100 mg',7),(252,'Masker N95',7),(253,'Clofazimin 50 mg',7),(254,'Amikasin 1 gr inj',7),(256,'Masker N95 (Type Flat Fold)',7),(257,'Ampisilin inj 1 gr',7),(258,'Calsium Gluconas Injeksi',7),(259,'Gentamycin 80 mg inj',7),(260,'Magnesium Sulfat 40% Injeksi',7),(261,'Metil Ergometrin Injeksi 0.2 mg',7),(262,'Methyl ergometrin maleat tab 0,125 mg',7),(263,'Metronidazol inf 500 mg/100ml',7),(264,'Oxytocin Inj 10 IU / 100\"s\"',7),(265,'Tablet Tambah Darah',7),(268,'Fenobarbital Injeksi',7),(270,'Natrium Tirosin tab',7),(271,'Okstetrasiklin 1% salep mata',7),(272,'Vit K Injeksi 2 mg/ml',7),(273,'Biskuit PMT - Bumil Kek',7),(274,'Mineral Mix',7),(275,'MP ASI',7),(277,'Retinol Vit. A 200.000 IU',7),(279,'UKS KIT',5),(280,'Anti Difteri Serum',5),(281,'Vaksin BCG 20 Dosis ( Impor )',15),(282,'Vaksin Campak 10 Dosis',15),(283,'Vaksin DPT-HB-Hib',15),(284,'Vaksin DT 10 Dosis',15),(285,'Vaksin HB-ADS ( PID )',15),(286,'Vaksin MR (measles Rubella) 10 dosis',15),(287,'Vaksin Polio 10 Dosis',15),(288,'Vaksin Td 10 Dosis',15),(289,'Vaksin IPV',15),(290,'ADS 0.05 ml',5),(291,'ADS 0.5 ml',5),(292,'ADS 0.5 ml (GAVI)',5),(293,'ADS 5 ml',5),(294,'Safety Box 2,5 Liter',5),(295,'Safety Box 5 Liter',5),(296,'Vaksin Carier',15),(298,'ADS 0.5 ml (SKIFA)',5),(301,'ADS 0.5 ml (Oneject)',5),(302,'Vaksin Meningitis ( Menivax )',15),(303,'Hyperrab s/d 150 iu/ml @2 ml',15),(304,'Hyperrab s/d 150 iu/ml @10 ml',15),(305,'Vaksin Anti Rabies ( Verorab )',15),(306,'Hyperrab s/d 300 iu/ml @1 ml',15),(307,'Gloves Panjang',5),(308,'Handscrub Gel',5),(309,'Jarum bersayap 25G ( Wing Needle )',5),(310,'Jarum Pengambil Darah ( Needle Flashback 22G )',5),(311,'Media Amis ( Copan - Italy )',5),(312,'Media Amis (deltalab)',5),(313,'Pegangan Jarum',5),(314,'Pipet Disposible Polyethylene 3 ml',5),(315,'Tabung Vial / Penampung Serum ( Propylene ) 1,8 ml',5),(316,'Wadah Penampung Urine 60 ml Steril',5),(317,'APD 5 item',5),(318,'Masker Bedah',5),(319,'APD 4 item',5),(320,'Sarung Tangan Pendek',5),(322,'Cover All',5),(323,'Azithromycin 500 mg tablet',7),(324,'Klorokuin 150 mg tablet',7),(325,'Levofloxacin 500 mg tablet',7),(326,'Levofloxacin infus',7),(327,'Oseltamivir 75 mg tablet',7),(328,'Azithromycin infus',7),(329,'Hidroksikloroquin 200 mg',7),(330,'Favipiravir 200 mg Tab',7),(331,'Remsidivir 100 mg Injeksi',7),(333,'Allopurinol tablet 100 mg',7),(337,'Anti Haemoroid Suppos',7),(346,'Dektrose 5% ( Cairan Infus D5%)',7),(347,'Diazepam 2 mg tablet',7),(350,'Epinephrine Inj 1 mg',7),(358,'Haloperidol 0,5 mg tablet',7),(359,'Haloperidol 1,5 mg tablet',7),(369,'Klorpromazine injeksi i.m 25 mg/ml',7),(371,'Kotrimoksazol ( Dewasa ) Kombinasi sulfametoksazol 400 mg + Trimetoprim 80 mg',7),(372,'Lidocaine Compositum Injeksi',7),(373,'Lorazepam 1 mg tablet',7),(374,'Miconazole cream',7),(381,'Propanolol tablet 40 mg',7),(385,'Sefadroksil Kapsul 500 mg',7),(387,'Thiamin HCL / Mononitrat ( Vit B1 ) tablet 50 mg',7),(393,'Cat Gut Plain 3/0 + Jarum ( Onemed )',5),(394,'Infusion Set Anak',5),(395,'Infusion Set Dewasa',5),(402,'Plester 5 cm x 4,5 m hansaplas',5),(403,'Sarung Tangan Steril 6,5',5),(416,'Food Model',5),(419,'Tensimeter Digital+Tas ( Merk Omron )',5),(420,'Alat Diagnostik Set Indera di Puskesmas',5),(455,'BHP untuk Deteksi Dini ( untuk Labkesda )',5),(456,'BHP untuk Deteksi Dini ( untuk RS )',5),(466,'Mikroskop Nikon Stereo SMZ 745',5),(470,'Mikroskop Malaria ( Merk Leica DM 500 Unit )',5),(477,'Doksisiklin Kapsul 100 mg',5),(485,'Sandoz PB Blister Anak ( Child )',5),(492,'Masker 3M 1870+ N95',5),(493,'Masker 3M 1860 N95',5),(494,'Masker 3M1860S N95',5),(504,'Capreomycin 1 gr',5),(551,'Vaksin Polio IPV 5 Dosis',15),(568,'Kacamata Keselamatan',5),(569,'Media Amis ( ABL )',5),(574,'Sepatu Boot Pengaman',5),(575,'Tabung Pengambil Darah Vena 6 ml',5),(578,'Wadah Penampung Tinja 60 ml Steril ( Pot Faeces )',5),(579,'Baju Kerja',5),(581,'Densifektan',5),(582,'Face Shield',5),(583,'Google',5),(584,'Gown',5),(585,'Handsanitizer 100 ml',5),(586,'Handsanitizer 30 ml',5),(587,'Handsanitizer 500 ml',5),(588,'Handschoon ginekolog',5),(589,'Handscoon',5),(590,'Kantong Mayat',5),(593,'Rapid Test',5),(594,'Sarung Tangan Panjang',5),(595,'Sepatu Boot',5),(596,'Thermogun',5),(597,'Tutup Kepala',5),(598,'Virus Transpor Media ( VTM )',5),(599,'Handschoon Sensi Non Steril',5),(600,'Rapid Test Antigen',5),(601,'Handsanitizer 250 ml',5),(602,'Baju Steril Disposibel',5),(603,'Fescopore',5),(604,'Kain Operasi',5),(605,'Kapas Besar',5),(606,'Laken ( Hijau )',5),(607,'Mitella',5),(608,'Nebulizer',5),(609,'Pakaian Set ke Lapangan',5),(610,'Pakaian Set Operasi',5),(611,'Sarung Tangan',5),(612,'Water Storage',5),(613,'Derigen',5),(614,'Interagency Emergensi Health Kit 2006',5),(615,'Investigasi Kit ( Tas )',5),(616,'Kursi Roda',5),(617,'Tripot Care Adult/Stick',5),(618,'Surgical Kit',5),(619,'Pagar Tempat Tidur',5),(620,'Tiang Infus ( Atas Penyangkut Slang )',5),(621,'Tiang Infus Beroda',5),(622,'Tongkat',5),(623,'Tongkat Orang Tua',5),(624,'Mesin Bor Tulang',5),(625,'Minor Set',5),(626,'Vaccine Carier Uk. M',5),(627,'Misblower',5),(628,'PSN DBD Kit',5),(630,'Kelambu BNPB',5),(631,'SOS 4 Ltr',5),(632,'SOS 800',5),(651,'APD Coverall',5),(652,'Appron Plastik Jantra',5),(653,'Blood Lancet',5),(654,'Collection Swab (CTA Steril)',5),(655,'Disposible Gown Blue',5),(658,'Handscoon Ginekolog (L)',5),(659,'Infuset',5),(660,'Infuset /IV Chateter 20',5),(662,'Jas Lab/Stenen',5),(663,'Jas Lab Uk. L',5),(664,'Jas Lab Uk. M',5),(665,'Jas Lab. Uk. S',5),(666,'Jas Lab. Uk. XL',5),(667,'Jumper Pulse Oxymeter 500 A',5),(668,'Kacamata Google',5),(669,'Kursi Roda FS 809',5),(670,'Kursi Roda SM 800 C',5),(671,'Latex Steril Surgical (Uk. 7)',5),(673,'Latex Steril Surgical (Uk.7.5)',5),(675,'Mesin Sprayer Electrik',5),(676,'Nassal Oxygen Adult (GEA)',5),(677,'Non Rebrating Mask',5),(678,'Sarung Tangan Nitril',5),(679,'Sarung Tangan Non Steril Uk. L (Aximet)',5),(680,'Sarung Tangan Non Steril Uk. L (Sensi)',5),(681,'Sarung Tangan Non Steril Uk. L Sunshine',5),(682,'Handscoon Non Steril Sunshine (Uk.M)',5),(683,'Sarung Tangan Non Steril Uk. M',5),(684,'Sarung Tangan Non Steril Uk. XS',5),(685,'Sarung Tangan Non Steril Uk.S',5),(686,'Sarung Tangan Steril Protus No.7.5',5),(687,'Sepatu Bot APD Uk 38.39.40',5),(688,'Stetoskop Dewasa',5),(689,'Surgical google',5),(690,'Tabung Oksigen Lengkap',5),(691,'Tensimeter Digital',5),(692,'Tensimeter Jumper',5),(693,'Thermo Gun',5),(694,'Thermometer Badan Digital',5),(695,'Thermometer Digital',5),(696,'Thermometer Infrared F102',5),(697,'Tonge Spatel Plastik berlubang',5),(698,'Topi Operasi/Penutup Kepala',5),(699,'Virus Transport Media',5),(700,'Ambroxol Tab',7),(701,'NaCl 0,9 %',5),(702,'Omeprazol',7),(703,'Sukralfat Syrup',7),(704,'Vitamin Becefort Tab',7),(705,'Vioxy FM',7),(706,'Alkohol 70 %',5),(707,'Alkohol 96 %',5),(708,'Antigermen Forte',5),(710,'Hand Scrub 70 % 500 ml',5),(711,'Hand Sanitizer 1 liter',5),(712,'Sabun cuci tangan Nosy',5),(713,'Sabun cuci tangan Nosy 420 ml Apple',5),(714,'Sabun cuci tangan Nosy 420 ml Strawberry',5),(715,'Sabun cuci tangan Nosy 420 ml Aloevera',5),(716,'Ceftriaxone inj 1 gr',7),(719,'Kotrimoksazol (anak) kombinasi tiap 5 ml suspensi : sulfametoksazol 200mg + trimetoprim 40 mg',7),(720,'Isoniazid 300 mg',7),(721,'Cat Gut Plain 2/0 + Jarum ( Onemed )',5),(729,'Retinol Vit.A 100.000 IU',7);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_keluar`
--

DROP TABLE IF EXISTS `barang_keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang_keluar` (
  `id_keluar` varchar(30) NOT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `pj` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_keluar`
--

LOCK TABLES `barang_keluar` WRITE;
/*!40000 ALTER TABLE `barang_keluar` DISABLE KEYS */;
INSERT INTO `barang_keluar` VALUES ('M02','2021-04-08','Dinas Kesehatan Kota Padang','Yulia');
/*!40000 ALTER TABLE `barang_keluar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_masuk`
--

DROP TABLE IF EXISTS `barang_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barang_masuk` (
  `id_masuk` varchar(30) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `pj` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_masuk`
--

LOCK TABLES `barang_masuk` WRITE;
/*!40000 ALTER TABLE `barang_masuk` DISABLE KEYS */;
INSERT INTO `barang_masuk` VALUES ('m01','2021-01-15','Dinas Kesehatan Provinsi Sumatera Barat ','Yulia'),('M02','2021-04-18','Dinas Kesehatan Provinsi Sumatera Barat ','Yulia'),('M05','2021-06-28','agung','yulia');
/*!40000 ALTER TABLE `barang_masuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_barang_keluar`
--

DROP TABLE IF EXISTS `detail_barang_keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_barang_keluar` (
  `id_keluar` varchar(30) NOT NULL,
  `id_barang` int NOT NULL,
  `id_masuk` varchar(30) NOT NULL,
  `pengeluaran` int DEFAULT NULL,
  `ket_keluar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`,`id_masuk`,`id_keluar`),
  KEY `id_masuk3_idx` (`id_masuk`),
  KEY `id_barang3_idx` (`id_barang`),
  KEY `id_keluar3_idx` (`id_keluar`),
  CONSTRAINT `id_barang3` FOREIGN KEY (`id_barang`) REFERENCES `detail_barang_masuk` (`id_barang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `id_keluar3` FOREIGN KEY (`id_keluar`) REFERENCES `barang_keluar` (`id_keluar`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `id_masuk3` FOREIGN KEY (`id_masuk`) REFERENCES `detail_barang_masuk` (`id_masuk`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_barang_keluar`
--

LOCK TABLES `detail_barang_keluar` WRITE;
/*!40000 ALTER TABLE `detail_barang_keluar` DISABLE KEYS */;
INSERT INTO `detail_barang_keluar` VALUES ('M02',175,'M05',899,'');
/*!40000 ALTER TABLE `detail_barang_keluar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_barang_masuk`
--

DROP TABLE IF EXISTS `detail_barang_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_barang_masuk` (
  `id_barang` int NOT NULL,
  `id_masuk` varchar(30) NOT NULL,
  `id_sumber` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `pemasukan` int DEFAULT NULL,
  `harga_perolehan` int DEFAULT NULL,
  `no_batch` varchar(100) DEFAULT NULL,
  `tanggal_daluwarsa` date DEFAULT NULL,
  `stok` int DEFAULT '0',
  `ket_masuk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`,`id_masuk`),
  KEY `id_barang_idx` (`id_barang`),
  KEY `id_masuk_idx` (`id_masuk`),
  KEY `id_sumber_idx` (`id_sumber`),
  KEY `id_satuan_idx` (`id_satuan`),
  CONSTRAINT `id_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `id_masuk` FOREIGN KEY (`id_masuk`) REFERENCES `barang_masuk` (`id_masuk`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `id_satuan` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `id_sumber` FOREIGN KEY (`id_sumber`) REFERENCES `sumber` (`id_sumber`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_barang_masuk`
--

LOCK TABLES `detail_barang_masuk` WRITE;
/*!40000 ALTER TABLE `detail_barang_masuk` DISABLE KEYS */;
INSERT INTO `detail_barang_masuk` VALUES (175,'M05',3,154,900,9000,'A890','2021-05-20',1,'');
/*!40000 ALTER TABLE `detail_barang_masuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_barang_return`
--

DROP TABLE IF EXISTS `detail_barang_return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_barang_return` (
  `id_barang` int NOT NULL,
  `id_masuk` varchar(30) NOT NULL,
  `id_keluar` varchar(30) NOT NULL,
  `id_return` int NOT NULL AUTO_INCREMENT,
  `ket_return` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_return`,`id_barang`,`id_masuk`,`id_keluar`),
  KEY `id_barang_idx` (`id_barang`),
  KEY `id_masuk_idx` (`id_masuk`),
  KEY `id_keluar4_idx` (`id_keluar`),
  CONSTRAINT `id_barang4` FOREIGN KEY (`id_barang`) REFERENCES `detail_barang_keluar` (`id_barang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `id_keluar4` FOREIGN KEY (`id_keluar`) REFERENCES `detail_barang_keluar` (`id_keluar`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `id_masuk4` FOREIGN KEY (`id_masuk`) REFERENCES `detail_barang_keluar` (`id_masuk`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_barang_return`
--

LOCK TABLES `detail_barang_return` WRITE;
/*!40000 ALTER TABLE `detail_barang_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_barang_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_program`
--

DROP TABLE IF EXISTS `detail_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_program` (
  `id_barang` int DEFAULT NULL,
  `id_program` int DEFAULT '38',
  KEY `id_barang4_idx` (`id_barang`),
  KEY `id_program4_idx` (`id_program`),
  CONSTRAINT `id_barang5` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_program5` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_program`
--

LOCK TABLES `detail_program` WRITE;
/*!40000 ALTER TABLE `detail_program` DISABLE KEYS */;
INSERT INTO `detail_program` VALUES (2,38),(4,38),(5,38),(6,38),(7,38),(9,38),(10,38),(11,38),(13,38),(14,38),(15,38),(16,38),(17,38),(18,38),(19,38),(20,38),(22,38),(23,38),(24,38),(25,38),(26,38),(27,38),(28,38),(30,38),(31,38),(32,38),(33,38),(34,38),(36,38),(37,38),(38,38),(39,38),(41,38),(42,38),(43,38),(44,38),(46,38),(47,38),(48,38),(49,38),(50,38),(51,38),(52,38),(53,38),(54,38),(55,38),(56,38),(58,38),(59,38),(60,38),(61,38),(62,38),(63,38),(65,38),(66,38),(69,38),(71,38),(90,38),(93,38),(153,38),(333,38),(337,38),(346,38),(347,38),(350,38),(358,38),(359,38),(369,38),(371,38),(372,38),(373,38),(374,38),(381,38),(385,38),(387,38),(394,38),(395,38),(402,38),(403,38),(416,38),(420,38),(455,38),(456,38),(466,38),(470,38),(477,38),(492,38),(493,38),(494,38),(504,38),(551,38),(568,38),(569,38),(574,38),(575,38),(578,38),(579,38),(581,38),(582,38),(583,38),(584,38),(585,38),(586,38),(587,38),(588,38),(589,38),(590,38),(593,38),(594,38),(595,38),(596,38),(597,38),(598,38),(599,38),(600,38),(601,38),(602,38),(603,38),(604,38),(605,38),(606,38),(607,38),(608,38),(609,38),(610,38),(611,38),(612,38),(613,38),(614,38),(615,38),(616,38),(617,38),(618,38),(619,38),(620,38),(621,38),(622,38),(623,38),(624,38),(625,38),(626,38),(627,38),(628,38),(630,38),(631,38),(632,38),(651,38),(652,38),(653,38),(654,38),(655,38),(658,38),(659,38),(660,38),(662,38),(663,38),(664,38),(665,38),(666,38),(667,38),(668,38),(669,38),(670,38),(671,38),(673,38),(675,38),(676,38),(677,38),(678,38),(679,38),(680,38),(681,38),(682,38),(683,38),(684,38),(685,38),(686,38),(687,38),(688,38),(689,38),(690,38),(691,38),(692,38),(693,38),(694,38),(695,38),(696,38),(697,38),(698,38),(699,38),(700,38),(701,38),(702,38),(703,38),(704,38),(705,38),(706,38),(707,38),(708,38),(710,38),(711,38),(712,38),(713,38),(714,38),(715,38),(3,6),(8,6),(21,6),(29,6),(40,6),(45,6),(67,6),(68,6),(70,6),(72,6),(73,6),(74,6),(76,6),(77,6),(78,6),(79,6),(80,6),(81,6),(82,6),(83,6),(85,6),(86,6),(87,6),(88,6),(89,6),(91,6),(92,6),(94,6),(95,6),(97,6),(98,6),(99,6),(100,6),(101,6),(102,6),(103,6),(104,6),(105,6),(106,6),(107,6),(108,6),(109,6),(111,6),(112,6),(113,6),(114,6),(115,6),(116,6),(117,6),(118,6),(716,6),(719,6),(119,7),(122,7),(123,7),(124,7),(125,7),(126,7),(127,7),(128,7),(129,7),(130,7),(131,7),(132,7),(133,7),(393,7),(12,8),(134,8),(135,8),(137,8),(138,8),(139,8),(140,8),(141,8),(142,8),(144,8),(57,9),(145,9),(147,10),(148,10),(149,10),(150,10),(151,10),(152,10),(419,10),(154,11),(155,12),(156,12),(157,12),(158,12),(159,12),(160,12),(161,12),(162,12),(163,12),(164,12),(165,12),(166,12),(167,12),(168,12),(169,12),(170,12),(172,12),(173,12),(174,12),(175,13),(176,13),(177,13),(178,13),(179,13),(180,13),(181,13),(182,13),(183,13),(184,13),(185,13),(186,13),(187,13),(188,13),(190,13),(191,13),(193,14),(194,14),(195,14),(196,14),(197,14),(198,15),(199,15),(200,15),(201,16),(202,16),(203,16),(204,16),(205,17),(206,17),(207,17),(208,17),(209,17),(210,18),(211,18),(212,18),(213,18),(214,19),(215,19),(216,19),(217,20),(218,20),(219,20),(220,20),(485,20),(222,21),(64,22),(223,22),(224,22),(225,22),(226,22),(228,22),(229,22),(230,23),(231,23),(232,23),(233,23),(234,23),(189,24),(235,24),(236,24),(237,24),(238,24),(239,24),(240,24),(242,24),(243,24),(244,24),(245,24),(246,24),(247,24),(248,24),(249,24),(250,24),(251,24),(252,24),(253,24),(254,24),(256,24),(720,24),(257,25),(258,25),(260,25),(261,25),(262,25),(263,25),(264,25),(143,26),(259,26),(268,26),(270,26),(271,26),(272,26),(273,27),(274,27),(275,27),(277,27),(279,27),(280,28),(281,28),(282,28),(283,28),(284,28),(285,28),(286,28),(287,28),(288,28),(289,28),(290,29),(291,29),(292,29),(293,29),(294,29),(295,29),(296,29),(192,30),(298,30),(301,30),(302,31),(303,32),(304,32),(305,32),(306,32),(307,33),(308,33),(309,33),(310,33),(311,33),(312,33),(313,33),(314,33),(315,33),(316,33),(318,33),(319,33),(320,33),(317,34),(323,35),(324,35),(325,35),(326,35),(327,35),(328,35),(329,35),(330,35),(331,35),(1,38),(265,25),(265,27),(721,7),(143,8),(189,13),(192,14),(259,25),(257,26),(729,27),(322,34);
/*!40000 ALTER TABLE `detail_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_barang`
--

DROP TABLE IF EXISTS `jenis_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_barang` (
  `id_jenis_barang` int NOT NULL AUTO_INCREMENT,
  `jenis_barang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_barang`
--

LOCK TABLES `jenis_barang` WRITE;
/*!40000 ALTER TABLE `jenis_barang` DISABLE KEYS */;
INSERT INTO `jenis_barang` VALUES (5,'ALKES'),(6,'REAGEN'),(7,'OBAT'),(15,'VAKSIN');
/*!40000 ALTER TABLE `jenis_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program` (
  `id_program` int NOT NULL AUTO_INCREMENT,
  `program` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_program`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (6,'BUFFER STOK PROVINSI'),(7,'ALKES HABIS PAKAI'),(8,'PROGRAM JIWA'),(9,'PROGRAM DIARE'),(10,'PROGRAM PTM'),(11,'PROGRAM PTM (BUK)'),(12,'PROGRAM HIV / AIDS'),(13,'PROGRAM HIV / AIDS ( ARV HIV)'),(14,'PROGRAM HEPATITIS'),(15,'PROGRAM ISPA'),(16,'PROGRAM DBD'),(17,'PROGRAM MALARIA ALAT DAN REAGEN'),(18,'PROGRAM MALARIA OBAT'),(19,'PROGRAM FILARIASIS'),(20,'PROGRAM FRAMBUSIA DAN KUSTA'),(21,'PROGRAM FRAMBUSIA ALAT'),(22,'PROGRAM TB PARU ALAT DAN REAGEN'),(23,'PROGRAM TB PARU OBAT'),(24,'PROGRAM TB MDR'),(25,'PROGRAM KESEHATAN IBU'),(26,'PROGRAM KESEHATAN ANAK'),(27,'PROGRAM GIZI'),(28,'PROGRAM IMUNISASI'),(29,'BMHP PROGRAM IMUNISASI'),(30,'BMHP VAKSIN COVID-19'),(31,'PROGRAM HAJI'),(32,'PROGRAM RABIES'),(33,'PROGRAM SURVEILANS'),(34,'COVID-19 ALKES'),(35,'COVID-19 OBAT'),(38,'kosong');
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `satuan`
--

DROP TABLE IF EXISTS `satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `satuan` (
  `id_satuan` int NOT NULL AUTO_INCREMENT,
  `satuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=716 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `satuan`
--

LOCK TABLES `satuan` WRITE;
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
INSERT INTO `satuan` VALUES (1,'Klg 10 x 10 tablet'),(3,'Kotak 10 x 10 tablet'),(6,'Kotak/25 Tube'),(7,'Vial'),(15,'Ktk 10 x 10 Tablet'),(16,'Ampul'),(17,'Ktk 10 x 10 kaplet'),(19,'Btl 60 ml'),(22,'Botol 5 ml'),(24,'Botol 500 ml'),(26,'Ktk / 5 amp'),(27,'Tube'),(31,'Ktk 5 x 10 Kapsul'),(32,'Ktk 10 x 10 Kapsul'),(34,'Kotak 20 x 10 tablet'),(37,'Ktk 2 x 10 Tablet'),(38,'Kotak 10 tablet'),(44,'Ktk 10 TAV'),(46,'Botol'),(48,'Btl 100 Tablet'),(50,'Btl 500 ml'),(52,'Ktk 3 x 10 tablet'),(55,'Botol 50 Kapsul'),(59,'Rol'),(63,'Buah'),(64,'Pcs'),(65,'Kotak / 100 Pcs'),(68,'Botol/ 100 tablet'),(69,'Kotak / 100 tablet'),(77,'Kotak / 200 tablet'),(78,'Ampul 1 ml'),(92,'Kotak / 50 kapsul'),(93,'Botol 60 ml'),(97,'Botol 30 ml'),(98,'Botol 300 ml'),(101,'Pot 30 g'),(102,'Kotak/100 kapsul'),(104,'Kotak / 100 Ampul'),(105,'Botol/500 Ml'),(106,'Kotak/100 Tab'),(108,'Box/100'),(109,'Kotak/50 tab'),(111,'Kotak/30 Ampul'),(114,'Botol 1000 ml'),(117,'Suppositoria'),(119,'Kotak / 24 pcs'),(123,'Kotak / 50 pcs'),(124,'Bungkus'),(133,'Pasang'),(145,'Kotak / 100 sachet'),(147,'Unit'),(148,'Set'),(154,'Paket'),(156,'Kotak/25 pcs'),(157,'Kotak / 25 kit'),(159,'Test'),(170,'Kotak / 25 Test'),(173,'Box/50'),(175,'Botol / 60 tab'),(176,'Botol/30 tab'),(178,'Botol/60 tab'),(179,'Botol/90 tab'),(181,'Kotak/30'),(182,'Botol / 30 tab'),(183,'Kotak / 10 tablet'),(185,'Botol/120 tab'),(189,'Tablet'),(193,'kotak / 25 pcs'),(200,'Kaplet'),(205,'Botol /100ml'),(210,'Kotak/ 1 vial'),(212,'Kotak/60'),(213,'Kotak/100 Tablet'),(215,'Botol/10 ml'),(217,'botol/500 tablet'),(218,'Kotak / 6 Blister'),(225,'Botol / 1 liter'),(229,'Kit'),(273,'Dus / 28 Bungkus'),(274,'Sachet'),(275,'Dus / 84 Bungkus'),(276,'Botol / 50'),(285,'Pouch'),(307,'Kotak 12 Psg'),(329,'Kotak/20'),(337,'Suppos'),(338,'Vial 20 ml'),(349,'Ktk / 30 ampul'),(372,'Kotak / 30 ampul'),(379,'Botol / 1000 tablet'),(385,'Kapsul'),(425,'Kotak/20 test'),(474,'Kotak / 8 vial'),(476,'Kotak/9 Tablet'),(477,'Kotak/100'),(480,'Kotak/30 tablet'),(487,'kotak/ 200 pcs'),(491,'Kotak / 72 buah'),(492,'Kotak / 20 pcs'),(508,'Kotak / 672 tab'),(520,'kotak/10 vial'),(574,'Psg'),(581,'Diregen/5 '),(591,'Ktk/50 Pcs'),(603,'Ktk/10 Rol'),(608,'Ktk'),(611,'Bks/10 Psg'),(618,'Dus'),(631,'Bks'),(636,'Dus/85 Pcs'),(640,'Ktk/4 Pcs'),(672,'Box/50 Psg'),(679,'Box/50 pcs'),(700,'Box/100 tab'),(702,'Box/30 cap'),(705,'Box/30 tab'),(708,'Galon/5 ltr'),(709,'Liter');
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sumber`
--

DROP TABLE IF EXISTS `sumber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sumber` (
  `id_sumber` int NOT NULL AUTO_INCREMENT,
  `sumber` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sumber`
--

LOCK TABLES `sumber` WRITE;
/*!40000 ALTER TABLE `sumber` DISABLE KEYS */;
INSERT INTO `sumber` VALUES (2,'APBD'),(3,'APBN'),(4,'BANTUAN');
/*!40000 ALTER TABLE `sumber` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-15  9:48:09
