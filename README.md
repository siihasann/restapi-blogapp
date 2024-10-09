# Admin Panel

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

![Dashboard](screenshots/dashboard.png)
![Create Post](screenshots/create_post.png)

## Dependency

- PHP >= 8.0
- Laravel Framework
- Livewire
- Tailwind CSS
- Laravel Sanctum

## Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/username/admin-panel.git
   cd admin-panel
