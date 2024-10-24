CREATE DATABASE DB_industria 

USE DB_industria 

CREATE TABLE tbl_fornecedor (
    for_numero INT PRIMARY KEY,
    for_endereco VARCHAR(100)
);

CREATE TABLE tbl_departamento (
    dep_numero INT PRIMARY KEY,
    dep_setor VARCHAR(45)
);

CREATE TABLE tbl_funcionario (
    funci_numero INT PRIMARY KEY,
    funci_salario INT,
    funci_telefone VARCHAR(45),
    funci_departamento_dep_numero INT,
    FOREIGN KEY (funci_departamento_dep_numero) REFERENCES tbl_departamento(dep_numero)
);

CREATE TABLE tbl_pecas (
    pecas_numero INT PRIMARY KEY,
    pecas_peso INT,
    pecas_cor VARCHAR(45),
    tbl_fornecedor_for_numero INT,
    FOREIGN KEY (tbl_fornecedor_for_numero) REFERENCES tbl_fornecedor(for_numero)
);

CREATE TABLE tbl_projeto (
    proj_numero INT PRIMARY KEY,
    proj_orcamento FLOAT,
    proj_funcionario_funci_numero INT,
    FOREIGN KEY (proj_funcionario_funci_numero) REFERENCES tbl_funcionario(funci_numero)
);

CREATE TABLE tbl_itens (
    itens_numero INT PRIMARY KEY,
    tbl_pecas_pecas_numero INT,
    FOREIGN KEY (tbl_pecas_pecas_numero) REFERENCES tbl_pecas(pecas_numero)
);

CREATE TABLE tbl_controle (
    con_numero INT PRIMARY KEY,
    con_data DATE,
    con_hora TIME,
    tbl_projeto_proj_numero INT,
    tbl_projeto_tbl_funcionario_funci_numero INT,
    tbl_projeto_tbl_itens_itens_numero INT,
    FOREIGN KEY (tbl_projeto_proj_numero) REFERENCES tbl_projeto(proj_numero),
    FOREIGN KEY (tbl_projeto_tbl_funcionario_funci_numero) REFERENCES tbl_funcionario(funci_numero),
    FOREIGN KEY (tbl_projeto_tbl_itens_itens_numero) REFERENCES tbl_itens(itens_numero)
);

CREATE TABLE tbl_depositos (
    deposit_numero INT PRIMARY KEY,
    deposit_endereco VARCHAR(100),
    tbl_pecas_pecas_numero INT,
    FOREIGN KEY (tbl_pecas_pecas_numero) REFERENCES tbl_pecas(pecas_numero)
);

INSERT INTO tbl_fornecedor (for_numero, for_endereco) 
VALUES (1, 'Rua das Flores, 123'), 
       (2, 'Avenida Central, 456');

INSERT INTO tbl_departamento (dep_numero, dep_setor) 
VALUES (1, 'Vendas'), 
       (2, 'Produção');

INSERT INTO tbl_funcionario (funci_numero, funci_salario, funci_telefone, funci_departamento_dep_numero) 
VALUES (1, 3500, '1234-5678', 1), 
       (2, 4500, '8765-4321', 2);

INSERT INTO tbl_pecas (pecas_numero, pecas_peso, pecas_cor, tbl_fornecedor_for_numero) 
VALUES (1, 500, 'Azul', 1), 
       (2, 300, 'Vermelho', 2);

INSERT INTO tbl_projeto (proj_numero, proj_orcamento, proj_funcionario_funci_numero) 
VALUES (1, 50000, 1), 
       (2, 100000, 2);

INSERT INTO tbl_itens (itens_numero, tbl_pecas_pecas_numero) 
VALUES (1, 1), 
       (2, 2);

INSERT INTO tbl_controle (con_numero, con_data, con_hora, tbl_projeto_proj_numero, tbl_projeto_tbl_funcionario_funci_numero, tbl_projeto_tbl_itens_itens_numero) 
VALUES (1, '2024-10-22', '08:30', 1, 1, 1), 
       (2, '2024-10-23', '14:00', 2, 2, 2);

INSERT INTO tbl_depositos (deposit_numero, deposit_endereco, tbl_pecas_pecas_numero) 
VALUES (1, 'Depósito A', 1), 
       (2, 'Depósito B', 2);

SELECT * FROM tbl_fornecedor;

SELECT * FROM tbl_departamento;

SELECT * FROM tbl_funcionario;

SELECT * FROM tbl_pecas;

SELECT * FROM tbl_projeto;

SELECT * FROM tbl_itens;

SELECT * FROM tbl_controle;

SELECT * FROM tbl_depositos;














































