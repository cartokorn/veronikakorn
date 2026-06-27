# Claude Code Prompt: Artist Portfolio Website

Build a simple, elegant, and effective portfolio website for a Vienna-based fine artist (oil paintings). The site should help her sell paintings and prints, attract gallery and exhibition opportunities, and build a reputable name in the art scene. The artwork is the hero — the design must get out of the way and let the paintings speak.

## Tech Stack

- Use a modern **npm-based JavaScript framework**. **Astro** is preferred (fast, content-focused, ships minimal JS), but **Next.js (React)** is acceptable if it fits better. Set the project up with `npm`.
- Keep dependencies lean so the site stays fast, cheap to host, and maintainable.
- Production build must output a deployable site (static export or Node server) that can run on a **self-managed Hetzner VPS** behind **Nginx** (see deployment section).
- Excellent performance: optimized, lazy-loaded, responsive images (use the framework's image optimization where available).

## Responsiveness (critical requirement)

- **Mobile-first.** It must look excellent on a phone — this is a hard requirement, not an afterthought. Assume most visitors arrive via Instagram on mobile.
- Fully responsive across phone, tablet, and desktop using fluid layouts and CSS (Flexbox/Grid). Test breakpoints for small phones (~360px) up to large desktops.
- The gallery grid must reflow gracefully (e.g. 1 column on phones, 2–3 on tablets, 3–4 on desktop). Touch targets must be comfortably large; the lightbox/detail view must be fully usable on touch screens.

## JSON Catalog (critical requirement)

- The entire artwork catalog must live in a **single JSON file** (e.g. `src/data/artworks.json` or served from `/public/artworks.json`).
- The website must **read this JSON dynamically** and render the gallery, detail views, and prints section from it. Adding, editing, or removing a painting must require **only editing the JSON file and dropping an image into a folder** — no code changes.
- Each entry should include at least: `id`, `title`, `year`, `technique`, `width_cm`, `height_cm`, `price`, `currency`, `status` (`available` / `sold`), `category` (`original` / `print`), `image` (path), `thumbnail` (optional), `description` (optional), `featured` (boolean for homepage hero).
- Validate gracefully: if a field is missing, the site should still render without breaking.
- Include 6–8 realistic placeholder entries and matching placeholder images so the site looks complete on first run.

## Design Direction

- Clean, gallery-like, minimal. Generous whitespace; the artwork is the focus.
- Neutral, sophisticated palette (off-white / warm gray / soft black) with one restrained accent color.
- Elegant typography: a refined serif for headings, a clean sans-serif for body (system or Google Fonts).
- No clutter, no template look. Quiet confidence over flashiness. Subtle, tasteful interactions only (gentle hover states, smooth fade-ins).
- Accessible: strong contrast, alt text on every image, keyboard-navigable, semantic HTML.

## Pages / Sections

1. **Home** — Striking hero featuring the `featured` work(s) from the JSON, the artist's name, and a one-line statement. Clear navigation.
2. **Gallery / Works** — Responsive grid rendered from the JSON. Clicking a work opens a detail view (lightbox or dedicated route) showing title, year, technique, dimensions, price, availability status, and an inquiry button.
3. **Prints / Shop** — Section for limited-edition prints (filtered from the JSON by `category: print`) with price and a purchase/inquiry path (contact-based ordering is fine; no full e-commerce needed).
4. **About** — Artist bio, artist statement, portrait photo.
5. **Exhibitions / CV** — Clean chronological list of past and upcoming exhibitions (can also be JSON-driven).
6. **Contact** — Simple contact form (or clear email link) for purchase and exhibition inquiries, plus an Instagram link and an email newsletter sign-up field.

## SEO & Sharing

- Sensible page titles, meta descriptions, and Open Graph / Twitter Card tags so shared links show the artwork.
- Descriptive image alt text, a generated `sitemap.xml`, and `robots.txt`.

## Deployment (self-hosted on Hetzner + custom domain)

The user owns a domain and a Hetzner server. Provide everything needed to deploy:

- Build instructions and the production output (static files for Nginx, or a Node process managed by **PM2**/systemd if a server runtime is required).
- A sample **Nginx** server block (serving the site, gzip/compression, caching headers for images).
- Steps to point the custom domain's DNS to the server and to enable **HTTPS with Let's Encrypt (Certbot)**.
- Optionally include a `Dockerfile` + `docker-compose.yml` as an alternative deployment path.
- A short, repeatable "deploy an update" workflow (build locally or on server, copy/pull, reload Nginx).

## Maintainability

- Keep the codebase small, well-commented, and organized.
- Add a plain-language `README.md` explaining, for a **non-technical person**: how to add a new painting (edit JSON + add image), how to change the bio/text, how to run locally, and how to deploy an update to the server.

## Deliverables

1. The complete npm project, ready to run locally (`npm install`, `npm run dev`) and build (`npm run build`).
2. The JSON catalog with placeholder data and placeholder images.
3. Nginx config + HTTPS/domain setup instructions (and optional Docker files).
4. The plain-language `README.md` for ongoing maintenance and deployment.

Start by proposing the file/folder structure, the chosen framework, and the design approach, then build it out.