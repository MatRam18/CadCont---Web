<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro</title>
    <link rel="stylesheet" href="{{ asset('css/cad.css') }}" />
</head>
<body>
    <main>
        <div class="title">
            <h1>Cadastro</h1>
        </div>
        <section class="content-box">
            <form action="">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu email" required />

                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="Digite seu nome" required />

                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite sua senha" required />

                <label for="confirm-password">Confirmar Senha</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirme sua senha" required />

                <label for="tel">Telefone</label>
                <input type="tel" name="tel" id="tel" placeholder="(xx) xxxx-xxxx" />

                <div class="cad-button">
                    <button type="submit" class="button-cad">Cadastrar</button>
                    <a href="/login" class="link-cad">Já possui uma conta? Faça login</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
