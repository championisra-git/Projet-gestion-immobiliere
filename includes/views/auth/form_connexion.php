<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --bg: #f5f3ef;
            --surface: #ffffff;
            --border: #e2ddd6;
            --text: #1a1714;
            --muted: #8a847c;
            --accent: #2563eb;
            --accent-light: #eff6ff;
            --error: #c0392b;
            --error-light: #fdf0ef;
            --shadow: 0 1px 3px rgba(0,0,0,0.08), 0 8px 32px rgba(0,0,0,0.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .wrapper {
            width: 100%;
            max-width: 420px;
        }

        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            background: var(--text);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .brand h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            font-weight: 400;
        }

        .brand p {
            color: var(--muted);
            font-size: 0.875rem;
            margin-top: 0.3rem;
        }

        .card {
            background: var(--surface);
            border-radius: 14px;
            box-shadow: var(--shadow);
            padding: 2rem;
        }

        /* Alerte erreur globale */
        .alert-error {
            background: var(--error-light);
            border: 1px solid #f5c6c2;
            border-radius: 7px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: var(--error);
            margin-bottom: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--muted);
            margin-bottom: 0.4rem;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        input {
            width: 100%;
            padding: 0.7rem 0.9rem 0.7rem 2.5rem;
            border: 1px solid var(--border);
            border-radius: 7px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            background: var(--surface);
            color: var(--text);
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }

        input.is-error { border-color: var(--error); }
        input.is-error:focus { box-shadow: 0 0 0 3px rgba(192,57,43,0.1); }

        .field-error {
            display: block;
            color: var(--error);
            font-size: 0.78rem;
            margin-top: 0.3rem;
        }

        /* Toggle mot de passe */
        .toggle-pwd {
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            padding: 0;
            display: flex;
            align-items: center;
        }

        .toggle-pwd:hover { color: var(--text); }

        input[type="password"], input[type="text"].pwd-field {
            padding-right: 2.5rem;
        }

        /* Remember me */
        .remember {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .remember label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            text-transform: none;
            letter-spacing: 0;
            color: var(--text);
            font-size: 0.85rem;
            font-weight: 400;
            cursor: pointer;
            margin: 0;
        }

        .remember input[type="checkbox"] {
            width: 16px;
            height: 16px;
            padding: 0;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .forgot {
            color: var(--accent);
            font-size: 0.85rem;
            text-decoration: none;
        }

        .forgot:hover { text-decoration: underline; }

        /* Bouton */
        .btn-submit {
            width: 100%;
            padding: 0.78rem;
            background: var(--text);
            color: #fff;
            border: none;
            border-radius: 7px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
            letter-spacing: 0.01em;
        }

        .btn-submit:hover { background: #333; }

        /* Lien inscription */
        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--muted);
        }

        .signup-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="wrapper">

    <div class="brand">
        <div class="brand-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </div>
        <h1>Gestion Immobilière</h1>
        <p>Connectez-vous à votre espace</p>
    </div>

    <div class="card">

        <?php if (!empty($errors['global'])): ?>
            <div class="alert-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <?= htmlspecialchars($errors['global']) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">

            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="votre@email.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        class="<?= !empty($errors['email']) ? 'is-error' : '' ?>"
                        required
                        autocomplete="email"
                    >
                </div>
                <?php if (!empty($errors['email'])): ?>
                    <span class="field-error"><?= htmlspecialchars($errors['email']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        class="<?= !empty($errors['password']) ? 'is-error' : '' ?>"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="toggle-pwd" onclick="togglePwd('password', this)" title="Afficher/masquer">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                <?php if (!empty($errors['password'])): ?>
                    <span class="field-error"><?= htmlspecialchars($errors['password']) ?></span>
                <?php endif; ?>
            </div>

            <div class="remember">
                <label>
                    <input type="checkbox" name="remember" <?= isset($_POST['remember']) ? 'checked' : '' ?>>
                    Se souvenir de moi
                </label>
                <a href="forgot.php" class="forgot">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>

        </form>
    </div>

    <div class="signup-link">
        Pas encore de compte ? <a href="inscription.php">S'inscrire</a>
    </div>

</div>

<script>
function togglePwd(inputId, btn) {
    const input = document.getElementById(inputId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.innerHTML = isHidden
        ? `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`
        : `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
}
</script>

</body>
</html>