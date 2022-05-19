# PHP Morderno: Criando uma aplicação com área administrativa

Esse projeto faz parte das aulas ministradas na plataforma da https://academy.satellasoft.com, seu material e conteúdo se restringe apenas para uso não comercial e com fins para acompanhamento das aulas.


# Área administrativa

Acesso a área administrativa

Para realizar o acesso, é necessário efetuar o login em **http://localhost/php-moderno/login/**, para isso, um usuário e senha deve ter sido criado e o status do usuário deve estar ativo.

# Configurações

Há três pontos que requer uma prévia configuração de acordo com as explicações em aulas, mas também, é necessário criar dois arquivos **.htaccess** e por fim o arquivo **Config.php**. 
## .htaccess

Por padrão os arquivos .htaccess não são versionados, então, ao fazer o download desse projeto provavelmente você irá ver apenas os arquivos **.htaccess-tmp**.

Na root do projeto crie um novo arquivo chamado de **.htaccess**, em seguida, copiei todo o conteúdo do arquivo **.htaccess-tmp** e cole no arquivo que criou. Faça o mesmo processo para o diretório **/public**.

## Config

Dentro do diretório **app\Config**, criei um novo arquivo chamado de **Config.php**, sem seguida, copie todo o código do arquivo já existe **Config-tmp.php** para o arquivo que acabou de criar.

# Links uteis

- https://academy.satellasoft.com/course/php-moderno-criando-uma-aplicacao-com-area-administrativa


# Configurar Emmet Twig

Por padrão as páginas .twig não contém as abrevissões do Emmet, então, confira o link abaixo para fazer configurar o VS.

- https://www.codegrepper.com/code-examples/html/emmet+vscode+twig


# Campos de senha

Quando vamos cadastrar um novo usuário, uma boa prática é utilizar no **input type password**, o atributo **autocomplete** com o valor **new-password**. Confira o link abaixo com mais informações.

- https://web.dev/sign-in-form-best-practices/#new-password