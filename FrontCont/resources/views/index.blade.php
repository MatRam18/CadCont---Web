<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Contatos</title>
    <link rel="stylesheet" href="{{ asset('css/init.css') }}" />
</head>
<body>
    <main>
        <header class="title">
            <h1 class="title-text">Cadastro de Contatos</h1>
        </header>

        <section class="content-box">
            <div class="welcome-message">
                <p>
                    Bem-vindo ao nosso sistema de cadastro de contatos! Aqui você pode gerenciar seus contatos de forma fácil e rápida.
                </p>
                <p>
                    Para começar, clique no botão <strong>"CADASTRE-SE AGORA"</strong> e preencha o formulário com as informações do seu contato.
                </p>
                <p>
                    Se você já possui um cadastro, pode acessar sua conta para visualizar ou editar seus contatos.
                </p>
            </div>

            <div class="button-container">
                <button id="registerBtn" aria-label="Cadastrar-se agora">
                    CADASTRE-SE AGORA
                </button>
                <button id="loginBtn" aria-label="Fazer login">
                    LOGIN
                </button>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('registerBtn').addEventListener('click', () => {
            window.location.href = '/cadastro';
        });

        document.getElementById('loginBtn').addEventListener('click', () => {
            window.location.href = '/login';
        });
    </script>
</body>
</html>
