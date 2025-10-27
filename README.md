# 🔐 Projeto Login - Sistema de Autenticação (em desenvolvimento)
> Este projeto é o início de um sistema de autenticação e controle de usuários, com base em **grupos de permissões**.
> Ele ainda está em **desenvolvimento**, com foco inicial no backend e autenticação básica.
> A ideia é que ele evolua futuramente, incluindo **módulos adicionais e segurança aprimorada**.

--- 

## 🧠 Objetivo do Projeto

O principal objetivo é **praticar e consolidar conhecimentos** em: 
- Autenticação e controle de usuários;
- CRUD (criar, listar, editar e excluir);
- Relacionamentos entre tabelas;
- Organização de código;
- Fundamentos de segurança (hash de senha, níveis de acesso, etc).

Atualmente o projeto está em fase inicial — a estrutura está tomando forma, mas **ainda há muito a ser feito**, principalmente na parte de **segurança e controle de acessos**.

--- 

## ⚙️ Tecnologias Utilizadas 
- **PHP** (versão 8+)
- **MySQL** (banco de dados relacional)
- **HTML / CSS / JavaScript / Bootstrap** (estrutura e estilização da página)
- **PDO** (para acesso ao banco de dados com segurança)

<p align="center">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="60" height="60" alt="PHP"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" width="60" height="60" alt="MySQL"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="60" height="60" alt="HTML"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" width="60" height="60" alt="CSS"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="60" height="60" alt="JavaScript"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" width="60" height="60" alt="Bootstrap"/>
</p>

--- 

## 🧩 Estrutura do Projeto 
O sistema é dividido em partes principais: 
- login/ → Tela e lógica de autenticação
- usuarios/ → Cadastro, edição e exclusão de usuários
- grupos/ → Controle de permissões por grupo
- includes/ → Conexão com banco e funções auxiliares

*(A estrutura ainda pode mudar conforme o projeto evoluir.)*

--- 

## 🗃️ Banco de Dados 
Antes de rodar o sistema, é necessário **criar o banco de dados e suas tabelas**. 

### 🔹 Script SQL (limpo e revisado)
```sql
-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS teste01;
USE teste01;

-- Tabela de grupos
CREATE TABLE grupos (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  cadastrar_usuario TINYINT NOT NULL,
  editar_usuario TINYINT NOT NULL,
  listar_usuario TINYINT NOT NULL,
  excluir_usuario TINYINT NOT NULL,
  cadastrar_grupo TINYINT NOT NULL,
  editar_grupo TINYINT NOT NULL,
  listar_grupo TINYINT NOT NULL,
  excluir_grupo TINYINT NOT NULL,
  PRIMARY KEY (id)
)

-- Tabela de usuários
CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  email VARCHAR(50) NOT NULL,
  senha VARCHAR(256) NOT NULL,
  fk_grupo INT DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (fk_grupo) REFERENCES grupos(id)
)
```

---

## 👤 Inserindo um usuário inicial

Após criar o banco de dados, é necessário **inserir manualmente um usuário** para poder fazer login e acessar o sistema.

Exemplo:

```sql
-- Inserir grupo padrão (Administrador)
INSERT INTO grupos (
  nome,
  cadastrar_usuario, editar_usuario, listar_usuario, excluir_usuario,
  cadastrar_grupo, editar_grupo, listar_grupo, excluir_grupo
) VALUES (
  'Administrador', 1, 1, 1, 1, 1, 1, 1, 1
);

-- Inserir usuário administrador (senha: 123456)
INSERT INTO usuarios (nome, email, senha, fk_grupo)
VALUES (
  'Administrador',
  'admin@teste.com',
  SHA2('123456', 256),
  1
);
```

---

## ▶️ Como Executar o Projeto

1. **Configure seu servidor local** (XAMPP, WAMP ou equivalente).  
2. **Coloque o projeto** dentro da pasta `htdocs` ou similar.  
3. **Importe o script SQL** no seu banco de dados MySQL ou PostgreSQL.  
4. **Edite o arquivo de conexão** (`includes/conexao.php` ou o equivalente no backend Java) com suas credenciais.  
5. **Acesse o projeto** no navegador:

---

## 🧱 Funcionalidades (em desenvolvimento)

✅ Login e logout de usuários  
✅ Validação básica de credenciais  
✅ Estrutura de banco com grupos e permissões  
✅ Cadastro, edição, consulta e exclusão de usuários e grupos 
🕐 Controle de permissões por grupo *(em construção)*  
🔒 Segurança (criptografia, session hardening, etc) – *em construção*

---

## 🌱 Próximos Passos

- Implementar sistema completo de permissões  
- Melhorar o CRUD  
- Modernizar a interface com **Bootstrap 5**  
- Adicionar proteções contra **SQL Injection** e **CSRF**  
- Futuramente integrar **JWT** ou **OAuth2** para autenticação moderna  

---

## ✨ Autor

**Gustavo Henrique**  
📘 Técnico em Desenvolvimento de Sistemas  

💡 *Este projeto é pessoal e voltado ao aprendizado prático. Ele será continuamente aprimorado com novas funcionalidades e reforços de segurança.*
