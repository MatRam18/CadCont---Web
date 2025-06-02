<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    @vite('resources/css/cadastro.css')
    @vite('resources/css/footer.css')
    @vite('resources/css/header.css')
    @vite('resources/css/nav.css')
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
        <div class="cad-title">
            <h1> Cadastro </h1>
        </div>
        <section>
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
    <footer>
        <p>
            &copy; 2024 Cadastro de Contatos. Todos os direitos reservados.
        </p>
    </footer>
</body>
</html>