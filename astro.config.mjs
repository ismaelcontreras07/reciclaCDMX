import { defineConfig } from 'astro/config';
export default defineConfig({outDir:'./.build',build:{format:'file'}, vite:{build:{assetsInlineLimit:0}}});
