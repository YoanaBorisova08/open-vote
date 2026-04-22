<h1 align="center">🗳 Open Vote</h1>

<p align="center">Web platform for publishing suggestions and voting</p>

<p align="center">
  <a href="https://open-vote.yoanaborisova.com">
    <img src="https://img.shields.io/badge/Live-open--vote.yoanaborisova.com-3B6D11?style=for-the-badge&logo=google-chrome&logoColor=EAF3DE&labelColor=27500A"/>
  </a>
</p>

---

## 📌 Project Overview

Open Vote is a web-based platform where users can publish suggestions, vote on ideas, and track their progress. The system includes user authentication and an administrative panel for content management.

Built with:
- **Laravel 13** (PHP Framework)
- **PHP 8.4**
- **MariaDB** with Eloquent ORM
- **Tailwind CSS v4**
- **Blade** templating engine
- **Pest** for testing
- **Laravel Herd** for local development

---

## 🎯 Project Objectives

- Users submit suggestions and ideas
- Other users browse, search, filter and vote
- Administrators manage content and update statuses
- Secure authentication with role-based access control
- Policies to protect suggestion ownership

---

## 👥 User Roles

### 👤 Regular User
- Register and login
- Create, edit and delete own suggestions
- Browse all suggestions in the forum
- Vote once per suggestion (toggle vote on/off)
- Search suggestions by title
- Filter by status
- Sort by date or votes
- View most popular and most recent suggestions on home page
- View own votes in "My Votes" section

### 🛠 Administrator
- All regular user permissions
- Change suggestion status directly from the card:
    - New
    - Approved
    - In Progress
    - Completed
    - Rejected
- Delete any suggestion
- Add administrative comments (optional)

---

## 🌐 Application Structure

### Public Section

**🏠 Home Page**
- Most popular suggestions (top 3 by votes)
- Most recent suggestions (latest 3)
- Search bar with live filtering

**📋 Forum / Suggestions List**
- Paginated list of all suggestions
- Sort by: newest, oldest, most voted, least voted
- Filter by status (auto-submits on change)
- Search by title

**📄 Suggestion Details Page**
- Title, description, author, status badge
- Created date and last modified
- Total votes with toggle vote button
- Admin status editor (admin only)
- Comments section

### 🔐 Registered User Section
- Registration and login pages
- Create suggestion page
- Edit suggestion page (owner only — enforced by Policy)
- My Votes page

### ⚙ Administrator Panel
- Status dropdown on every card (admin only)
- Delete any suggestion
- Role managed via `UserRoles` enum

---

## 🗄 Database Structure

| Table | Description |
|---|---|
| `users` | Stores user accounts with hashed passwords and roles |
| `suggestions` | User submitted ideas with status and timestamps |
| `votes` | Pivot table linking users and suggestions |
| `comments` | Comments on suggestions |

### Relationships
- One user → many suggestions (`hasMany`)
- One suggestion → many votes (`hasMany`)
- One user → many votes (`hasMany`)
- One vote → one suggestion, one user (`belongsTo`)
- One suggestion → many comments (`hasMany`)

---

## 🔄 CRUD Functionality

- **Create** — Submit new suggestions
- **Read** — Browse, search, filter and sort suggestions
- **Update** — Edit own suggestions / Admin updates status
- **Delete** — Remove own suggestions (Policy protected)

---

## 🔒 Security Features

- Password hashing via Laravel's built-in `bcrypt`
- CSRF protection on all forms
- Laravel Policies for suggestion ownership (`SuggestionPolicy`)
- Role-based access control via `UserRoles` enum and Gates
- One vote per user per suggestion enforced at DB and app level
- Route middleware: `auth`, `can:modify,suggestion`, `can:admin`

---

## ✅ Testing

Tests written with **Pest**:

```bash
php artisan test
```

---

## 🚀 Installation & Setup

### 1 — Clone the repository

```bash
git clone https://github.com/YoanaBorisova08/open-vote.git
cd open-vote
```

### 2 — Install dependencies

```bash
composer install --ignore-platform-reqs
npm install && npm run build
```

### 3 — Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:
```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=open_vote
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4 — Run migrations and seed

```bash
php artisan migrate --seed
```

### 5 — Create storage symlink

```bash
php artisan storage:link
```

### 6 — Run locally with Laravel Herd

Add the project to your Herd directory and visit:
```http://open-vote.test```

---

## 🛠 Technologies Used

| Technology | Purpose |
|---|---|
| Laravel 13 | PHP framework |
| PHP 8.4 | Server-side language |
| MariaDB | Database |
| Eloquent ORM | Database queries and relationships |
| Tailwind CSS v4 | Styling |
| Blade | Templating |
| Pest | Testing |
| Laravel Herd | Local development |
| Laravel Policies | Authorization |

---

## 👩‍💻 Author

**Yoana Borisova**
Web Application Development Project — 2026
[yoanaborisova.com](https://yoanaborisova.com)
