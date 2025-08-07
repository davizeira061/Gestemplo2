# Como Rodar o Projeto Gestemplo em Ambiente Local

## 1. Introdução

Este é um guia passo a passo para configurar e executar o sistema "Gestemplo" em um ambiente de desenvolvimento local.

O sistema foi gerado utilizando a ferramenta **PHPMaker 11**, uma versão de 2014. Isso significa que o código original foi feito para rodar em versões mais antigas do PHP.

**NOTA:** Foram feitas modificações nos arquivos de configuração (`ewcfg11.php`, `db.php`, `phpfn11.php`) para remover o uso de funções depreciadas e tornar o sistema compatível com **PHP 8+**.

## 2. Requisitos

Você precisará de um ambiente de servidor local. Ferramentas como [XAMPP](https://www.apachefriends.org/index.html) ou [WAMP](https://www.wampserver.com/en/) são as mais fáceis de usar, pois já vêm com tudo o que é necessário:

*   **Servidor Web:** Apache
*   **Banco de Dados:** MySQL ou MariaDB
*   **PHP:** Versão 7.4 ou superior

## 3. Passo a Passo da Instalação

### Passo 3.1: Configurar o Banco de Dados

1.  **Inicie o MySQL** através do painel de controle do seu servidor local (XAMPP, WAMP, etc.).
2.  Abra a ferramenta de gerenciamento de banco de dados, como o **phpMyAdmin**, que geralmente está acessível em `http://localhost/phpmyadmin`.
3.  **Crie um novo banco de dados.** Clique em "Novo" e dê ao banco o nome de **`gestemplo`**. Para o `collation`, escolha `utf8_general_ci`.
4.  **Importe a estrutura e os dados.** Com o banco `gestemplo` selecionado, vá para a aba "Importar". Clique em "Escolher arquivo" e selecione o arquivo `BASE-DE-DADOS.sql` que está na raiz do projeto. Ao final, clique em "Executar".

### Passo 3.2: Configurar os Arquivos do Projeto

1.  **Copie os arquivos do projeto** para a pasta raiz do seu servidor web.
    *   No **XAMPP**, essa pasta geralmente é `C:/xampp/htdocs/`. Você pode criar uma subpasta, por exemplo: `C:/xampp/htdocs/gestemplo/`.
    *   No **WAMP**, a pasta é `C:/wamp/www/`.

2.  **Verifique a configuração de conexão.** O arquivo `db.php` contém as credenciais de acesso ao banco de dados. A configuração padrão é a seguinte e geralmente funciona para ambientes locais padrão:

    ```php
    <?php
    // Informações de Conexão com banco de dados MySQL > 5.0

    define("EW_CONN_HOST", 'localhost'); // Servidor do BD
    define("EW_CONN_PORT",'');            // Porta (deixe em branco para padrão)
    define("EW_CONN_USER", 'root');      // Usuário do BD
    define("EW_CONN_PASS", '');          // Senha do BD (geralmente vazia no XAMPP)
    define("EW_CONN_DB", 'gestemplo');   // Nome do banco de dados
    ?>
    ```

    Se o seu ambiente local tiver uma senha para o usuário `root`, você deve preenchê-la no campo `EW_CONN_PASS`.

### Passo 3.3: Acessar a Aplicação

1.  **Inicie o serviço Apache** no seu servidor local.
2.  Abra seu navegador e acesse o endereço correspondente à pasta onde você colocou os arquivos.
    *   Se você colocou na raiz (`htdocs`), acesse: `http://localhost/`
    *   Se você criou uma subpasta `gestemplo`, acesse: `http://localhost/gestemplo/`

3.  Você será redirecionado para a tela de login. Use as credenciais padrão para entrar:
    *   **Usuário:** `Admin2`
    *   **Senha:** `707090`

## 4. Problemas Comuns e Soluções

### Erros de "Deprecated"

Ao rodar com uma versão mais nova do PHP (7.3+), você poderia encontrar erros de `Deprecated`. As modificações feitas neste projeto já corrigiram os problemas mais comuns. Se novos erros aparecerem, a causa provável é a incompatibilidade do código antigo com a versão do PHP utilizada.

### E se outros erros aparecerem?

A solução ideal para garantir total compatibilidade futura seria:
1.  Encontrar o arquivo de projeto do PHPMaker (um arquivo com extensão `.pmp`).
2.  Abrir este arquivo em uma **versão recente do PHPMaker**.
3.  Gerar o código novamente. A nova versão da ferramenta irá gerar código compatível com PHP 8+.

Como o arquivo `.pmp` não está presente neste repositório, a alternativa seria corrigir os erros pontualmente, como foi feito com os avisos de `Deprecated`.
