# estrutura-php-backend

Projeto de Backend com PHP (MVC simplificado: Model, DAO, Controller e Views) com PDO/MySQL.
Atividade: implementar a funcionalidade de **editar registros** para as entidades **Cliente** e **Fornecedor**.

## Integrante

- Guilherme Duarte Nunes

## Funcionalidades

| Entidade   | Campos                                        | Cadastrar | Listar | Editar | Excluir |
| ---------- | --------------------------------------------- | :-------: | :----: | :----: | :-----: |
| Categoria  | id, nome, informacoes                         | sim | sim | sim | sim |
| Cliente    | id (PK), nome, email, telefone                | sim | sim | sim | sim |
| Fornecedor | id (PK), razao_social, email, telefone        | sim | sim | sim | sim |

## Como executar

1. Copie a pasta do projeto para o servidor local (ex.: USBWebserver, XAMPP).
2. Execute o script `database/script.sql` no MySQL (cria o banco `bd_backend` e as tabelas).
3. Confira os dados de conexão em `model/Conn.php` (host, usuário, senha, banco).
4. Acesse `views/index.php` no navegador e use o menu **Consultar Clientes** / **Consultar Fornecedores**.

## Como funciona a edição

1. Na listagem, o botão amarelo (lápis) abre `?p=editar/cliente&id=N` (ou `fornecedor`), enviando o `id` pela URL.
2. `views/<entidade>/editar.php` busca o registro com `buscarPorId()` e preenche o formulário.
3. O formulário envia os dados por POST, incluindo o `id` em um campo `hidden`.
4. O Controller (`alterar()`) valida o id, monta o objeto e chama `salvar()` do DAO.
5. O DAO, ao receber um objeto **com id**, executa `UPDATE` (sem id, executa `INSERT`).

## Estrutura

```
model/        Cliente.php, Fornecedor.php, Categoria.php, Conn.php
dao/          ClienteDAO.php, FornecedorDAO.php, CategoriaDAO.php
controller/   ClienteController.php, FornecedorController.php, CategoriaController.php
views/        index.php, rotas.php, navbar.php, cliente/, fornecedor/, categoria/
database/     script.sql
```
