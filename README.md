# 📬 Laravel 13 - Kontaktformulär & Projektportfölj

Detta är ett av mina färdiga webbprojekt byggt med **Laravel 13**. Applikationen innehåller ett fullt fungerande kontaktformulär där användare kan skicka meddelanden, vilket sedan hanteras och skickas vidare som e-post med hjälp av Laravels **Mailable-klasser**.

## 🛠 Tech Stack
*   **Backend:** Laravel 13 & PHP 8.3+
*   **Authentication & Scaffolding:** Laravel Breeze
*   **Frontend:** Alpine.js (för reaktivitet) & Tailwind CSS (för styling)

## ✨ Funktioner
*   **Kontaktformulär:** Validering av input (namn, e-post, meddelande) på serversidan.
*   **Mailable:** Strukturering och utskick av HTML-mail till administratören när ett formulär skickas.
*   **Säkerhet:** Inbyggt CSRF-skydd på alla formulär via Laravel.

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
   *Öppna `.env` och ställ in din databas samt dina SMTP-inställningar för e-post (t.ex. via Mailpit eller Mailtrap).*

5. **Generera en applikationsnyckel:**
   ```bash
   php artisan key:generate
   ```

6. **Kör databasmigreringar:**
   ```bash
   php artisan migrate
   ```

7. **Starta den lokala servern:**
   ```bash
   php artisan serve
   ```
   Besök sedan `http://127.0.0.1:8000` i din webbläsare!

