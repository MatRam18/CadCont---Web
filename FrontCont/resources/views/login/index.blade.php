<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/log.css') }}" />
</head>
<body>
    <main>
        <div class="title">
            <h1>Login</h1>
        </div>
        <section class="content-box">
            <form action="">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu email" required />

                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite sua senha" required />

                <button type="submit" class="button-login">Entrar</button>

                <div class="links">
                    <a href="/cadastro">Criar uma conta</a>
                    <a href="https://www.youtube.com/watch?v=WxDCVvZseyk" target="_blank" rel="noopener">Esqueci a senha</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
