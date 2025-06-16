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
            <button class="image-button" id="perfilBtn">
                <img src="{{ asset('images/Profile.png') }}" alt="Perfil" class="button-icon">
            </button>
        </div>
    </aside>
    <main>
        <article class="content-box">
            <h2>Contatos</h2>
            @if(is_array($contato) && count($contato) > 0)
                @foreach($contato as $item)
                    <p class="contact-item"
                       data-contact-id="{{ $item['id'] ?? '0' }}"
                       data-contact-nome="{{ $item['Nome'] ?? 'N/A' }}"
                       data-contact-email="{{ $item['email'] ?? 'N/A' }}"
                       data-contact-idade="{{ $item['idade'] ?? 'N/A' }}"
                       data-contact-telefone="{{ $item['telefone'] ?? 'N/A' }}">
                       {{ $item['Nome'] ?? 'N/A' }}
                   </p>
                @endforeach
            @else
                <p>Nenhum contato encontrado.</p>
            @endif
        </article>
        <section class="content-box">
            <h2>Detalhes do Contato</h2>
            <div class="detalhes-item">
                <p  id="detalhes"><b>Nome:</b><br> <b>Email:</b><br> <b>Idade:</b><br> <b>Telefone:</b></p>
                <div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentContactId = null; // Variável para armazenar o ID do contato atualmente selecionado

            function ExibirInfo(id){
                const detalhes = document.getElementById('detalhes');
                const clickedItem = document.querySelector(`.contact-item[data-contact-id="${id}"]`);
                
                // Remover a classe 'active' de todos os itens e adicionar ao clicado
                document.querySelectorAll('.contact-item').forEach(item => {
                    item.classList.remove('active');
                });
                if (clickedItem) {
                    clickedItem.classList.add('active');
                    currentContactId = id; // Armazena o ID do contato ativo

                    const nome = clickedItem.dataset.contactNome;
                    const email = clickedItem.dataset.contactEmail;
                    const idade = clickedItem.dataset.contactIdade;
                    const telefone = clickedItem.dataset.contactTelefone;

                    detalhes.innerHTML = `
                        <p class="content-detalhe"><b>Nome:</b> ${nome}</p>
                        <p class="content-detalhe"><b>Email:</b> ${email}</p>
                        <p class="content-detalhe"><b>Idade:</b> ${idade}</p>
                        <p class="content-detalhe"><b>Telefone:</b> ${telefone}</p>
                        <div>
                            <button class="button-p" id="editBtn">Editar</button>
                            <button class="button-n" id="deleteBtn">Excluir</button>
                        </div>
                    `;
                    // Adicionar event listeners após a renderização do HTML
                    document.getElementById('editBtn').addEventListener('click', toggleEditMode);
                    document.getElementById('deleteBtn').addEventListener('click', function() {
                        if (confirm('Tem certeza que deseja excluir este contato?')) {
                            window.location.href = `/deletecontact/${currentContactId}`;
                        }
                    });
                }
            }

            function toggleEditMode() {
                const detalhes = document.getElementById('detalhes');
                const clickedItem = document.querySelector(`.contact-item[data-contact-id="${currentContactId}"]`);
                if (!clickedItem) return;

                const nome = clickedItem.dataset.contactNome;
                const email = clickedItem.dataset.contactEmail;
                const idade = clickedItem.dataset.contactIdade;
                const telefone = clickedItem.dataset.contactTelefone;

                detalhes.innerHTML = `
                    <p class="content-detalhe"><b>Nome:</b> ${nome}<input type="text" id="editNome" value="${nome}" class="edit-input-field"></p>
                    <p class="content-detalhe"><b>Email:</b> ${email} <input type="email" id="editEmail" value="${email}" class="edit-input-field"></p>
                    <p class="content-detalhe"><b>Idade:</b> ${idade} <input type="number" id="editIdade" value="${idade}" class="edit-input-field"></p>
                    <p class="content-detalhe"><b>Telefone:</b> ${telefone} <input type="text" id="editTelefone" value="${telefone}" class="edit-input-field"></p>
                    <div>
                        <button class="button-p" id="confirmBtn">Confirmar</button>
                        <button class="button-n" id="cancelBtn">Cancelar</button>
                    </div>
                `;
                document.getElementById('confirmBtn').addEventListener('click', confirmEdit);
                document.getElementById('cancelBtn').addEventListener('click', cancelEdit);
            }

            async function confirmEdit() {
                const nome = document.getElementById('editNome').value;
                const email = document.getElementById('editEmail').value;
                const idade = document.getElementById('editIdade').value;
                const telefone = document.getElementById('editTelefone').value;

                const data = {
                    id: currentContactId,
                    Nome: nome || document.querySelector(`.contact-item[data-contact-id="${currentContactId}"]`).dataset.contactNome,
                    email: email || document.querySelector(`.contact-item[data-contact-id="${currentContactId}"]`).dataset.contactEmail,
                    idade: idade || document.querySelector(`.contact-item[data-contact-id="${currentContactId}"]`).dataset.contactIdade,
                    telefone: telefone || document.querySelector(`.contact-item[data-contact-id="${currentContactId}"]`).dataset.contactTelefone,
                    _token: '{{ csrf_token() }}' // Adiciona o token CSRF
                };

                try {
                    const response = await fetch(`/contactupdate/${currentContactId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': data._token // Adiciona o token CSRF ao cabeçalho
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        alert('Contato atualizado com sucesso!');
                        window.location.reload(); // Recarrega a página após o update
                    } else {
                        const errorData = await response.json();
                        alert('Erro ao atualizar contato: ' + errorData.message || response.statusText);
                    }
                } catch (error) {
                    console.error('Erro na requisição:', error);
                    alert('Ocorreu um erro ao conectar com o servidor.');
                }
            }

            function cancelEdit() {
                if (currentContactId) {
                    ExibirInfo(currentContactId);
                }
            }

            const contactItems = document.querySelectorAll('.contact-item');
            contactItems.forEach(item => {
                item.addEventListener('click', function() {
                    const contactId = this.dataset.contactId;
                    ExibirInfo(contactId);
                });
            });

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
            const perfilBtn = document.getElementById('perfilBtn');
            if (perfilBtn) {
                perfilBtn.addEventListener('click', function() {
                    window.location.href = '/profile';
                });
            }
        });
    </script>
</body>
</html>
