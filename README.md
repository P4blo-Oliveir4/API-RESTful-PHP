# 📚 API RESTful de Produtos

Esta API permite gerenciar produtos de uma loja online, com funcionalidades de autenticação, cadastro, listagem, filtro, atualização e remoção de produtos.

> 🔐 **Atenção:** Todas as rotas (exceto registro e login) exigem autenticação via token.

---

## ⚡ Pré-requisitos

- PHP **8.1+**
- Composer
- MySQL rodando (ex: **Laragon**, **XAMPP**, **Workbench** etc)
- Projeto Laravel já migrado:
  ```bash
  php artisan migrate
  ```
- Ferramenta de testes de API como **Postman** ou **Insomnia**

---

## 🚀 Fluxo de Uso da API

### 📌 Registrar um novo usuário

- **Método:** `POST`
- **Endpoint:** `/api/register`

**Body (JSON):**
```json
{
  "name": "Seu Nome",
  "email": "seu@email.com",
  "password": "senha123",
  "password_confirmation": "senha123"
}
```

➡️ **Resposta:** Dados do usuário criado.

---

### 🔐 Fazer login e obter o token

- **Método:** `POST`
- **Endpoint:** `/api/login`

**Body (JSON):**
```json
{
  "email": "seu@email.com",
  "password": "senha123"
}
```

➡️ **Resposta:**
```json
{
  "token": "SEU_TOKEN_AQUI"
}
```

> ⚠️ Guarde esse token! Ele será usado nas próximas requisições.

---

### 🔒 Autenticação nas rotas protegidas

Adicione o token no cabeçalho de todas as requisições:

```
Authorization: Bearer SEU_TOKEN_AQUI
```

---

### ➕ Cadastrar um produto

- **Método:** `POST`
- **Endpoint:** `/api/produtos`

**Body (JSON):**
```json
{
  "nome": "Notebook Dell",
  "descricao": "Notebook com 16GB RAM",
  "preco": 3500.00,
  "quantidade": 5,
  "categoria": "Informática"
}
```

➡️ **Resposta:** Produto criado (HTTP `201`)

---

### 📄 Listar produtos (com paginação)

- **Método:** `GET`
- **Endpoint:** `/api/produtos?page=1`

➡️ **Resposta:** Lista paginada de produtos (10 por página, por padrão)

---

### 🔍 Filtrar produtos por categoria

- **Método:** `GET`
- **Endpoint:** `/api/produtos?categoria=Informática`

➡️ **Resposta:** Produtos da categoria especificada

---

### 👁️ Visualizar um produto específico

- **Método:** `GET`
- **Endpoint:** `/api/produtos/{id}`

**Exemplo:** `/api/produtos/1`

➡️ **Resposta:** Dados do produto

---

### ✏️ Atualizar um produto

- **Método:** `PUT`
- **Endpoint:** `/api/produtos/{id}`

**Body (JSON):**
```json
{
  "nome": "Notebook Dell Atualizado",
  "descricao": "Agora com 32GB RAM",
  "preco": 4200.00,
  "quantidade": 3,
  "categoria": "Informática"
}
```

➡️ **Resposta:** Produto atualizado

---

### ❌ Remover um produto

- **Método:** `DELETE`
- **Endpoint:** `/api/produtos/{id}`

**Exemplo:** `/api/produtos/1`

➡️ **Resposta:** Mensagem de sucesso

---

### 🗃️ Visualizar produtos no MySQL Workbench

1. Abra o **MySQL Workbench** e conecte-se ao seu servidor.
2. Clique no banco de dados usado pelo Laravel (Nome do servidor: Laravel).
3. Expanda a seção `Tables` e selecione `products`.
4. Clique com o botão direito e selecione `Select Rows - Limit 1000` para ver os produtos.

---

## 🧪 Dicas para Testes

- Use **Postman** ou **Insomnia** para testar todos os endpoints.
- Sempre envie o token nas rotas protegidas.
- Para paginação: `?page=2`
- Para filtro por categoria: `?categoria=Informática`

---

## 📄 Documentação Swagger

Acesse:
```
http://localhost:8000/api/documentation
```

---

## 🛠️ Tabela Resumo das Requisições

| Operação       | Método | Endpoint                  | Body JSON            | Token? |
|----------------|--------|---------------------------|----------------------|--------|
| Registrar      | POST   | `/api/register`           | name, email, password | ❌ Não |
| Login          | POST   | `/api/login`              | email, password       | ❌ Não |
| Criar produto  | POST   | `/api/produtos`           | nome, descrição, etc. | ✅ Sim |
| Listar         | GET    | `/api/produtos`           | -                    | ✅ Sim |
| Filtrar        | GET    | `/api/produtos?categoria=...` | -              | ✅ Sim |
| Ver produto    | GET    | `/api/produtos/{id}`      | -                    | ✅ Sim |
| Atualizar      | PUT    | `/api/produtos/{id}`      | campos a atualizar    | ✅ Sim |
| Excluir        | DELETE | `/api/produtos/{id}`      | -                    | ✅ Sim |

---

## ❓ Dúvidas Frequentes

- **Não consigo acessar uma rota:**  
  Verifique se está enviando o token corretamente no cabeçalho.

- **Erro de banco de dados:**  
  Confirme se o banco de dados existe e está configurado no arquivo `.env`.

- **Como ver os dados no MySQL?**  
  Use o **MySQL Workbench**, **phpMyAdmin** ou outro cliente MySQL para visualizar os dados da tabela `products`.

---
