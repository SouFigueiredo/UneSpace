# 📚 UneSpace — Sistema Inteligente de Gestão de Salas

Sistema web desenvolvido para gerenciamento e agendamento de salas acadêmicas, oferecendo controle de disponibilidade, reservas em tempo real e organização inteligente dos ambientes universitários.

---

# 🚀 Objetivo do Projeto

O UneSpace foi criado com o objetivo de digitalizar e simplificar o processo de reserva de salas dentro do ambiente acadêmico.

O sistema permite:

* ✅ Visualização de salas disponíveis
* ✅ Controle de horários ocupados
* ✅ Agendamento inteligente de salas
* ✅ Bloqueio automático de conflitos
* ✅ Controle de reservas por período
* ✅ Visualização de agendamentos em tempo real
* ✅ Exclusão automática de reservas expiradas
* ✅ Interface moderna e responsiva

---

# 🌐 Tecnologias Utilizadas

* HTML5
* TailwindCSS
* JavaScript
* PHP
* MySQL
* XAMPP

---

# 🔐 Sistema de Autenticação

O sistema possui autenticação administrativa utilizando:

* `$_SESSION`
* `password_hash()`
* `password_verify()`
* Proteção de rotas privadas

---

# 🧠 Funcionalidades Implementadas

## ✅ Reservas Inteligentes

* Não permite reservar horários já ocupados
* Bloqueia horários automaticamente
* Atualização dinâmica via JavaScript

---

## ✅ Controle de Datas

O sistema:

* bloqueia reservas em datas passadas
* remove automaticamente reservas expiradas
* controla disponibilidade em tempo real

---

## ✅ Dashboard Dinâmico

* Visualização das salas por andar
* Status visual:

  * Disponível
  * Reservada
* Cards modernos com TailwindCSS

---

## ✅ Modal de Reservas

Ao clicar em uma sala:

* exibe formulário de reserva
* mostra agendamentos já existentes
* exibe horários ocupados
* impede conflitos automaticamente

---

# 🗄️ Banco de Dados

### Nome do banco:

```sql
gestaosala
```

---

# ⚙️ Como Executar o Projeto

## 1️⃣ Clone o repositório

```bash
git clone https://github.com/souFigueiredo/UneSpace.git
```

---

## 2️⃣ Mova para o XAMPP

Coloque a pasta do projeto em:

```txt
htdocs/
```

---

## 3️⃣ Inicie o Apache e MySQL

Utilize o painel do XAMPP.

---

## 4️⃣ Execute o setup.sql

Importe o arquivo:

```txt
setup.sql
```

no phpMyAdmin.

---

## 5️⃣ Acesse o sistema

```txt
http://localhost/extensionproject/public/index.html
```

---

# 👤 Usuário Padrão

```txt
Usuário: admin
Senha: admin
```

---

# 📂 Estrutura do Projeto

```txt
PROJETO-EXTENSAO/
│
├── api/
│   ├── auth/
│   │   ├── login.php
│   │   └── logout.php
│   │
│   ├── config/
│   │   └── connect.php
│   │
│   └── reservas/
│       ├── cancelar.php
│       ├── criar.php
│       ├── listar.php
│       └── listarSala.php
│
├── public/
│   ├── components/
│   │   └── modalReserva.php
│   │
│   ├── img/
│   │   └── unesc.webp
│   │
│   ├── js/
│   │   └── modalReserva.js
│   │
│   ├── dashboard.php
│   └── index.html
│
├── README.md
└── setup.sql
```

---

# 🎯 Próximas Funcionalidades

* [ ] CRUD administrativo
* [ ] Diferentes níveis de usuário
* [ ] Histórico de reservas
* [ ] Dashboard analítico
* [ ] Filtros avançados
* [ ] API REST completa
* [ ] Notificações de reservas
* [ ] Responsividade mobile aprimorada

---

# 💡 Aprendizados no Projeto

Durante o desenvolvimento foram praticados conceitos de:

* autenticação segura
* APIs em PHP
* integração frontend/backend
* manipulação de DOM
* consumo de APIs com Fetch
* modelagem relacional
* sessões em PHP
* validações de disponibilidade
* TailwindCSS
* organização de projeto fullstack

---

# ⭐ UneSpace

> “Organizando espaços, facilitando conexões.”
