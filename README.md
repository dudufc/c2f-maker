# C2F Maker - Gravação a Laser e Cuias

Este é um projeto simples e intuitivo desenvolvido para facilitar a venda de cuias e a solicitação de serviços de gravação a laser personalizada.

## 🚀 Funcionalidades

- **Catálogo de Produtos:** Exibição de modelos populares como Bago de Touro, Porongo com Pé e Coquinho.
- **Serviço Personalizado:** Opção para o cliente trazer sua própria cuia para gravação.
- **Formulário de Pedido:** Sistema simples para coleta de nome, WhatsApp e observações.
- **Upload de Referência:** O cliente pode enviar a imagem/logo que deseja gravar diretamente pelo site.
- **Design Responsivo:** Desenvolvido com Bootstrap 5, funcionando perfeitamente em celulares e computadores.

## 🛠️ Tecnologias Utilizadas

- **HTML5 / CSS3** (Estrutura e Estilização)
- **Bootstrap 5** (Framework de UI)
- **JavaScript** (Interatividade e integração com WhatsApp)

## 💻 Como rodar localmente

1. Clone este repositório:
   ```bash
   git clone https://github.com/dudufc/c2f-maker.git
   ```
2. Entre na pasta:
   ```bash
   cd c2f-maker
   ```
3. Abra `index.html` no navegador ou use um servidor local, por exemplo a extensão Live Server do VS Code.

## ☁️ Publicação gratuita na Vercel

1. Acesse [vercel.com](https://vercel.com) e entre com o GitHub.
2. Clique em **Add New > Project** e importe `dudufc/c2f-maker`.
3. Em **Framework Preset**, selecione **Other**.
4. Não preencha comandos de build nem diretório de saída.
5. Clique em **Deploy**.

Cada novo push na branch `main` será publicado automaticamente.

## 📱 Alterar o WhatsApp

No arquivo `index.html`, localize `WHATSAPP_C2F` e substitua o número no formato internacional, somente com dígitos:

```js
const WHATSAPP_C2F = '5555999827869';
```

O prefixo `55` representa o Brasil. Depois dele vêm o DDD e o número.

## 📁 Estrutura de Pastas

- `/assets/img`: Contém o logo e imagens do site.
- `/assets/css`: Estilos personalizados.
- `index.html`: Página principal, catálogo e formulário.

> Por segurança do navegador, a imagem selecionada não pode ser anexada automaticamente ao WhatsApp. O cliente recebe uma orientação na mensagem para anexá-la na conversa.

---
Desenvolvido para **C2F Maker - 3D & Engenharia Elétrica**.
