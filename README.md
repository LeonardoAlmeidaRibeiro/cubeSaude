# 🏥 Cube Saúde - Sistema de Monitoramento de Saúde

Sistema web desenvolvido em **Laravel (PHP)** para acompanhamento de saúde pessoal, permitindo o controle de glicose, pressão arterial, medicamentos, alimentação e atividades físicas em um único painel integrado.

---

## 🚀 Sobre o Projeto

O **Cube Saúde** é uma aplicação completa para monitoramento de indicadores de saúde, voltada principalmente para:

* Pessoas com **diabetes**
* Controle de **pressão arterial**
* Acompanhamento de hábitos diários

O sistema centraliza informações importantes e auxilia o usuário com **alertas e lembretes inteligentes**, promovendo um melhor controle da saúde.

---

## 🧠 Funcionalidades Principais

### 📊 Dashboard Inteligente

* Exibe resumo completo do dia:

  * Medições de glicose
  * Pressão arterial
  * Refeições
  * Exercícios
  * Medicamentos
* Sistema de **alertas automáticos**

  * Ex: medições de glicose pendentes
* Identificação de itens críticos (valores altos/baixos)

---

### 💉 Controle de Glicose

* Registro de medições ao longo do dia
* Classificação por tipo de medição
* Destaque visual para:

  * Valores altos (hiperglicemia)
  * Valores baixos (hipoglicemia)

---

### 💊 Gestão de Medicamentos

* Cadastro de medicamentos
* Controle de horários
* Marcação de medicamentos como:

  * ✅ Tomado
  * ❎ Pendente

---

### ❤️ Monitoramento de Pressão Arterial

* Registro de pressão sistólica/diastólica
* Cálculo e classificação automática:

  * Normal
  * Atenção
  * Alta
* Registro de pulso

---

### 🍽️ Controle de Refeições

* Registro de refeições diárias
* Classificação por tipo (café, almoço, etc.)
* Controle de carboidratos

---

### 🏃 Atividades Físicas

* Registro de exercícios
* Controle de duração
* Histórico diário de atividades

---

### 🔐 Autenticação de Usuário

* Login e registro
* Alteração de senha
* Recuperação de acesso
* Rotas protegidas por autenticação

---

## 🧱 Arquitetura

O projeto segue o padrão **MVC do Laravel**:

```id="mvc2"
routes/web.php      → Definição das rotas
Controllers         → Regras de negócio
Models              → Dados e relacionamentos
Blade (views)       → Interface do usuário
```

---

## 🔄 Fluxo do Sistema

1. Usuário realiza login no sistema
2. Acessa o dashboard
3. Registra dados de saúde ao longo do dia
4. Sistema analisa informações automaticamente
5. Alertas são gerados conforme necessidade

---

## 🛠️ Tecnologias Utilizadas

* **PHP**
* **Laravel**
* **Blade**
* **Bootstrap**
* **JavaScript**
* **MySQL / PostgreSQL**

---

## 📡 Rotas Principais

* `/login` → Autenticação
* `/register` → Cadastro
* `/painel/index` → Dashboard
* `/glucose` → Glicose
* `/medicamentos` → Medicamentos
* `/registros-pressao` → Pressão arterial
* `/refeicoes` → Refeições
* `/exercises` → Exercícios

---

## ⚙️ Como Executar o Projeto

```bash
# Clonar repositório
git clone https://github.com/seu-usuario/cube-saude.git

# Instalar dependências
composer install

# Configurar ambiente
cp .env.example .env

# Gerar chave
php artisan key:generate

# Rodar migrations
php artisan migrate

# Iniciar servidor
php artisan serve
```

---

## 💡 Diferenciais do Projeto

* Sistema completo de **monitoramento de saúde**
* Dashboard com **dados em tempo real**
* **Alertas automáticos inteligentes**
* Controle integrado de múltiplos indicadores
* Interface organizada e responsiva
* Aplicação com potencial real de uso

---

## 🎯 Objetivo

Projeto desenvolvido para:

* Prática com **Laravel**
* Construção de sistemas reais
* Demonstração de capacidade **full stack backend + interface**
* Portfólio profissional

---

## 👨‍💻 Autor

**Leonardo Almeida Ribeiro**

---

## 📄 Licença

MIT
