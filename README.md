# SISTEMA CADASTRO VENDAS
## Sistema para cadastro de vendas para vendedores que calcula a comissão das vendas e envia um relatório com a soma de todas as vendas efetuadas no dia.

### Tecnologias usadas
* PHP
* LARAVEL
* HTML5
* CSS
* BANCO DE DADOS SQL
* JAVASCRIPT

### Configurações para instalação

* Instalação do laravel 
* Configurar o arquivo web.php a Route de envio de email.
* Criar e configurar o arquivo .env nas linhas abaixo para recebimento dos emails.

MAIL_MAILER=smtp  
MAIL_HOST=smtp.mailtrap.io  
MAIL_PORT=2525    
MAIL_USERNAME=null  
MAIL_PASSWORD=null  
MAIL_ENCRYPTION=null  
MAIL_FROM_ADDRESS=null  
MAIL_FROM_NAME="${APP_NAME}"  

* Efetuar comando 'php artisan migrate' na pasta do projeto para criar as tabelas
* Efetuado todo o procedimento, executar o comando php artisan serve para visualizar a aplicação no navegador caso seja localhost
* O arquivo na views 'enviar-email' deve ser executado numa cron job no ultimo horario do dia para enviar o relatorio diario

