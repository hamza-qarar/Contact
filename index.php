<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktverwaltung</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f0f2f5;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1f36 0%, #2d3561 100%);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.3);
        }

        .sidebar-header {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-header .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
        }

        .sidebar-header .logo i {
            font-size: 22px;
            color: #7c83f5;
        }

        .sidebar-header .logo span {
            font-size: 17px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 24px;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .nav-item i {
            width: 20px;
            font-size: 16px;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #ffffff;
            border-left-color: rgba(124, 131, 245, 0.5);
        }

        .nav-item.active {
            background: rgba(124, 131, 245, 0.15);
            color: #ffffff;
            border-left-color: #7c83f5;
        }

        .nav-item.active i {
            color: #7c83f5;
        }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.35);
            font-size: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #ffffff;
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-size: 18px;
            font-weight: 600;
            color: #1a1f36;
        }

        .topbar-actions .avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #7c83f5, #a78bfa);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .content-area {
            flex: 1;
            padding: 32px;
        }

        /* Startseite */
        .welcome-card {
            background: linear-gradient(135deg, #1a1f36 0%, #2d3561 100%);
            border-radius: 16px;
            padding: 40px;
            color: white;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::after {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 200px;
            height: 200px;
            background: rgba(124, 131, 245, 0.15);
            border-radius: 50%;
        }

        .welcome-card h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .welcome-card p {
            color: rgba(255, 255, 255, 0.65);
            font-size: 14.5px;
            max-width: 480px;
            line-height: 1.6;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-icon.blue   { background: #eff1ff; color: #7c83f5; }
        .stat-icon.green  { background: #ecfdf5; color: #10b981; }
        .stat-icon.orange { background: #fff7ed; color: #f59e0b; }

        .stat-info h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1a1f36;
            margin-bottom: 18px;
        }

        .stat-info p {
            font-size: 13px;
            color: #6b7280;
            margin-top: 2px;
        }

        .success-msg {
            background: #ffffff;
            border-radius: 12px 12px 0 0;
            padding: 16px 32px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06);
            color: #10b981;
            font-weight: 500;
        }

        .success-msg + .page-card {
            border-radius: 0 0 12px 12px;
        }

        /* Kontaktliste */
        .contact-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f0f2f5;
        }

        .contact-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .contact-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 18px;
            flex-shrink: 0;
        }

        .contact-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .contact-name {
            font-weight: 600;
            font-size: 15px;
            color: #1a1f36;
        }

        .contact-phone {
            font-size: 13px;
            color: #6b7280;
        }

        .contact-call {
            background: #10b981;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .contact-call:hover {
            background: #059669;
        }

        /* Allgemeine Inhaltsseiten */
        .page-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06);
        }

        .page-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1f36;
            margin-bottom: 30px;
        }

        .page-card p {
            color: #6b7280;
            font-size: 14.5px;
            line-height: 1.7;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fa-solid fa-address-book"></i>
                <span>Kontaktverwaltung</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="?" class="nav-item <?= !isset($_GET['page']) ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i>
                <span>Start</span>
            </a>
            <a href="?page=contacts" class="nav-item <?= ($_GET['page'] ?? '') == 'contacts' ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i>
                <span>Kontakte</span>
            </a>
            <a href="?page=addcontact" class="nav-item <?= ($_GET['page'] ?? '') == 'addcontact' ? 'active' : '' ?>">
                <i class="fa-solid fa-user-plus"></i>
                <span>Kontakt hinzufügen</span>
            </a>
            <a href="?page=legal" class="nav-item <?= ($_GET['page'] ?? '') == 'legal' ? 'active' : '' ?>">
                <i class="fa-solid fa-circle-info"></i>
                <span>Impressum</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            &copy; <?= date('Y') ?> Kontaktverwaltung
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="topbar">
            <span class="topbar-title">Kontaktverwaltung</span>
            <div class="topbar-actions">
                <div class="avatar">H</div>
            </div>
        </header>

        <main class="content-area">
            <?php
            $headline = 'Herzlich willkommen';
            $contacts = [];

            if(file_exists('contacts.txt')) {
                $text = file_get_contents('contacts.txt');
                $decoded = json_decode($text, true);
                if(is_array($decoded)) {
                    $contacts = $decoded;
                }
            }


            if(isset($_POST['name']) && isset($_POST['phone'])) {
                echo '<div class="success-msg">Kontakt <b>' . $_POST['name'] . '</b> wurde hinzugefügt</div>';
                $newContact = [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone']
                ];
                array_push($contacts, $newContact);
                file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            if (($_GET['page'] ?? '') == 'contacts') {
                $headline = 'Deine Kontakte';
            }

            if (($_GET['page'] ?? '') == 'addcontact') {
                $headline = 'Kontakt hinzufügen';
            }

            if (($_GET['page'] ?? '') == 'legal') {
                $headline = 'Impressum';
            }


            if (($_GET['page'] ?? '') == 'contacts') {
                echo "<div class='page-card'>
                    <h2>Deine Kontakte</h2>";

                foreach ($contacts as $row) {
                    $name  = htmlspecialchars($row['name']);
                    $phone = htmlspecialchars($row['phone']);
                    echo "
                    <div class='contact-item'>
                        <div class='contact-avatar'><i class='fa-solid fa-user'></i></div>
                        <div class='contact-info'>
                            <span class='contact-name'>$name</span>
                            <span class='contact-phone'>$phone</span>
                        </div>
                        <a href='tel:$phone' class='contact-call'>Anrufen</a>
                    </div>";
                }

                echo "</div>";

            } else if (($_GET['page'] ?? '') == 'legal') {
                echo "
                <div class='page-card'>
                    <h2>Impressum</h2>
                    <p>Hier kommt das Impressum hin.</p>
                </div>
                ";
            } else if (($_GET['page'] ?? '') == 'addcontact') {
                echo "
                <div class='page-card'>
                    <h2>Kontakt hinzufügen</h2>
                    <p>Auf dieser Seite kannst du einen neuen Kontakt hinzufügen.</p>
                    <form action='?page=contacts' method='POST'>
                        <div><input placeholder='Namen eingeben' name='name'></div>
                        <div><input placeholder='Telefonnummer eingeben' name='phone'></div>
                        <button type='submit'>Absenden</button>
                    </form>
                </div>
                ";
            } else {
                echo "
                <div class='welcome-card'>
                    <h2>Willkommen!</h2>
                    <p>Verwalten Sie Ihre Kontakte schnell und übersichtlich. Fügen Sie neue Kontakte hinzu oder durchsuchen Sie Ihre bestehenden Einträge.</p>
                </div>
                <div class='stats-grid'>
                    <div class='stat-card'>
                        <div class='stat-icon blue'><i class='fa-solid fa-users'></i></div>
                        <div class='stat-info'><h3>0</h3><p>Kontakte gesamt</p></div>
                    </div>
                    <div class='stat-card'>
                        <div class='stat-icon green'><i class='fa-solid fa-user-check'></i></div>
                        <div class='stat-info'><h3>0</h3><p>Aktive Kontakte</p></div>
                    </div>
                    <div class='stat-card'>
                        <div class='stat-icon orange'><i class='fa-solid fa-star'></i></div>
                        <div class='stat-info'><h3>0</h3><p>Favoriten</p></div>
                    </div>
                </div>
                ";
            }
            ?>
        </main>
    </div>

</body>
</html>
