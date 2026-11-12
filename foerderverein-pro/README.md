# Förderverein Pro – WordPress-Theme

WordPress-Theme für einen Förderverein, der einen Amateurfussballverein unterstützt. Farbschema: Blau (#22274e), Rot (#e53832) und Grau (#c0c0c1).

## Features

- **Bearbeitbarer Header**: obere Kontaktleiste, Hinweistext, CTA-Button und eigener Widget-Bereich – alles über Customizer und Widgets (Design → Anpassen → „Kopfzeile & Header")
- **Bearbeitbarer Footer**: Über-uns-Text, drei Widget-Spalten, Footer-Menü, Copyright-Zeile (Customizer + Design → Widgets)
- **12 Seitenvorlagen für jeden Seitentyp** (beim Bearbeiten einer Seite rechts unter „Vorlage" wählen):
  - Vollbreite Seite (ohne Seitenleiste)
  - Seite mit Seitenleiste
  - Kontaktseite (mit Formular-Bereich)
  - Formularseite (Kontakt-/Antragsformular, z. B. für Formular-Plugins)
  - Mitgliedschaft (Mitglied werden)
  - Veranstaltungsübersicht
  - Sponsoren
  - Spenden
  - Über uns / Vorstand
  - FAQ (Häufige Fragen, mit automatischer FAQ-Structured-Data)
  - Übersicht: Unterseiten (zeigt Unterseiten als Karten)
  - Rechtliches (Impressum / Datenschutz)
- **Blockmuster als Designbausteine** (im Block-Editor unter „Muster" → Kategorie „Förderverein"): Hero-Banner, Kontakt-Bereich, Mitglied werden, Spenden-Aufruf, Termin-Hinweis
- **Kontaktformular-fertig**: eigener Widget-Bereich „Kontaktformular-Bereich" und fertige Styles für Contact Form 7, WPForms und Forminator – Formulare erscheinen automatisch im Theme-Look
- Eigene Inhaltstypen: **Veranstaltungen** (mit Datum-Feld) und **Sponsoren** (mit Logo)
- Startseite mit Hero (optional mit Hintergrundbild), Kennzahlen, News, Veranstaltungen, Mitgliedschafts-CTA, Spenden und Sponsoren
- **Vollständig responsiv nach Mobile-First**: Basis-Styles für Smartphones, Erweiterung mit `min-width`-Media-Queries (600 / 782 / 1000 px), Hamburger-Menü auf Mobilgeräten, große Touch-Ziele, flüssige Typografie mit `clamp()`, Rücksicht auf `prefers-reduced-motion`
- **Voll Gutenberg-/Block-Editor-fähig**: Vereinsfarben und Farbverläufe als Farbpalette im Editor, Schriftgrößen, „Breit/Vollbild“-Ausrichtung für Blöcke, Editor-Styles (der Editor sieht aus wie die Website), responsive Einbettungen, eigene Zeilenhöhen und Abstände
- Responsiv, übersetzungsbereit (Text-Domain `foerderverein-pro`)

## Technische Voraussetzungen

- **PHP 8.5** (das Theme ist für PHP 8.5 entwickelt; ältere PHP-Versionen werden nicht unterstützt)
- **WordPress 6.7 oder neuer**, getestet bis WordPress 7.2
- **Block-Vorlagen & Vorlagen-Teile**: Das Theme meldet `block-templates` und `block-template-parts` – eigene Blockvorlagen können im Editor unter „Design → Vorlagen“ erstellt werden. Zusätzlich sind zwei fertige Blockvorlagen für Veranstaltungen registriert (Einzelansicht und Übersicht, ab WordPress 6.7). Auf älteren Versionen greift automatisch die klassische PHP-Vorlage – nichts geht verloren.

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
2. **Design → Widgets**: Seitenleiste, Kopfzeile, die drei Footer-Spalten und den „Kontaktformular-Bereich" befüllen. Für das Kontaktformular das Formular-Widget des Plugins (z. B. Contact Form 7 oder WPForms) in den „Kontaktformular-Bereich" ziehen – oder den Plugin-Shortcode direkt in den Seiteninhalt einfügen.
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

## SEO & KI-Suche (eingebaut, `inc/seo.php`)

Das Theme bringt ohne Plugin mit:

- **Meta-Tags**: Meta-Beschreibung, Canonical-URL, korrekte robots-Angaben (`max-image-preview:large`, Suchseiten/404 auf `noindex`)
- **Open Graph & Twitter Cards** für saubere Vorschauen in sozialen Netzwerken und Messenger
- **JSON-LD-strukturierte Daten** (schema.org): Förderverein als Organisation (NGO) mit Kontaktdaten, Website mit Suchaktion, Artikel, **Veranstaltungen mit Datum und Ort** (erscheinen so in der Google-Ereignissuche), Brotkrumen-Navigation
- **`llms.txt`-Endpunkt** unter `https://deine-domain.de/llms.txt`: maschinenlesbare Zusammenfassung der Website (Kontakt, Seiten, Veranstaltungen, News) für KI-Suchsysteme wie ChatGPT, Perplexity & Co. – wird bei Theme-Aktivierung automatisch eingerichtet
- **Performance**: eigenes JavaScript wird `defer`-geladen

Wichtig: Ist ein SEO-Plugin aktiv (Yoast, Rank Math, SEOPress, All in One SEO, The SEO Framework), schaltet das Theme seine eigenen Meta-/Schema-Ausgaben automatisch ab, damit nichts doppelt ausgegeben wird.

Empfehlungen außerhalb des Themes:

- **Sitemap** liefert WordPress bereits unter `/wp-sitemap.xml` – bei Google Search Console einreichen
- **Site-Icon setzen** (Customizer → Website-Informationen): dient als Logo in den strukturierten Daten und als OG-Bild-Fallback
- **KI-Crawler erlauben**: falls die robots.txt der Domain Crawler wie `GPTBot`, `PerplexityBot` oder `ClaudeBot` blockt, dort die Freigabe ergänzen, damit die Website in KI-Antworten erscheinen kann
- Veranstaltungen mit **Datum und Ort** pflegen – nur so erscheinen sie in der Google-Ereignissuche

## Farben ändern

Alle Farben sind CSS-Variablen am Anfang von `style.css`:
- `--fv-primary: #22274e` (Vereinsblau)
- `--fv-accent: #e53832` (Vereinsrot)
- `--fv-grey: #c0c0c1` (Grau, Rahmen & Trenner)
- `--fv-grey-light: #f3f3f4` (helle Hintergrundflächen)

## Lizenz

GPL-2.0-or-later.
