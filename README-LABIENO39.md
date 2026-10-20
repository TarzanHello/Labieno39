# Labieno 39 — sito ufficiale

Sito dell'appartamento in **Viale Tito Labieno 39, 00174 Roma**, costruito partendo dal sito di Via Arriano 11
(stessa struttura: PHP + JSON, nessun database, 14 lingue, calendario, sync iCal con Booking, area admin).

Le istruzioni per caricarlo su Aruba sono in `README-ARUBA.txt`; quelle per la sincronizzazione automatica
del calendario in `README_AUTOSYNC.md`.

---

## Cose da fare prima di pubblicarlo

### 1. Il dominio
Dominio ufficiale: **www.labieno39.it** (registrato su Aruba). È già impostato in `lib/config.php`,
`robots.txt`, `llms.txt` e `assets/js/cookie-consent.js`.

### 2. Dati da inserire nell'area admin
Dopo il primo accesso a `/admin/login.php` (la password iniziale si trova in `/data/INITIAL_ADMIN_CREDENTIALS.txt`,
da leggere via FTP e poi cancellare), vai nella scheda **Impostazioni**:

- **N. alloggio per uso turistico** (se ce l'hai).
- **Link agli annunci** (Booking, Agoda…): uno per riga, aiutano Google a collegare il sito alla struttura.
- **Coordinate** del portone (da Google Maps: tasto destro sul punto → clic sulle coordinate per copiarle).
- **Booking iCal URL (import)** di Labieno 39, poi scheda "Sync iCal" → "Esegui sync adesso".
- **Prezzi**: prezzo base, pulizie, soggiorno minimo. Il "Motore prezzi" parte con i valori di Arriano:
  controllali e adattali a Labieno.
- **Orario di check-out**: il sito usa le 11:00. Se per Labieno è diverso, cambialo qui.

Già impostati (modificabili): **CIN IT058091B4PMPCO872** (compare in footer, home e dati strutturati), nome "Labieno 39", indirizzo, telefono/WhatsApp +39 328 675 5392,
email viaarriano11@gmail.com, massimo 4 ospiti, check-in dalle 14:00.

### 3. Da verificare nei testi
I testi sono stati scritti dalle foto e dalle informazioni note. Controlla che siano giusti:

- **Wi‑Fi** e **aria condizionata**: il sito dice che ci sono (in soggiorno il climatizzatore si vede in foto).
- **Footer**: "Titolare: Aureliano Procacci · P.IVA 17869861009" è lo stesso di Arriano.
  L'appartamento è intestato a tua moglie: verifica con il commercialista quale titolare/P.IVA indicare.
- **Distanze**: Subaugusta 3 minuti, Termini ~20 minuti di metro, Parco degli Acquedotti ~20 minuti a piedi,
  bus 520 da Ciampino ~30 minuti.
- **Pagina "Consigli"**: per non inventare nomi di locali, contiene ricerche Google Maps (supermercati,
  farmacie, pizzerie…) e pochi luoghi certi. Se vuoi, aggiungi i tuoi posti preferiti in `i18n/it.php`
  (sezione `tips` → `sections`) e nelle altre lingue.

---

## Cosa è cambiato rispetto ad Arriano

- **Foto**: 19 foto di Labieno ritagliate e ottimizzate (JPG + WebP, miniature e versioni 480/800/1200).
- **Logo e favicon** nuovi (archi dell'acquedotto, pino, "Labieno 39 · Roma · Cinecittà").
- **Colori**: terracotta, travertino e arancione della Metro A.
- **Testi** riscritti in 14 lingue: home, appartamento, FAQ, regole (arrivo con apertura da remoto,
  documenti prima dell'ingresso, niente bagagli prima del check-in, silenzio 22–8), quartiere, consigli.
- **Pagina speciale** "Vicino a Cinecittà" (`/vicino-cinecitta`, italiano e inglese) al posto di quella
  sul Policlinico.
- **3 guide** in 7 lingue (IT, EN, FR, DE, ES, PT, RU): come arrivare a Cinecittà/Subaugusta,
  Parco degli Acquedotti, street art del Quadraro.
- **Area admin**: nuovi campi CIN, numero licenza, link annunci e coordinate.
- Rimossi i file di verifica Google/IndexNow di Arriano; nuova chiave IndexNow
  (`5d2f8a91c4e64b07a3b6e1f09c7d2a48.txt`). Per Google Search Console dovrai aggiungere il nuovo dominio
  e caricare il suo file di verifica.
