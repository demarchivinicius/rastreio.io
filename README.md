# 📦 Bot de Rastreamento de Encomendas no Telegram

Um bot feito em PHP que responde no Telegram com o status atualizado de um código de rastreio dos Correios. Ele usa a API da [Linketrack](https://linketrack.com/) para buscar as informações reais da encomenda.

---

## 🚀 Funcionalidades

- Recebe mensagens via Telegram.
- Valida se o texto enviado é um código de rastreio válido (ex: `AA123456789BR`).
- Consulta o status de rastreio em tempo real usando a API da Linketrack.
- Responde com o status da última movimentação do pacote.

---

## 📦 Tecnologias Usadas

- PHP
- Telegram Bot API
- Linketrack API

---

## 🛠️ Como Usar

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/seu-usuario/nome-do-repo.git
   cd nome-do-repo
