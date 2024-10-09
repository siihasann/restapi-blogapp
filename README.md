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

![Dashboard](![image](https://github.com/user-attachments/assets/6ec49a04-fde7-4a32-81e6-e6f905641c76)
)
![Create Post](![image](https://github.com/user-attachments/assets/ed43c991-a340-4714-b1b0-ac31613d3f54)
)

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
