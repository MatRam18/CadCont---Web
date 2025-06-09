<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/log.css') }}">  
</head>
<body>
    <main>
        <div class="title">
            <h1> Login </h1>
        </div>
        <section class="content-box">
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
</body>
</html>