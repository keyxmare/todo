import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
export default defineConfig({
  plugins: [vue()],
  server: { host: true, proxy: { "/api": { target: "http://nginx", changeOrigin: true } }, },
  build: { outDir: "../backend/public/build", emptyOutDir: false },
})
