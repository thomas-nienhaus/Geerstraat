# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Statische website voor Buurtraad Geerstraat (Vaassen). Geen build-stap of package manager.

## Structuur

- `index.html` — de volledige single-page website (Noaber-stijl: warm, serif, groen/zand palet)
- `assets/logo.png` — het Buurtraad Geerstraat logo

## Inhoud beheren

Alle inhoud staat als JavaScript-arrays direct in `index.html`:
- **Jaarplanner** (`months`-array, ~regel 254): maanden met evenementen voor seizoen 2025/2026
- **Clubs** (`clubs`-array, ~regel 286): wekelijkse clubs met dag, tijd, naam en omschrijving

Lettertypes worden geladen via Google Fonts (Newsreader + Hanken Grotesque).

## Lokaal testen

Open `index.html` direct in een browser. Geen server nodig voor basisgebruik; voor het laden van lokale assets via sommige browsers kan een simpele HTTP-server helpen:

```
python3 -m http.server 8080
```
