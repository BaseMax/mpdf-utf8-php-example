# mpdf-utf8-php-example

A simple PHP project demonstrating how to generate right-to-left (RTL) **Persian invoices** as PDFs using [mPDF](https://github.com/mpdf/mpdf). This setup supports full **UTF-8 rendering**, **custom Persian fonts**, and is ready to clone, run, and customize.

## ✨ Key Features

- Generates **Persian-language invoices** with correct RTL layout
- Handles **UTF-8 non-ASCII characters**
- Loads and embeds **custom Persian fonts** (`Vazirmatn-Medium`)
- Supports multiple PHP versions (see compatibility section)

---

## ⚠️ Challenges Covered

This example solves common issues when working with Persian (Farsi) PDFs in PHP:

- ✅ Right-to-left text layout
- ✅ UTF-8 character support (Arabic script, numbers)
- ✅ Custom TTF font loading and usage in mPDF

> ℹ️ The example uses [Vazirmatn](https://github.com/rastikerdar/vazirmatn/releases/tag/v33.003), a high-quality Persian typeface by the late **VazirMatn** – a respected contributor to the Persian design community. Best and be at peace.

---

## 🧰 PHP Compatibility

Make sure to match your PHP version with the correct mPDF version:

| PHP Version   | Minimum mPDF Version |
|---------------|----------------------|
| ≥ 5.6 < 7.3   | 7.0                  |
| 7.3           | 7.1.7                |
| 7.4           | 8.0.4                |
| 8.0           | 8.0.10               |
| 8.1           | 8.0.13               |
| 8.2           | 8.1.3                |
| 8.3           | 8.2.1                |
| 8.4           | 8.2.5                |

### Required PHP Extensions

Make sure the following extensions are enabled in your `php.ini`:

- `mbstring`
- `gd`

---

## 📦 Installation

```bash
git clone https://github.com/BaseMax/mpdf-utf8-php-example.git
cd mpdf-utf8-php-example
composer install
php -S localhost:8000
```

Then open http://localhost:8000/invoice.php in your browser.

---

## 📄 License

MIT License

© 2025 Max Base
