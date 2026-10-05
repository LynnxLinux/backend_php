-- Banco usado pelo projeto (ver model/Conn.php)
CREATE DATABASE IF NOT EXISTS bd_backend
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE bd_backend;

-- Tabela da aula (já existente)
CREATE TABLE IF NOT EXISTS categoria (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  informacoes VARCHAR(255) NULL,
  PRIMARY KEY (id)
);

-- Atividade: entidade Cliente
CREATE TABLE IF NOT EXISTS cliente (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NULL,
  PRIMARY KEY (id)
);

-- Atividade: entidade Fornecedor
CREATE TABLE IF NOT EXISTS fornecedor (
  id INT NOT NULL AUTO_INCREMENT,
  razao_social VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NULL,
  PRIMARY KEY (id)
);
