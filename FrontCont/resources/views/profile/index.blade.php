<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
    <style>
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }
        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #e3e3e3;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px #0001;
            overflow: hidden;
            position: relative;
        }
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-avatar svg {
            width: 60px;
            height: 60px;
            fill: #888;
        }
        .camera-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 2px solid #ccc;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            position: absolute;
            left: 50%;
            bottom: -18px;
            transform: translateX(-50%);
            cursor: pointer;
            box-shadow: 0 2px 8px #0002;
            transition: background 0.2s;
        }
        .camera-btn:hover {
            background: #f0f0f0;
        }
        .camera-btn svg {
            width: 22px;
            height: 22px;
            fill: #444;
        }
        .profile-info {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px #0002;
            padding: 24px 36px;
            text-align: center;
            min-width: 260px;
            margin-top: 30px;
        }
        .profile-info h3 {
            margin: 0 0 10px 0;
            font-size: 1.5em;
            color: #222;
        }
        .profile-info p {
            margin: 0;
            font-size: 1.1em;
            color: #444;
        }
        .profile-label {
            color: #888;
            font-size: 0.95em;
            margin-bottom: 2px;
        }
        .profile-form {
            margin-top: 24px;
        }
        .profile-form input[type="text"] {
            margin-bottom: 10px;
            padding: 6px;
            width: 80%;
        }
        .profile-form button {
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
            background: #222;
            color: #fff;
            cursor: pointer;
        }
        .profile-form button:hover {
            background: #444;
        }
        .profile-status {
            color: green;
            margin-top: 10px;
        }
        input[type="file"] {
            display: none;
        }
    </style>
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
            <div class="profile-container">
                <div class="profile-avatar" id="profileAvatar">
                    @if(isset($profile['photo']) && $profile['photo'])
                        <img src="{{ $profile['photo'] }}" alt="Foto de perfil" id="profilePhotoImg">
                    @else
                        <svg id="profilePhotoImg" viewBox="0 0 64 64">
                            <circle cx="32" cy="24" r="16"/>
                            <ellipse cx="32" cy="50" rx="20" ry="12"/>
                        </svg>
                    @endif
                    <label class="camera-btn" for="photoInput" title="Alterar foto de perfil">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm-7 5c0-3.866 3.134-7 7-7s7 3.134 7 7-3.134 7-7 7-7-3.134-7-7zm16-7h-2.586l-1.707-1.707A.997.997 0 0 0 15 3h-6a.997.997 0 0 0-.707.293L6.586 5H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm0 14H4V7h4.586l1.707-1.707A.997.997 0 0 1 11 5h2c.265 0 .52.105.707.293L15.414 7H20v10z"/>
                        </svg>
                    </label>
                    <form id="photoForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                        @csrf
                        <input type="file" name="photo" id="photoInput" accept="image/*">
                        <input type="hidden" name="name" value="{{ $profile['name'] ?? '' }}">
                        <input type="hidden" name="current_photo" value="{{ $profile['photo'] ?? '' }}">
                    </form>
                </div>
                <div class="profile-info">
                    <h3>Bem-vindo!</h3>
                    <div class="profile-label">Email</div>
                    <p>{{ $user['email'] }}</p>
                    <div class="profile-label">Nome</div>
                    <form class="profile-form" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="Seu nome" value="{{ $profile['name'] ?? '' }}" required>
                        <input type="hidden" name="current_photo" value="{{ $profile['photo'] ?? '' }}">
                        <button type="submit">Atualizar Nome</button>
                    </form>
                    @if(session('status'))
                        <div class="profile-status">{{ session('status') }}</div>
                    @endif
                </div>
            </div>
        </section>
    </main>
    <script>
        // Botão de foto de perfil
        document.getElementById('photoInput').addEventListener('change', function() {
            if (this.files.length > 0) {
                document.getElementById('photoForm').submit();
            }
        });

        const criarContatoBtn = document.getElementById('criarContatoBtn');
        if (criarContatoBtn) {
            criarContatoBtn.addEventListener('click', function() {
                window.location.href = '/newcontact';
            });
        }
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function() {
                window.location.href = '/logout';
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
