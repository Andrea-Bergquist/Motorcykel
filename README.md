# 🏍 MC Bloggen – Allt om livet på två hjul

Detta är ett modernt och levande bloggprojekt byggt med **Laravel 13**. Hemsidan är utvecklad för motorcykelentusiaster och fokuserar på publicering av guider, resor och tester, samt att erbjuda besökare ett interaktivt kontaktformulär med automatiserade e-postaviseringar.

**🔗 Se projektet live:** [www.andréa.se](https://xn--andra-esa.se)

## 🛠 Tech Stack
*   **Backend:** Laravel 13 & PHP 8.5+
*   **Frontend & Interaktivitet:** Alpine.js
*   **Styling:** Tailwind CSS (helt responsiv för mobila enheter på vägarna)
*   **E-posthantering:** Laravels `Mailable`-system

## ✨ Nyckelfunktioner

### 📰 Dynamiskt bloggflöde & Kategorisering
*   **Inläggshantering:** Löpande publicering av reseberättelser, mekaniktips, produkttester och guider direkt från databasen.
*   **Kategorifiltrering:** Sömlös sortering av artiklar (Motorcyklar, Resor, Mek & tips, Tester) för hög användarvänlighet.
*   **Nyhetsbrev:** Integrerad prenumerationsfunktion för utskick av de senaste artiklarna till läsarens inkorg.

### 📬 Skräddarsytt Kontakt- & Ärendeformulär
*   **Branschspecifika fält:** Innehåller fält för *MC-modell* och *Ärende*, vilket ger strukturerad data från besökaren.
*   **Robust validering:** Serversidans validering som säkerställer att e-postadresser är giltiga och att alla obligatoriska fält är ifyllda innan sändning.
*   **Mailable-integration:** Systemet använder Laravels `Mailable`-arkitektur för att omedelbart generera och skicka ett snyggt HTML-formaterat e-postmeddelande till bloggansvarig när en läsare hör av sig.

---

## 🚀 Installation (För att köra lokalt)

Följ dessa steg för att installera och köra projektet på din egen dator:

1. **Klona projektet:**
   ```bash
   git clone https://github.com
   cd DITT-REPOSITORIUM
   ```

2. **Installera PHP-beroenden:**
   ```bash
   composer install
   ```

3. **Installera frontend-beroenden & bygg assets:**
   ```bash
   npm install
   npm run dev
   ```

4. **Skapa din miljöfil (.env):**
   ```bash
   cp .env.example .env
   ```
   *Öppna `.env` och ställ in din databas samt dina SMTP-inställningar för e-post (t.ex. Mailpit eller Mailtrap).*

5. **Generera applikationsnyckel & kör migreringar:**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

6. **Starta den lokala servern:**
   ```bash
   php artisan serve
   ```
   Besök sedan `http://127.0.0.1:8000` i din webbläsare!
