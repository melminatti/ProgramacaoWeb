-- sql/setup.sql
CREATE EXTENSION IF NOT EXISTS pgcrypto;

CREATE TABLE setores (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(100) NOT NULL
);

CREATE TABLE dispositivos (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  status BOOLEAN DEFAULT TRUE
);

CREATE TABLE perguntas (
  id SERIAL PRIMARY KEY,
  texto TEXT NOT NULL,
  ativa BOOLEAN DEFAULT TRUE
);

CREATE TABLE avaliacoes (
  id SERIAL PRIMARY KEY,
  setor_id INT REFERENCES setores(id),
  pergunta_id INT REFERENCES perguntas(id),
  dispositivo_id INT REFERENCES dispositivos(id),
  resposta INT NOT NULL CHECK (resposta BETWEEN 0 AND 10),
  feedback TEXT,
  data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
  id SERIAL PRIMARY KEY,
  usuario VARCHAR(50) UNIQUE NOT NULL,
  senha TEXT NOT NULL
);


--------------------------------------------------------------------------------

-- usuário admin padrão (senha: 1234)
INSERT INTO usuarios (usuario, senha)
VALUES ('admin', crypt('1234', gen_salt('bf')));

-- Exemplo: inserir setor e dispositivo padrão
INSERT INTO setores (nome) VALUES ('Recepção');
INSERT INTO dispositivos (nome, status) VALUES ('Tablet 01', TRUE);

-- Exemplo: inserir perguntas
INSERT INTO perguntas (texto) VALUES
('Como você avalia a limpeza do local?'),
('Como foi o atendimento?'),
('Como avalia o tempo de espera?');
