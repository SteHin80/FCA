# Förderverein Fussball – WordPress-Theme

Ein schlankes, klassisches PHP-Theme für einen Förderverein, der einen Amateurfussballverein unterstützt. Keine Abhängigkeiten, keine Build-Tools – einfach aktivieren und loslegen.

## Features

- Startseite mit Hero, Kennzahlen, News, Veranstaltungen, Mitgliedschafts-CTA, Spendeninfos und Sponsorenbereich
- Eigene Inhaltstypen: **Veranstaltungen** (`fv_event`) mit Datum-Feld und **Sponsoren** (`fv_sponsor`) mit Logo
- Customizer-Einstellungen: Hero-Titel, Hero-Text, Bankverbindung für Spenden
- Haupt- und Footer-Menü, Logo-Unterstützung, Widget-Bereiche (Seitenleiste + Footer)
- Responsive, barrierearm, übersetzt vorbereitet (Text-Domain `foerderverein`)

## Installation

1. Ordner `foerderverein-theme` als ZIP herunterladen bzw. packen.
2. In WordPress unter **Design → Themes → Theme hinzufügen → Theme hochladen** die ZIP-Datei auswählen und aktivieren.

## Einrichtung nach Aktivierung

1. **Design → Anpassen → Förderverein: Startseite** – Hero-Titel, Hero-Text und Bankverbindung eintragen.
2. **Design → Menüs** – Hauptmenü (und optional Footer-Menü) zuweisen.
3. **Design → Anpassen → Website-Informationen** – Logo hochladen, Titel und Untertitel setzen.
4. **Design → Widgets** – Seitenleiste (z. B. Suche, nächste Termine, Kontakt) und Footer befüllen.
5. **Seiten** – Eine Seite als statische Startseite festlegen (**Einstellungen → Lesen**), damit `front-page.php` greift.
6. **Veranstaltungen / Sponsoren** – Neue Menüpunkte im Dashboard befüllen. Beim Sponsor ein Beitragsbild (Logo) setzen; ohne Logo wird der Name angezeigt.

## Dateien

| Datei | Zweck |
| --- | --- |
| `style.css` | Theme-Header + komplettes Styling |
| `functions.php` | Setup, Menüs, Widgets, Inhaltstypen, Customizer |
| `front-page.php` | Startseite mit allen Vereinsbereichen |
| `index.php`, `archive.php` | Blog- und Archivlisten |
| `single.php`, `page.php` | Einzelansichten |
| `header.php`, `footer.php`, `sidebar.php` | Layoutbausteine |
| `comments.php`, `searchform.php`, `404.php` | Kommentare, Suche, Fehlerseite |

## Anpassen der Farben

Die Vereinsfarben sind als CSS-Variablen am Anfang von `style.css` definiert (`--fv-primary`, `--fv-accent`, `--fv-dark`). Dort einfach die Farbwerte ändern.

## Lizenz

GPL-2.0-or-later.
