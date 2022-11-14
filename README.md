# Desafio Back-End

<p>O objetivo desse projeto consiste em uma aplicação que realiza consultas em uma API que 
retorna as ações de determinada empresa da bolsa. O projeto foi desenvolvido com o framework Laravel.</p>

### Instalação

Realize o clone do repositório e execute
> composer install
- `Composer Install`: Instala as dependências da aplicação, [clique aqui](https://getcomposer.org/) caso não tenha composer instalado.
<p>Realize uma cópia do arquivo <b>.env.example</b>, definindo como <b>.env</b> para que consiga 
definir as variáveis de ambientes da aplicação. Abaixo estarão as informações pré-definidas que você deverá preencher com as informações do banco de dados que irá utilizar.</p>

>DB_CONNECTION=mysql <br>
DB_HOST=127.0.0.1 <br>
DB_PORT=3306 <br>
DB_DATABASE=banco_de_dados <br>
DB_USERNAME=usuario_banco_de_dados <br>
DB_PASSWORD=senha_banco_de_dados <br>

Neste arquivo você encontrará os dados de autenticação para a API externa, que devem ser obtidos e mantidos neste arquivo, são eles: 
>IEX_BASE_URL=url_aqui <br>
IEX_TOKEN=token_aqui <br>

<p>Após definir os dados necessários para conexão com seu banco de dados, execute o seguinte comando para criar as tabelas.</p>

> php artisan migrate

 ### Iniciando a aplicação

Para iniciar a aplicação, por padrão, o Laravel irá iniciar no endereço (http://localhost:8000), executando o comando
> php artisan serve

Você pode se registrar na aplicação utilizando e fazer o login. Se preferir, pode rodar o comando `php artisan db:seed` que será gerado um usuário test para que possa acessar a aplicação.
>email: test@example.com <br>
>senha: 123456

