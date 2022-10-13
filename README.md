## Prerequisites
- PHP 8.0
- Composer
- Docker

--------------------
### Processo instalação do projeto no "**WINDOWS**"

- iniciando os containers.

```sh
docker-compose up -d --build
```
- Lembre-se de aguardar o build finalizar.
- Entrar no container **teste-dev-php-fpm-1**

```sh
docker exec -it teste-dev-php-fpm-1 sh
```
- Digitar comandos a seguir dentro do container acima:


```sh
composer install
```

```sh
php bin/console doctrine:migrations:diff
```

```sh
php bin/console doctrine:migrations:migrate
```

- digitar **yes**

```sh
php bin/console doctrine:fixtures:load
```
- digitar **yes**

### Acessos
Banco de dados local:
- host: localhost
- port: 3306
- userName: teste
- password: teste
--------------------
API:

```sh 
http://localhost:8088/api/user/getall
```
 
### Documentação
- [Symfony](https://symfony.com/doc/current/doctrine.html)
- [Docker](https://docs.docker.com/)
- [Composer](https://getcomposer.org/)

------------------------------------
### Objetivos:
- implementar um CRUD na controller de usúarios, somente backend por que será tudo via API
- adicionar 2 novos campos na entidade user, são eles:
  - cidade
  - cpf
- adicionar um novo usuário
- fazer um novo branch e commitar no repositório "teste-dev"
  - [Repositório](https://github.com/denakop/teste-dev)
- atualizar o arquivo AppFixtures
