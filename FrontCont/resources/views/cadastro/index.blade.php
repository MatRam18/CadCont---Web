<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="{{ asset('css/cad.css') }}">
</head>
<body>
    <main>
        <div class="title">
            <h1> Cadastro </h1>
        </div>
        <section class="content-box">
            <form action="">
                <div>
                    <h3> Email </h3>
                    <input type="text" name="email" id="email" class="input-cad">
                </div>
                <div>
                    <h3> Nome </h3>
                    <input type="text" name="name" id="name" class="input-cad">
                </div>
                <div>
                    <h3> Senha </h3>
                    <input type="password" name="password" id="password" class="input-cad">
                </div>
                <div>
                    <h3> Confirmar Senha </h3>
                    <input type="password" name="confirm-password" id="confirm-password" class="input-cad">
                </div>
                <div>
                    <h3> Telefone </h3>
                    <input type="tel" name="tel" id="tel" class="input-tel">
                </div>
                <div class="cad-button">
                    <button type="submit" class="button-cad">Entrar</button>
                    <a href="/login" class="link-cad"> Já possui uma conta? Faça login </a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>