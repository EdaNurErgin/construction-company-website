# Yapı ve Dekorasyon Şirketi — Web Sitesi

PHP ve MySQL ile yazılmış kurumsal web sitesi ve yönetim paneli.

- **Site:** Ana sayfa (son 3 hizmet), Hizmetler, İletişim formu
- **Yönetim paneli:** Giriş/çıkış, hizmet ekleme-düzenleme-silme, gelen mesajlar

## Kullanılan Teknolojiler

| Araç | Sürüm |
| --- | --- |
| PHP | 8.4 |
| MySQL Server | 8.4 |
| MySQL Workbench | 26.10 |
| Tailwind CSS | 4.1 (derlenmiş CSS projede hazır) |
| HTML / CSS | HTML5 / CSS3 |


Siteyi çalıştırmak için sadece **PHP 8+** ve **MySQL** gerekir.

## Kurulum

**1. Projeyi indirin**

```bash
git clone https://github.com/EdaNurErgin/construction-company-website.git
cd construction-company-website
```

**2. Veritabanını oluşturun**

MySQL Workbench'te **File → Open SQL Script** ile `database/schema.sql` dosyasını
açın ve **⚡** simgesine basın. Veritabanı ve tablolar otomatik oluşur.

**3. Ayar dosyasını oluşturun** ⚠️ *Bu adım olmadan site çalışmaz.*

`app/Config/config.example.php` dosyasını kopyalayın, adını **`config.php`** yapın
ve kendi MySQL kullanıcı adı ile şifrenizi yazın:

```php
'username' => 'root',
'password' => 'mysql-sifreniz',
```

**4. Siteyi başlatın**

```bash
php -S localhost:8000 -t public
```

Tarayıcıda açın: **http://localhost:8000**

**5. Admin hesabı oluşturun**

Hazır bir admin hesabı yoktur. **http://localhost:8000/admin/register.php**
adresinden bir hesap oluşturun (şifre en az 12 karakter), ardından giriş yapın.

Örnek: kullanıcı adı `admin`, şifre `Admin12345678`

## Sayfalar

| Sayfa | Adres |
| --- | --- |
| Ana sayfa | http://localhost:8000 |
| Hizmetler | http://localhost:8000/services.php |
| İletişim | http://localhost:8000/contact.php |
| Admin girişi | http://localhost:8000/admin/login.php |

## Sorun mu var?

| Hata | Çözüm |
| --- | --- |
| `config.php` bulunamadı | 3. adımı yapın. |
| `Access denied` veya bağlantı hatası | `config.php` içindeki kullanıcı adı/şifreyi kontrol edin. |
| `Unknown database` | 2. adımı yapın. |
| `could not find driver` | `php.ini` içinde `extension=pdo_mysql` satırının başındaki `;` işaretini silin. |
| Sayfalar tasarımsız / bağlantılar çalışmıyor | Sunucuyu `-t public` ile başlatın. |



```bash
npm install
npm run build
```
