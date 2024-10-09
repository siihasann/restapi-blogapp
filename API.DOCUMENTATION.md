# Admin Panel API Documentation

## Authentication

### Register

- **Endpoint:** `/api/register`
- **Method:** `POST`
- **Body Parameters:**
  - `name` (string, required)
  - `email` (string, required, unique)
  - `password` (string, required, min:6)
  - `password_confirmation` (string, required)

### Login

- **Endpoint:** `/api/login`
- **Method:** `POST`
- **Body Parameters:**
  - `email` (string, required)
  - `password` (string, required)

### Logout

- **Endpoint:** `/api/logout`
- **Method:** `POST`
- **Headers:**
  - `Authorization: Bearer {token}`

## Posts

### Get All Posts

- **Endpoint:** `/api/posts`
- **Method:** `GET`
- **Headers:**
  - `Authorization: Bearer {token}`

### Get Post Detail

- **Endpoint:** `/api/posts/{id}`
- **Method:** `GET`
- **Headers:**
  - `Authorization: Bearer {token}`

### Search Posts

- **Endpoint:** `/api/search`
- **Method:** `GET`
- **Headers:**
  - `Authorization: Bearer {token}`
- **Query Parameters:**
  - `query` (string)

### Create Post

- **Endpoint:** `/api/posts`
- **Method:** `POST`
- **Headers:**
  - `Authorization: Bearer {token}`
- **Body Parameters:**
  - `title` (string, required)
  - `content` (string, required)

### Update Post

- **Endpoint:** `/api/posts/{id}`
- **Method:** `PUT/PATCH`
- **Headers:**
  - `Authorization: Bearer {token}`
- **Body Parameters:**
  - `title` (string, required)
  - `content` (string, required)

### Delete Post

- **Endpoint:** `/api/posts/{id}`
- **Method:** `DELETE`
- **Headers:**
  - `Authorization: Bearer {token}`
