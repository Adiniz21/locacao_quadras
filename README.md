## 🎾 Sistema de Aluguel de Quadras Esportivas

---

## Sumário

- [Sobre o Projeto](#-sobre-o-projeto)
- [Funcionalidades](#%EF%B8%8F-funcionalidades)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Instalação e Configuração](#%EF%B8%8F-instalação-e-configuração)
- [Estrutura Banco de Dados](#-estrutura-do-banco-de-dados)
- [Rotas Principais](#-rotas-principais)

---

## 📌 Sobre o Projeto

Este é um sistema de gestão de quadras esportivas, permitindo que usuários reservem quadras para diversos esportes, como futsal, vôlei, basquete, peteca e futebol society. O sistema também gerencia pagamentos, clientes, funcionários e manutenções.

## ⚙️ Funcionalidades

📅 Agendamento de Quadras (Reserva por data e horário)

💳 Gerenciamento de Pagamentos (Pix, cartão, boleto, etc.)

🏢 Gestão de Quadras e Espaços Esportivos

👥 Cadastro e gerenciamento de usuários (Clientes e Funcionários)

📊 Dashboard e Relatórios sobre faturamento e uso das quadras

🔔 Notificações Automáticas via WhatsApp ou e-mail

## 🚀 Tecnologias Utilizadas

Laravel 10+ (Back-end)

MySQL (Banco de Dados)

Blade + TailwindCSS (Front-end padrão Laravel)

Composer (Gerenciador de dependências)

Eloquent ORM (Manipulação do banco de dados)

## 🛠️ Instalação e Configuração

1️⃣ Clonar o repositório

    git clone https://github.com/seu-usuario/locacao-quadras.git
    cd locacao-quadras

2️⃣ Instalar as dependências

    composer install
    npm install && npm run dev

3️⃣ Configurar o .env

    cp .env.example .env
    php artisan key:generate

4️⃣ Configurar o Banco de Dados

No arquivo .env, configure as credenciais do banco:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=locacao_quadras
    DB_USERNAME=root
    DB_PASSWORD=

5️⃣ Rodar as Migrações e Seeders

    php artisan migrate --seed

6️⃣ Iniciar o Servidor Local

    php artisan serve

Acesse o sistema em: http://127.0.0.1:8000

## 📜 Estrutura do Banco de Dados

users (Clientes e Funcionários)

sports_facilities (Quadras)

reservations (Agendamentos)

payments (Pagamentos)

employees (Funcionários)

maintenances (Histórico de Manutenções)

## 📌 Rotas Principais

| Método | Rota | Descrição | 
| --- | --- |  --- |
| **GET** | /quadras |  Lista todas as quadras |
| **POST** | /reservas | Criar nova reserva |
| **GET** | /reservas/{id} | Exibir detalhes da reserva |
| **POST** | /pagamentos | Registrar pagamento |
| **GET** | /relatorios | Dashboard financeiro |







