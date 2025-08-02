/*
CREATE DATABASE senac;

USE senac;

CREATE TABLE pessoa (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(120) NOT NULL,
	cpf CHAR(14) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
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
	
UPDATE 
	pessoa 
SET 
	nome = 'Débora Barros', 
	cpf = '222.222.222-22'
WHERE 
	id = 2;
	
DELETE FROM pessoa WHERE id = 1;
*/

-- ALTER TABLE pessoa MODIFY email VARCHAR(255) NOT NULL UNIQUE;

-- ALTER TABLE pessoa ADD telefone3 VARCHAR(20) NULL AFTER telefone;
 
/*ALTER TABLE pessoa 
	DROP telefone2, 
	DROP telefone3;*/
	
-- ALTER TABLE pessoa RENAME pessoa2;

-- ALTER TABLE pessoa CHANGE telefone3 telefone2 VARCHAR(20) NULL;

-- DROP TABLE pessoa2;

-- DROP DATABASE wordpress;

-- TRUNCATE pessoa;
/*
SELECT
	COUNT(*) AS total
FROM pessoa
WHERE
	sexo = 'Feminino';

SELECT
	sexo,
	YEAR(data_nascimento) AS ano,
	COUNT(*) AS total
FROM pessoa 
WHERE 
	YEAR(data_nascimento) > 1992
GROUP BY
	sexo,
	ano
HAVING
	total > 1
ORDER BY
	ano DESC,
	sexo ASC;
	
SELECT
	nome,
	UPPER(nome) AS nome_maiusculo,
	LOWER(nome) AS nome_minusculo,
	REPLACE(REPLACE(LOWER(nome), 'a', '4'), 'o', '0') AS nome_sem_espaco
FROM pessoa;

CREATE TABLE curso (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(80) NOT NULL,
	carga_horaria INT(9) NOT NULL,
	modalidade ENUM('Presencial', 'Online', 'Mista') NOT NULL DEFAULT 'Presencial' 
);

CREATE TABLE matricula (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_pessoa INT(10) NOT NULL,
	FOREIGN KEY (id_pessoa) REFERENCES pessoa (id),
	id_curso INT(10) NOT NULL,
	FOREIGN KEY (id_curso) REFERENCES curso (id),
	data_inicio DATE NOT NULL,
	data_termino DATE NOT NULL
);

CREATE TABLE telefone (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	numero VARCHAR(20) NOT NULL,
	id_pessoa INT(10) NOT NULL,
	FOREIGN KEY (id_pessoa) REFERENCES pessoa (id)
);

INSERT INTO curso (
    nome, carga_horaria, modalidade
) VALUES 
('Programador Web', 240, 'Presencial'),
('Sushiman', 180, 'Presencial'),
('Mecânico de Peugeot', 360, 'Online');

INSERT INTO matricula (
    id_pessoa, id_curso, data_inicio, data_termino
) VALUES 
(1, 2, '2025-07-01', '2025-09-30'),
(45, 3, '2025-04-01', '2025-05-29'),
(7, 1, '2025-05-06', '2025-07-24'),
(11, 2, '2025-03-01', '2025-07-27'),
(4, 1, '2025-07-05', '2025-08-30'),
(1, 3, '2025-10-01', '2025-12-21'),
(2, 2, '2025-07-01', '2025-09-30'),
(99, 2, '2025-02-14', '2025-04-27'),
(47, 3, '2025-03-11', '2025-04-23');

SELECT
    pessoa.nome,
    pessoa.cpf, 
    curso.nome AS curso,
    matricula.data_inicio,
    matricula.data_termino
FROM matricula
INNER JOIN pessoa ON matricula.id_pessoa = pessoa.id 
INNER JOIN curso ON matricula.id_curso = curso.id
WHERE 
    pessoa.sexo = 'masculino'
ORDER BY
    pessoa.id ASC;
    
CREATE DATABASE senac;
USE senac;

CREATE TABLE pessoa (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(120) NOT NULL,
	cpf CHAR(14) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	senha VARCHAR(64) NOT NULL,
	telefone VARCHAR(20) NOT NULL,
	sexo ENUM('Masculino', 'Feminino') NOT NULL,
	data_nascimento DATE NOT NULL
);

*/


SELECT * FROM pessoa 
WHERE 
    nome LIKE 'Carla%Almeida'


