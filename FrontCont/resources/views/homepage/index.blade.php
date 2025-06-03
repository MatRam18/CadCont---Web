<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  
    
</head>
<body>
    <aside>
        <div class="button-container">
            <button class="image-button">
                <img src="{{ asset('images/Criar.png') }}" alt="Contato" class="button-icon">
            </button>
        </div>
        <div class="button-container">
            <button class="image-button">
                <img src="{{ asset('images/logout.png') }}" alt="Logout" class="button-icon">
            </button>
        </div>
        <div class="button-container">
            <button class="image-button">
                <img src="{{ asset('images/Profile.png') }}" alt="Perfil" class="button-icon">
            </button>
        </div>
    </aside>
    <main>
        <article class="content-box">
            <h2>Artigo</h2>
            <p>Conteúdo do artigo aqui</p>
        </article>
        <section class="content-box">
            <h2>Seção</h2>
            <p>Conteúdo da seção aqui</p>
        </section>
    </main>
</body>
</html>