# RestAPI BlogApp

## Penjelasan Project

Admin Panel ini memungkinkan manajemen data Posts dan Comments dengan fitur autentikasi. Dibangun menggunakan Laravel, Livewire, Tailwind CSS, dan Laravel Sanctum untuk API authentication.

## Desain Database

### Tables

- **posts**
  - `id` (primary key)
  - `title` (string)
  - `content` (text)
  - `timestamps`

- **comments**
  - `id` (primary key)
  - `post_id` (foreign key ke posts.id)
  - `comment` (text)
  - `timestamps`

### Relasi

- Satu Post memiliki banyak Comments (One to Many).

## Screenshot Aplikasi
<img src="https://github.com/user-attachments/assets/43f4e8b2-b325-4658-befc-2e370b2fc11a" alt="Deskripsi Gambar" width="auto" />
<img src="https://github.com/user-attachments/assets/7ef03ca1-c69e-4b1e-b3d1-9113f9b418a3" alt="Deskripsi Gambar" width="500" />
<img src="https://github.com/user-attachments/assets/56d394fb-2509-426b-aaa1-6dc43a8b4734" alt="Deskripsi Gambar" width="500" />



## Dependency

- PHP >= 8.0.28
- Laravel Framework versi 9
- Livewire
- Tailwind CSS
- Laravel Sanctum
- Laravel Breze

## Instalasi

1. Clone repository:

   ```bash
   git clone 
   cd restapi-blogapp
