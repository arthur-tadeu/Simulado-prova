CREATE DATABASE IF NOT EXISTS saep_db;
USE saep_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especificacoes TEXT,
    estoque_minimo INT NOT NULL DEFAULT 5,
    estoque_atual INT NOT NULL DEFAULT 0
);

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

-- População inicial
INSERT INTO usuarios (nome, senha) VALUES 
('admin', '123'),
('usuario1', 'senha1'),
('usuario2', 'senha2');

INSERT INTO produtos (nome, especificacoes, estoque_minimo, estoque_atual) VALUES 
('Smartphone X', '128GB, 8GB RAM, 5G', 10, 15),
('Notebook Pro', 'Intel i7, 16GB RAM, SSD 512GB', 5, 8),
('Smart TV 55', '4K, HDMI 2.1, WiFi 6', 3, 2);

INSERT INTO movimentacoes (produto_id, usuario_id, tipo, quantidade, data_movimentacao) VALUES 
(1, 1, 'entrada', 15, '2024-08-15 10:00:00'),
(2, 1, 'entrada', 8, '2024-08-15 10:30:00'),
(3, 2, 'entrada', 2, '2024-08-16 09:00:00');
