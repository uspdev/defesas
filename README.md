defesas
=======

Sistema de geração de documentos da Pós-Graduação FFLCH. 
 
Passos para deploy no ambiente dev:

1) Instalação de requisitos:
  
    sudo apt-get install apache2 postgresql php5-pgsql php5 php5-gd

2) Gera dump do banco na produção e importa no dev:

    #No servidor de produção:
    pg_dump -U defesas defesas -h 0.0.0.0 -W > dump.sql
    # No servidor dev:
    su postgres
    psql
    CREATE USER defesas WITH PASSWORD 'defesas';
    \du
    CREATE DATABASE defesas OWNER defesas ENCODING 'UTF8';
    \l
    \q
    psql -U defesas defesas -h localhost -W -f dump-1.0.sql 
    exit

3) Colocar dados de acesso ao banco:

    cp default.config.php config.php
    
4) Colocar biblioteca dompdf versão 6 em libraries/dompdf6:
 
    git clone https://github.com/dompdf/dompdf.git libraries/dompdf6
    cd libraries/dompdf6
    git submodule init
    git submodule update
