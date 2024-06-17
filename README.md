# Dev

É uma plataforma para facilitar compartilhamento de informações pessoais ou profissionais de membros de uma determinada empresa.



# Instalação
### Rodar comando composer install
```composer install```

### Criar atalho para o'bash vendor/bin/sail'

```bash
composer require laravel/sail --dev
```

```bash
	$ php artisan sail:install 
```

Pode usar este comando => ``` bash
 "alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'" ```que permitirar que utilize apenas o "sail up"
```

### Iniciando projeto

Agora copie o **.env-example** para um arquivo **.env** e gere uma nova gave do projeto conforme os comandos abaixo:
```bash
  $ cp .env.example .env
  $ php artisan key:generate
```

### Iniciando Banco de dados
Agora crie o banco de dados e as tabelas com o seguinte comando:
```bash
  $ sail artisan migrate
  $ sail artisan db:seed
```

### Use o npm para instalar o vue 

npm install 

Use o comando composer require tightenco/ziggy para o laravel
e depois use o npm i ziggy-js

