import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

export default defineConfig({
  site: 'https://vkorn.at',
  output: 'static',
  compressHTML: true,
  integrations: [sitemap()],
});
