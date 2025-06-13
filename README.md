📚 Como usar a API RESTful de Produtos
Esta API permite gerenciar produtos de uma loja online, incluindo autenticação, cadastro, listagem, filtro, atualização e remoção de produtos. Todas as rotas (exceto registro e login) exigem autenticação via token.

⚡ Pré-requisitos
PHP 8.1+ e Composer instalados

MySQL rodando (ex: via Laragon, XAMPP, Workbench, etc)

Projeto Laravel já migrado (php artisan migrate)

Ferramenta de testes de API (Postman, Insomnia, etc)

🚀 Fluxo de uso da API
1. Registrar um novo usuário
Método: POST

Endpoint: /api/register

Body (JSON):

json
{
  "name": "Seu Nome",
  "email": "seu@email.com",
  "password": "senha123",
  "password_confirmation": "senha123"
}
Resposta: Dados do usuário criado.

2. Fazer login e obter o token
Método: POST

Endpoint: /api/login

Body (JSON):

json
{
  "email": "seu@email.com",
  "password": "senha123"
}
Resposta:

json
{
  "token": "SEU_TOKEN_AQUI"
}
Importante: Guarde o token para usar nas próximas requisições.

3. Autenticação nas rotas protegidas
Em todas as requisições abaixo, adicione o token no cabeçalho:

Authorization: Bearer SEU_TOKEN_AQUI

4. Cadastrar um produto
Método: POST

Endpoint: /api/produtos

Body (JSON):

json
{
  "nome": "Notebook Dell",
  "descricao": "Notebook com 16GB RAM",
  "preco": 3500.00,
  "quantidade": 5,
  "categoria": "Informática"
}
Resposta: Produto criado (status 201).

5. Listar produtos (com paginação)
Método: GET

Endpoint: /api/produtos?page=1

Resposta: Lista paginada de produtos (10 por página por padrão).

6. Filtrar produtos por categoria
Método: GET

Endpoint: /api/produtos?categoria=Informática

Resposta: Lista paginada apenas dos produtos da categoria informada.

7. Visualizar um produto específico
Método: GET

Endpoint: /api/produtos/{id}

Exemplo: /api/produtos/1

Resposta: Dados do produto.

8. Atualizar um produto
Método: PUT

Endpoint: /api/produtos/{id}

Body (JSON):

json
{
  "nome": "Notebook Dell Atualizado",
  "descricao": "Agora com 32GB RAM",
  "preco": 4200.00,
  "quantidade": 3,
  "categoria": "Informática"
}
Resposta: Produto atualizado.

9. Remover um produto
Método: DELETE

Endpoint: /api/produtos/{id}

Exemplo: /api/produtos/1

Resposta: Mensagem de sucesso.

10. Visualizar produtos no banco de dados (MySQL Workbench)
Abra o MySQL Workbench.

Conecte-se ao seu servidor MySQL.

No painel esquerdo, clique no banco de dados usado pelo Laravel (ex: laravel ou api_loja).

Expanda “Tables” e clique em products.

Clique com o botão direito e escolha Select Rows - Limit 1000 para ver todos os produtos cadastrados pela API.

🧪 Dicas para testes
Use o Postman ou Insomnia para testar todos os endpoints.

Sempre envie o token de autenticação nas rotas protegidas.

Para paginação, use o parâmetro ?page=2 para acessar as próximas páginas.

Para filtrar, use ?categoria=NomeDaCategoria junto com a rota de listagem.

📄 Documentação e exemplos
Acesse a documentação Swagger em:
http://localhost:8000/api/documentation
(se configurado no projeto)

🛠️ Exemplos rápidos de requisições
Operação	Método	Endpoint	Body (JSON)	Token?
Registrar	POST	/api/register	name, email, password	Não
Login	POST	/api/login	email, password	Não
Criar produto	POST	/api/produtos	nome, descricao, ...	Sim
Listar produtos	GET	/api/produtos	-	Sim
Filtrar	GET	/api/produtos?categoria=...	-	Sim
Ver produto	GET	/api/produtos/{id}	-	Sim
Atualizar	PUT	/api/produtos/{id}	campos a atualizar	Sim
Excluir	DELETE	/api/produtos/{id}	-	Sim
❓ Dúvidas frequentes
Não consigo acessar uma rota:
Verifique se está enviando o token corretamente.

Erro de banco de dados:
Confirme se o banco existe e está configurado no .env.

Como ver os dados no MySQL?
Use o MySQL Workbench, phpMyAdmin ou outro cliente MySQL.
