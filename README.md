Sistema para geração e gerenciamento de documentos na pré e pós banca das 
defesas do setor de pós-graduação da FFLCH. 
 
Pacotes para Ubuntu 16.04:
  
    sudo apt-get install apache2 php libapache2-mod-php php-mbstring php-xml -y
    sudo apt-get install postgresql php-pgsql php-gd
    dpkg-reconfigure locales # escolher pt_BR.UTF-8

Instalação do composer:

    wget https://getcomposer.org/installer
    php installer
    sudo mv composer.phar /usr/local/bin/composer

Criação de usuário e banco de dados:

    su postgres
    psql
    CREATE USER defesas WITH PASSWORD 'defesas';
    CREATE DATABASE defesas WITH OWNER defesas;

Import do dump:

    psql -U defesas defesas -h localhost -W -f dbschemas/defesas_1.0.sql 

Aplicar updates do banco:

    psql -U defesas defesas -h localhost -W -f dbschemas/update_1.0-1.1.sql 

Informações de acesso ao banco:

    cp default.config.php config.php
    
Dependências:
 
    composer install

Acessar via web:

    Usuário padrão: 123
    Senha padrão: 123

[dica] Dump do banco de dados de produção para testes locais:

    pg_dump -U defesas defesas -h 0.0.0.0 -W > dump.sql

Subir server local para desenvolvimento:

    cd defesas
    php -S localhost:8787 -t .
