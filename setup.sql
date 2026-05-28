CREATE DATABASE IF NOT EXISTS gestaosala;

USE gestaosala;

-- =========================
-- USUÁRIOS
-- =========================

CREATE TABLE usuarios (

```
id INT AUTO_INCREMENT PRIMARY KEY,

usuario VARCHAR(100) NOT NULL UNIQUE,

senha VARCHAR(255) NOT NULL
```

);

-- =========================
-- SALAS
-- =========================

CREATE TABLE salas (

```
id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(50) NOT NULL,

bloco VARCHAR(10) NOT NULL,

andar INT NOT NULL,

capacidade INT,

status VARCHAR(20) DEFAULT 'Disponível'
```

);

-- =========================
-- TURMAS
-- =========================

CREATE TABLE turmas (

```
id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(100) NOT NULL,

curso VARCHAR(100),

periodo VARCHAR(20)
```

);

-- =========================
-- HORÁRIOS
-- =========================

CREATE TABLE horarios (

```
id INT AUTO_INCREMENT PRIMARY KEY,

horario_inicio TIME NOT NULL,

horario_fim TIME NOT NULL
```

);

-- =========================
-- PERÍODOS
-- =========================

CREATE TABLE periodos (

```
id INT AUTO_INCREMENT PRIMARY KEY,

nome VARCHAR(50)
```

);

-- =========================
-- RESERVAS
-- =========================

CREATE TABLE reservas (

```
id INT AUTO_INCREMENT PRIMARY KEY,

sala_id INT NOT NULL,

turma_id INT NOT NULL,

usuario_id INT NOT NULL,

data_reserva DATE NOT NULL,

periodo_id INT NOT NULL,

horario_id INT NOT NULL,

status VARCHAR(20) DEFAULT 'Reservado',

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (sala_id) REFERENCES salas(id),

FOREIGN KEY (turma_id) REFERENCES turmas(id),

FOREIGN KEY (usuario_id) REFERENCES usuarios(id),

FOREIGN KEY (periodo_id) REFERENCES periodos(id),

FOREIGN KEY (horario_id) REFERENCES horarios(id)
```

);

-- =========================
-- USUÁRIO PADRÃO
-- senha: admin
-- =========================

INSERT INTO usuarios (usuario, senha) VALUES

(
'admin',

```
'$2y$10$7yDVcF87aJHvSNEcstvVouzVfUK/8fSYFUjOl2zWCA1k508cpzApS'
```

);

-- =========================
-- SALAS
-- =========================

INSERT INTO salas (nome, bloco, andar, capacidade) VALUES

('B101', 'B', 1, 40),
('B102', 'B', 1, 35),
('B103', 'B', 1, 50),

('B201', 'B', 2, 40),
('B202', 'B', 2, 35),
('B203', 'B', 2, 50),

('B301', 'B', 3, 40),
('B302', 'B', 3, 35),
('B303', 'B', 3, 50);

-- =========================
-- TURMAS
-- =========================

INSERT INTO turmas (nome, curso, periodo) VALUES

('SI 1', 'Sistemas de Informação', 'Noturno'),
('CC 1', 'Ciências Contábeis', 'Noturno'),
('ADM 1', 'Administração', 'Noturno'),
('DIR 1', 'Direito', 'Noturno'),
('PSI 1', 'Psicologia', 'Noturno');

-- =========================
-- HORÁRIOS
-- =========================

INSERT INTO horarios (horario_inicio, horario_fim) VALUES

('18:50:00', '19:30:00'),
('19:30:00', '20:30:00'),
('20:40:00', '22:00:00');

-- =========================
-- PERÍODOS
-- =========================

INSERT INTO periodos (nome) VALUES

('1° Período'),
('2° Período'),
('3° Período');
