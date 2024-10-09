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

![image](https://github.com/user-attachments/assets/7ef03ca1-c69e-4b1e-b3d1-9113f9b418a3)

## Dependency

- PHP >= 9.0
- Laravel Framework
- Livewire
- Tailwind CSS
- Laravel Sanctum
- Laravel Breze

## Instalasi

1. Clone repository:

   ```bash
   git clone 
   cd restapi-blogapp
