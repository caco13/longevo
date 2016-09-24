# Longevo - SAC

## Configurações externas

1. Servidor web

Diretório público:
{dir_laravel}/public

2. Banco de dados

Criar banco de dados PostgreSQL

## Instalação

. Clonar repositório

1. Criar arquivo .env

- Em sistemas Unix-like executar (no diretório raiz do projeto):
$ cp .env.example .env
- Abrir arquivo .env e editar dados de acesso ao banco de dados PostgreSQL:
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

2. Permitir acesso dos diretórios de escrita pelo servidor

Em sistemas Unix-like executar (no diretório raiz do projeto):

\# chgrp -R www-data storage bootstrap/cache

\# chmod -R ug+rwx storage bootstrap/cache

3. Rodar <i>migragions</i>

Dentro do diretório do projeto executar:

$ php artisan migrate

4. Rodar <i>seeder</i>

Dentro do diretório do projeto executar:

$ php artisan db:seed

Obs: este comando ira inserir a massa de dados nas tabelas do banco de dados.