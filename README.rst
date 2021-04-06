***************
PETRUS portaria
***************

PETRUS é um sistema de portaria baseado na web, como alternativa multiplataforma
aos diversos softwares desktop, normalmente limitados a Windows.

Features
========

- Cadastro de dados dos visitantes (a implementar)
- Associação a crachá numerado (a implementar)
- Comunicação interna (a implementar)

Configuração
============
Para configurar o banco de dados edite o arquivo `./petrus/model/Connection.php`
com as configurações de seu schema. O arquivo `./petrus/example.sql` contém uma
carga de exemplo do PostgreSQL, ou editado para ser compatível com outro RDBMS.

O arquivo acima também adiciona o usuário 'admin' com a senha 'petrus'.

Algumas configurações são necessárias para o roteamento funcionar. Adicione as
configurações a seguir na diretiva correspondente à pasta petrus do seu arquivo
de VirtualHost. Opcionalmente você pode pôr esse código em um arquivo .htaccess
(ewww... por favor, não escolha essa opção!) na pasta petrus. Isso irá habilitar
o módulo Rewrite:
::

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !^public/.+$
        RewriteCond %{REQUEST_FILENAME} !^index.php.*$
        RewriteRule ^(.+)$ public/$1 [QSA,L]
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^public/(.*)$ index.php?p=$1 [QSA,L]
    </IfModule>

