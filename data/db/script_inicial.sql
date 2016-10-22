-- MySQL dump 10.16  Distrib 10.1.9-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: bdpainelenade
-- ------------------------------------------------------
-- Server version	10.1.9-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `bdpainelenade`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bdpainelenade` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bdpainelenade`;

--
-- Temporary table structure for view `acl`
--

DROP TABLE IF EXISTS `acl`;
/*!50001 DROP VIEW IF EXISTS `acl`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `acl` (
  `id_perfil` tinyint NOT NULL,
  `nm_resource` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action` (
  `id_action` int(11) NOT NULL AUTO_INCREMENT,
  `nm_action` varchar(200) DEFAULT NULL COMMENT '{"label":"Ação"}',
  PRIMARY KEY (`id_action`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,'index'),(2,'index-pagination'),(3,'cadastro'),(4,'edita'),(5,'gravar'),(6,'excluir'),(7,'upload'),(8,'alterar-senha'),(9,'salvar-redefinicao-senha'),(10,'reenviar-email'),(11,'dados-usuario'),(12,'listar-permissoes-acoes'),(13,'cadastro-contato'),(14,'gravar-compromisso'),(15,'gravar-contatos'),(16,'cadastro-compromissos'),(17,'contatos'),(18,'ver-contato'),(19,'contatos-pagination');
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) DEFAULT NULL,
  `id_sexo` int(11) DEFAULT NULL,
  `nm_aluno` varchar(60) DEFAULT NULL,
  `nr_matricula` varchar(25) DEFAULT NULL,
  `em_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_aluno`),
  KEY `FK_Reference_42` (`id_sexo`),
  KEY `FK_curso_aluno` (`id_curso`),
  CONSTRAINT `FK_Reference_42` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`),
  CONSTRAINT `FK_curso_aluno` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno`
--

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!50001 DROP VIEW IF EXISTS `auth`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `auth` (
  `id_usuario` tinyint NOT NULL,
  `id_perfil` tinyint NOT NULL,
  `em_email` tinyint NOT NULL,
  `pw_senha` tinyint NOT NULL,
  `nm_usuario` tinyint NOT NULL,
  `id_contrato` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `idconfigs` int(11) NOT NULL AUTO_INCREMENT,
  `nm_config` varchar(200) DEFAULT NULL COMMENT '{"label":"Nome da Configuração"}',
  `nm_valor` varchar(200) DEFAULT NULL COMMENT '{"label":"Valor"}',
  PRIMARY KEY (`idconfigs`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (3,'agencia','0643'),(4,'op','013'),(5,'conta_corrente','782.632-8'),(6,'favorecido','Miqueias Castro de Sá Lima'),(10,'situacao_ativo','1'),(11,'situacao_inativo','2'),(13,'tipo_usuario_administrador','1'),(14,'tipo_usuario_aluno','2'),(15,'situacao_usuario_ativo','1'),(16,'situacao_usuario_inativo','2'),(17,'situacao_usuario_congelado','3'),(18,'situacao_usuario_atrasado','4'),(19,'perfil_administrador','2'),(20,'perfil_administrador_cliente','3'),(21,'perfil_cliente','2'),(23,'tipo_telefone_residencial','1'),(24,'tipo_telefone_comercial','2'),(25,'tipo_telefone_celular','3'),(26,'telefone_admin','6130366853'),(27,'email_admin','contato@gmail.com'),(28,'nome_admin','Alysson Vicuña de Oliveira'),(29,'telefone_cel_admin','6191123250'),(35,'situacao_empresa_contrato_ativo','1'),(36,'situacao_empresa_contrato_inativo','2'),(37,'situacao_empresa_contrato_congelado','3'),(38,'situacao_empresa_contrato_regusado','4'),(44,'cnpj','08.988.565/0001-30'),(45,'razao_social','Minha Razao Social'),(46,'endereco','CH 44 LOTE 22 Col Agricola Samambaia , Vicente Pires - DISTRITO FEDERAL'),(64,'id_tipo_comunicado_video','1'),(65,'id_tipo_comunicado_texto','2'),(67,'tipo_conta_corrente','1'),(68,'tipo_conta_poupanca','2'),(69,'exibir_no_combo','S'),(70,'nao_exibir_no_combo','N'),(71,'flag_responsavel_pelo_escritorio','1'),(72,'perfil_administrador_adve','1');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo`
--

DROP TABLE IF EXISTS `conteudo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conteudo` (
  `id_conteudo` int(11) NOT NULL AUTO_INCREMENT,
  `id_disciplina` int(11) DEFAULT NULL,
  `ds_conteudo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_conteudo`),
  KEY `FK_disciplina_conteudo` (`id_disciplina`),
  CONSTRAINT `FK_disciplina_conteudo` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo`
--

LOCK TABLES `conteudo` WRITE;
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
/*!40000 ALTER TABLE `conteudo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo_simulado`
--

DROP TABLE IF EXISTS `conteudo_simulado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conteudo_simulado` (
  `id_conteudo_simulado` int(11) NOT NULL AUTO_INCREMENT,
  `id_conteudo` int(11) DEFAULT NULL,
  `id_simulado` int(11) DEFAULT NULL,
  `nr_questao` int(11) DEFAULT NULL,
  `nr_peso_questao` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`id_conteudo_simulado`),
  KEY `AK_Key_2` (`id_simulado`,`nr_questao`),
  KEY `FK_conteudo_conteudo_simulado` (`id_conteudo`),
  CONSTRAINT `FK_conteudo_conteudo_simulado` FOREIGN KEY (`id_conteudo`) REFERENCES `conteudo` (`id_conteudo`),
  CONSTRAINT `FK_simulado_conteudo_simulado` FOREIGN KEY (`id_simulado`) REFERENCES `simulado` (`id_simulado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo_simulado`
--

LOCK TABLES `conteudo_simulado` WRITE;
/*!40000 ALTER TABLE `conteudo_simulado` DISABLE KEYS */;
/*!40000 ALTER TABLE `conteudo_simulado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controller`
--

DROP TABLE IF EXISTS `controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controller` (
  `id_controller` int(11) NOT NULL AUTO_INCREMENT,
  `nm_controller` varchar(400) DEFAULT NULL COMMENT '{"label":"Controller"}',
  `nm_modulo` varchar(50) DEFAULT NULL,
  `cs_exibir_combo` char(1) DEFAULT 'S',
  PRIMARY KEY (`id_controller`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (1,'admin-index','Admin Index','S'),(3,'usuario-usuario','Usuario-Usuario','S'),(4,'application-index','Aplication index','S'),(5,'cidade-cidade','Cidade Cidade','S'),(6,'estado-estado','Estado Estado','S'),(8,'pagamento-pagamento','Pagamento','S'),(9,'PhpBoletoZf2\\Controller\\Itau','Boleto Itau','S'),(10,'admin-relatorio','AdministraÃ§ao do Relatorio','S'),(13,'comunicado-comunicado','Comunicado Comunicado','S'),(14,'tipo-comunicado','Modulo de Tipo de Comunicado','S'),(15,'usuario','Modulo de Usuarios','S'),(16,'contrato','Modulo de Contratos','S'),(17,'action','Modulo de Acoes','S'),(18,'cidade','Modulo de Cidades','S'),(19,'infra-infra','Modulo de Infraestrutura','S'),(20,'principal','Pagina Principal','S'),(21,'departamento','Departamentos','S'),(22,'permissao','Modulo de Permissionamento','S'),(23,'funcionario','Modulo de Funcionarios','S'),(24,'telefone_funcionario','Modulo de Telefone Funcionario','S'),(25,'controller','Modulo de Controller','S'),(26,'perfil','Cad. Perfis','S'),(27,'acl','View ACL','N'),(28,'auth','View AUTH','N'),(29,'banco','Banco','S'),(30,'categoria_produto','Categoria do Produto','S'),(31,'categoria_servico','Categoria do Servico','S'),(32,'comunicado','Comunicado','S'),(33,'comunicado_as_contrato','Comunicado por Contrato','S'),(34,'config','Configuracoes Gerais','N'),(35,'conta_bancaria','Conta Bancaria','S'),(36,'email','Email','S'),(37,'xxxxxx','A definir','S'),(38,'empresa','Empresa','S'),(39,'endereco','Endereco','S'),(40,'escolaridade','Escolaridade','S'),(41,'escritorio','Escritorio','S'),(42,'esqueci_senha','Esqueci Minha Senha','S'),(43,'estado','Estado','S'),(44,'estado_civil','Estado Civil','S'),(45,'login','Login','N'),(46,'natureza_juridica','Natureza Juridica','S'),(47,'nivel_escolaridade','Nivel de Escolaridade','S'),(48,'perfil_controller_action','Perfil Controller Action','N'),(49,'pessoa','Pessoa','S'),(50,'pessoa_estrangeira','Pessoa Estrangeira','S'),(51,'pessoa_fisica','Pessoa Fisica','S'),(52,'pessoa_juridica','Pessoa Juridica','S'),(53,'pessoa_juridica_lucro','Pessoa Juridica Lucro','S'),(54,'pessoa_vinculo','Pessoa Vinculo','S'),(55,'produto','Produto','S'),(56,'produto_pessoa','Produto Pessoa','S'),(57,'responsavel_escritorio','Responsavel pelo Escritorio','S'),(58,'servico','ServiÃ§o','S'),(59,'servico_pessoa','Servico Pessoa','S'),(60,'sexo','Sexo','S'),(61,'situacao','Situacao','S'),(62,'situacao_empresa_contrato','Situacao do Contrato da Empresa','S'),(63,'situacao_usuario','Situacao Usuario','S'),(64,'subcategoria_produto','Subcategoria do Produto','S'),(65,'subcategoria_servico','Subcategoria do ServiÃ§o','S'),(66,'telefone','Telefone','S'),(67,'tipo_comunicado','Tipo de Comunicado','S'),(68,'tipo_conta','Tipo de Conta','S'),(69,'tipo_email','Tipo de Email','S'),(70,'tipo_lucro','Tipo de Lucro','S'),(71,'tipo_telefone','Tipo de Telefone','S'),(72,'tipo_usuario','Tipo de Usuario','S'),(73,'tipo_vinculo_pessoa','Tipo de Vinculo Pessoa','S'),(74,'email_2','Email-2','S'),(75,'aluno',NULL,'S'),(76,'conteudo',NULL,'S'),(77,'conteudo_simulado',NULL,'S'),(78,'curso',NULL,'S'),(79,'disciplina',NULL,'S'),(80,'email_acesso',NULL,'S'),(81,'resultado',NULL,'S'),(82,'simulado',NULL,'S'),(83,'turno',NULL,'S');
/*!40000 ALTER TABLE `controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `id_turno` int(11) DEFAULT NULL,
  `nm_curso` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `FK_Reference_38` (`id_turno`),
  CONSTRAINT `FK_Reference_38` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) DEFAULT NULL,
  `nm_disciplina` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `FK_curso_disciplina` (`id_curso`),
  CONSTRAINT `FK_curso_disciplina` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_acesso`
--

DROP TABLE IF EXISTS `email_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_acesso` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `em_email` varchar(200) DEFAULT NULL COMMENT '{"label":"E-mail"}',
  `id_situacao` int(11) NOT NULL,
  PRIMARY KEY (`id_email`),
  KEY `ix_emails_situacao` (`id_situacao`),
  CONSTRAINT `FK_Reference_50` FOREIGN KEY (`id_situacao`) REFERENCES `situacao` (`id_situacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emails_situacao` FOREIGN KEY (`id_situacao`) REFERENCES `situacao` (`id_situacao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_acesso`
--

LOCK TABLES `email_acesso` WRITE;
/*!40000 ALTER TABLE `email_acesso` DISABLE KEYS */;
INSERT INTO `email_acesso` VALUES (1,'administrador@adve.com.br',1),(2,'alyssontkd@gmail.com',1);
/*!40000 ALTER TABLE `email_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `esqueci_senha`
--

DROP TABLE IF EXISTS `esqueci_senha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esqueci_senha` (
  `id_esqueci_senha` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `tx_identificacao` varchar(60) DEFAULT NULL,
  `id_situacao` int(11) DEFAULT NULL,
  `dt_solicitacao` datetime DEFAULT NULL,
  `dt_alteracao` datetime NOT NULL,
  PRIMARY KEY (`id_esqueci_senha`),
  KEY `ix_esqueci_senha_usuarios` (`id_usuario`),
  KEY `ix_esqueci_senha_situacoes` (`id_situacao`),
  CONSTRAINT `fk_esqueci_senha_situacoes1` FOREIGN KEY (`id_situacao`) REFERENCES `situacao` (`id_situacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_esqueci_senha_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `esqueci_senha`
--

LOCK TABLES `esqueci_senha` WRITE;
/*!40000 ALTER TABLE `esqueci_senha` DISABLE KEYS */;
INSERT INTO `esqueci_senha` VALUES (1,1,'fa3bc40ed75f31efa62cdef771635679',2,'2016-09-02 12:09:33','0000-00-00 00:00:00'),(2,1,'50419b7938b389c54e10a04b71ab4fc4',2,'2016-09-04 12:26:55','0000-00-00 00:00:00'),(3,1,'ba25e904f00e7aeabfc2dc6ee5513d14',2,'2016-09-04 12:27:17','0000-00-00 00:00:00'),(4,1,'62cfe92c87f89b9bd4bcd9de86bd9cb5',2,'2016-09-04 12:29:31','0000-00-00 00:00:00'),(5,1,'9147930fa19dbef92487c7fccaa715a8',2,'2016-09-04 12:31:43','0000-00-00 00:00:00'),(6,1,'24333e140899f87cf8c6748ab93fb4fb',2,'2016-09-04 12:34:14','0000-00-00 00:00:00'),(7,1,'adfc9b2845a7c774eec8329a68e987ef',1,'2016-09-04 12:42:02','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `esqueci_senha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id_Login` int(11) NOT NULL AUTO_INCREMENT,
  `pw_senha` varchar(40) DEFAULT NULL COMMENT '{"label":"Senha"}',
  `nr_tentativas` int(11) DEFAULT NULL COMMENT '{"label":"Tentativas"}',
  `dt_visita` datetime DEFAULT NULL COMMENT '{"label":"Data da última visita"}',
  `dt_registro` datetime DEFAULT NULL COMMENT '{"label":"Data de Registro"}',
  `id_usuario` int(11) NOT NULL,
  `id_email` int(11) NOT NULL,
  `id_situacao` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `pw_senha_financeira` varchar(40) NOT NULL,
  PRIMARY KEY (`id_Login`),
  KEY `ix_Login_usuarios` (`id_usuario`),
  KEY `ix_Login_emails` (`id_email`),
  KEY `ix_Login_situacao` (`id_situacao`),
  KEY `ix_Login_perfil` (`id_perfil`),
  CONSTRAINT `fk_Login_emails` FOREIGN KEY (`id_email`) REFERENCES `email_acesso` (`id_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Login_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Login_situacao` FOREIGN KEY (`id_situacao`) REFERENCES `situacao` (`id_situacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Login_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'25d55ad283aa400af464c76d713c07ad',1,'2014-08-27 21:53:33','2014-08-27 21:53:37',1,1,1,1,'25d55ad283aa400af464c76d713c07ad'),(2,'25d55ad283aa400af464c76d713c07ad',1,'2014-08-27 21:53:33','2014-08-27 21:53:37',2,2,1,1,'25d55ad283aa400af464c76d713c07ad');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"label":"Id Perfil"}',
  `nm_perfil` varchar(100) NOT NULL COMMENT '{''label'':"Perfil"}',
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Administrador ENADE'),(2,'Professor'),(3,'Coordenacao'),(4,'Secretaria');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_controller_action`
--

DROP TABLE IF EXISTS `perfil_controller_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_controller_action` (
  `id_perfil_controller_action` int(11) NOT NULL AUTO_INCREMENT,
  `id_controller` int(11) NOT NULL,
  `id_action` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_perfil_controller_action`),
  KEY `ix_perfil_controller_action_controller` (`id_controller`),
  KEY `ix_perfil_controller_action_action` (`id_action`),
  KEY `ix_perfil_controller_action_perfil` (`id_perfil`),
  CONSTRAINT `fk_perfil_controller_action_action` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_controller_action_controller` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_controller_action_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=612 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_controller_action`
--

LOCK TABLES `perfil_controller_action` WRITE;
/*!40000 ALTER TABLE `perfil_controller_action` DISABLE KEYS */;
INSERT INTO `perfil_controller_action` VALUES (1,1,1,1),(44,18,1,1),(45,18,2,1),(46,18,3,1),(47,18,4,1),(48,18,5,1),(49,18,6,1),(50,15,1,1),(51,15,2,1),(52,15,3,1),(53,15,4,1),(54,15,5,1),(55,15,6,1),(56,19,1,1),(57,20,1,1),(58,21,1,1),(59,21,2,1),(60,21,3,1),(61,21,4,1),(62,21,5,1),(63,21,6,1),(70,24,1,1),(71,24,2,1),(72,24,3,1),(73,24,4,1),(74,24,5,1),(75,24,6,1),(76,22,1,1),(77,22,2,1),(78,22,3,1),(79,22,4,1),(80,22,5,1),(81,22,6,1),(88,22,12,1),(89,17,1,1),(90,17,2,1),(91,17,3,1),(92,17,4,1),(93,17,5,1),(94,17,6,1),(138,23,1,1),(139,23,2,1),(140,23,3,1),(141,23,4,1),(142,23,5,1),(143,23,6,1),(144,23,7,1),(145,26,1,1),(146,26,2,1),(147,26,3,1),(148,26,6,1),(158,3,1,1),(159,3,2,1),(160,3,3,1),(161,3,4,1),(162,3,5,1),(163,3,6,1),(164,3,7,1),(165,3,8,1),(166,3,9,1),(167,3,10,1),(168,3,11,1),(169,3,12,1),(170,25,1,1),(171,25,2,1),(172,25,3,1),(173,25,4,1),(174,25,5,1),(175,25,6,1),(176,27,1,1),(177,27,2,1),(178,27,3,1),(179,27,4,1),(180,27,5,1),(181,27,6,1),(182,28,1,1),(183,28,2,1),(184,28,3,1),(185,28,4,1),(186,28,5,1),(187,28,6,1),(188,29,1,1),(189,29,2,1),(190,29,3,1),(191,29,4,1),(192,29,5,1),(193,29,6,1),(194,30,1,1),(195,30,2,1),(196,30,3,1),(197,30,4,1),(198,30,5,1),(199,30,6,1),(200,31,1,1),(201,31,2,1),(202,31,3,1),(203,31,4,1),(204,31,5,1),(205,31,6,1),(206,32,1,1),(207,32,2,1),(208,32,3,1),(209,32,4,1),(210,32,5,1),(211,32,6,1),(212,33,1,1),(213,33,2,1),(214,33,3,1),(215,33,4,1),(216,33,5,1),(217,33,6,1),(218,34,1,1),(219,34,2,1),(220,34,3,1),(221,34,4,1),(222,34,5,1),(223,34,6,1),(224,35,1,1),(225,35,2,1),(226,35,3,1),(227,35,4,1),(228,35,5,1),(229,35,6,1),(230,16,1,1),(231,16,2,1),(232,16,3,1),(233,16,4,1),(234,16,5,1),(235,16,6,1),(236,36,1,1),(237,36,2,1),(238,36,3,1),(239,36,4,1),(240,36,5,1),(241,36,6,1),(242,37,1,1),(243,37,2,1),(244,37,3,1),(245,37,4,1),(246,37,5,1),(247,37,6,1),(248,38,1,1),(249,38,2,1),(250,38,3,1),(251,38,4,1),(252,38,5,1),(253,38,6,1),(254,39,1,1),(255,39,2,1),(256,39,3,1),(257,39,4,1),(258,39,5,1),(259,39,6,1),(260,40,1,1),(261,40,2,1),(262,40,3,1),(263,40,4,1),(264,40,5,1),(265,40,6,1),(272,42,1,1),(273,42,2,1),(274,42,3,1),(275,42,4,1),(276,42,5,1),(277,42,6,1),(278,43,1,1),(279,43,2,1),(280,43,3,1),(281,43,4,1),(282,43,5,1),(283,43,6,1),(284,44,1,1),(285,44,2,1),(286,44,3,1),(287,44,4,1),(288,44,5,1),(289,44,6,1),(290,45,1,1),(291,45,2,1),(292,45,3,1),(293,45,4,1),(294,45,5,1),(295,45,6,1),(296,46,1,1),(297,46,2,1),(298,46,3,1),(299,46,4,1),(300,46,5,1),(301,46,6,1),(302,47,1,1),(303,47,2,1),(304,47,3,1),(305,47,4,1),(306,47,5,1),(307,47,6,1),(308,26,4,1),(309,26,5,1),(310,48,1,1),(311,48,2,1),(312,48,3,1),(313,48,4,1),(314,48,5,1),(315,48,6,1),(316,49,1,1),(317,49,2,1),(318,49,3,1),(319,49,4,1),(320,49,5,1),(321,49,6,1),(322,50,1,1),(323,50,2,1),(324,50,3,1),(325,50,4,1),(326,50,5,1),(327,50,6,1),(328,51,1,1),(329,51,2,1),(330,51,3,1),(331,51,4,1),(332,51,5,1),(333,51,6,1),(334,52,1,1),(335,52,2,1),(336,52,3,1),(337,52,4,1),(338,52,5,1),(339,52,6,1),(340,53,1,1),(341,53,2,1),(342,53,3,1),(343,53,4,1),(344,53,5,1),(345,53,6,1),(346,54,1,1),(347,54,2,1),(348,54,3,1),(349,54,4,1),(350,54,5,1),(351,54,6,1),(352,55,1,1),(353,55,2,1),(354,55,3,1),(355,55,4,1),(356,55,5,1),(357,55,6,1),(358,56,1,1),(359,56,2,1),(360,56,3,1),(361,56,4,1),(362,56,5,1),(363,56,6,1),(364,57,1,1),(365,57,2,1),(366,57,3,1),(367,57,4,1),(368,57,5,1),(369,57,6,1),(370,58,1,1),(371,58,2,1),(372,58,3,1),(373,58,4,1),(374,58,5,1),(375,58,6,1),(376,59,1,1),(377,59,2,1),(378,59,3,1),(379,59,4,1),(380,59,5,1),(381,59,6,1),(382,60,1,1),(383,60,2,1),(384,60,3,1),(385,60,4,1),(386,60,5,1),(387,60,6,1),(388,61,1,1),(389,61,2,1),(390,61,3,1),(391,61,4,1),(392,61,5,1),(393,61,6,1),(394,62,1,1),(395,62,2,1),(396,62,3,1),(397,62,4,1),(398,62,5,1),(399,62,6,1),(400,63,1,1),(401,63,2,1),(402,63,3,1),(403,63,4,1),(404,63,5,1),(405,63,6,1),(406,64,1,1),(407,64,2,1),(408,64,3,1),(409,64,4,1),(410,64,5,1),(411,64,6,1),(412,65,1,1),(413,65,2,1),(414,65,3,1),(415,65,4,1),(416,65,5,1),(417,65,6,1),(418,66,1,1),(419,66,2,1),(420,66,3,1),(421,66,4,1),(422,66,5,1),(423,66,6,1),(424,67,1,1),(425,67,2,1),(426,67,3,1),(427,67,4,1),(428,67,5,1),(429,67,6,1),(430,68,1,1),(431,68,2,1),(432,68,3,1),(433,68,4,1),(434,68,5,1),(435,68,6,1),(436,69,1,1),(437,69,2,1),(438,69,3,1),(439,69,4,1),(440,69,5,1),(441,69,6,1),(442,70,1,1),(443,70,2,1),(444,70,3,1),(445,70,4,1),(446,70,5,1),(447,70,6,1),(448,71,1,1),(449,71,2,1),(450,71,3,1),(451,71,4,1),(452,71,5,1),(453,71,6,1),(454,72,1,1),(455,72,2,1),(456,72,3,1),(457,72,4,1),(458,72,5,1),(459,72,6,1),(460,73,1,1),(461,73,2,1),(462,73,3,1),(463,73,4,1),(464,73,5,1),(465,73,6,1),(500,74,1,1),(501,74,2,1),(502,74,3,1),(503,74,4,1),(504,74,5,1),(505,74,6,1),(506,74,7,1),(529,20,1,2),(530,41,1,1),(531,41,2,1),(532,41,3,1),(533,41,4,1),(534,41,5,1),(535,41,6,1),(536,41,7,1),(537,41,13,1),(538,41,14,1),(539,41,15,1),(540,41,16,1),(541,41,17,1),(542,41,18,1),(543,41,19,1),(544,41,1,2),(545,41,2,2),(546,41,3,2),(547,41,4,2),(548,41,5,2),(549,41,6,2),(550,41,7,2),(551,41,13,2),(552,41,14,2),(553,41,15,2),(554,41,16,2),(555,41,17,2),(556,41,18,2),(557,41,19,2),(558,75,1,1),(559,75,2,1),(560,75,3,1),(561,75,4,1),(562,75,5,1),(563,75,6,1),(564,76,1,1),(565,76,2,1),(566,76,3,1),(567,76,4,1),(568,76,5,1),(569,76,6,1),(570,77,1,1),(571,77,2,1),(572,77,3,1),(573,77,4,1),(574,77,5,1),(575,77,6,1),(576,78,1,1),(577,78,2,1),(578,78,3,1),(579,78,4,1),(580,78,5,1),(581,78,6,1),(582,79,1,1),(583,79,2,1),(584,79,3,1),(585,79,4,1),(586,79,5,1),(587,79,6,1),(588,80,1,1),(589,80,2,1),(590,80,3,1),(591,80,4,1),(592,80,5,1),(593,80,6,1),(594,81,1,1),(595,81,2,1),(596,81,3,1),(597,81,4,1),(598,81,5,1),(599,81,6,1),(600,82,1,1),(601,82,2,1),(602,82,3,1),(603,82,4,1),(604,82,5,1),(605,82,6,1),(606,83,1,1),(607,83,2,1),(608,83,3,1),(609,83,4,1),(610,83,5,1),(611,83,6,1);
/*!40000 ALTER TABLE `perfil_controller_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultado`
--

DROP TABLE IF EXISTS `resultado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultado` (
  `id_resultado` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) DEFAULT NULL,
  `id_conteudo_simulado` int(11) DEFAULT NULL,
  `cs_resposta` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_resultado`),
  KEY `FK_conteudo_simulado_resultado` (`id_conteudo_simulado`),
  KEY `FK_resultado_aluno` (`id_aluno`),
  CONSTRAINT `FK_conteudo_simulado_resultado` FOREIGN KEY (`id_conteudo_simulado`) REFERENCES `conteudo_simulado` (`id_conteudo_simulado`),
  CONSTRAINT `FK_resultado_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultado`
--

LOCK TABLES `resultado` WRITE;
/*!40000 ALTER TABLE `resultado` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sexo`
--

DROP TABLE IF EXISTS `sexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL AUTO_INCREMENT,
  `nm_sexo` varchar(45) NOT NULL COMMENT '{"label":"Sexo"}',
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sexo`
--

LOCK TABLES `sexo` WRITE;
/*!40000 ALTER TABLE `sexo` DISABLE KEYS */;
INSERT INTO `sexo` VALUES (1,'Masculino'),(2,'Feminino');
/*!40000 ALTER TABLE `sexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `simulado`
--

DROP TABLE IF EXISTS `simulado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `simulado` (
  `id_simulado` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `ds_simulado` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_simulado`),
  KEY `FK_Reference_39` (`id_curso`),
  KEY `FK_Reference_40` (`id_usuario`),
  CONSTRAINT `FK_Reference_39` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  CONSTRAINT `FK_Reference_40` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simulado`
--

LOCK TABLES `simulado` WRITE;
/*!40000 ALTER TABLE `simulado` DISABLE KEYS */;
/*!40000 ALTER TABLE `simulado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situacao`
--

DROP TABLE IF EXISTS `situacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `situacao` (
  `id_situacao` int(11) NOT NULL AUTO_INCREMENT,
  `nm_situacao` varchar(100) DEFAULT NULL COMMENT '{"label":"Situação"}',
  PRIMARY KEY (`id_situacao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situacao`
--

LOCK TABLES `situacao` WRITE;
/*!40000 ALTER TABLE `situacao` DISABLE KEYS */;
INSERT INTO `situacao` VALUES (1,'Ativo'),(2,'Inativo');
/*!40000 ALTER TABLE `situacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situacao_usuario`
--

DROP TABLE IF EXISTS `situacao_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `situacao_usuario` (
  `id_situacao_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_situacao_usuario` varchar(100) DEFAULT NULL COMMENT '{"label":"Situação usuário"}',
  PRIMARY KEY (`id_situacao_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situacao_usuario`
--

LOCK TABLES `situacao_usuario` WRITE;
/*!40000 ALTER TABLE `situacao_usuario` DISABLE KEYS */;
INSERT INTO `situacao_usuario` VALUES (1,'Ativo'),(2,'Inativo'),(3,'Congelado'),(4,'Atrasado');
/*!40000 ALTER TABLE `situacao_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tipo_usuario` varchar(100) DEFAULT NULL COMMENT '{"label":"Tipo usuário"}',
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador ENADE'),(2,'Coordenaçao'),(3,'Professor(a)'),(4,'Secretaria(o)');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL AUTO_INCREMENT,
  `nm_turno` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(250) NOT NULL COMMENT '{"label":"Usuário"}',
  `id_sexo` int(11) DEFAULT NULL COMMENT '{"label":"Sexo"}',
  `id_tipo_usuario` int(11) NOT NULL,
  `id_situacao_usuario` int(11) NOT NULL,
  `id_email` int(11) DEFAULT NULL COMMENT '{"label":"E-mail","valor_fk":"em_email"}',
  PRIMARY KEY (`id_usuario`),
  KEY `ix_usuarios_sexo` (`id_sexo`),
  KEY `ix_usuarios_tipo_usuario` (`id_tipo_usuario`),
  KEY `ix_usuarios_situacao_usuario` (`id_situacao_usuario`),
  KEY `ix_usuarios_emails` (`id_email`),
  CONSTRAINT `fk_usuarios_emails` FOREIGN KEY (`id_email`) REFERENCES `email_acesso` (`id_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_sexo` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_situacao_usuario` FOREIGN KEY (`id_situacao_usuario`) REFERENCES `situacao_usuario` (`id_situacao_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Administrador ENADE',1,1,1,1),(2,'Alysson VicuÃ±a de Oliveira',1,1,1,2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `bdpainelenade`
--

USE `bdpainelenade`;

--
-- Final view structure for view `acl`
--

/*!50001 DROP TABLE IF EXISTS `acl`*/;
/*!50001 DROP VIEW IF EXISTS `acl`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`miqueiascastro`@`localhost` SQL SECURITY INVOKER */
/*!50001 VIEW `acl` AS (select `perfil_controller_action`.`id_perfil` AS `id_perfil`,concat(`controller`.`nm_controller`,'/',`action`.`nm_action`) AS `nm_resource` from ((`perfil_controller_action` join `controller` on((`controller`.`id_controller` = `perfil_controller_action`.`id_controller`))) join `action` on((`action`.`id_action` = `perfil_controller_action`.`id_action`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `auth`
--

/*!50001 DROP TABLE IF EXISTS `auth`*/;
/*!50001 DROP VIEW IF EXISTS `auth`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY INVOKER */
/*!50001 VIEW `auth` AS (select `login`.`id_usuario` AS `id_usuario`,`perfil`.`id_perfil` AS `id_perfil`,`email_acesso`.`em_email` AS `em_email`,`login`.`pw_senha` AS `pw_senha`,`usuario`.`nm_usuario` AS `nm_usuario`,1 AS `id_contrato` from (((`usuario` join `login` on((`login`.`id_usuario` = `usuario`.`id_usuario`))) join `email_acesso` on((`email_acesso`.`id_email` = `login`.`id_email`))) join `perfil` on((`perfil`.`id_perfil` = `login`.`id_perfil`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-22 19:32:02
