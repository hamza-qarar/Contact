<!DOCTYPE html>
<!-- DOCTYPE teilt dem Browser mit, dass dies ein modernes HTML5-Dokument ist -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <!-- charset=UTF-8 sorgt dafür, dass Sonderzeichen wie Umlaute (ä, ö, ü) korrekt angezeigt werden -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- viewport passt die Seite an die Bildschirmbreite des Geräts an (wichtig für Smartphones) -->
    <title>Kontaktverwaltung</title>
    <!-- Favicon: das kleine Icon im Browser-Tab -->
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <!-- Font Awesome: eine Bibliothek mit tausenden Icons, die wir per CSS-Klasse einbinden -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ============================================================
           RESET & GRUNDLAYOUT
           ============================================================ */

        /* Der *-Selektor gilt für ALLE Elemente auf der Seite.
           Wir entfernen den Standard-Abstand der Browser, damit
           alle Browser gleich aussehen. */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box; /* Breite/Höhe schließt Rahmen und Padding ein */
        }

        /* Das body-Element ist der sichtbare Seitenbereich.
           display:flex legt Sidebar und Hauptbereich nebeneinander. */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh; /* 100vh = volle Bildschirmhöhe */
            background-color: #f0f2f5; /* Hellgrauer Hintergrund */
        }

        /* ============================================================
           SEITENLEISTE (SIDEBAR)
           ============================================================ */

        /* Die Sidebar ist fest am linken Rand (position: fixed) und
           bleibt beim Scrollen stehen. z-index:100 legt sie über anderen Elementen. */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1f36 0%, #2d3561 100%); /* Dunkler Farbverlauf */
            display: flex;
            flex-direction: column; /* Inhalt untereinander anordnen */
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.3); /* Schatten nach rechts */
        }

        /* Logo-Bereich oben in der Sidebar */
        .sidebar-header {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08); /* Dezente Trennlinie */
        }

        .sidebar-header .logo {
            display: flex;
            align-items: center; /* Icon und Text vertikal zentrieren */
            gap: 12px;
            color: #ffffff;
        }

        .sidebar-header .logo i {
            font-size: 22px;
            color: #7c83f5; /* Lila Akzentfarbe */
        }

        .sidebar-header .logo span {
            font-size: 17px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* Navigationsbereich: flex:1 lässt ihn den verfügbaren Platz füllen */
        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
        }

        /* Jeder Menüpunkt ist ein Link (<a>-Element) */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 24px;
            color: rgba(255, 255, 255, 0.65); /* Halbtransparentes Weiß */
            text-decoration: none; /* Unterstrich des Links entfernen */
            font-size: 14.5px;
            font-weight: 500;
            transition: all 0.2s ease; /* Weicher Übergang beim Hover */
            cursor: pointer;
            border-left: 3px solid transparent; /* Platz für den aktiven Indikator */
        }

        .nav-item i {
            width: 20px;
            font-size: 16px;
            text-align: center;
            flex-shrink: 0; /* Icon darf nicht kleiner werden */
        }

        /* Stil wenn der Mauszeiger über einem Menüpunkt ist */
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #ffffff;
            border-left-color: rgba(124, 131, 245, 0.5);
        }

        /* Stil für die aktuell aktive Seite (per PHP gesetzt) */
        .nav-item.active {
            background: rgba(124, 131, 245, 0.15);
            color: #ffffff;
            border-left-color: #7c83f5; /* Lila Linie links */
        }

        .nav-item.active i {
            color: #7c83f5;
        }

        /* Copyright-Zeile am unteren Rand der Sidebar */
        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.35);
            font-size: 12px;
        }

        /* ============================================================
           HAUPTBEREICH
           ============================================================ */

        /* margin-left:240px schiebt den Hauptbereich rechts neben die Sidebar */
        .main-content {
            margin-left: 240px;
            flex: 1; /* Nimmt den restlichen Platz ein */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Die Topbar klebt am oberen Rand (position:sticky, top:0) */
        .topbar {
            background: #ffffff;
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Titel links, Avatar rechts */
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

        /* Runder Avatar-Kreis mit Farbverlauf */
        .topbar-actions .avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #7c83f5, #a78bfa);
            border-radius: 50%; /* Macht das Div zu einem Kreis */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Der eigentliche Inhaltsbereich mit Abstand */
        .content-area {
            flex: 1;
            padding: 32px;
        }

        /* ============================================================
           STARTSEITE
           ============================================================ */

        /* Dunkle Willkommenskarte mit Farbverlauf */
        .welcome-card {
            background: linear-gradient(135deg, #1a1f36 0%, #2d3561 100%);
            border-radius: 16px;
            padding: 40px;
            color: white;
            margin-bottom: 28px;
            position: relative; /* Nötig damit ::after absolut positioniert werden kann */
            overflow: hidden;   /* Dekorationskreis wird abgeschnitten wenn er rausragt */
        }

        /* ::after erzeugt einen dekorativen Kreis ohne eigenes HTML-Element */
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

        /* Drei Statistik-Kacheln nebeneinander mit CSS Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 gleichbreite Spalten */
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

        /* Icon-Quadrat mit abgerundeten Ecken */
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

        /* Farbvarianten der Statistik-Icons */
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

        /* ============================================================
           ERFOLGSMELDUNG (nach Kontakt hinzufügen)
           ============================================================ */

        /* Grüner Balken über der Kontaktliste — sieht aus als wäre er
           Teil der weißen Box (border-radius nur oben) */
        .success-msg {
            background: #ffffff;
            border-radius: 12px 12px 0 0;
            padding: 16px 32px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06);
            color: #10b981;
            font-weight: 500;
        }

        /* Wenn .success-msg direkt vor .page-card steht:
           obere Ecken der Box abschneiden damit es nahtlos wirkt */
        .success-msg + .page-card {
            border-radius: 0 0 12px 12px;
        }

        /* ============================================================
           FORMULAR (Kontakt hinzufügen)
           ============================================================ */

        .contact-form {
            margin-top: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 480px;
        }

        /* Jede Formularzeile: Label + Eingabefeld untereinander */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #1a1f36;
        }

        /* Wrapper mit Icon links und Textfeld rechts */
        .input-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            padding: 0 14px;
            background: #fff;
            transition: border-color 0.2s;
        }

        /* :focus-within greift wenn ein Kind-Element (das input) fokussiert ist */
        .input-wrapper:focus-within {
            border-color: #7c83f5; /* Lila Rahmen beim Tippen */
        }

        .input-wrapper i {
            color: #9ca3af;
            font-size: 14px;
            flex-shrink: 0;
        }

        /* Das eigentliche Eingabefeld hat keinen eigenen Rahmen,
           da der Rahmen auf dem Wrapper liegt */
        .input-wrapper input {
            border: none;
            outline: none;
            width: 100%;
            padding: 12px 0;
            font-size: 14.5px;
            font-family: inherit;
            color: #1a1f36;
            background: transparent;
        }

        .input-wrapper input::placeholder {
            color: #9ca3af;
        }

        /* Absenden-Button mit Farbverlauf */
        .form-submit {
            align-self: flex-start; /* Nur so breit wie der Inhalt */
            background: linear-gradient(135deg, #7c83f5, #a78bfa);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s;
        }

        .form-submit:hover {
            opacity: 0.9; /* Leicht transparenter beim Hover */
        }

        /* ============================================================
           KONTAKTLISTE
           ============================================================ */

        /* Jeder Kontakt ist eine horizontale Zeile mit Flexbox */
        .contact-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f0f2f5; /* Trennlinie zwischen Kontakten */
        }

        /* Letzter Kontakt bekommt keine Trennlinie */
        .contact-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        /* Runder Avatar-Kreis mit Person-Icon */
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

        /* Name und Telefonnummer untereinander — flex:1 füllt den verfügbaren Platz */
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

        /* Grüner Anrufen-Button (tel:-Link öffnet den Telefon-Dialer) */
        .contact-call {
            background: #10b981;
            color: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-call:hover {
            background: #059669;
        }

        /* Stern-Button für Favoriten — standardmäßig grau */
        .contact-fav {
            background: none;
            border: none;
            font-size: 20px;
            color: #d1d5db;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }

        .contact-fav:hover {
            color: #f59e0b; /* Gold beim Hover */
        }

        /* Wenn der Kontakt als Favorit markiert ist (.active per PHP gesetzt) */
        .contact-fav.active {
            color: #f59e0b;
        }

        /* Roter Entfernen-Button */
        .contact-remove {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-remove:hover {
            background: #fecaca;
        }

        /* ============================================================
           ALLGEMEINE INHALTSSEITEN (Weiße Box)
           ============================================================ */

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

        /* Abschnittsüberschriften im Impressum */
        .page-card h3 {
            font-size: 14px;
            font-weight: 700;
            color: #1a1f36;
            margin-top: 24px;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ============================================================
           MOBILES MENÜ (Hamburger + Overlay)
           ============================================================ */

        /* Die Sidebar bekommt eine Animation für das Ein-/Ausfahren */
        .sidebar {
            transition: transform 0.3s ease;
        }

        /* Dunkles Overlay das hinter der geöffneten Sidebar liegt.
           Klick darauf schließt das Menü wieder. */
        .sidebar-overlay {
            display: none; /* Standardmäßig unsichtbar */
            position: fixed;
            inset: 0; /* Füllt den gesamten Bildschirm */
            background: rgba(0,0,0,0.4);
            z-index: 99; /* Unter der Sidebar (100), aber über dem Inhalt */
            opacity: 0;
            pointer-events: none; /* Klicks gehen durch, wenn unsichtbar */
            transition: opacity 0.3s ease;
        }

        /* Hamburger-Button (drei Striche) — nur im Mobilmodus sichtbar */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #1a1f36;
            font-size: 20px;
            cursor: pointer;
            padding: 4px;
            align-items: center;
            justify-content: center;
        }

        /* ============================================================
           PORTRAIT / MOBILMODUS
           Die Regeln hier gelten nur wenn das Gerät im Hochformat
           ist oder der Bildschirm schmaler als 768px ist.
           WICHTIG: Diese Regeln müssen NACH den Basis-Stilen stehen,
           damit sie diese überschreiben können.
           ============================================================ */
        @media (orientation: portrait), (max-width: 768px) {
            /* Sidebar versteckt sich nach links außerhalb des Bildschirms */
            .sidebar {
                transform: translateX(-100%);
            }

            /* Wenn die Klasse "open" per JavaScript hinzugefügt wird,
               fährt die Sidebar wieder herein */
            .sidebar.open {
                transform: translateX(0);
            }

            /* Overlay wird aktiviert (aber noch transparent) */
            .sidebar-overlay {
                display: block;
            }

            /* Overlay wird sichtbar wenn Klasse "open" gesetzt ist */
            .sidebar-overlay.open {
                opacity: 1;
                pointer-events: all;
            }

            /* Hauptbereich nimmt die volle Breite ein */
            .main-content {
                margin-left: 0;
                padding-bottom: 70px; /* Platz für die Bottom-Navigation */
            }

            .topbar {
                padding: 0 16px;
            }

            /* Hamburger-Button wird sichtbar */
            .menu-toggle {
                display: flex;
            }

            .content-area {
                padding: 16px;
            }

            /* Statistiken untereinander statt nebeneinander */
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome-card {
                padding: 24px;
            }

            /* Bottom-Navigation einblenden */
            .bottom-nav {
                display: flex;
            }
        }

        /* ============================================================
           BOTTOM NAVIGATION (nur im Mobilmodus sichtbar)
           ============================================================ */

        /* Navigationsleiste am unteren Bildschirmrand */
        .bottom-nav {
            display: none; /* Standardmäßig ausgeblendet — Media Query schaltet es ein */
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: linear-gradient(90deg, #1a1f36, #2d3561);
            box-shadow: 0 -2px 10px rgba(0,0,0,0.2);
            z-index: 100;
            justify-content: space-around;
            align-items: center;
        }

        /* Jeder Menüpunkt in der Bottom-Navigation */
        .bottom-nav a {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 11px;
            font-weight: 500;
            flex: 1;
            padding: 8px 0;
        }

        .bottom-nav a i {
            font-size: 18px;
        }

        /* Aktiver Menüpunkt leuchtet lila */
        .bottom-nav a.active {
            color: #7c83f5;
        }
    </style>
</head>
<body>

    <!-- Overlay: dunkler Hintergrund wenn die Sidebar offen ist (nur mobil) -->
    <div class="sidebar-overlay" id="overlay" onclick="toggleMenu()"></div>

    <!-- SEITENLEISTE -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fa-solid fa-address-book"></i>
                <span>Kontaktverwaltung</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <!-- PHP prüft welche Seite aktiv ist und setzt die CSS-Klasse "active".
                 ?? '' bedeutet: falls $_GET['page'] nicht gesetzt ist, nimm einen leeren String -->
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

        <!-- date('Y') gibt das aktuelle Jahr aus -->
        <div class="sidebar-footer">
            &copy; <?= date('Y') ?> Kontaktverwaltung
        </div>
    </aside>

    <!-- HAUPTBEREICH -->
    <div class="main-content">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <!-- Hamburger-Button: nur im Mobilmodus sichtbar (per CSS) -->
                <button class="menu-toggle" onclick="toggleMenu()"><i class="fa-solid fa-bars"></i></button>
                <span class="topbar-title">Kontaktverwaltung</span>
            </div>
            <div class="topbar-actions">
                <div class="avatar">H</div>
            </div>
        </header>

        <main class="content-area">
            <?php
            /* --------------------------------------------------------
               DATENVERWALTUNG
               Alle PHP-Logik läuft hier, bevor HTML ausgegeben wird.
               -------------------------------------------------------- */

            $headline = 'Herzlich willkommen'; // Standard-Überschrift
            $contacts = [];                     // Leeres Array als Startwert

            /* Kontakte aus der Textdatei laden.
               Die Datei speichert alle Kontakte als JSON-Text.
               json_decode wandelt den Text zurück in ein PHP-Array. */
            if(file_exists('contacts.txt')) {
                $text = file_get_contents('contacts.txt');
                $decoded = json_decode($text, true); // true = als Array, nicht als Objekt
                if(is_array($decoded)) {             // Nur übernehmen wenn das Ergebnis ein gültiges Array ist
                    $contacts = $decoded;
                }
            }

            /* KONTAKT ENTFERNEN
               Wenn das Formular mit "remove" abgeschickt wurde,
               wird der Kontakt an der angegebenen Position gelöscht.
               array_splice entfernt ein Element aus dem Array. */
            if(isset($_POST['remove'])) {
                array_splice($contacts, (int)$_POST['remove'], 1);
                file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            /* FAVORIT UMSCHALTEN
               Das ! dreht den Wert um: true wird false, false wird true.
               ?? false bedeutet: falls 'favorite' noch nicht gesetzt ist, nehme false. */
            if(isset($_POST['favorite'])) {
                $i = (int)$_POST['favorite'];
                $contacts[$i]['favorite'] = !($contacts[$i]['favorite'] ?? false);
                file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            /* ANRUF MARKIEREN
               Wird per JavaScript (fetch) im Hintergrund aufgerufen wenn
               jemand auf den Anrufen-Button drückt. */
            if(isset($_POST['called'])) {
                $i = (int)$_POST['called'];
                $contacts[$i]['called'] = true;
                file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            /* KONTAKT HINZUFÜGEN
               Prüft ob beide Felder (Name und Telefon) abgeschickt wurden. */
            if(isset($_POST['name']) && isset($_POST['phone'])) {
                // htmlspecialchars verhindert dass HTML-Code in der Ausgabe ausgeführt wird
                echo '<div class="success-msg">Kontakt <b>' . htmlspecialchars($_POST['name']) . '</b> wurde hinzugefügt</div>';
                $newContact = [
                    'name'  => $_POST['name'],
                    'phone' => $_POST['phone']
                ];
                array_push($contacts, $newContact); // Neuen Kontakt ans Ende des Arrays hängen
                // JSON_PRETTY_PRINT = lesbare Formatierung, JSON_UNESCAPED_UNICODE = Umlaute direkt speichern
                file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            /* ÜBERSCHRIFT BESTIMMEN je nach aktiver Seite */
            if (($_GET['page'] ?? '') == 'contacts') {
                $headline = 'Deine Kontakte';
            }

            if (($_GET['page'] ?? '') == 'addcontact') {
                $headline = 'Kontakt hinzufügen';
            }

            if (($_GET['page'] ?? '') == 'legal') {
                $headline = 'Impressum';
            }

            /* --------------------------------------------------------
               SEITENINHALT AUSGEBEN
               Je nach URL-Parameter (?page=...) wird ein anderer
               Inhalt angezeigt. Ohne Parameter erscheint die Startseite.
               -------------------------------------------------------- */

            if (($_GET['page'] ?? '') == 'contacts') {
                /* KONTAKTLISTE
                   id="contacts-list" ist der Anker für die URL (#contacts-list),
                   damit die Seite nach dem Entfernen nicht nach oben springt. */
                echo "<div class='page-card' id='contacts-list'>
                    <h2>Deine Kontakte</h2>";

                /* foreach geht jeden Kontakt im Array durch.
                   $index ist die Position (0, 1, 2, ...), $row der Kontakt selbst. */
                foreach ($contacts as $index => $row) {
                    // htmlspecialchars schützt vor XSS (eingeschleuster HTML-Code)
                    $name      = htmlspecialchars($row['name']);
                    $phone     = htmlspecialchars($row['phone']);
                    $isFav     = !empty($row['favorite']); // true wenn Favorit, sonst false
                    // Gefüllter Stern wenn Favorit, leerer Stern wenn nicht
                    $starClass = $isFav ? 'fa-solid fa-star' : 'fa-regular fa-star';
                    $favClass  = $isFav ? 'contact-fav active' : 'contact-fav';
                    echo "
                    <div class='contact-item'>
                        <div class='contact-avatar'><i class='fa-solid fa-user'></i></div>
                        <div class='contact-info'>
                            <span class='contact-name'>$name</span>
                            <span class='contact-phone'>$phone</span>
                        </div>
                        <!-- Favorit-Formular: sendet den Index des Kontakts per POST -->
                        <form method='POST' action='?page=contacts#contacts-list'>
                            <input type='hidden' name='favorite' value='$index'>
                            <button type='submit' class='$favClass'><i class='$starClass'></i></button>
                        </form>
                        <!-- tel: öffnet den Telefon-Dialer, onclick markiert den Kontakt als angerufen -->
                        <a href='tel:$phone' class='contact-call' onclick='markCalled($index)'><i class='fa-solid fa-phone'></i></a>
                        <!-- Entfernen-Formular: sendet den Index per POST -->
                        <form method='POST' action='?page=contacts#contacts-list'>
                            <input type='hidden' name='remove' value='$index'>
                            <button type='submit' class='contact-remove'><i class='fa-solid fa-trash'></i></button>
                        </form>
                    </div>";
                }

                echo "</div>";

            } else if (($_GET['page'] ?? '') == 'legal') {
                /* IMPRESSUM */
                echo "
                <div class='page-card'>
                    <h2>Impressum</h2>

                    <h3>Angaben gemäß § 5 TMG</h3>
                    <p>Max Mustermann<br>
                    Musterstraße 12<br>
                    12345 Musterstadt</p>

                    <h3>Kontakt</h3>
                    <p>Telefon: +49 151 23456789<br>
                    E-Mail: max.mustermann@example.com</p>

                    <h3>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h3>
                    <p>Max Mustermann<br>
                    Musterstraße 12<br>
                    12345 Musterstadt</p>

                    <h3>Haftungsausschluss</h3>
                    <p>Die Inhalte dieser Anwendung wurden mit größtmöglicher Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte kann jedoch keine Gewähr übernommen werden.</p>
                </div>
                ";

            } else if (($_GET['page'] ?? '') == 'addcontact') {
                /* FORMULAR: KONTAKT HINZUFÜGEN
                   action='?page=contacts' bedeutet: nach dem Absenden zur Kontaktliste wechseln.
                   method='POST' schickt die Daten unsichtbar im Hintergrund (nicht in der URL). */
                echo "
                <div class='page-card'>
                    <h2>Kontakt hinzufügen</h2>
                    <p>Fülle das Formular aus, um einen neuen Kontakt zu speichern.</p>
                    <form action='?page=contacts' method='POST' class='contact-form'>
                        <div class='form-group'>
                            <label>Name</label>
                            <div class='input-wrapper'>
                                <i class='fa-solid fa-user'></i>
                                <input type='text' placeholder='Namen eingeben' name='name' required>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label>Telefonnummer</label>
                            <div class='input-wrapper'>
                                <i class='fa-solid fa-phone'></i>
                                <!-- oninput filtert beim Tippen alle Zeichen außer Ziffern und + heraus -->
                                <input type='tel' placeholder='Telefonnummer eingeben' name='phone' required inputmode='tel' oninput=\"this.value = this.value.replace(/[^0-9+]/g, '')\">
                            </div>
                        </div>
                        <button type='submit' class='form-submit'>
                            <i class='fa-solid fa-user-plus'></i> Kontakt speichern
                        </button>
                    </form>
                </div>
                ";

            } else {
                /* STARTSEITE
                   array_filter gibt nur die Elemente zurück, für die die Funktion true liefert.
                   count zählt dann wie viele das sind. */
                $total     = count($contacts);
                $favorites = count(array_filter($contacts, fn($c) => !empty($c['favorite'])));
                $active    = count(array_filter($contacts, fn($c) => !empty($c['called'])));
                echo "
                <div class='welcome-card'>
                    <h2>Willkommen!</h2>
                    <p>Verwalten Sie Ihre Kontakte schnell und übersichtlich. Fügen Sie neue Kontakte hinzu oder durchsuchen Sie Ihre bestehenden Einträge.</p>
                </div>
                <div class='stats-grid'>
                    <div class='stat-card'>
                        <div class='stat-icon blue'><i class='fa-solid fa-users'></i></div>
                        <div class='stat-info'><h3>$total</h3><p>Kontakte gesamt</p></div>
                    </div>
                    <div class='stat-card'>
                        <div class='stat-icon green'><i class='fa-solid fa-user-check'></i></div>
                        <div class='stat-info'><h3>$active</h3><p>Aktive Kontakte</p></div>
                    </div>
                    <div class='stat-card'>
                        <div class='stat-icon orange'><i class='fa-solid fa-star'></i></div>
                        <div class='stat-info'><h3>$favorites</h3><p>Favoriten</p></div>
                    </div>
                </div>
                ";
            }
            ?>
        </main>
    </div>

    <!-- BOTTOM NAVIGATION (nur im Mobilmodus sichtbar, gesteuert per CSS) -->
    <nav class="bottom-nav">
        <a href="?" class="<?= !isset($_GET['page']) ? 'active' : '' ?>">
            <i class="fa-solid fa-house"></i>
            <span>Start</span>
        </a>
        <a href="?page=contacts" class="<?= ($_GET['page'] ?? '') == 'contacts' ? 'active' : '' ?>">
            <i class="fa-solid fa-users"></i>
            <span>Kontakte</span>
        </a>
        <a href="?page=addcontact" class="<?= ($_GET['page'] ?? '') == 'addcontact' ? 'active' : '' ?>">
            <i class="fa-solid fa-user-plus"></i>
            <span>Hinzufügen</span>
        </a>
        <a href="?page=legal" class="<?= ($_GET['page'] ?? '') == 'legal' ? 'active' : '' ?>">
            <i class="fa-solid fa-circle-info"></i>
            <span>Impressum</span>
        </a>
    </nav>

<script>
    /* toggleMenu öffnet und schließt die Sidebar im Mobilmodus.
       classList.toggle fügt eine CSS-Klasse hinzu wenn sie fehlt,
       oder entfernt sie wenn sie bereits vorhanden ist. */
    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('open');
    }

    /* markCalled wird aufgerufen wenn jemand auf den Anrufen-Button klickt.
       fetch schickt eine POST-Anfrage im Hintergrund an den Server,
       ohne die Seite neu zu laden. So wird der Kontakt als "angerufen" gespeichert. */
    function markCalled(index) {
        fetch('?page=contacts', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'called=' + index
        });
    }
</script>
</body>
</html>
