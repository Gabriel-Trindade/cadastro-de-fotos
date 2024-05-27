# Meu Projeto CakePHP

Este é um projeto em CakePHP que realiza o cadastro de fotos, incluindo sua visualização, edição e exclusão.

## Pré-requisitos

Certifique-se de ter o seguinte instalado em seu sistema:

-   [PHP](https://www.php.net) (versão 8.2.4 ou superior)
-   [Composer](https://getcomposer.org/download/)
-   [MySQL](https://dev.mysql.com/downloads/installer/)

## Passos para Inicializar o Projeto

1. **Clone o Repositório:**

    ```bash
    git clone https://github.com/Gabriel-Trindade/cadastro-de-fotos
    cd cadastro-de-fotos
    ```

2. **Instale as dependências:**

    ```bash
    composer install
    ```

 - O composer irá perguntar se deve setar as permissões de pasta, digite:

    ```bash
       Y
    ```

3. **Configure o banco de dados:**

- Primeiramente crie o banco de dados que o cakephp irá receber os dados (recomendo o nome photo_gallery ou relacionados).

- Vá até a pasta config e procure por app_local.php, no array de 'DataSources', configure o host, username, password e o database em que você irá fazer a migração do banco de dados.

-   Após isso, vá até o console e rode:

    ```bash
    bin/cake migrations migrate
    ```

4. **Inicie o servidor de desenvolvimento (NÃO UTILIZE XAMPP)**

    ```bash
    bin/cake server
    ```

5. **Acesse o projeto:**

-   Abra o navegador e acesse http://localhost:8765.

## Notas Adicionais

 - Caso tenha problemas com as migrações, verifique se o usuário do MySQL tem permissões para criar e alterar bancos de dados.
 - Para mais informações sobre o CakePHP e como desenvolver com ele, consulte a [documentação oficial](https://book.cakephp.org/4/en/).
 - O código se baseia no controller de PhotosController em que faz todos os principais componentes funcionarem, utilizei para estilizar bootstrap, jquery e isotope para o grid de fotos.
