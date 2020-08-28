## Conceito

Agendamento de defesas.

## Funcionalidades

- Agendar defesas

## Procedimentos de deploy
 
- Adicionar a biblioteca PHP referente ao sgbd da base replicada

```bash
composer install
cp .env.example .env
```
- Editar o arquivo .env
    - Dados da conexão na base do sistema
    - Dados da conexão na base replicada
    - Nº USP dos funcionários da secretaria

As diretivas específicas do sistema `defesas` estão documentadas em `config/defesas.php`

- Configurações finais do framework e do sistema:

```bash
php artisan key:generate
php artisan migrate
```

- Publicando assets do AdminLTE

```bash
php artisan vendor:publish --provider="Uspdev\UspTheme\ServiceProvider" --tag=assets --force
```

Caso falte alguma dependência, siga as instruções do `composer`.

## Projetos utilizados

github: [uspdev/laravel-usp-theme](https://github.com/uspdev/laravel-usp-theme)

github: [uspdev/replicado](https://github.com/uspdev/replicado)

github: [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite)


## Contribuindo com o projeto

### Passos iniciais

Siga o guia no site do [uspdev](https://uspdev.github.io/contribua)

### Padrões de Projeto

Utilizamos a [PSR-2](https://www.php-fig.org/psr/psr-2/) para padrões de projeto. Ajuste seu editor favorito para a especificação.
