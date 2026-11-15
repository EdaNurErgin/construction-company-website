# construction-company-website
## Arayüz (Tailwind CSS)

Stiller Tailwind CSS v4 ile yazılır ve derlenmiş çıktı repoya dahildir;
siteyi çalıştırmak için Node.js gerekmez.

| Klasör / dosya | Görev |
| --- | --- |
| `resources/css/app.css` | Giriş noktası (yalnızca `@import`'lar) |
| `resources/css/theme.css` | Renk ve yazı tipi token'ları |
| `resources/css/base.css` | Genel element stilleri |
| `resources/css/components/` | Bileşen sınıfları (buton, kart, form, tablo...) |
| `public/assets/css/app.css` | Derlenmiş çıktı — elle düzenlenmez |
| `public/assets/js/navigation.js` | Mobil menü aç/kapa |
| `public/assets/js/pagination.js` | Sayfalamayı tam sayfa yenilemeden günceller (`[data-pagination-region]`) |

Stil değiştirildikten sonra:

```bash
npm install      # ilk kurulum
npm run build    # minify edilmiş CSS üretir
npm run watch    # geliştirme sırasında otomatik derleme
```
