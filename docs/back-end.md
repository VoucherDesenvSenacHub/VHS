# 🧩 Back-end PHP MVC

Este projeto implementa uma arquitetura **MVC (Model-View-Controller)** utilizando PHP puro com foco em organização, desacoplamento de responsabilidades e escalabilidade. A estrutura foi desenhada para ser simples, extensível e funcional.

---

## 📂 Estrutura de Diretórios

```bash
application/
│
├── core/              # Núcleo da aplicação (Controller, Model, Database)
│
├── routes/            # Definições de rotas
│
├── utils/             # Utilitários diversos (e-mails, reCAPTCHA, etc)
│
├── middlewares/       # Middleware HTTP
│
├── controllers/       # Controladores da aplicação
│
├── infra/             # Camada de infraestrutura (modelos reais)
```

---

## 🚀 Core

### 📄 `Controller.php`

Classe base para os controladores da aplicação. Fornece os métodos:

- `index()` → método abstrato a ser implementado.
- `model($model)` → carrega dinamicamente um modelo da pasta `infra/models`.
- `view($viewName, $data)` → carrega uma view da pasta `views/pages` e injeta dados via sessão.

### 📄 `Database.php`

Responsável pela conexão com o banco de dados usando `PDO`. Lê as variáveis de ambiente:

- `DB_DRIVER`, `DB_HOST`, `DB_DATABASE`, `DB_USER`, `DB_PASSWORD`

Oferece:

- `getDatabase()` → retorna a instância do PDO.
- `query($sql, $params)` → executa uma query preparada.

### 📄 `Model.php`

Classe base para todos os modelos. Instancia automaticamente uma conexão com o banco de dados via `Database`.

---

## 🧭 Rotas

### 📄 `route.config.php`

Contém configurações globais de roteamento, como middlewares e prefixos.

### 📄 `route.php`

Define as rotas da aplicação apontando para controladores e métodos.

---

## 🧰 Utils

Utilitários que complementam a lógica da aplicação:

- `emailTransporter.php` → envio de e-mails.
- `redirect.php` → redirecionamento de rotas.
- `verifyRecaptcha.php` → validação do Google reCAPTCHA.
- `purify/` → utilitários de limpeza e validação de dados.

---

## 🏗️ Infraestrutura

### 📁 `models/`

Contém os modelos reais da aplicação (ex: `UserModel.php`, `ProductModel.php`), que estendem `Model.php` e interagem com o banco de dados diretamente. É preciso que todas as classem terminem com o Model, ex: NomeModel e devem ter Namespace declarado no arquivo, ex: ```Src\Application\Core;```

---

## 🧑‍💻 Controllers

### 📁 `controllers/`

Controladores que herdam de `Controller.php`. São responsáveis por orquestrar os dados entre modelos e views.

---

## 🖼️ Views

As views devem ser adicionadas manualmente em `views/pages/` (fora do escopo atual deste repositório).

---

## ✅ Exemplo de Uso

```php
class UserController extends Controller {
    public function index() {
        $userModel = $this->model("User");
        $users = $userModel->getAllUsers();

        $this->view("users/index", ["users" => $users]);
    }
}
```

---

## 📌 Requisitos

- PHP 8.1+
- Extensão PDO habilitada
- Variáveis de ambiente configuradas (ex: `.env`)

---

## 📃 Licença

Este projeto está licenciado sob os termos de uso definidos pela sua equipe. Sinta-se livre para adaptá-lo conforme suas necessidades.

---

## 📫 Contato

Para dúvidas, sugestões ou colaboração, entre em contato com o mantenedor do projeto.

---

# 🧭 Inicialização e Roteamento da Aplicação PHP

Este arquivo tem como objetivo configurar o ambiente, registrar rotas HTTP e executar o roteador principal da aplicação.

---

## 📦 Dependências e Autoload

```php
require_once __DIR__ . '/../../../vendor/autoload.php';
```

Carrega o autoloader do Composer, permitindo usar bibliotecas externas como `vlucas/phpdotenv` e aplicar o carregamento automático (autoload) das classes no projeto.

---

## ⚙️ Arquivos da Aplicação

```php
require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../controllers/signUp.controller.php';
```

- `route.config.php`: configurações globais de roteamento.
- `signUp.controller.php`: controlador responsável por processar o cadastro de usuários.

---

## 🌱 Variáveis de Ambiente

```php
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();
```

Carrega variáveis do arquivo `.env`, como credenciais de banco de dados e tokens.

---

## 🧭 Definição de Rotas

```php
use Src\Application\Controllers\SignUpController;
use Src\Application\Routes\Router;

$router = new Router();

$router->post('/api/v1/auth/signup', SignUpController::class);
```

- Inicializa o roteador personalizado da aplicação.
- Define uma rota do tipo **POST** para `/api/v1/auth/signup`, que aponta para `SignUpController`.

---

## 🧪 Formato da Requisição

### [Use postman para testes de requisições](https://postman.com)

Todas as requisições esperadas devem utilizar **form-data** como método de envio. Exemplo:

### 📤 Exemplo de Requisição (form-data)

```
POST /api/v1/auth/signup HTTP/1.1
Content-Type: multipart/form-data

Form Data:
- name: Guilherme
- email: guilherme@example.com
- password: 123456
```

---

## ▶️ Execução do Roteador

```php
$router->run();
```

Responsável por:

- Capturar o caminho e método da requisição.
- Buscar a rota correspondente.
- Executar o método adequado do controlador especificado.

---

## ✅ Resumo

| Componente         | Responsabilidade                              |
|--------------------|-----------------------------------------------|
| `.env`             | Armazenar variáveis de ambiente               |
| `Router`           | Registrar e gerenciar rotas HTTP              |
| `SignUpController` | Controlador da rota `/api/v1/auth/signup`     |
| `form-data`        | Formato padrão de envio das requisições       |

---

Para adicionar novas rotas, use métodos como:

```php
$router->get('/rota', NomeDoController::class);
$router->post('/rota', NomeDoController::class);
```