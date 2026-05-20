CREATE DATABASE  IF NOT EXISTS `db-acme-tarde` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db-acme-tarde`;
-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: localhost    Database: db-acme-tarde
-- ------------------------------------------------------
-- Server version	8.0.45

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
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faqs_category_id` int NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faqs_faqs_categories1_idx` (`faqs_category_id`),
  CONSTRAINT `fk_faqs_faqs_categories1` FOREIGN KEY (`faqs_category_id`) REFERENCES `faqs_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,1,'Como faço para acompanhar o status do meu pedido?','Acesse a área \"Meus Pedidos\" no seu perfil e clique sobre o número do pedido para ver o status detalhado.'),(2,1,'Posso cancelar um pedido após a confirmação?','Pedidos podem ser cancelados em até 1 hora após a confirmação, desde que ainda não tenham sido separados para envio.'),(3,1,'É possível alterar o endereço de entrega após o pedido?','Sim, contate nosso suporte em até 2 horas após a compra com o número do pedido e o novo endereço.'),(4,2,'Quais formas de pagamento são aceitas?','Aceitamos cartão de crédito (Visa, Mastercard, Elo), boleto bancário e Pix.'),(5,2,'Em quantas parcelas posso parcelar minha compra?','Compras com cartão de crédito podem ser parceladas em até 12 vezes sem juros para pedidos acima de R$ 200,00.'),(6,2,'Meu pagamento foi recusado. O que fazer?','Verifique os dados do cartão e o limite disponível. Se o problema persistir, tente outra forma de pagamento ou entre em contato com seu banco.'),(7,2,'O boleto venceu. Posso gerar um novo?','Sim. Acesse \"Meus Pedidos\", localize o pedido em questão e clique em \"Gerar novo boleto\". O prazo de pagamento será de 1 dia útil.'),(8,3,'Qual o prazo de entrega?','O prazo varia conforme a região e o produto. Após a confirmação do pagamento, o prazo estimado é exibido no resumo do pedido.'),(9,3,'Meu pedido está atrasado. O que fazer?','Se o prazo estimado já passou, acesse \"Meus Pedidos\" e clique em \"Falar com suporte\" para abrir um chamado de rastreamento.'),(10,3,'Posso retirar meu pedido na loja?','Sim. Selecione a opção \"Retirar na loja\" durante o checkout e aguarde o e-mail de confirmação de disponibilidade.'),(11,4,'Como solicito a troca de um produto?','Acesse \"Meus Pedidos\", selecione o produto e clique em \"Solicitar troca\". O prazo para solicitação é de até 7 dias após o recebimento.'),(12,4,'Qual o prazo para devolução?','De acordo com o Código de Defesa do Consumidor, você tem até 7 dias corridos após o recebimento para desistir da compra.'),(13,4,'Quem paga o frete da devolução?','Caso o produto apresente defeito, o frete de devolução é por nossa conta. Em caso de desistência, o frete é de responsabilidade do cliente.'),(14,5,'Como altero minha senha?','Acesse \"Minha Conta\" > \"Segurança\" > \"Alterar senha\". Você receberá um e-mail de confirmação para concluir a alteração.'),(15,5,'Esqueci minha senha. Como recuperá-la?','Na tela de login, clique em \"Esqueci minha senha\" e informe o e-mail cadastrado. Você receberá um link de redefinição em até 5 minutos.');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs_categories`
--

DROP TABLE IF EXISTS `faqs_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs_categories`
--

LOCK TABLES `faqs_categories` WRITE;
/*!40000 ALTER TABLE `faqs_categories` DISABLE KEYS */;
INSERT INTO `faqs_categories` VALUES (1,'Pedidos'),(2,'Pagamentos'),(3,'Entregas'),(4,'Devoluções e Trocas'),(5,'Cadastro e Conta');
/*!40000 ALTER TABLE `faqs_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_products_categories1_idx` (`category_id`),
  CONSTRAINT `fk_products_products_categories1` FOREIGN KEY (`category_id`) REFERENCES `products_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Mouse Logitech M170',89.90),(2,1,'Teclado Logitech K120',79.90),(3,1,'Monitor LG 24 Polegadas IPS Full HD',899.00),(4,2,'Notebook Dell Inspiron 15 i5 16GB 512GB SSD',4299.00),(5,2,'Notebook Lenovo IdeaPad 3 Ryzen 5 8GB 256GB SSD',3199.00),(6,2,'MacBook Air M2 13 Polegadas 256GB',7999.00),(7,3,'Smartphone Samsung Galaxy A55 128GB',2199.00),(8,3,'iPhone 15 128GB',5999.00),(9,3,'Smartphone Motorola Edge 50 Fusion 256GB',2499.00),(10,4,'Headset HyperX Cloud Stinger 2',329.90),(11,4,'Webcam Logitech C920s Full HD',449.90),(12,4,'Caixa de Som JBL Go 4 Bluetooth',279.90),(13,5,'SSD Kingston NV2 1TB NVMe',399.90),(14,5,'HD Externo Seagate 2TB USB 3.0',499.90),(15,5,'Pen Drive Sandisk Ultra 128GB USB 3.0',89.90),(16,6,'Roteador TP-Link Archer AX53 Wi-Fi 6',449.90),(17,6,'Switch TP-Link TL-SG108 8 Portas Gigabit',219.90),(18,6,'Cabo de Rede Cat6 2m',29.90),(19,7,'Impressora Epson EcoTank L3250',1199.00),(20,7,'Nobreak Intelbras XNB 720VA',679.90),(21,7,'Filtro de Linha Clamper 5 Tomadas',89.90),(22,8,'Cadeira Gamer ThunderX3 EC3',1199.00),(23,8,'Mesa de Escritorio 120cm com 2 Gavetas',699.00),(24,8,'Suporte Articulado para Monitor ELG F80N',289.90),(25,8,'Base Refrigerada para Notebook C3Tech NBC-50',139.90),(39,2,'DELL Inspirion 5567',10000.00),(40,2,'DELL Inspirion 5567',10000.00),(41,2,'DELL Inspirion 5567',10000.00),(42,2,'DELL Inspirion 5567',10000.00),(43,2,'DELL Inspirion 5567',10000.00),(44,2,'DELL Inspirion 5567',10000.00),(45,2,'DELL Inspirion 5567',10000.00),(46,2,'DELL Inspirion 5567',10000.00),(47,2,'DELL Inspirion 5567',10000.00),(48,2,'DELL Inspirion 5567',10000.00),(49,2,'DELL Inspirion 5567',10000.00),(50,2,'DELL Inspirion 5567',10000.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_categories`
--

DROP TABLE IF EXISTS `products_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_categories`
--

LOCK TABLES `products_categories` WRITE;
/*!40000 ALTER TABLE `products_categories` DISABLE KEYS */;
INSERT INTO `products_categories` VALUES (1,'Periféricos'),(2,'Notebooks'),(3,'Smartphones'),(4,'Áudio e Vídeo'),(5,'Armazenamento'),(6,'Redes'),(7,'Energia e Impressão'),(8,'Acessórios de Escritório');
/*!40000 ALTER TABLE `products_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'ADMIN'),(2,'STANDARD');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `typeId` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_user_types_idx` (`typeId`),
  CONSTRAINT `fk_users_user_types` FOREIGN KEY (`typeId`) REFERENCES `user_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Fábio Santos','fabiosantos@ifsul.edu.br','12345678',NULL),(2,2,'Godofredo Silva','godofredo@gmail.com','12345678',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-20  8:40:09