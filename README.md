# 📦 Bot de Rastreamento de Encomendas no Telegram

Um bot simples em PHP que responde no Telegram com o status de um código de rastreio dos Correios. Ele verifica se o código enviado está no formato correto e responde com uma mensagem genérica de rastreamento.

## 🚀 Funcionalidades

- Recebe mensagens via Telegram.
- Valida se o texto é um código de rastreio dos Correios no formato `AA123456789BR`.
- Retorna uma resposta personalizada confirmando o recebimento do código.

> ⚠️ Por enquanto, o bot **não consulta a API dos Correios**, apenas valida o formato do código. Ideal como base para evoluções futuras.

---

## 📂 Estrutura do Projeto

- `rastreamento.php`: script principal que consome a API do Telegram e responde ao usuário.
  
---

## 🛠️ Como Usar

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/seu-usuario/nome-do-repo.git
   cd nome-do-repo
