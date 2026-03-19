# 🏥 Cube Saúde - Sistema de Gestão

Sistema web desenvolvido em **Laravel (PHP)** para gerenciamento de informações na área de saúde, com foco em organização, controle e eficiência operacional.

---

## 🚀 Sobre o Projeto

O **Cube Saúde** é uma aplicação web que permite o gerenciamento de dados e processos relacionados à área da saúde, oferecendo uma estrutura organizada e escalável.

O sistema foi desenvolvido com foco em:

* Organização de código (MVC)
* Facilidade de manutenção
* Boas práticas com Laravel
* Separação de responsabilidades

---

## 🛠️ Tecnologias Utilizadas

* **PHP**
* **Laravel**
* **MySQL / PostgreSQL**
* **Blade (Template Engine)**
* **Bootstrap / CSS**
* **JavaScript**

---

## 🧱 Arquitetura

O projeto segue o padrão **MVC (Model-View-Controller)**:

```id="mvc123"
app/
 ├── Models        → Representação dos dados
 ├── Http/
 │    ├── Controllers → Regras de entrada
 ├── Services (se houver)
resources/
 ├── views         → Interface (Blade)
routes/
 ├── web.php       → Rotas da aplicação
```

---

## 📦 Funcionalidades

✔️ Cadastro e gerenciamento de dados
✔️ Operações CRUD completas
✔️ Interface web com Blade
✔️ Integração com banco de dados
✔️ Estrutura organizada e escalável

---

## 🔄 Fluxo da Aplicação

1. Usuário acessa o sistema via navegador
2. Requisição é enviada pelas rotas (`web.php`)
3. Controller processa a requisição
4. Model interage com o banco
5. View (Blade) retorna a interface ao usuário

---

## ⚙️ Como Executar o Projeto

### Pré-requisitos

* PHP 8+
* Composer
* Banco de dados (MySQL ou PostgreSQL)

---

### Passos

```bash id="laravelrun"
# Clonar o repositório
git clone https://github.com/seu-usuario/cube-saude.git

# Entrar na pasta
cd cube-saude

# Instalar dependências
composer install

# Copiar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Configurar banco no .env

# Rodar migrations
php artisan migrate

# Iniciar servidor
php artisan serve
```

---

## 🗄️ Configuração

As configurações principais ficam no arquivo:

```id="envfile"
.env
```

Exemplo:

```env id="envex"
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cube_saude
DB_USERNAME=root
DB_PASSWORD=******
```

---

## 💡 Diferenciais do Projeto

* Estrutura seguindo padrão MVC
* Organização clara de rotas e controllers
* Uso do Eloquent ORM
* Facilidade para manutenção e evolução
* Base sólida para sistemas corporativos

---

## 🎯 Objetivo

Projeto desenvolvido para:

* Prática com **Laravel**
* Construção de sistemas web completos
* Aplicação de boas práticas de desenvolvimento
* Portfólio profissional

---

## 👨‍💻 Autor

**Leonardo Almeida Ribeiro**

---

## 📄 Licença

MIT
