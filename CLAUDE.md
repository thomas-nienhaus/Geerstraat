# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Statische website voor Buurtraad Geerstraat (Vaassen). Geen build-stap of package manager. Gehost via GitHub Pages.

## Lokaal testen

```
python3 -m http.server 8080
```
Open dan `http://localhost:8080`. Een HTTP-server is nodig omdat de pagina's JSON laden via `fetch()`.

## Bestandsstructuur

```
index.html        — Homepagina (hero, nieuws, jaarplanner, clubs, contact)
over.html         — Over ons (statisch)
fotos.html        — Fotogalerij (laadt data/fotos.json)
admin.html        — Beheerinterface (password-beveiligd)
assets/
  style.css       — Gedeelde CSS voor alle pagina's (Noaber-stijl)
  common.js       — Injecteert header en footer op elke pagina
  logo.png        — Buurtraad Geerstraat logo
data/
  nieuws.json     — Array van {id, titel, datum, inhoud, afbeelding?}
  jaarplanning.json — Array van {maand, jaar, kleur, evenementen[]|note}
  fotos.json      — Array van {src, alt}
.github/workflows/deploy.yml — GitHub Pages deployment bij push naar main
```

## Inhoud beheren

Alle inhoud wordt beheerd via `admin.html`. Het standaard wachtwoord is `geerstraat`.

De admin slaat wijzigingen op via de GitHub Contents API. Hiervoor is een GitHub Personal Access Token nodig (fine-grained, Contents: Read & Write voor deze repo). De beheerder stelt dit eenmalig in via de token-balk in de admin.

## Wachtwoord wijzigen

In `admin.html` staat de constante `WACHTWOORD_HASH`. Dit is de SHA-256 hash van het wachtwoord:
```bash
echo -n "nieuwwachtwoord" | sha256sum
```
Vervang de hash-waarde in `admin.html`.

## Stijl

- **Lettertypen**: Newsreader (koppen), Hanken Grotesque (tekst) — via Google Fonts
- **Kleurpalet** (CSS-variabelen in `assets/style.css`): `--cream`, `--green`, `--green-deep`, `--leaf`, `--terra`, `--blush`, `--gold`
- Elke pagina laadt `assets/style.css` en `assets/common.js`
