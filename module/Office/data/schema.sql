START TRANSACTION;

CREATE TABLE IF NOT EXISTS `office` (
  `office_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `office_name` varchar(100) NOT NULL,
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

INSERT INTO `office` (`office_id`, `office_name`) VALUES
(1, 'AUX. ADMINISTRATIVO'),
(2, 'AUX. DE ESCRITÓRIO'),
(3, 'AUX. DE SERVIÇOS GERAIS'),
(4, 'DIRETOR'),
(5, 'GERENTE'),
(6, 'REPRESENTANTE DE VENDAS'),
(7, 'FISIOTERAPEUTA'),
(8, 'MOTORISTA'),
(10, 'ESCREVENTE JUDICIÁRIO'),
(11, 'APOSENTADO-INSS'),
(12, 'ELETRICISTA'),
(13, 'MECÂNICO'),
(14, 'PEDREIRO'),
(15, 'PINTOR'),
(16, 'OPERADOR DE MÁQUINAS'),
(17, 'PADEIRO'),
(18, 'SÓCIO PROPRIETÁRIO'),
(19, 'VENDEDOR'),
(20, 'AUX. GERAL'),
(21, 'MONTADOR DE MÓVEIS'),
(22, 'MARCINEIRO'),
(23, 'TRABALHADOR RURAL'),
(24, 'TÉCNICO EM ELETRÔNICA'),
(25, 'ENTREGADOR'),
(26, 'COZINHEIRO(A)'),
(27, 'SERRALHEIRO'),
(28, 'SEGURANÇA'),
(29, 'CABELEIREIRO(A)'),
(30, 'PROFESSOR(A)'),
(31, 'SECRETÁRIA'),
(32, 'IMPRESSOR'),
(33, 'AUX. DE PRODUÇÃO'),
(34, 'FISCAL TRIBUTÁRIO'),
(35, 'SOLDADOR'),
(36, 'ARRENDATÁRIO'),
(37, 'AUX. DE LABORATÁRIO'),
(38, 'FERMENTADORA'),
(39, 'ENGENHEIRO QUÍMICO'),
(40, 'BIOMÉDICO(A)'),
(41, 'ADVOGADO(A)'),
(42, 'FISCAL DE IRRIGAÇÃO'),
(43, 'REPOSITOR'),
(44, 'PRODUTOR SECUNDÁRIO'),
(45, 'TORNEIRO'),
(46, 'PROPRIETÁRIO DE CAMINHÃO'),
(47, 'INSPETOR'),
(48, 'DEPTO. DE COMPRAS'),
(49, 'FRENTISTA'),
(50, 'ASSISTENTE'),
(51, 'MESTRE DE OBRAS'),
(52, 'COPEIRO(A)'),
(53, 'AUX. CONTÁBIL'),
(54, 'ARMADOR'),
(55, 'ANALISTA DE SISTEMAS'),
(56, 'COORDENADOR(A)'),
(57, 'AGROPECUARISTA'),
(58, 'AGENTE FUNERÁRIO'),
(59, 'JARDINEIRO'),
(60, 'OP. DE PÁ ESCAVADEIRA'),
(61, 'PRESTADOR DE SERVIÇOS'),
(62, 'SOLDADO'),
(63, 'SUBTENENTE'),
(64, 'TENENTE'),
(65, 'ADMINISTRADOR'),
(66, 'ENCARREGADO'),
(67, 'LIDER'),
(68, 'VETERINÁRIO'),
(69, 'ENFERMEIRO(A)'),
(70, 'MICROBIOLOGISTA'),
(71, 'LOCUTOR'),
(72, 'AÇOUGUEIRO'),
(73, 'GUARDA NOTURNO'),
(74, 'COSTUREIRA'),
(75, 'PLANTIO MANUAL'),
(76, 'CONTADOR'),
(77, 'PRODUTOR DE CARVÃO'),
(78, 'VAQUEIRO'),
(79, 'PROPIETÁRIO RURAL'),
(80, 'FARMACÊUTICA'),
(81, 'EMPRESÁRIO'),
(82, 'BORRACHEIRO'),
(83, 'MONTADOR'),
(84, 'TÉC. DE SEGURANÇA DO TRABALHO'),
(85, 'POLICIAL MILITAR'),
(86, 'ATENDENTE'),
(87, 'OPERADOR DE CAIXA'),
(88, 'TÉC. DE PRODUÇÃO'),
(89, 'PROPRIETÁRIO DE IMÓVEL'),
(90, 'TRATORISTA'),
(91, 'PREPARADOR DE RAÇÃO'),
(92, 'PROPRIETÁRIO'),
(93, 'FISCAL DE CAIXA'),
(94, 'LANTERNEIRO'),
(95, 'PRÁTICO EM FRIGORÍFICO'),
(96, 'EMPREGADA DOMÉSTICA'),
(97, 'GARÇONETE'),
(98, 'SUPERVISOR AGRÍCOLA'),
(99, 'AGENTE COMBATE DE ENDEMIAS'),
(100, 'LABORATORISTA'),
(101, 'FOTÓGRAFO'),
(102, 'VIGILANTE'),
(103, 'CARREGADOR'),
(104, 'ANALISTA DE ESTOQUE'),
(105, 'FEIRANTE'),
(106, 'MESTRE DE CERIMÔNIAS'),
(107, 'AUXILIAR DE COMPRAS'),
(108, 'INSTRUTOR'),
(109, 'OPERADOR / CLASSIFICADOR'),
(110, 'REPRESENTANTE COMERCIAL'),
(111, 'BALCONISTA'),
(112, 'SORVETEIRO'),
(113, 'OFFICE BOY'),
(114, 'OPERADOR(A) DE ORDENHA'),
(115, 'GESSEIRO'),
(116, 'CONSTRUTOR'),
(117, 'INSTALADOR DE LINHAS ELÉTRICAS'),
(118, 'ENCARREGADO DE LAVANDERIA'),
(119, 'AGRICULTOR POLIVALENTE'),
(120, 'TEC. REC. HUMANOS'),
(121, 'PORTEIRO'),
(122, 'SARGENTO'),
(123, 'GERENTE DE NÚCLEO'),
(124, 'BOMBEIRO');

COMMIT;