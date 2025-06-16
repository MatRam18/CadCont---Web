<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Contato</title>
    <link rel="stylesheet" href="{{ asset('css/ncont.css') }}?v=1.0">  
</head>
<body>
    <aside>
        <div class="button-container">
            <button class="image-button" id="ContatoBtn">
                <img src="{{ asset('images/Contato.png') }}" alt="Contato" class="button-icon">
            </button>
        </div>
        <div class="button-container">
            <button class="image-button" id="logoutBtn">
                <img src="{{ asset('images/logout.png') }}" alt="Logout" class="button-icon">
            </button>
        </div>
        <div class="button-container">
            <button class="image-button" id="profileBtn">
                <img src="{{ asset('images/Profile.png') }}" alt="Perfil" class="button-icon">
            </button>
        </div>
    </aside>
    <main>
        <section class="content-box">
            <h2>Novo Contato</h2>
            <!-- <div class="detalhes-item"> -->
                <form id="newContactForm">
                    @csrf
                    <div class="content-detalhe">
                        <b>Nome:</b>
                        <input type="text" id="editNome" name="nome" class="edit-input-field" placeholder="Digite o nome">
                    </div>
                    <div class="content-detalhe">
                        <b>Email:</b>
                        <input type="email" id="editEmail" name="email" class="edit-input-field" placeholder="Digite o email">
                    </div>
                    <div class="content-detalhe">
                        <b>Idade:</b>
                        <input type="number" id="editIdade" name="idade" class="edit-input-field" placeholder="Digite a idade">
                    </div>
                    <div class="content-detalhe">
                        <b>Telefone:</b>
                        <input type="text" id="editTelefone" name="telefone" class="edit-input-field" placeholder="Digite o telefone">
                    </div>
                    <button type="submit" class="button-confirm" id="confirmBtn">Confirmar</button>
                </form>
            <!-- </div> -->
        </section>
    </main>
    <script>
        const criarContatoBtn = document.getElementById('ContatoBtn');
        if (criarContatoBtn) {
            criarContatoBtn.addEventListener('click', function() {
                window.location.href = '/homepage';
            });
        }
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function() {
                window.location.href = '/';
            });
        }
        const profileBtn = document.getElementById('profileBtn');
        if (profileBtn) {
            profileBtn.addEventListener('click', function() {
                window.location.href = '/profile';
            });
        }

        const newContactForm = document.getElementById('newContactForm');
        const confirmBtn = document.getElementById('confirmBtn');

        if (confirmBtn && newContactForm) {
            newContactForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                const nome = document.getElementById('editNome').value;
                const email = document.getElementById('editEmail').value;
                const idade = document.getElementById('editIdade').value;
                const telefone = document.getElementById('editTelefone').value;

                if (!nome || !email || !idade || !telefone) {
                    alert('Por favor, preencha todos os campos!');
                    return;
                }

                const csrfToken = document.querySelector('input[name="_token"]').value;

                try {
                    const response = await fetch('/newcontact', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            "Nome": nome,
                            "email": email,
                            "idade": idade,
                            "telefone": telefone
                        })
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const contentType = response.headers.get("content-type");
                    if (!contentType || !contentType.includes("application/json")) {
                        throw new TypeError("A resposta não é JSON!");
                    }

                    const data = await response.json();

                    if (data.success) {
                        alert(data.message);
                        window.location.href = '/homepage';
                    } else {
                        alert(data.message || 'Erro ao criar contato');
                    }
                } catch (error) {
                    console.error('Erro ao enviar o formulário:', error);
                    if (error instanceof TypeError) {
                        alert('Erro no formato da resposta do servidor. Por favor, tente novamente.');
                    } else {
                        alert('Ocorreu um erro ao tentar criar o contato. Por favor, tente novamente.');
                    }
                }
            });
        }
    </script>
</body>
</html>