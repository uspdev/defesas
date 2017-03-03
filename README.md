Sistema para geração e gerenciamento de documentos na pré e pós banca das 
defesas da pós-graduação da FFLCH. 
 
Pacotes para Ubuntu 16.04:
  
    sudo apt-get install apache2 php7.0 libapache2-mod-php7.0 -y
    sudo apt-get install postgresql php-pgsql php-gd
    dpkg-reconfigure locales # escolher en_US.UTF-8

Preparando banco de dados:

    su postgres
    export LANGUAGE="en_US.UTF-8"
    export LANG="en_US.UTF-8"
    export LC_ALL="en_US.UTF-8"
    psql
    CREATE USER defesas WITH PASSWORD 'defesas'; # \du para ver os usuários
    CREATE DATABASE defesas WITH OWNER=defesas ENCODING='UTF-8' LC_COLLATE='en_US.utf8' LC_CTYPE='en_US.utf8' TEMPLATE template0;
    \q
    exit
    psql -U defesas defesas -h localhost -W -f dbschemas/defesas_1.0.sql 

Aplicar refatorações no banco:

    psql -U defesas defesas -h localhost -W -f dbschemas/update_1.0-1.1.sql 

Informações de acesso ao banco:

    cp default.config.php config.php
    
Colocar biblioteca dompdf versão 6 em libraries/dompdf6:
 
    git clone https://github.com/dompdf/dompdf.git libraries/dompdf6
    cd libraries/dompdf6
    git submodule init
    git submodule update

Acessar via web:

    Usuário padrão: 123
    Senha padrão: 123



    #No servidor de produção:
    pg_dump -U defesas defesas -h 0.0.0.0 -W > dump.sql
