# Aplicação de Lista de Tarefas (To-Do List) em PHP

Este projeto demonstra uma aplicação simples de Lista de Tarefas desenvolvida em PHP, com duas fases distintas de persistência de dados: a primeira utilizando arquivos de texto e a segunda migrando para um banco de dados MySQL com PDO.

## Estrutura do Projeto

```
todo_list/
├── fase1_txt/
│   └── index.php
├── fase2_mysql/
│   ├── db.php
│   └── index.php
├── README.md
└── script.sql
```

## Requisitos

Para rodar este projeto, você precisará de um ambiente de servidor web com PHP instalado (ex: Apache, Nginx com PHP-FPM) e, para a Fase 2, um servidor MySQL/MariaDB.

Recomenda-se o uso de ambientes como XAMPP, WAMP, MAMP ou Docker para facilitar a configuração.

## Fase 1: Armazenamento em Arquivo Texto

Nesta fase, as tarefas são armazenadas em um arquivo `tarefas.txt` localizado no mesmo diretório do `index.php`.

### Como Rodar:

1.  Certifique-se de ter um servidor web com PHP configurado.
2.  Copie o conteúdo da pasta `fase1_txt` para o diretório raiz do seu servidor web (ou um subdiretório configurado).
3.  Acesse `http://localhost/fase1_txt/index.php` (ou o caminho correspondente no seu servidor) no seu navegador.

O arquivo `tarefas.txt` será criado automaticamente na primeira vez que você adicionar uma tarefa.

## Fase 2: Migração para Banco de Dados (MySQL com PDO)

Nesta fase, as tarefas são armazenadas em um banco de dados MySQL, utilizando PDO para a conexão e Prepared Statements para segurança.

### Configuração do Banco de Dados:

1.  Acesse seu servidor MySQL (via phpMyAdmin, MySQL Workbench ou linha de comando).
2.  Execute o script `script.sql` para criar o banco de dados `todo_db` e a tabela `tarefas`:

    ```sql
    CREATE DATABASE IF NOT EXISTS todo_db;
    USE todo_db;

    CREATE TABLE IF NOT EXISTS tarefas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        status VARCHAR(50) NOT NULL DEFAULT 'pendente'
    );
    ```

3.  Verifique o arquivo `fase2_mysql/db.php` e ajuste as credenciais do banco de dados (`$user`, `$pass`) se necessário. Por padrão, o usuário é `root` e a senha é vazia em muitas instalações locais.

### Como Rodar:

1.  Copie o conteúdo da pasta `fase2_mysql` para o diretório raiz do seu servidor web (ou um subdiretório configurado).
2.  Acesse `http://localhost/fase2_mysql/index.php` (ou o caminho correspondente no seu servidor) no seu navegador.

## Funcionalidades Comuns a Ambas as Fases:

-   **Criar:** Adicionar uma nova tarefa com título e status inicial 'pendente'.
-   **Listar:** Exibir todas as tarefas cadastradas.
-   **Atualizar:** Alterar o status de uma tarefa (entre 'pendente' e 'concluida').
-   **Deletar:** Remover uma tarefa da lista.
