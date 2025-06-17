<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="{{ asset('css/log.css') }}" />
</head>
<body>
    <main>
        <div class="title">
            <h1>Recuperar Senha</h1>
        </div>
        <section class="content-box">
            <form action="/forgotpassword" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu email" required />

                <button type="submit" class="button-login">Enviar link de recuperação</button>

                <div class="links">
                    <a href="/login">Voltar ao login</a>
                </div>
                @if(session('status'))
                    <div style="color:green; margin-top:10px;">
                        {{ session('status') }}
                    </div>
                @endif
                @if($errors->any())
                    <div style="color:red; margin-top:10px;">
                        {{ $errors->first() }}
                    </div>
                @endif
            </form>
        </section>
    </main>
</body>
</html>
