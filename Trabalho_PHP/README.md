Meu Projeto de Lista de Tarefas (To-Do List) - PHP
Este é o projeto que desenvolvi para praticar PHP. O objetivo foi criar uma lista de tarefas simples, mas que funcionasse de duas formas diferentes: primeiro salvando tudo em um arquivo de texto comum e depois evoluindo para um banco de dados MySQL.
O que tem nas pastas?
Dividi o projeto em duas partes para ficar bem organizado:
fase1_txt: Aqui a lógica funciona usando apenas um arquivo .txt. É a versão inicial e mais simples.
fase2_mysql: Esta é a versão migrada, onde usei banco de dados e tomei cuidado com a segurança usando PDO.
Também deixei o arquivo script.sql pronto para criar o banco de dados rapidamente.
Como testar a Fase 1 (Arquivo de Texto)
Essa parte é bem direta, não precisa configurar banco de dados.
Coloque a pasta fase1_txt no seu servidor (como o htdocs do XAMPP).
Abra no navegador: http://localhost/fase1_txt/index.php.
Já pode adicionar tarefas. O PHP vai criar um arquivo chamado tarefas.txt sozinho para guardar as informações.
Como testar a Fase 2 (MySQL )
Nesta fase, o sistema usa o MySQL para guardar as tarefas de forma mais profissional.
Passo a passo:
Vá no seu phpMyAdmin e crie um banco de dados chamado todo_db.
Importe o arquivo script.sql que está na raiz do projeto ou copie o código SQL de lá e execute no console.
Se o seu MySQL tiver uma senha de root, lembre-se de ajustar no arquivo db.php que está dentro da pasta fase2_mysql.
Acesse no navegador: http://localhost/fase2_mysql/index.php.
O que eu implementei:
Em ambas as versões, você consegue fazer o básico de qualquer lista:
Adicionar uma tarefa nova.
Marcar como concluída (o texto fica riscado ).
Desmarcar se mudar de ideia.
Excluir a tarefa da lista.
Um detalhe importante: Na Fase 2, eu usei Prepared Statements (PDO) para garantir a segurança contra ataques de SQL Injection no formulário.
Para o visual, usei o Bootstrap para deixar a interface limpa e fácil de usar.
