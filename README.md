*   **[🏍 MC Bloggen - Livet på två hjul (Live: www.andréa.se)](LÄNK_TILL_PROJEKTET)**
    En fullfjädrad motorcykelblogg med ett robust administrationsgränssnitt och avancerad backend-logik. 
    *   **Tekniska funktioner:** Komplett fil- och bildhantering (huvudbilder samt extra galleribilder med bildtexter) säkrad via UUID och paketerad i atomiska databastransaktioner (`DB::transaction`).
    *   **Automation & Köhantering:** Automatiserade nyhetsbrevsutskick till prenumeranter via Laravels `Mailable` och asynkrona bakgrundsköer (Queues).
    *   **Säkerhet & Spamskydd:** Skyddade adminsidor (CRUD) via autentisering, parat med osynliga Honeypots och Cloudflare Turnstile för att eliminera spambotar på publika formulär.


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

### 📬 Skräddarsytt Kontakt- & Ärendeformulär med Spamskydd
*   **Branschspecifika fält:** Innehåller fält för *MC-modell* och *Ärende*, vilket ger strukturerad data från besökaren.
*   **Robust validering:** Serversidans validering som säkerställer att e-postadresser är giltiga och att alla obligatoriska fält är ifyllda innan sändning.
*   **Mailable-integration:** Systemet använder Laravels `Mailable`-arkitektur för att omedelbart generera och skicka ett snyggt HTML-formaterat e-postmeddelande till bloggansvarig när en läsare hör av sig.
*   **🛡️ Avancerat Botskydd:** Integrerat med både en osynlig **Honeypot**-fälla och **Cloudflare Turnstile** (ett modernt, integritetsvänligt alternativ till reCAPTCHA) för att effektivt stoppa spambotar utan att förstöra       användarupplevelsen.


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
