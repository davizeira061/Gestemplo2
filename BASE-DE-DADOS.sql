CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `Prioridade` tinyint(3) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Horario` time DEFAULT NULL,
  `Assunto` varchar(50) DEFAULT '',
  `Tarefa` text DEFAULT NULL,
  `Resolvido` tinyint(1) DEFAULT 4
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agsolucao`
--

CREATE TABLE `agsolucao` (
  `Id` int(11) NOT NULL,
  `solucao` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agsolucao`
--

INSERT INTO `agsolucao` (`Id`, `solucao`) VALUES
(1, 'Nao'),
(2, 'Aguardo outros'),
(3, 'Aguardo finan?as'),
(4, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ajuda`
--

CREATE TABLE `ajuda` (
  `Id` int(11) NOT NULL,
  `pg` varchar(100) DEFAULT NULL,
  `txt` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `ajuda`
--

INSERT INTO `ajuda` (`Id`, `pg`, `txt`) VALUES
(4, 'igrejaslist.php', '<p>Este conte&uacute;do &eacute; apenas um exemplo da ajuda. Para edita-lo v&aacute; at&eacute; o menu Manuten&ccedil;&atilde;o e clique em Editar Ajuda do Sistema.&nbsp;s\\dasdfasdfasdf asd</p>'),
(5, 'membrolist.php', '<p>Para Cadastrar Membros Use o Quadrado Verde Com o Mais;</p>\r\n\r\n<p>Para Ver Mais Detalhes Sobre Os Membros Use A lupa;</p>\r\n\r\n<p>Para Editar Alguma Informa&ccedil;&atilde;o Sobre o Membro Use O Quadrado Com o L&aacute;pis;</p>\r\n\r\n<p>Para Deletar Utilize a Lixeira;</p>\r\n\r\n<p>Sr. Tesoureiro Para Lan&ccedil;ar D&iacute;zimos e Ofertas Utilizar&nbsp;<a href=\"http://localhost/igrejasistem_corrigido/caixadodialist.php\"><strong>Caixa-Lan&ccedil;amento de Hoje</strong>.</a></p>');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `anos`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `anos` (
`anos_financ` int(4)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `audittrail`
--

CREATE TABLE `audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext DEFAULT NULL,
  `oldvalue` longtext DEFAULT NULL,
  `newvalue` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `Banco` varchar(30) DEFAULT NULL,
  `N_do_Banco` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `bancos`
--

INSERT INTO `bancos` (`id`, `Banco`, `N_do_Banco`) VALUES
(1, 'Bradesco', '237'),
(5, 'Caixa Economica Federal', '104'),
(7, 'Tesouraria', '9999'),
(8, 'Itau', '341');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bens_patrimoniais`
--

CREATE TABLE `bens_patrimoniais` (
  `Id_Patri` int(11) NOT NULL,
  `Descricao` varchar(80) DEFAULT NULL,
  `DataAquisao` date DEFAULT NULL,
  `Localidade` int(11) DEFAULT NULL COMMENT 'Localidade / Cidade / Estado se imóvel',
  `Tipo` enum('M&oacute;vel','Im&oacute;vel') DEFAULT NULL,
  `Estado_do_bem` tinyint(3) DEFAULT NULL,
  `Valor_estimado` decimal(10,2) DEFAULT NULL,
  `Situacao` enum('Quitado','N&atilde;o quitado') DEFAULT NULL,
  `Anotacoes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bens_patrimoniais`
--

INSERT INTO `bens_patrimoniais` (`Id_Patri`, `Descricao`, `DataAquisao`, `Localidade`, `Tipo`, `Estado_do_bem`, `Valor_estimado`, `Situacao`, `Anotacoes`) VALUES
(1, 'Mesa de Madeira', '2014-09-06', 9, 'M&oacute;vel', 2, 250.00, 'Quitado', NULL),
(2, 'DATA SHOW', '2014-11-03', 8, 'M&oacute;vel', 1, 1500.00, 'Quitado', 'SAmSUng'),
(3, 'GUITARRA', '2014-11-12', 16, 'M&oacute;vel', 1, 460.00, 'Quitado', 'VERMELHA MARCA GIANINE'),
(4, 'AR CONDICIONADO 9.000 BTUS', '2015-02-10', 9, 'Im&oacute;vel', 1, 1000.00, 'Quitado', 'REFRIGERA??O DO TEMPLO');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `caixadodia`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `caixadodia` (
`Tipo` tinyint(1)
,`N_Documento` varchar(20)
,`Conta_Caixa` int(11)
,`Situacao` tinyint(1)
,`Descricao` varchar(60)
,`Receitas` decimal(10,2)
,`Despesas` decimal(10,2)
,`FormaPagto` tinyint(3)
,`Dt_Lancamento` date
,`Vencimento` date
,`Centro_de_Custo` int(11)
,`id_discipulo` int(11)
,`Id` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargoscelulas`
--

CREATE TABLE `cargoscelulas` (
  `id_cgcelula` int(11) NOT NULL,
  `Cargo_Celula` varchar(35) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `cargoscelulas`
--

INSERT INTO `cargoscelulas` (`id_cgcelula`, `Cargo_Celula`) VALUES
(4, 'Dirigente'),
(5, 'Anfitrião'),
(6, 'Discipulador'),
(7, 'Lider'),
(8, 'Co-Lider');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargosministeriais`
--

CREATE TABLE `cargosministeriais` (
  `id_cgm` int(11) NOT NULL,
  `Cargo_Ministerial` varchar(35) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `cargosministeriais`
--

INSERT INTO `cargosministeriais` (`id_cgm`, `Cargo_Ministerial`) VALUES
(4, 'Pastor'),
(5, 'Bispo'),
(6, 'Apostolo'),
(7, 'Diacono'),
(8, 'Presbitero'),
(9, 'Membro'),
(10, 'Pastor Oresidente'),
(11, 'MINISTRA DE LOUVOR'),
(12, 'JOVEM MENOR'),
(13, 'Obreira'),
(14, 'COREOGRAFIA'),
(15, 'CANDIDATA'),
(16, '300'),
(17, '300 TROPA DE ELITE'),
(18, 'PASTORA'),
(19, 'LEVITA'),
(20, 'OBREIRO'),
(21, 'DJ IGREJA'),
(22, 'CANDIDATO'),
(23, 'LIDER DE CRIANCA'),
(24, 'bla');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartas`
--

CREATE TABLE `cartas` (
  `Id` int(11) NOT NULL,
  `Corpo_TR` text DEFAULT NULL,
  `Atualizado_TR` date DEFAULT NULL,
  `Corpo_CR` text DEFAULT NULL,
  `Atualizado_CR` date DEFAULT NULL,
  `Corpo_EX` text DEFAULT NULL,
  `Atualizado_EX` date DEFAULT NULL,
  `Corpo_Of` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `cartas`
--

INSERT INTO `cartas` (`Id`, `Corpo_TR`, `Atualizado_TR`, `Corpo_CR`, `Atualizado_CR`, `Corpo_EX`, `Atualizado_EX`, `Corpo_Of`) VALUES
(1, '<table cellpadding=\"1\" cellspacing=\"10\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"width:200px\"><img alt=\"\" src=\"/igrejasistem/fotosmembros/userfiles/image/Logo%20-%20Igreja%20Batista%20Liberdade_.jpg\" style=\"width:189px\" />&nbsp;&nbsp;</td>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"1\" cellspacing=\"10\" style=\"width:500px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;Rua, 123<br />\r\n						&nbsp;Bairro - S&atilde;o Paulo - SP<br />\r\n						&nbsp;CEP: 00000-000<br />\r\n						&nbsp;CNPJ: 123123123123123</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"width:100px\">\r\n			<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CARTA DE TRANSFER&Ecirc;NCIA</strong></h2>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"width:100px\">\r\n			<table cellpadding=\"1\" cellspacing=\"10\" style=\"width:727px\">\r\n				<tbody>\r\n					<tr>\r\n						<td colspan=\"2\" style=\"width:100px\">\r\n						<p>&nbsp;Recebei no senhor como convem os santos Membro ativo participante dos eventos da Igreja Dizimista estar em plena comunh&atilde;o com a igreja e seu pastor..</p>\r\n\r\n						<p>Nome: &nbsp;[#nome],</p>\r\n\r\n						<p>Sexo: [#sexo],</p>\r\n\r\n						<p>Estado Civil:&nbsp;[#estadocivil],</p>\r\n\r\n						<p>Nacionalidade: [#nacionalidade],</p>\r\n\r\n						<p>CPF:&nbsp;[#cpf],</p>\r\n\r\n						<p>Cargo Ministerial: [#cargoministerial]</p>\r\n\r\n						<p>Da Igreja:&nbsp;[#daigreja]</p>\r\n\r\n						<p>Admiss&atilde;o: [#admissao]</p>\r\n\r\n						<p>RG:&nbsp;[#rg]</p>\r\n\r\n						<p>Dia:&nbsp;[#dia]</p>\r\n\r\n						<p>M&ecirc;s:&nbsp;[#mes]</p>\r\n\r\n						<p>Ano:&nbsp;[#ano]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '2015-08-25', '<table cellpadding=\"1\" cellspacing=\"10\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"width:200px\"><img alt=\"\" src=\"/igrejasistem/fotosmembros/userfiles/image/Logo%20-%20Igreja%20Batista%20Liberdade_.jpg\" style=\"width:189px\" />&nbsp;&nbsp;</td>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"1\" cellspacing=\"10\" style=\"width:500px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;Rua, 123<br />\r\n						&nbsp;Bairro - S&atilde;o Paulo - SP<br />\r\n						&nbsp;CEP: 00000-000<br />\r\n						&nbsp;CNPJ: 123123123123123</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"width:100px\">\r\n			<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CARTA DE RECOMENDA&Ccedil;&Atilde;O</strong></h2>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"width:100px\">\r\n			<table cellpadding=\"1\" cellspacing=\"10\" style=\"width:727px\">\r\n				<tbody>\r\n					<tr>\r\n						<td colspan=\"2\" style=\"width:100px\">\r\n						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus sed dui cursus egestas et ac dolor. Nam fringilla laoreet arcu, elementum sagittis urna suscipit vel. Proin et molestie ante. Praesent posuere lacus ut nulla gravida vestibulum. In in urna eu eros lobortis consequat. Curabitur nec dictum nisl. Fusce interdum ultricies massa, et dapibus mauris vehicula vel. Donec posuere lobortis rutrum.</p>\r\n\r\n						<p>Nome: &nbsp;[#nome],</p>\r\n\r\n						<p>Sexo: [#sexo],</p>\r\n\r\n						<p>Estado Civil:&nbsp;[#estadocivil],</p>\r\n\r\n						<p>Nacionalidade: [#nacionalidade],</p>\r\n\r\n						<p>CPF:&nbsp;[#cpf],</p>\r\n\r\n						<p>Cargo Ministerial: [#cargoministerial]</p>\r\n\r\n						<p>Da Igreja:&nbsp;[#daigreja]</p>\r\n\r\n						<p>Admiss&atilde;o: [#admissao]</p>\r\n\r\n						<p>RG:&nbsp;[#rg]</p>\r\n\r\n						<p>Dia:&nbsp;[#dia]</p>\r\n\r\n						<p>M&ecirc;s:&nbsp;[#mes]</p>\r\n\r\n						<p>Ano:&nbsp;[#ano]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '2015-08-25', '<table cellpadding=\"1\" cellspacing=\"10\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"width:200px\"><img alt=\"\" src=\"/igrejasistem/fotosmembros/userfiles/image/Logo%20-%20Igreja%20Batista%20Liberdade_.jpg\" style=\"width:189px\" />&nbsp;&nbsp;</td>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"1\" cellspacing=\"10\" style=\"width:500px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;Rua, 123<br />\r\n						&nbsp;Bairro - S&atilde;o Paulo - SP<br />\r\n						&nbsp;CEP: 00000-000<br />\r\n						&nbsp;CNPJ: 123123123123123</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"width:100px\">\r\n			<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CARTA DE DESLIGAMENTO</strong></h2>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"width:100px\">\r\n			<table cellpadding=\"1\" cellspacing=\"10\" style=\"width:727px\">\r\n				<tbody>\r\n					<tr>\r\n						<td colspan=\"2\" style=\"width:100px\">\r\n						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non lacus sed dui cursus egestas et ac dolor. Nam fringilla laoreet arcu, elementum sagittis urna suscipit vel. Proin et molestie ante. Praesent posuere lacus ut nulla gravida vestibulum. In in urna eu eros lobortis consequat. Curabitur nec dictum nisl. Fusce interdum ultricies massa, et dapibus mauris vehicula vel. Donec posuere lobortis rutrum.</p>\r\n\r\n						<p>Nome: &nbsp;[#nome],</p>\r\n\r\n						<p>Sexo: [#sexo],</p>\r\n\r\n						<p>Estado Civil:&nbsp;[#estadocivil],</p>\r\n\r\n						<p>Nacionalidade: [#nacionalidade],</p>\r\n\r\n						<p>CPF:&nbsp;[#cpf],</p>\r\n\r\n						<p>Cargo Ministerial: [#cargoministerial]</p>\r\n\r\n						<p>Da Igreja:&nbsp;[#daigreja]</p>\r\n\r\n						<p>Admiss&atilde;o: [#admissao]</p>\r\n\r\n						<p>RG:&nbsp;[#rg]</p>\r\n\r\n						<p>Dia:&nbsp;[#dia]</p>\r\n\r\n						<p>M&ecirc;s:&nbsp;[#mes]</p>\r\n\r\n						<p>Ano:&nbsp;[#ano]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '2015-08-25', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Of. N&deg;_______/___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________, de _______de____.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&Aacute;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ilm&ordm;. Sr.&nbsp;_________________________.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Secretaria _______________________&shy;.</p>\r\n\r\n<p>__________-____</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A igreja<strong>&nbsp;_______________________&nbsp;</strong>&eacute; uma organiza&ccedil;&atilde;o religiosa, sem finslucrativos, criada com o objetivo de pregar o evangelho de nosso Senhor Jesus Cristo, realizar obras de Assist&ecirc;ncia Social e Educacional junto &agrave; Comunidade, colaborando com as entidades governamentais para o desenvolvimento de uma sociedade pac&iacute;fica, ordeira e progressista.</p>\r\n\r\n<p>Tendo em vista a realiza&ccedil;&atilde;o de&nbsp;<strong>um ______________________________desta Igreja,&nbsp;</strong>onde estaremos fazendo apresenta&ccedil;&otilde;es como ___________________, solicitamos desta secretaria&nbsp;&nbsp;a<strong>libera&ccedil;&atilde;o&nbsp;&nbsp;da (rua) ____________________________</strong>&nbsp;para realiz&ccedil;&atilde;o deste evento. Com &iacute;nicio apartir das ______ at&eacute; as ______ no (dia da semana) dia ___ de _______________ do corrente ano.</p>\r\n\r\n<p>Certo de sua aten&ccedil;&atilde;o e pronta acolhida, aproveitamos a oportunidade para apresentar-lhe os protestos de nosso respeito e apre&ccedil;o.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(assinatura do pastor)_______________________________</p>\r\n\r\n<p>(nome do pastor)</p>\r\n\r\n<p>(Pastor Presidente)</p>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `celulas`
--

CREATE TABLE `celulas` (
  `Id_celula` int(11) NOT NULL,
  `Responsavel` varchar(60) DEFAULT NULL,
  `NomeCelula` varchar(60) DEFAULT NULL,
  `DiasReunioes` set('Domingo','Segunda','Ter?a','Quarta','Quinta','Sexta','S?bado') DEFAULT '',
  `HorarioReunioes` time DEFAULT NULL,
  `Endereco` varchar(80) DEFAULT NULL,
  `Anotacoes` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contatos`
--

CREATE TABLE `contatos` (
  `Id` int(11) NOT NULL,
  `Pessoa_Empresa` varchar(70) DEFAULT NULL,
  `Telefone_1` varchar(25) NOT NULL DEFAULT '',
  `Telefone_2` varchar(25) DEFAULT NULL,
  `Celular_1` varchar(25) DEFAULT NULL,
  `Celular_2` varchar(25) DEFAULT NULL,
  `EnderecoCompleto` varchar(500) DEFAULT NULL COMMENT 'Pressione Shif + Enter',
  `EmailPessoal` varchar(65) DEFAULT NULL,
  `EmailComercial` varchar(65) DEFAULT NULL,
  `Anotacoes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta_bancaria`
--

CREATE TABLE `conta_bancaria` (
  `Id` int(11) NOT NULL,
  `Banco` int(11) DEFAULT NULL,
  `Agencia` varchar(10) DEFAULT NULL,
  `Conta` varchar(20) DEFAULT NULL,
  `Gerente` varchar(40) DEFAULT NULL,
  `Telefone` varchar(50) DEFAULT NULL,
  `Limite` decimal(10,2) DEFAULT NULL,
  `Site` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_tarefas`
--

CREATE TABLE `controle_tarefas` (
  `Id_tarefas` int(11) NOT NULL,
  `DuracaoEstimada` varchar(50) DEFAULT NULL,
  `Descricao` varchar(100) DEFAULT NULL,
  `Prioridade` tinyint(1) DEFAULT NULL,
  `Anotacoes` varchar(255) DEFAULT NULL,
  `Completa` tinyint(1) DEFAULT NULL,
  `Concluida_em` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dias_semana`
--

CREATE TABLE `dias_semana` (
  `Id_semana` tinyint(3) NOT NULL,
  `Dias` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dias_semana`
--

INSERT INTO `dias_semana` (`Id_semana`, `Dias`) VALUES
(1, 'Domingo'),
(2, 'Segunda'),
(3, 'Ter?a'),
(4, 'Quarta'),
(5, 'Quinta'),
(6, 'Sexta'),
(7, 'Sabado');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `dizimos`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `dizimos` (
`Tipo` tinyint(1)
,`Conta_Caixa` int(11)
,`Situacao` tinyint(1)
,`Descricao` varchar(60)
,`Receitas` decimal(10,2)
,`FormaPagto` tinyint(3)
,`Dt_Lancamento` date
,`Vencimento` date
,`Centro_de_Custo` int(11)
,`id_discipulo` int(11)
,`Id` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `dizimosmesatual`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `dizimosmesatual` (
`Tipo` tinyint(1)
,`Conta_Caixa` int(11)
,`Situacao` tinyint(1)
,`Descricao` varchar(60)
,`Receitas` decimal(10,2)
,`FormaPagto` tinyint(3)
,`Dt_Lancamento` date
,`Vencimento` date
,`Centro_de_Custo` int(11)
,`id_discipulo` int(11)
,`Id` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `dizimosporcriterio`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `dizimosporcriterio` (
`Mes` int(2)
,`Tipo` tinyint(1)
,`Conta_Caixa` int(11)
,`Situacao` tinyint(1)
,`Descricao` varchar(60)
,`Receitas` decimal(10,2)
,`FormaPagto` tinyint(3)
,`Dt_Lancamento` date
,`Vencimento` date
,`Centro_de_Custo` int(11)
,`id_discipulo` int(11)
,`Id` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolaridade`
--

CREATE TABLE `escolaridade` (
  `Id` int(11) NOT NULL,
  `Escolaridade` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escolaridade`
--

INSERT INTO `escolaridade` (`Id`, `Escolaridade`) VALUES
(1, 'Ensino medio Completo'),
(2, 'Ensino Medio Incompleto'),
(3, 'Nivel Superior'),
(4, 'Nivel Superior Incompleto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado_patrimonio`
--

CREATE TABLE `estado_patrimonio` (
  `Id_est_patri` int(11) NOT NULL,
  `Estado_do_Bem` varchar(20) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `estado_patrimonio`
--

INSERT INTO `estado_patrimonio` (`Id_est_patri`, `Estado_do_Bem`) VALUES
(1, 'Novo'),
(2, 'Bom'),
(3, 'Regular'),
(4, 'Ruim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudos_biblicos`
--

CREATE TABLE `estudos_biblicos` (
  `Id_estu_bb` int(11) NOT NULL,
  `Numero_do_Estudo` int(11) DEFAULT NULL,
  `Data_do_Estudo` date DEFAULT NULL,
  `Assunto` varchar(100) DEFAULT NULL,
  `DescricaoMensagem` text DEFAULT NULL,
  `Anotacoes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `Id` int(11) NOT NULL,
  `Evento` varchar(100) DEFAULT NULL,
  `Descriacao` text DEFAULT NULL,
  `DataInicio` date DEFAULT NULL,
  `DataTermino` date DEFAULT NULL,
  `Anotacoes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `financeiro`
--

CREATE TABLE `financeiro` (
  `Id` int(11) NOT NULL,
  `id_discipulo` int(11) DEFAULT NULL COMMENT 'para controle de dizimos',
  `Tipo` tinyint(1) DEFAULT NULL COMMENT 'Receita,Despesa',
  `Tipo_Recebimento` tinyint(1) NOT NULL,
  `Despesas` decimal(10,2) DEFAULT NULL,
  `Receitas` decimal(10,2) DEFAULT NULL,
  `Descricao` varchar(60) DEFAULT NULL,
  `Conta_Caixa` int(11) DEFAULT NULL,
  `N_Documento` varchar(20) DEFAULT NULL,
  `Dt_Lancamento` date DEFAULT NULL,
  `Vencimento` date DEFAULT NULL,
  `Centro_de_Custo` int(11) DEFAULT NULL COMMENT 'olg conta',
  `Situacao` tinyint(1) DEFAULT NULL,
  `FormaPagto` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_centro_de_custo`
--

CREATE TABLE `fin_centro_de_custo` (
  `Id` int(11) NOT NULL,
  `Conta` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `fin_centro_de_custo`
--

INSERT INTO `fin_centro_de_custo` (`Id`, `Conta`) VALUES
(6, 'Pagamento Funcionarios'),
(7, 'Manutenção da Igreja'),
(8, 'RECEBIMENTO'),
(10, '139 - RADIONAL'),
(11, 'TEMPLO - 42%'),
(12, 'Retiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_conta_caixa`
--

CREATE TABLE `fin_conta_caixa` (
  `Id` int(11) NOT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Conta_Caixa` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `fin_conta_caixa`
--

INSERT INTO `fin_conta_caixa` (`Id`, `Tipo`, `Conta_Caixa`) VALUES
(1, 1, 'Dizimo'),
(3, 0, 'Energia'),
(4, 0, 'Agua'),
(8, 1, 'Oferta'),
(9, 1, 'Boas Novas'),
(10, 0, 'Aluguel'),
(11, 0, 'Telefone'),
(12, 1, 'Outros - Infraestrutura'),
(13, 0, 'Zelador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_forma_pgto`
--

CREATE TABLE `fin_forma_pgto` (
  `Id` int(11) NOT NULL,
  `filtro_tipo_recebimento` tinyint(3) DEFAULT NULL,
  `Forma_Pagto` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `fin_forma_pgto`
--

INSERT INTO `fin_forma_pgto` (`Id`, `filtro_tipo_recebimento`, `Forma_Pagto`) VALUES
(1, 1, 'Debito Aut.'),
(2, 1, 'Cheque'),
(3, 1, 'Escritural'),
(4, 1, 'Boleto'),
(5, 2, 'Dinheiro'),
(6, 2, 'Cheque'),
(7, 1, 'Visa Debito'),
(8, 1, 'Visa Credito'),
(9, 1, 'Mastercard Debito'),
(10, 1, 'Mastercard Credito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_situacao`
--

CREATE TABLE `fin_situacao` (
  `Id` int(11) NOT NULL,
  `id_tipo` tinyint(1) DEFAULT NULL,
  `Situacao` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `fin_situacao`
--

INSERT INTO `fin_situacao` (`Id`, `id_tipo`, `Situacao`) VALUES
(1, 0, '<div class=\"badge bg-cobalt\">Pago</div>'),
(2, 0, '<div class=\"badge bg-red\">A Pagar</div>'),
(3, 1, '<div class=\"badge bg-darker\">Recebido</div>'),
(4, 1, '<div class=\"badge bg-emerald\">A Receber</div>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `Id` int(11) NOT NULL,
  `EhMembro` tinyint(1) DEFAULT NULL,
  `Data_Admissao` date DEFAULT NULL,
  `Nome` varchar(100) NOT NULL DEFAULT '',
  `Data_Nasc` date DEFAULT NULL,
  `Estado_Civil` enum('Solteiro','Casado','Viúvo','Divorciado','Amasiado') DEFAULT NULL,
  `Endereco` varchar(100) DEFAULT NULL,
  `Bairro` varchar(50) DEFAULT NULL,
  `Cidade` varchar(60) DEFAULT NULL,
  `UF` char(2) DEFAULT 'SP',
  `CEP` varchar(10) DEFAULT NULL,
  `Celular` varchar(20) DEFAULT NULL,
  `Telefone Fixo` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Cargo` varchar(100) DEFAULT NULL,
  `Setor` varchar(50) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `RG` varchar(25) DEFAULT NULL,
  `Org_Exp` varchar(20) DEFAULT NULL,
  `Data_Expedicao` date DEFAULT NULL,
  `CTPS_N` varchar(30) DEFAULT NULL,
  `CTPS_Serie` varchar(10) DEFAULT NULL,
  `Titulo_Eleitor` varchar(20) DEFAULT NULL,
  `Numero_Filhos` varchar(5) DEFAULT NULL,
  `Escolaridade` enum('Básico','Fundamental','Médio','Superior') DEFAULT NULL,
  `Situacao` enum('Completo','Incompleto','Cursando') DEFAULT NULL,
  `Qual_ano` varchar(5) DEFAULT NULL,
  `Observacoes` varchar(255) DEFAULT NULL,
  `Inativo` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`Id`, `EhMembro`, `Data_Admissao`, `Nome`, `Data_Nasc`, `Estado_Civil`, `Endereco`, `Bairro`, `Cidade`, `UF`, `CEP`, `Celular`, `Telefone Fixo`, `Email`, `Cargo`, `Setor`, `CPF`, `RG`, `Org_Exp`, `Data_Expedicao`, `CTPS_N`, `CTPS_Serie`, `Titulo_Eleitor`, `Numero_Filhos`, `Escolaridade`, `Situacao`, `Qual_ano`, `Observacoes`, `Inativo`) VALUES
(1, 0, '2012-12-12', 'fulana de tal', '1990-10-10', 'Solteiro', 'rua cc', 'setor vv', 'franca', 'SP', '74550420', '65662312', NULL, 'ghxg@uol.com.br', 'Secretaria', 'secretaria', '15632599-80', '254865', 'sspsp', '1999-12-12', '2154', '125', NULL, '0', 'Médio', 'Completo', '2', 'bla bla bla', NULL),
(2, 1, '2013-01-01', 'Monteiro Lobato', '1900-01-21', 'Casado', 'Rua x', 'x', 'x', 'GO', '74000000', NULL, NULL, NULL, NULL, NULL, '11111111111', '1111111', NULL, NULL, NULL, NULL, NULL, '7', 'Superior', 'Completo', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcoes_exerce`
--

CREATE TABLE `funcoes_exerce` (
  `Id` int(11) NOT NULL,
  `Funcao` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `funcoes_exerce`
--

INSERT INTO `funcoes_exerce` (`Id`, `Funcao`) VALUES
(1, 'Lider de Louvor'),
(2, 'Dirigente de Mocidade'),
(3, 'Dirigente do Circulo de Oração'),
(4, 'Lider de Evangelismo'),
(5, 'Lider de Visitas'),
(6, 'Lider de Celula'),
(7, 'Supervisor de Região'),
(8, 'Discipulado'),
(9, 'LOUVOR'),
(10, 'MJ'),
(11, 'Membro'),
(12, 'Pastor'),
(13, 'Obreira'),
(14, 'Jovem Menor'),
(15, 'COREOGRAFIA'),
(16, 'CANDIDATA'),
(17, '300 TROPA DE ELITE'),
(18, 'PASTORA'),
(19, 'LEVITA'),
(20, 'OBREIRO'),
(21, 'DJ IGREJA'),
(22, 'LIDER');

-- --------------------------------------------------------

--
-- Estrutura da tabela `igrejas`
--

CREATE TABLE `igrejas` (
  `Id_igreja` int(11) NOT NULL,
  `Igreja` varchar(50) DEFAULT NULL,
  `DirigenteResponsavel` varchar(100) DEFAULT NULL,
  `CNPJ` varchar(20) NOT NULL DEFAULT '',
  `Email` varchar(100) DEFAULT NULL,
  `Endereco` varchar(50) NOT NULL DEFAULT '',
  `Bairro` varchar(25) DEFAULT NULL,
  `Cidade` varchar(22) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `CEP` varchar(9) DEFAULT NULL,
  `Telefone1` varchar(15) DEFAULT NULL,
  `Telefone2` varchar(15) DEFAULT NULL,
  `Fax` varchar(15) DEFAULT NULL,
  `Site_Igreja` varchar(100) DEFAULT NULL,
  `Email_da_igreja` varchar(100) DEFAULT NULL,
  `Modelo` tinyint(3) DEFAULT NULL,
  `Data_de_Fundacao` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_videos`
--

CREATE TABLE `lista_videos` (
  `Id_video` int(11) NOT NULL,
  `TituloVideo` varchar(100) DEFAULT NULL,
  `Embed_do_Video` varchar(100) DEFAULT NULL,
  `Anotacoes` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro`
--

CREATE TABLE `membro` (
  `Id_membro` int(11) NOT NULL,
  `Da_Igreja` int(11) DEFAULT NULL COMMENT 'Igreja que pertence',
  `Matricula` varchar(20) DEFAULT NULL,
  `CargoMinisterial` tinyint(3) DEFAULT NULL,
  `Nome` varchar(60) DEFAULT NULL,
  `Sexo` enum('Masculino','Feminino') DEFAULT 'Masculino',
  `DataNasc` date DEFAULT NULL,
  `Nacionalidade` varchar(30) DEFAULT 'Brasileiro',
  `EstadoCivil` enum('Solteiro(a)','Casado(a)','Divorciado(a)','Viuvo(a)','Amasiado(a)') DEFAULT 'Solteiro(a)',
  `CPF` varchar(15) DEFAULT NULL,
  `RG` varchar(15) DEFAULT NULL,
  `Profissao` varchar(60) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `TelefoneRes` char(15) DEFAULT NULL,
  `Celular_1` char(15) DEFAULT NULL,
  `Celular_2` char(15) DEFAULT NULL,
  `GrauEscolaridade` tinyint(3) DEFAULT NULL,
  `Curso` varchar(50) DEFAULT NULL,
  `Endereco` varchar(60) DEFAULT NULL,
  `Complemento` varchar(50) DEFAULT NULL,
  `Bairro` varchar(30) DEFAULT NULL,
  `Cidade` varchar(30) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `CEP` char(9) DEFAULT NULL,
  `Anotacoes` text DEFAULT NULL,
  `Foto` varchar(50) DEFAULT NULL,
  `Conjuge` varchar(80) DEFAULT NULL,
  `N_Filhos` varchar(5) DEFAULT NULL,
  `Empresa_trabalha` varchar(60) DEFAULT NULL,
  `Fone_Empresa` varchar(15) DEFAULT NULL,
  `Celula` int(11) DEFAULT NULL COMMENT 'Faz parte da Célula',
  `Nome_da_Familia` varchar(60) DEFAULT NULL,
  `Nome_da_Mae` varchar(60) DEFAULT NULL,
  `Nome_do_Pai` varchar(60) DEFAULT NULL,
  `Situacao` tinyint(3) DEFAULT NULL,
  `Data_batismo` date DEFAULT NULL,
  `Admissao` date DEFAULT NULL,
  `Tipo_Admissao` tinyint(3) DEFAULT NULL,
  `Funcao` tinyint(3) DEFAULT NULL,
  `Rede_Ministerial` tinyint(3) DEFAULT NULL,
  `Data_Casamento` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `meses`
--

CREATE TABLE `meses` (
  `id` int(11) NOT NULL,
  `Mes` varchar(10) DEFAULT NULL,
  `Mes_abrev` char(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `meses`
--

INSERT INTO `meses` (`id`, `Mes`, `Mes_abrev`) VALUES
(1, 'Janeiro', 'JAN'),
(2, 'Fevereiro', 'FEV'),
(3, 'Mar?o', 'MAR'),
(4, 'Abril', 'ABR'),
(5, 'Maio', 'MAI'),
(6, 'Junho', 'JUN'),
(7, 'Julho', 'JUL'),
(8, 'Agosto', 'AGO'),
(9, 'Setembro', 'SET'),
(10, 'Outubro', 'OUT'),
(11, 'Novembro', 'NOV'),
(12, 'Dezembro', 'DEZ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_igreja`
--

CREATE TABLE `modelo_igreja` (
  `Id` tinyint(3) NOT NULL,
  `Modelo` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modelo_igreja`
--

INSERT INTO `modelo_igreja` (`Id`, `Modelo`) VALUES
(11, 'Célula'),
(22, 'Grupo'),
(33, 'Família'),
(34, 'Tradicional'),
(35, 'Congregação'),
(36, 'COMUNIDADE');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `ofertasporcriterio`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `ofertasporcriterio` (
`Mes` int(2)
,`Tipo` tinyint(1)
,`Conta_Caixa` int(11)
,`Situacao` tinyint(1)
,`Descricao` varchar(60)
,`Receitas` decimal(10,2)
,`FormaPagto` tinyint(3)
,`Dt_Lancamento` date
,`Vencimento` date
,`Centro_de_Custo` int(11)
,`id_discipulo` int(11)
,`Id` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `ofertassmesatual`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `ofertassmesatual` (
`Tipo` tinyint(1)
,`Conta_Caixa` int(11)
,`Situacao` tinyint(1)
,`Descricao` varchar(60)
,`Receitas` decimal(10,2)
,`FormaPagto` tinyint(3)
,`Dt_Lancamento` date
,`Vencimento` date
,`Centro_de_Custo` int(11)
,`id_discipulo` int(11)
,`Id` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_oracao`
--

CREATE TABLE `plano_oracao` (
  `Id_ora` int(11) NOT NULL,
  `Motivo_da_Oracao` varchar(100) DEFAULT NULL,
  `Anotacoes` varchar(255) DEFAULT '',
  `Prioridade` tinyint(1) DEFAULT NULL,
  `Plano_p_todos` tinyint(1) DEFAULT NULL COMMENT 'Plano de Oração para todos os membros da Igreja',
  `Oracao_feita` tinyint(1) DEFAULT NULL COMMENT 'Oração feita / Concluida',
  `Data_do_Cadastro` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prioridade`
--

CREATE TABLE `prioridade` (
  `Id_prior` int(11) NOT NULL,
  `Prioridade` varchar(90) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prioridade`
--

INSERT INTO `prioridade` (`Id_prior`, `Prioridade`) VALUES
(1, '<span class=\"label bg-magenta\"><i class=\"icon-arrow-up icon-white\"></i>Urgente</span>'),
(2, '<span class=\"label bg-red\"><i class=\"icon-arrow-up icon-white\"></i> Alta</span>'),
(3, '<span class=\"label bg-orange\"><i class=\"icon-flag icon-white\"></i> Media</span>'),
(4, '<span class=\"label bg-green\"><i class=\"icon-arrow-down icon-white\"></i> Baixa</span>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rede_ministerial`
--

CREATE TABLE `rede_ministerial` (
  `Id` int(11) NOT NULL,
  `Rede_Ministerial` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `rede_ministerial`
--

INSERT INTO `rede_ministerial` (`Id`, `Rede_Ministerial`) VALUES
(1, 'Rede de Homens'),
(2, 'Rede de Mulheres'),
(3, 'Rede de Jovens'),
(4, 'Rede de Crianças'),
(10, 'SEDE NACIONAL'),
(11, 'FORMOSA CEPRODEUS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao_membro`
--

CREATE TABLE `situacao_membro` (
  `Id` int(11) NOT NULL,
  `Situacao` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `situacao_membro`
--

INSERT INTO `situacao_membro` (`Id`, `Situacao`) VALUES
(1, 'Disciplinado'),
(2, 'Ativo'),
(3, 'Inativo'),
(4, 'Falecido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `smtp`
--

CREATE TABLE `smtp` (
  `Id` int(11) NOT NULL,
  `SMTP` varchar(40) DEFAULT NULL,
  `SMTP_Porta` varchar(10) DEFAULT NULL,
  `SMTP_Usuario` varchar(60) DEFAULT NULL,
  `SMTP_Senha` varchar(50) DEFAULT NULL,
  `Email_de_Envio` varchar(65) DEFAULT NULL,
  `Email_de_Recebimento` varchar(65) DEFAULT NULL,
  `Seguranca` enum('SSL','TLS') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `smtp`
--

INSERT INTO `smtp` (`Id`, `SMTP`, `SMTP_Porta`, `SMTP_Usuario`, `SMTP_Senha`, `Email_de_Envio`, `Email_de_Recebimento`, `Seguranca`) VALUES
(1, 'smtp.gmail.com', '467', 'admin', '123', 'suportesiteescola@gmail.com', 'suportesiteescola@gmail.com', 'SSL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_admissao`
--

CREATE TABLE `tipo_admissao` (
  `Id` int(11) NOT NULL,
  `Tipo_Admissao` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `tipo_admissao`
--

INSERT INTO `tipo_admissao` (`Id`, `Tipo_Admissao`) VALUES
(1, 'Batismo'),
(2, 'Recomendacão'),
(3, 'Aclamação'),
(4, 'Carta'),
(5, 'Outros'),
(6, 'Transferencia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ufs`
--

CREATE TABLE `ufs` (
  `UniFedSigla` varchar(2) NOT NULL,
  `UniFedNome` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `ufs`
--

INSERT INTO `ufs` (`UniFedSigla`, `UniFedNome`) VALUES
('AC', 'Acre                          '),
('AL', 'Alagoas                       '),
('AM', 'Amazonas                      '),
('AP', 'Amapá                        '),
('BA', 'Bahia                         '),
('CE', 'Ceará                        '),
('DF', 'Distrito Federal              '),
('ES', 'Espírito Santo               '),
('GO', 'Goiás                        '),
('MA', 'Maranhão                     '),
('MG', 'Minas Gerais                  '),
('MS', 'Mato Grosso do Sul            '),
('MT', 'Mato Grosso                   '),
('PA', 'Pará                         '),
('PB', 'Paraíba                      '),
('PE', 'Pernambuco                    '),
('PI', 'Piauí                        '),
('PR', 'Paraná                       '),
('RJ', 'Rio de Janeiro                '),
('RN', 'Rio Grande do Norte           '),
('RO', 'Rondônia                     '),
('RR', 'Roraima                       '),
('RS', 'Rio Grande do Sul             '),
('SC', 'Santa Catarina                '),
('SE', 'Sergipe                       '),
('SP', 'São Paulo'),
('TO', 'Tocantins                     ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `userlevelpermissions`
--

INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}agenda', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}Agenda_Morta', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}ajuda', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}Aniversariantes', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}audittrail', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}bancos', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}bens_patrimoniais', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}caixadodia', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}cargoscelulas', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}cargosministeriais', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}cartas', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}celulas', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}configuracoes', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}contatos', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}conta_bancaria', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}controle_tarefas', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}dizimos', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}dizimosmesatual', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}dizimosporcriterio', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}Emailsporfuncao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}escolaridade', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}estudos_biblicos', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}EtiquetasMalaDireta', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}eventos', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}financeiro', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}fin_centro_de_custo', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}fin_conta_caixa', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}fin_forma_pgto', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}fin_situacao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}funcionarios', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}funcoes_exerce', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}igrejas', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}ListadeEmailporCargo', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}ListaEmailsporFuncao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}Lista_de_Emails', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}lista_videos', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}membro', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}meus_lembretes', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}modelo_igreja', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}ofertasporcriterio', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}ofertassmesatual', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}plano_oracao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}print_cartaexclusao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}print_cartarecomendacao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}print_transferencia', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}rede_ministerial', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}RelatorioAdmissao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}RelatorioCasamento', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}RelatoriodataBatismo', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}situacao_membro', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}smtp', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}tipo_admissao', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}userlevels', 45),
(0, '{2B7992FC-5911-46A7-9310-01F4D4225C49}usuarios', 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-1, 'Administrador'),
(0, 'Default'),
(1, 'Tesoureiro'),
(2, 'Auxiliar'),
(3, 'Secretario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `u` int(2) NOT NULL,
  `Nome` varchar(35) DEFAULT NULL,
  `login` varchar(12) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `Level` int(1) DEFAULT NULL,
  `profile` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`u`, `Nome`, `login`, `senha`, `email`, `Level`, `profile`) VALUES
(44253578, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@scriptphp.ru', -1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para vista `anos`
--
DROP TABLE IF EXISTS `anos`;

CREATE VIEW `anos`  AS SELECT DISTINCT year(`financeiro`.`Dt_Lancamento`) AS `anos_financ` FROM `financeiro` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `caixadodia`
--
DROP TABLE IF EXISTS `caixadodia`;

CREATE VIEW `caixadodia`  AS SELECT `financeiro`.`Tipo` AS `Tipo`, `financeiro`.`N_Documento` AS `N_Documento`, `financeiro`.`Conta_Caixa` AS `Conta_Caixa`, `financeiro`.`Situacao` AS `Situacao`, `financeiro`.`Descricao` AS `Descricao`, `financeiro`.`Receitas` AS `Receitas`, `financeiro`.`Despesas` AS `Despesas`, `financeiro`.`FormaPagto` AS `FormaPagto`, `financeiro`.`Dt_Lancamento` AS `Dt_Lancamento`, `financeiro`.`Vencimento` AS `Vencimento`, `financeiro`.`Centro_de_Custo` AS `Centro_de_Custo`, `financeiro`.`id_discipulo` AS `id_discipulo`, `financeiro`.`Id` AS `Id` FROM `financeiro` WHERE `financeiro`.`Dt_Lancamento` = curdate() ORDER BY `financeiro`.`Dt_Lancamento` ASC ;

-- --------------------------------------------------------

--
-- Estrutura para vista `dizimos`
--
DROP TABLE IF EXISTS `dizimos`;

CREATE VIEW `dizimos`  AS SELECT `financeiro`.`Tipo` AS `Tipo`, `financeiro`.`Conta_Caixa` AS `Conta_Caixa`, `financeiro`.`Situacao` AS `Situacao`, `financeiro`.`Descricao` AS `Descricao`, `financeiro`.`Receitas` AS `Receitas`, `financeiro`.`FormaPagto` AS `FormaPagto`, `financeiro`.`Dt_Lancamento` AS `Dt_Lancamento`, `financeiro`.`Vencimento` AS `Vencimento`, `financeiro`.`Centro_de_Custo` AS `Centro_de_Custo`, `financeiro`.`id_discipulo` AS `id_discipulo`, `financeiro`.`Id` AS `Id` FROM `financeiro` WHERE `financeiro`.`Conta_Caixa` = 1 ;

-- --------------------------------------------------------

--
-- Estrutura para vista `dizimosmesatual`
--
DROP TABLE IF EXISTS `dizimosmesatual`;

CREATE VIEW `dizimosmesatual`  AS SELECT `financeiro`.`Tipo` AS `Tipo`, `financeiro`.`Conta_Caixa` AS `Conta_Caixa`, `financeiro`.`Situacao` AS `Situacao`, `financeiro`.`Descricao` AS `Descricao`, `financeiro`.`Receitas` AS `Receitas`, `financeiro`.`FormaPagto` AS `FormaPagto`, `financeiro`.`Dt_Lancamento` AS `Dt_Lancamento`, `financeiro`.`Vencimento` AS `Vencimento`, `financeiro`.`Centro_de_Custo` AS `Centro_de_Custo`, `financeiro`.`id_discipulo` AS `id_discipulo`, `financeiro`.`Id` AS `Id` FROM `financeiro` WHERE `financeiro`.`Conta_Caixa` = 1 AND month(`financeiro`.`Dt_Lancamento`) = month(curdate()) ORDER BY `financeiro`.`Dt_Lancamento` ASC ;

-- --------------------------------------------------------

--
-- Estrutura para vista `dizimosporcriterio`
--
DROP TABLE IF EXISTS `dizimosporcriterio`;

CREATE VIEW `dizimosporcriterio`  AS SELECT month(`financeiro`.`Dt_Lancamento`) AS `Mes`, `financeiro`.`Tipo` AS `Tipo`, `financeiro`.`Conta_Caixa` AS `Conta_Caixa`, `financeiro`.`Situacao` AS `Situacao`, `financeiro`.`Descricao` AS `Descricao`, `financeiro`.`Receitas` AS `Receitas`, `financeiro`.`FormaPagto` AS `FormaPagto`, `financeiro`.`Dt_Lancamento` AS `Dt_Lancamento`, `financeiro`.`Vencimento` AS `Vencimento`, `financeiro`.`Centro_de_Custo` AS `Centro_de_Custo`, `financeiro`.`id_discipulo` AS `id_discipulo`, `financeiro`.`Id` AS `Id` FROM `financeiro` WHERE `financeiro`.`Conta_Caixa` = 1 ORDER BY `financeiro`.`Dt_Lancamento` ASC ;

-- --------------------------------------------------------

--
-- Estrutura para vista `ofertasporcriterio`
--
DROP TABLE IF EXISTS `ofertasporcriterio`;

CREATE VIEW `ofertasporcriterio`  AS SELECT month(`financeiro`.`Dt_Lancamento`) AS `Mes`, `financeiro`.`Tipo` AS `Tipo`, `financeiro`.`Conta_Caixa` AS `Conta_Caixa`, `financeiro`.`Situacao` AS `Situacao`, `financeiro`.`Descricao` AS `Descricao`, `financeiro`.`Receitas` AS `Receitas`, `financeiro`.`FormaPagto` AS `FormaPagto`, `financeiro`.`Dt_Lancamento` AS `Dt_Lancamento`, `financeiro`.`Vencimento` AS `Vencimento`, `financeiro`.`Centro_de_Custo` AS `Centro_de_Custo`, `financeiro`.`id_discipulo` AS `id_discipulo`, `financeiro`.`Id` AS `Id` FROM `financeiro` WHERE `financeiro`.`Conta_Caixa` = 8 ORDER BY `financeiro`.`Dt_Lancamento` ASC ;

-- --------------------------------------------------------

--
-- Estrutura para vista `ofertassmesatual`
--
DROP TABLE IF EXISTS `ofertassmesatual`;

CREATE VIEW `ofertassmesatual`  AS SELECT `financeiro`.`Tipo` AS `Tipo`, `financeiro`.`Conta_Caixa` AS `Conta_Caixa`, `financeiro`.`Situacao` AS `Situacao`, `financeiro`.`Descricao` AS `Descricao`, `financeiro`.`Receitas` AS `Receitas`, `financeiro`.`FormaPagto` AS `FormaPagto`, `financeiro`.`Dt_Lancamento` AS `Dt_Lancamento`, `financeiro`.`Vencimento` AS `Vencimento`, `financeiro`.`Centro_de_Custo` AS `Centro_de_Custo`, `financeiro`.`id_discipulo` AS `id_discipulo`, `financeiro`.`Id` AS `Id` FROM `financeiro` WHERE `financeiro`.`Conta_Caixa` = 8 AND month(`financeiro`.`Dt_Lancamento`) = month(curdate()) ORDER BY `financeiro`.`Dt_Lancamento` ASC ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Data` (`Data`);

--
-- Índices para tabela `agsolucao`
--
ALTER TABLE `agsolucao`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `ajuda`
--
ALTER TABLE `ajuda`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Pagina` (`pg`);

--
-- Índices para tabela `audittrail`
--
ALTER TABLE `audittrail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datetime` (`datetime`),
  ADD KEY `script` (`script`),
  ADD KEY `user` (`user`),
  ADD KEY `action` (`action`),
  ADD KEY `table` (`table`),
  ADD KEY `field` (`field`),
  ADD KEY `keyvalue` (`keyvalue`(10)),
  ADD KEY `oldvalue` (`oldvalue`(10)),
  ADD KEY `newvalue` (`newvalue`(10));

--
-- Índices para tabela `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `bens_patrimoniais`
--
ALTER TABLE `bens_patrimoniais`
  ADD PRIMARY KEY (`Id_Patri`),
  ADD KEY `Tipo` (`Tipo`),
  ADD KEY `Situacao` (`Situacao`);

--
-- Índices para tabela `cargoscelulas`
--
ALTER TABLE `cargoscelulas`
  ADD PRIMARY KEY (`id_cgcelula`);

--
-- Índices para tabela `cargosministeriais`
--
ALTER TABLE `cargosministeriais`
  ADD PRIMARY KEY (`id_cgm`);

--
-- Índices para tabela `cartas`
--
ALTER TABLE `cartas`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `celulas`
--
ALTER TABLE `celulas`
  ADD PRIMARY KEY (`Id_celula`);

--
-- Índices para tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `conta_bancaria`
--
ALTER TABLE `conta_bancaria`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `controle_tarefas`
--
ALTER TABLE `controle_tarefas`
  ADD PRIMARY KEY (`Id_tarefas`);

--
-- Índices para tabela `dias_semana`
--
ALTER TABLE `dias_semana`
  ADD PRIMARY KEY (`Id_semana`);

--
-- Índices para tabela `escolaridade`
--
ALTER TABLE `escolaridade`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `estado_patrimonio`
--
ALTER TABLE `estado_patrimonio`
  ADD PRIMARY KEY (`Id_est_patri`);

--
-- Índices para tabela `estudos_biblicos`
--
ALTER TABLE `estudos_biblicos`
  ADD PRIMARY KEY (`Id_estu_bb`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `financeiro`
--
ALTER TABLE `financeiro`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `situacao` (`Situacao`),
  ADD KEY `id_discipulo` (`id_discipulo`),
  ADD KEY `Dt_Lancamento` (`Dt_Lancamento`),
  ADD KEY `Vencimento` (`Vencimento`),
  ADD KEY `Conta_Caixa` (`Conta_Caixa`);

--
-- Índices para tabela `fin_centro_de_custo`
--
ALTER TABLE `fin_centro_de_custo`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `fin_conta_caixa`
--
ALTER TABLE `fin_conta_caixa`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `fin_forma_pgto`
--
ALTER TABLE `fin_forma_pgto`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `fin_situacao`
--
ALTER TABLE `fin_situacao`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `funcoes_exerce`
--
ALTER TABLE `funcoes_exerce`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `igrejas`
--
ALTER TABLE `igrejas`
  ADD PRIMARY KEY (`Id_igreja`);

--
-- Índices para tabela `lista_videos`
--
ALTER TABLE `lista_videos`
  ADD PRIMARY KEY (`Id_video`);

--
-- Índices para tabela `membro`
--
ALTER TABLE `membro`
  ADD PRIMARY KEY (`Id_membro`),
  ADD KEY `Da_Igreja` (`Da_Igreja`),
  ADD KEY `DataNasc` (`DataNasc`),
  ADD KEY `CargoMinisterial` (`CargoMinisterial`),
  ADD KEY `Funcao` (`Funcao`),
  ADD KEY `Admissao` (`Admissao`),
  ADD KEY `Tipo_Admissao` (`Tipo_Admissao`),
  ADD KEY `EstadoCivil` (`EstadoCivil`);

--
-- Índices para tabela `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modelo_igreja`
--
ALTER TABLE `modelo_igreja`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `plano_oracao`
--
ALTER TABLE `plano_oracao`
  ADD PRIMARY KEY (`Id_ora`);

--
-- Índices para tabela `prioridade`
--
ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`Id_prior`);

--
-- Índices para tabela `rede_ministerial`
--
ALTER TABLE `rede_ministerial`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `situacao_membro`
--
ALTER TABLE `situacao_membro`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `smtp`
--
ALTER TABLE `smtp`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `tipo_admissao`
--
ALTER TABLE `tipo_admissao`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `ufs`
--
ALTER TABLE `ufs`
  ADD PRIMARY KEY (`UniFedSigla`);

--
-- Índices para tabela `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Índices para tabela `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`u`),
  ADD KEY `idx-email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `agsolucao`
--
ALTER TABLE `agsolucao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ajuda`
--
ALTER TABLE `ajuda`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `audittrail`
--
ALTER TABLE `audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `bens_patrimoniais`
--
ALTER TABLE `bens_patrimoniais`
  MODIFY `Id_Patri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cargoscelulas`
--
ALTER TABLE `cargoscelulas`
  MODIFY `id_cgcelula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `cargosministeriais`
--
ALTER TABLE `cargosministeriais`
  MODIFY `id_cgm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `cartas`
--
ALTER TABLE `cartas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `celulas`
--
ALTER TABLE `celulas`
  MODIFY `Id_celula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `conta_bancaria`
--
ALTER TABLE `conta_bancaria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `controle_tarefas`
--
ALTER TABLE `controle_tarefas`
  MODIFY `Id_tarefas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `dias_semana`
--
ALTER TABLE `dias_semana`
  MODIFY `Id_semana` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `escolaridade`
--
ALTER TABLE `escolaridade`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `estado_patrimonio`
--
ALTER TABLE `estado_patrimonio`
  MODIFY `Id_est_patri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `estudos_biblicos`
--
ALTER TABLE `estudos_biblicos`
  MODIFY `Id_estu_bb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `financeiro`
--
ALTER TABLE `financeiro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `fin_centro_de_custo`
--
ALTER TABLE `fin_centro_de_custo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `fin_conta_caixa`
--
ALTER TABLE `fin_conta_caixa`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `fin_forma_pgto`
--
ALTER TABLE `fin_forma_pgto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `fin_situacao`
--
ALTER TABLE `fin_situacao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcoes_exerce`
--
ALTER TABLE `funcoes_exerce`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `igrejas`
--
ALTER TABLE `igrejas`
  MODIFY `Id_igreja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `lista_videos`
--
ALTER TABLE `lista_videos`
  MODIFY `Id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `membro`
--
ALTER TABLE `membro`
  MODIFY `Id_membro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `meses`
--
ALTER TABLE `meses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `modelo_igreja`
--
ALTER TABLE `modelo_igreja`
  MODIFY `Id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `plano_oracao`
--
ALTER TABLE `plano_oracao`
  MODIFY `Id_ora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `prioridade`
--
ALTER TABLE `prioridade`
  MODIFY `Id_prior` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `rede_ministerial`
--
ALTER TABLE `rede_ministerial`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `situacao_membro`
--
ALTER TABLE `situacao_membro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `smtp`
--
ALTER TABLE `smtp`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tipo_admissao`
--
ALTER TABLE `tipo_admissao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `u` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44253579;
COMMIT;