<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contatos</title>
    <link rel="stylesheet" href="{{ asset('css/init.css') }}">  
</head>
<body>
    <main>
        <article class="title">
            <h1 class="title-text">Cadastro de Contatos</h1>
        </article>
        <section class="content-box">
            <div class="welcome-message">
                <p>
                    Bem-vindo ao nosso sistema de cadastro de contatos! Aqui você pode gerenciar seus contatos de forma fácil e rápida.
                </p>
                <p>
                    Para começar, clique no botão "CADASTRE-SE AGORA" e preencha o formulário com as informações do seu contato.
                </p>
                <p>
                    Se você já possui um cadastro, pode acessar sua conta para visualizar ou editar seus contatos.
                </p>
            </div>

            <div class="button-container">
                <button id="registerBtn">
                    CADASTRE-SE AGORA
                </button>
                <button id="loginBtn">
                    LOGIN
                </button>
            </div>
        </section>
    </main>
</body>
</html>