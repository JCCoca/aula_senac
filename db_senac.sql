/*
CREATE DATABASE senac;

USE senac;

CREATE TABLE pessoa (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(120) NOT NULL,
	cpf CHAR(14) NOT NULL,
	email VARCHAR(255) NOT NULL,
	senha VARCHAR(64) NOT NULL,
	telefone VARCHAR(20) NOT NULL,
	sexo ENUM('Masculino', 'Feminino') NOT NULL,
	data_nascimento DATE NOT NULL
);

ALTER TABLE pessoa MODIFY email VARCHAR(255) NOT NULL UNIQUE;

INSERT INTO pessoa (
	nome, 
	cpf, 
	email, 
	senha, 
	telefone, 
	sexo, 
	data_nascimento
) VALUES (
	'João da Silva Kerllon',
	'111.111.111-11',
	'joaogatinho123@gmail.com',
	'123456',
	'68999666855',
	'Masculino',
	'2008-08-27'
);

INSERT INTO pessoa (
	nome, 
	cpf, 
	email, 
	senha, 
	telefone, 
	sexo, 
	data_nascimento
) VALUES (
	'Débora de Souza Barros',
	'222.222.222-22',
	'deb.gatinha.s2@outlook.com',
	'654321',
	'68992015567',
	'Feminino',
	'2008-02-28'
);

SELECT * FROM pessoa;

SELECT nome, cpf FROM pessoa;

SELECT * FROM pessoa 
WHERE 
	sexo = 'Masculino'
	AND data_nascimento >= '2000-01-01'
	OR sexo = 'Feminino';
*/

ALTER TABLE pessoa MODIFY email VARCHAR(255) NOT NULL UNIQUE;
