import { defineConfig } from 'vite'

export default defineConfig({
  build: {
    outDir: 'public/build',    // La directory di destinazione per la build
    manifest: true,            // Assicurati che Vite generi il manifest.json
    rollupOptions: {
      input: ['resources/js/app.js', 'resources/css/app.css'],  // Includi sia il JS che il CSS come input
    },
  },
})
