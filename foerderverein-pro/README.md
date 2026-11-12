# Förderverein Pro – WordPress-Theme

WordPress-Theme für einen Förderverein, der einen Amateurfussballverein unterstützt. Farbschema: Blau (#294597) und Pink/Rot (#c81e84).

## Features

- **Bearbeitbarer Header**: obere Kontaktleiste, Hinweistext, CTA-Button und eigener Widget-Bereich – alles über Customizer und Widgets (Design → Anpassen → „Kopfzeile & Header")
- **Bearbeitbarer Footer**: Über-uns-Text, drei Widget-Spalten, Footer-Menü, Copyright-Zeile (Customizer + Design → Widgets)
- **Seitenvorlagen für jeden Seitentyp** (beim Bearbeiten einer Seite rechts unter „Vorlage" wählen):
  - Vollbreite Seite (ohne Seitenleiste)
  - Seite mit Seitenleiste
  - Kontaktseite
  - Mitgliedschaft (Mitglied werden)
  - Veranstaltungsübersicht
  - Sponsoren
  - Spenden
- Eigene Inhaltstypen: **Veranstaltungen** (mit Datum-Feld) und **Sponsoren** (mit Logo)
- Startseite mit Hero (optional mit Hintergrundbild), Kennzahlen, News, Veranstaltungen, Mitgliedschafts-CTA, Spenden und Sponsoren
- **Vollständig responsiv nach Mobile-First**: Basis-Styles für Smartphones, Erweiterung mit `min-width`-Media-Queries (600 / 782 / 1000 px), Hamburger-Menü auf Mobilgeräten, große Touch-Ziele, flüssige Typografie mit `clamp()`, Rücksicht auf `prefers-reduced-motion`
- **Voll Gutenberg-/Block-Editor-fähig**: Vereinsfarben und Farbverläufe als Farbpalette im Editor, Schriftgrößen, „Breit/Vollbild“-Ausrichtung für Blöcke, Editor-Styles (der Editor sieht aus wie die Website), responsive Einbettungen, eigene Zeilenhöhen und Abstände
- Responsiv, übersetzungsbereit (Text-Domain `foerderverein-pro`)

## Installation

1. ZIP herunterladen (enthält den Ordner `foerderverein-pro` mit `style.css` im Hauptverzeichnis).
2. WordPress-Admin → **Design → Themes → Theme hinzufügen → Theme hochladen** → ZIP auswählen → **Aktivieren**.

## Einrichtung nach Aktivierung

1. **Design → Anpassen**:
   - *Kopfzeile & Header*: Hinweistext (z. B. nächstes Heimspiel), CTA-Button mit Link
   - *Startseite: Hero*: Titel, Text, Hintergrundbild, Button-Texte und -Links
   - *Kontaktdaten*: Anschrift, Telefon, E-Mail (erscheinen in Kopfzeile, Footer und Kontaktseite)
   - *Spenden*: Bankverbindung
   - *Footer*: Über-uns-Text und Copyright-Zeile
2. **Design → Widgets**: Seitenleiste, Kopfzeile und die drei Footer-Spalten befüllen.
3. **Design → Menüs**: Hauptmenü und Footer-Menü zuweisen.
4. **Seiten**: Für jede Seite die passende Vorlage wählen (rechts in der Seitenleiste des Editors unter „Vorlage").
5. **Einstellungen → Lesen**: Eine statische Seite als Startseite festlegen.
6. **Veranstaltungen / Sponsoren** im Dashboard befüllen.

## Dateien

| Datei | Zweck |
| --- | --- |
| `style.css` | Theme-Header + Styling (Farben als CSS-Variablen) |
| `functions.php` | Setup, Menüs, Widgets, Inhaltstypen, Customizer |
| `header.php`, `footer.php` | Bearbeitbarer Header/Footer |
| `front-page.php` | Vereins-Startseite |
| `templates/` | 7 Seitenvorlagen |
| `index.php`, `archive.php`, `single.php`, `page.php` | Standardansichten |
| `sidebar.php`, `comments.php`, `searchform.php`, `404.php` | Bausteine |

## Farben ändern

Alle Farben sind CSS-Variablen am Anfang von `style.css` (`--fv-primary: #294597`, `--fv-accent: #c81e84`).

## Lizenz

GPL-2.0-or-later.
