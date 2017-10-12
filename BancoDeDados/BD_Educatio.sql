--
--  Banco de Dados EDUCATIO
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

##################################################################################
/*
  Diário Acadêmico
  id varchar(5);
  <nomes-no-geral> varchar(30) -> alunos.nome varchar(80);
  ativo varchar(1); // 'S'[Sim] ou 'N'[Não] (maiúsculas)
  hierarquia varchar(1); // 'B'[Bibliotecário], 'C'[Coordenador Geral] ou 'P'[Professor]
*/;

CREATE DATABASE IF NOT EXISTS `educatio`;
USE `educatio`;

CREATE TABLE IF NOT EXISTS `campi` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome varchar(30) NOT NULL,
  cidade varchar(60) NOT NULL,
  UF varchar(2) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `deptos` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idCampi int(5) NOT NULL,
  nome varchar(30) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `cursos` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idDepto int(5) NOT NULL,
  nome varchar(30) NOT NULL,
  horasTotal int(4) NOT NULL,
  modalidade varchar(30) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `turmas` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idCurso int(5) NOT NULL,
  nome varchar(30) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `alunos` (
  idCPF varchar(11) NOT NULL PRIMARY KEY,
  nome varchar(80) NOT NULL,
  sexo varchar(15) NOT NULL,
  nascimento varchar(10) NOT NULL,
  logradouro varchar(60) NOT NULL,
  numeroLogradouro int(5) NOT NULL,
  complemento varchar(60) NOT NULL,
  bairro varchar(60) NOT NULL,
  cidade varchar(60) NOT NULL,
  CEP int(9) NOT NULL,
  UF varchar(2) NOT NULL,
  email varchar(30) NOT NULL,
  foto blob NOT NULL,
  senha varchar(30) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `matriculas` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAluno varchar(11) NOT NULL,
  idDisciplina int(5) NOT NULL,
  ano int(4) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `funcionario` (
  idSIAPE int(9) NOT NULL PRIMARY KEY,
  idDepto int(5) NOT NULL,
  nome varchar(80) NOT NULL,
  titulacao varchar(1) NOT NULL,
  hierarquia varchar(1) NOT NULL,
  ativo varchar(1) NOT NULL 
  );

CREATE TABLE IF NOT EXISTS `disciplinas` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idTurma int(5) NOT NULL,
  nome varchar(30) NOT NULL,
  cargaHorariaMin int(4) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `profDisciplinas` (
  idProfessor int(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idDisciplina int(5) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `etapas` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  valor decimal(5,2) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `atividades` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idDisciplina int(5) NOT NULL,
  nome varchar(30) NOT NULL,
  data varchar(10) NOT NULL,
  valor decimal(5,2) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `conteudos` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idEtapa int(5) NOT NULL,
  idDisciplina int(5) NOT NULL,
  conteudo varchar(30) NOT NULL,
  datas varchar(10) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `diarios` (
  idConteudo int(5) NOT NULL,
  idMatricula int(5) NOT NULL,
  idAtividade int(5) NOT NULL,
  faltas int(4) NOT NULL,
  nota decimal(5,2) NOT NULL,
  ano int(4) NOT NULL,
  ativo varchar(1) NOT NULL
  );

##################################################################################
/*
  Biblioteca
*/;

CREATE TABLE IF NOT EXISTS `acervo` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idCampi int(5) NOT NULL,
  nome varchar(60) NOT NULL,
  tipo varchar(15) NOT NULL,
  local varchar(60) NOT NULL,
  ano varchar(4) NOT NULL,
  editora varchar(30) NOT NULL,
  paginas varchar(5) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `livros` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAcervo int(5) NOT NULL,
  edicao int(5) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `academicos` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAcervo int(5) NOT NULL,
  programa varchar(30) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `midias` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAcervo int(5) NOT NULL,
  tempo varchar(15) NOT NULL,
  subtipo varchar(5) NOT NULL,
  ano int(4) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `periodicos` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAcervo int(5) NOT NULL,
  periodicidade varchar(10) NOT NULL,
  mes varchar(20) NOT NULL,
  volume int(4) NOT NULL,
  subtipo varchar(15) NOT NULL,
  issn int(8) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `partes` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idPeriodico int(5) NOT NULL,
  titulo varchar(80) NOT NULL,
  pagInicio int(5) NOT NULL,
  pagFinal int(5) NOT NULL,
  palavrasChave varchar(100) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `autores` (
  idAcervo int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome varchar(30) NOT NULL,
  sobrenome varchar(80) NOT NULL,
  ordem varchar(20) NOT NULL,
  qualificacao varchar(20) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `reservas` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAluno varchar(11) NOT NULL,
  idAcervo int(5) NOT NULL,
  dataReserva varchar(10) NOT NULL,
  tempoEspera int(4) NOT NULL,
  emprestou varchar(1) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `emprestimos` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAluno varchar(11) NOT NULL,
  idAcervo int(5) NOT NULL,
  dataEmprestimo varchar(10) NOT NULL,
  dataPrevisaoDevolucao varchar(10) NOT NULL,
  dataDevolucao varchar(10) NOT NULL,
  multa decimal(5,2) NOT NULL,
  ativo varchar(1) NOT NULL
  );

CREATE TABLE IF NOT EXISTS `descartes` (
  id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idAcervo int(5) NOT NULL,
  idFuncionario varchar(9) NOT NULL,
  dataDescarte varchar(10) NOT NULL,
  motivos varchar(300) NOT NULL,
  ativo varchar(1) NOT NULL
  );