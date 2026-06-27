# Veronika Korn – Portfolio Website

This is your artist portfolio website. Below you'll find everything you need to maintain it, add new paintings, and deploy updates — no coding experience required for the everyday tasks.

---

## How to add a new painting

Everything you need to do is in **two steps**:

### Step 1 — Add the image file

Copy the image of your painting into this folder:

```
public/images/works/
```

Name the file something short and descriptive, using only lowercase letters, numbers, and hyphens. For example: `rosen-am-fenster.jpg`

Good photo quality matters here: shoot in daylight without direct sun, front-on, no reflections. JPEG or PNG both work.

### Step 2 — Add an entry to the catalog

Open the file `src/data/artworks.json` in any text editor (TextEdit on Mac works fine).

At the end of the list, before the closing `]`, add a new entry. Copy this template and fill in your details:

```json
{
  "id": "rosen-am-fenster-2024",
  "title": "Rosen am Fenster",
  "year": 2024,
  "technique": "Öl auf Leinwand",
  "width_cm": 60,
  "height_cm": 80,
  "price": 1200,
  "currency": "EUR",
  "status": "available",
  "category": "original",
  "image": "/images/works/rosen-am-fenster.jpg",
  "description": "Eine kurze Beschreibung des Bildes.",
  "featured": false
}
```

**Important:**
- `id` must be unique — use the title + year, no spaces, only hyphens
- `status` is either `"available"` or `"sold"`
- `category` is either `"original"` or `"print"`
- `featured: true` shows the work on the homepage hero — use this for your best current work
- End each entry with a comma `,` except the very last one

That's it. After saving, rebuild the site and the new painting appears everywhere automatically.

---

## How to change the bio or artist statement

Open `src/pages/about.astro` in a text editor. The biography and statement text are there as plain paragraphs. Edit the German text directly and save.

---

## How to add an exhibition

Open `src/data/exhibitions.json`. Add a new entry following this format:

```json
{
  "year": 2025,
  "title": "Name der Ausstellung",
  "venue": "Galerie XY",
  "location": "Wien",
  "type": "Einzelausstellung",
  "upcoming": true,
  "date": "März 2025"
}
```

Set `"upcoming": true` for future exhibitions, `false` for past ones.

---

## Running the site locally (on your computer)

You need [Node.js](https://nodejs.org) installed (LTS version).

```bash
# Install once
npm install

# Start the local preview
npm run dev
```

Open your browser at **http://localhost:4321** to see the site.

---

## Building for production

```bash
npm run build
```

This creates a `dist/` folder with all the files ready to upload to your server.

---

## Deploying an update to the Hetzner server

### One-time server setup

```bash
# On your server (replace with your user and IP)
ssh user@YOUR_SERVER_IP

# Install Node.js (LTS)
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# Create the web folder
sudo mkdir -p /var/www/vkorn
sudo chown $USER:$USER /var/www/vkorn

# Install Nginx
sudo apt-get install -y nginx

# Copy the Nginx config
sudo cp /path/to/deploy/nginx.conf /etc/nginx/sites-available/vkorn.at
sudo ln -s /etc/nginx/sites-available/vkorn.at /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

### HTTPS with Let's Encrypt

```bash
sudo apt-get install -y certbot python3-certbot-nginx
sudo certbot --nginx -d vkorn.at -d www.vkorn.at
# Follow the prompts — Certbot fills in the certificate paths automatically
```

### DNS setup

In your domain registrar's DNS settings, point these records to your server's IP:

```
A     vkorn.at        YOUR_SERVER_IP
A     www.vkorn.at    YOUR_SERVER_IP
```

DNS changes take a few hours to propagate worldwide.

### Deploying an update (repeat each time)

On your local computer:

```bash
npm run build
```

Then upload the `dist/` folder to your server:

```bash
rsync -avz --delete dist/ user@YOUR_SERVER_IP:/var/www/vkorn/dist/
```

No server restart needed — Nginx serves the files directly.

---

## Contact form

The contact form is currently pointed at a [Formspree](https://formspree.io) placeholder. To activate it:

1. Create a free account at formspree.io
2. Create a new form and copy your form ID
3. Open `src/pages/contact.astro` and replace `YOUR_FORM_ID` in the action URL

---

## File overview

```
src/
  data/
    artworks.json      ← All paintings and prints live here
    exhibitions.json   ← All exhibitions live here
  pages/
    index.astro        ← Homepage
    gallery.astro      ← Works grid
    prints.astro       ← Prints shop
    about.astro        ← Bio and statement
    exhibitions.astro  ← Exhibition CV
    contact.astro      ← Contact form
    works/[id].astro   ← Individual work page (auto-generated)

public/
  images/works/        ← Put painting images here
  images/about/        ← Portrait photo goes here (portrait.svg → replace with a real photo)

deploy/
  nginx.conf           ← Nginx server configuration
```
