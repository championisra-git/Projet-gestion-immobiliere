<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
            --success: #1e8449;
            --success-light: #eaf7f0;
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
            max-width: 480px;
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

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group { display: flex; flex-direction: column; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--muted);
            margin-bottom: 0.4rem;
        }

        .input-wrap { position: relative; }

        .input-wrap svg {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        input, select {
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

        select { padding-left: 0.9rem; }

        input:focus, select:focus {
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

        /* Force du mot de passe */
        .pwd-strength {
            margin-top: 0.5rem;
        }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: var(--border);
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            border-radius: 2px;
            transition: width 0.3s, background 0.3s;
            width: 0%;
        }

        .strength-label {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 0.25rem;
        }

        /* CGU */
        .cgu {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: var(--text);
            grid-column: 1 / -1;
        }

        .cgu input[type="checkbox"] {
            width: 16px;
            height: 16px;
            min-width: 16px;
            padding: 0;
            margin-top: 2px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .cgu a { color: var(--accent); text-decoration: none; }
        .cgu a:hover { text-decoration: underline; }

        /* Séparateur */
        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1.4rem 0;
            grid-column: 1 / -1;
        }

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
            grid-column: 1 / -1;
            margin-top: 0.3rem;
        }

        .btn-submit:hover { background: #333; }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--muted);
        }

        .login-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover { text-decoration: underline; }

        /* Icône user */
        .no-icon { padding-left: 0.9rem !important; }
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
        <h1>Créer un compte</h1>
        <p>Rejoignez la plateforme de gestion immobilière</p>
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

        <form method="POST" action="inscription.php">
            <div class="form-grid">

                <!-- Prénom -->
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <div class="input-wrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <input type="text" id="prenom" name="prenom"
                            placeholder="Jean"
                            value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>"
                            class="<?= !empty($errors['prenom']) ? 'is-error' : '' ?>"
                            required autocomplete="given-name">
                    </div>
                    <?php if (!empty($errors['prenom'])): ?>
                        <span class="field-error"><?= htmlspecialchars($errors['prenom']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Nom -->
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <div class="input-wrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <input type="text" id="nom" name="nom"
                            placeholder="Dupont"
                            value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
                            class="<?= !empty($errors['nom']) ? 'is-error' : '' ?>"
                            required autocomplete="family-name">
                    </div>
                    <?php if (!empty($errors['nom'])): ?>
                        <span class="field-error"><?= htmlspecialchars($errors['nom']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form-group full">
                    <label for="email">Adresse e-mail</label>
                    <div class="input-wrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <input type="email" id="email" name="email"
                            placeholder="jean.dupont@email.com"
                            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                            class="<?= !empty($errors['email']) ? 'is-error' : '' ?>"
                            required autocomplete="email">
                    </div>
                    <?php if (!empty($errors['email'])): ?>
                        <span class="field-error"><?= htmlspecialchars($errors['email']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Téléphone -->
                <div class="form-group full">
                    <label for="telephone">Téléphone <span style="font-weight:400;text-transform:none;letter-spacing:0">(optionnel)</span></label>
                    <div class="input-wrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 .84h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.64a16 16 0 006.29 6.29l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                        <input type="tel" id="telephone" name="telephone"
                            placeholder="+241 01 23 45 67"
                            value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>"
                            autocomplete="tel">
                    </div>
                </div>

                <!-- Rôle -->
                <div class="form-group full">
                    <label for="role">Rôle</label>
                    <select id="role" name="role" required>
                        <option value="">— Choisir un rôle —</option>
                        <?php
                        $roles = ['proprietaire' => 'Propriétaire', 'locataire' => 'Locataire', 'gestionnaire' => 'Gestionnaire', 'admin' => 'Administrateur'];
                        $cur = $_POST['role'] ?? '';
                        foreach ($roles as $val => $label):
                        ?>
                            <option value="<?= $val ?>" <?= $cur === $val ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['role'])): ?>
                        <span class="field-error"><?= htmlspecialchars($errors['role']) ?></span>
                    <?php endif; ?>
                </div>

                <hr class="divider">

                <!-- Mot de passe -->
                <div class="form-group full">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input type="password" id="password" name="password"
                            placeholder="Minimum 8 caractères"
                            class="<?= !empty($errors['password']) ? 'is-error' : '' ?>"
                            required autocomplete="new-password"
                            oninput="checkStrength(this.value)">
                        <button type="button" class="toggle-pwd" onclick="togglePwd('password', this)">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <div class="pwd-strength">
                        <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                        <div class="strength-label" id="strengthLabel">Entrez un mot de passe</div>
                    </div>
                    <?php if (!empty($errors['password'])): ?>
                        <span class="field-error"><?= htmlspecialchars($errors['password']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Confirmation mot de passe -->
                <div class="form-group full">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <div class="input-wrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input type="password" id="password_confirm" name="password_confirm"
                            placeholder="Répétez votre mot de passe"
                            class="<?= !empty($errors['password_confirm']) ? 'is-error' : '' ?>"
                            required autocomplete="new-password">
                        <button type="button" class="toggle-pwd" onclick="togglePwd('password_confirm', this)">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <?php if (!empty($errors['password_confirm'])): ?>
                        <span class="field-error"><?= htmlspecialchars($errors['password_confirm']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- CGU -->
                <div class="cgu">
                    <input type="checkbox" id="cgu" name="cgu" required <?= isset($_POST['cgu']) ? 'checked' : '' ?>>
                    <label for="cgu" style="text-transform:none;letter-spacing:0;font-weight:400;color:var(--text);margin:0;cursor:pointer;">
                        J'accepte les <a href="cgu.php" target="_blank">conditions générales d'utilisation</a>
                    </label>
                </div>
                <?php if (!empty($errors['cgu'])): ?>
                    <span class="field-error" style="grid-column:1/-1"><?= htmlspecialchars($errors['cgu']) ?></span>
                <?php endif; ?>

                <button type="submit" class="btn-submit">Créer mon compte</button>

            </div>
        </form>
    </div>

    <div class="login-link">
        Déjà un compte ? <a href="login.php">Se connecter</a>
    </div>

</div>

<script>
function togglePwd(inputId, btn) {
    const input = document.getElementById(inputId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.innerHTML = isHidden
        ? `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`
        : `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
}

function checkStrength(pwd) {
    const fill  = document.getElementById('strengthFill');
    const label = document.getElementById('strengthLabel');

    let score = 0;
    if (pwd.length >= 8)               score++;
    if (/[A-Z]/.test(pwd))             score++;
    if (/[0-9]/.test(pwd))             score++;
    if (/[^A-Za-z0-9]/.test(pwd))      score++;

    const levels = [
        { pct: '0%',   color: 'transparent',  text: 'Entrez un mot de passe' },
        { pct: '25%',  color: '#c0392b',       text: 'Très faible' },
        { pct: '50%',  color: '#e67e22',       text: 'Faible' },
        { pct: '75%',  color: '#f1c40f',       text: 'Moyen' },
        { pct: '100%', color: '#27ae60',       text: 'Fort' },
    ];

    const lvl = pwd.length === 0 ? levels[0] : levels[score];
    fill.style.width     = lvl.pct;
    fill.style.background = lvl.color;
    label.textContent    = lvl.text;
    label.style.color    = lvl.color === 'transparent' ? 'var(--muted)' : lvl.color;
}
</script>

</body>
</html>