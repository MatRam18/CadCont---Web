<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
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
    <nav>
        <ul>
            <li>
                <a href="/homepage">Home</a>
                <a href="http://eelslap.com/">Serviços</a>
                <button onclick="window.location.href='/login'">Sair</button>
            </li>
        </ul>
    </nav>
    <main>
        <section>
            <img src="" alt="Perfil">
            <h1>Perfil</h1>
            <h1>Nome:</h1>
            <input type="text" name="nome" id="nome">
            <h1>Email:</h1>
            <input type="text" name="email" id="email">
            <h1>Senha:</h1>
            <input type="password" name="senha" id="senha">
            <button onclick="window.location.href='/editprofile'">Editar</button>
        </section>
    </main>
    <footer>
        <p>
            &copy; 2024 Cadastro de Contatos. Todos os direitos reservados.
        </p>
    </footer>
</body>
</html>