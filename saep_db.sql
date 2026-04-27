-- SQL Script: Criação e População do Banco de Dados
-- Projeto: Gestão de Estoque GS Eletrônicos
-- Entrega 03 - Banco de Dados "saep_db"

-- 1. Criação do Schema
CREATE DATABASE IF NOT EXISTS saep_db;
USE saep_db;

-- 2. Tabela de Usuários (Login)
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);

-- 3. Tabela de Produtos
DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especificacoes TEXT,
    estoque_minimo INT NOT NULL DEFAULT 5,
    estoque_atual INT NOT NULL DEFAULT 0
);

-- 4. Tabela de Movimentações (Traceability/Rastreabilidade)
DROP TABLE IF EXISTS movimentacoes;
CREATE TABLE movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    usuario_id INT NOT NULL,
    tipo ENUM('entrada', 'saida') NOT NULL,
    quantidade INT NOT NULL,
    data_movimentacao DATETIME NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- 5. População Inicial (Mínimo de 3 registros por tabela - Item 3.2)

-- Usuários
INSERT INTO usuarios (nome, senha) VALUES 
('admin', '123'),
('almoxarife', 'saep2024'),
('gerente', 'gs_estoque');

-- Produtos
INSERT INTO produtos (nome, especificacoes, estoque_minimo, estoque_atual) VALUES 
('Smartphone Samsung Galaxy', '128GB, Tela 6.5, 5G, Carregador incluso', 10, 15),
('Notebook Dell Latitude', 'Processador i7, 16GB RAM, SSD 512GB', 5, 12),
('Smart TV LG 50"', '4K UHD, HDR10, Inteligência Artificial', 4, 3);

-- Movimentações (Histórico Inicial)
INSERT INTO movimentacoes (produto_id, usuario_id, tipo, quantidade, data_movimentacao) VALUES 
(1, 1, 'entrada', 15, '2024-08-15 08:30:00'),
(2, 2, 'entrada', 12, '2024-08-15 09:00:00'),
(3, 3, 'entrada', 3, '2024-08-16 14:20:00');
