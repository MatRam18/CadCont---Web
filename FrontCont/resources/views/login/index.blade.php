<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/login.css')
    @vite('resources/css/footer.css')
    @vite('resources/css/header.css')
    @vite('resources/css/nav.css')
    <title>Login</title>
</head>
<body>
    <header>
        <h1>
            CAD CONTACT
        </h1>
        <h1>
            Cadastro de Contatos
        </h1>
    </header>
    <main>
        <div class="login-title">
            <h1> Login </h1>
        </div>
        <section>
            <form action="">
                <div>
                    <h3> Email </h3>
                    <input type="text" name="email" id="email" class="input-login">
                </div>
                <div>
                    <h3> Senha </h3>
                    <input type="password" name="password" id="password" class="input-login">
                </div>
                <div>
                    <button type="submit" class="button-login">Entrar</button>
                </div>
                <div>
                    <a href="/cadastro" class="link-login">Criar uma conta</a>
                    <a href="https://www.youtube.com/watch?v=WxDCVvZseyk" class="link-login">Esqueci a senha</a>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>
            &copy; 2024 Cadastro de Contatos. Todos os direitos reservados.
        </p>
    </footer>
</body>
</html>