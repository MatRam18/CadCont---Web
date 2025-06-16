<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">  
    
</head>
<body>
    <aside>
        <div class="button-container">
            <button class="image-button" id="criarContatoBtn">
                <img src="{{ asset('images/Criar.png') }}" alt="Contato" class="button-icon">
            </button>
        </div>
        <div class="button-container">
            <button class="image-button" id="logoutBtn">
                <img src="{{ asset('images/logout.png') }}" alt="Logout" class="button-icon">
            </button>
        </div>
        <div class="button-container">
            <button class="image-button" id="contatoBtn">
                <img src="{{ asset('images/contato.png') }}" alt="Perfil" class="button-icon">
            </button>
        </div>
    </aside>
    <main>
        <section class="content-box">
        <h2>Perfil</h2>
           
        </section>
    </main>
    <script>
        // Adiciona o evento de clique para o botão "Criar Contato"
        const criarContatoBtn = document.getElementById('criarContatoBtn');
        if (criarContatoBtn) {
            criarContatoBtn.addEventListener('click', function() {
                window.location.href = '/newcontact';
            });
        }
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function() {
                window.location.href = '/';
            });
        }
        const contatoBtn = document.getElementById('contatoBtn');
        if (contatoBtn) {
            contatoBtn.addEventListener('click', function() {
                window.location.href = '/homepage';
            });
        }
    </script>
</body>
</html>
