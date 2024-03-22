# Lugares App

Bem-vindo ao repositório do Lugares App! Este é um aplicativo desenvolvido para gerenciar lugares de forma eficiente e intuitiva.

## Começando

Para começar a utilizar o projeto, siga os passos abaixo para configurar o ambiente de desenvolvimento.

### Pré-requisitos

Antes de começar, você precisará ter instalado em sua máquina:

- Git
- Docker
- Docker Compose

### Instalação

1. **Clonar o repositório**

   Primeiro, clone o repositório do projeto utilizando o Git:

   git clone https://github.com/kage3f/lugares-app.git

2. **Navegue até a página**

   `cd lugares-app`

3. **Próximos passos**

   Digite o comando na raiz do projeto: `docker compose up`
   Após isso, o docker estará rodando com sucesso naquele terminal.

4 **Configurar Dependências.**

Abra um novo terminal na raiz do projeto e digite o seguinte comando: `docker compose exec app bash`
Após isso navegue até a pasta application: `cd application`
Digite o comando `composer install` e aperte enter.

5 **Últimas Configurações**

Use o comando `cp .env.example .env` isso vai criar um arquivo .env a partir do .env.example

O banco de dados já está configurado corretamente. A única coisa que precisará fazer é copiar o valor de APP_ENV do arquivo docker-compose que está na raiz do projeto para o arquivo .env, onde estará a variavel APP_ENV= você cola.

Para finalizar, Rode as migrations usando `php artisan migration` após isso está tudo pronto.

6 **Acessar aplicação**

O Docker cuida de tudo, não precisa de mais nenhum comando, nem de servidor. Basta acessar a rota `http://localhost:8000/` e você já vai perceber que está online o projeto.

7 **Sobre a API**

Rotas:
![Descrição alternativa](https://i.imgur.com/EdwACc5.png)

Abaixo estão as rotas disponíveis na aplicação Lugares App:

| Método | Rota              | Descrição                                      |
|--------|-------------------|------------------------------------------------|
| GET    | `/places`         | Lista todos os lugares cadastrados.            |
| POST   | `/places`         | Cria um novo lugar.                            |
| GET    | `/places/{id}`    | Exibe os detalhes de um lugar específico.      |
| PUT    | `/places/{id}`    | Atualiza os dados de um lugar específico.      |
| DELETE | `/places/{id}`    | Remove um lugar específico do sistema.         |

## Exemplo de Criação de Lugar

Para criar um novo lugar usando a rota `POST /places`, o corpo da requisição deve seguir o seguinte formato JSON:

```json
{
  "name": "Campo Futebol",
  "city": "São Paulo",
  "state": "SP"
}

```

## Arquitetura da Aplicação

Abaixo está o diagrama que ilustra a arquitetura da aplicação, mostrando como a aplicação foi estruturada utilizando interfaces, um repositório abstrato, o repositório específico `PlaceRepository`, a camada de serviço `PlaceService`, e o `PlaceController` para delegar as operações:

![Descrição alternativa](https://i.imgur.com/GZGJAr3.png)

Essa estrutura promove a separação de responsabilidades, facilita a manutenção e a testabilidade da aplicação.
