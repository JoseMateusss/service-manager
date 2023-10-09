# Mini Sistema de Gestão de Ordens de Serviços

Este é um mini sistema de gestão de ordens de serviços desenvolvido como parte de um teste prático para uma vaga de desenvolvedor web. O sistema foi construído utilizando Laravel na versão 10 e Tailwind CSS.

## Funcionalidades Principais

1. **Autenticação e Autorização:**
    - O sistema oferece autenticação e autorização para os usuários.
    - Os usuários podem criar grupos de acesso e definir regras de segurança para outros usuários.

2. **Gestão de Grupos de Acesso:**
    - Os usuários podem criar grupos de acesso e associar regras de segurança a eles.

3. **Ordens de Serviços:**
    - Os usuários podem criar ordens de serviços.
    - Os usuários têm a capacidade de gerenciar suas ordens de serviços, incluindo edição e exclusão.

## Tecnologias Utilizadas

- **Laravel 10:** Framework PHP para o desenvolvimento da aplicação.
- **Tailwind CSS:** Framework de CSS para estilização e design responsivo.

## Instruções de Execução

1. **Pré-requisitos:**
    - Certifique-se de ter o PHP, Composer e todas as dependências do Laravel instaladas em seu sistema.
    - Tenha o Node.js e npm (Node Package Manager) instalados.

2. **Clonagem e Configuração:**
    - Clone este repositório e configure o ambiente de acordo com as orientações do Laravel.

3. **Instalação de Dependências:**
    - Execute `composer install` para instalar todas as dependências do projeto.
    - Execute `npm install` para instalar as dependências JavaScript.

4. **Configuração do Banco de Dados:**
    - Configure o arquivo `.env` com as credenciais do seu banco de dados.

5. **Migração e Seed:**
    - Execute `php artisan migrate` para criar as tabelas no banco de dados.
    - Execute `php artisan db:seed` para popular o banco de dados com dados iniciais.

6. **Compilação de Assets:**
    - Execute `npm run dev` para compilar os assets.

7. **Execução da Aplicação:**
    - Execute `php artisan serve` para iniciar o servidor local.

8. **Acesso à Aplicação:**
    - Acesse a aplicação através do URL fornecido pelo servidor local.

## Notas

Este projeto foi desenvolvido como parte de um teste prático para uma vaga de desenvolvedor web e possui funcionalidades limitadas. Fique à vontade para expandir e aprimorar conforme necessário para atender aos requisitos e escopo completos do sistema.
