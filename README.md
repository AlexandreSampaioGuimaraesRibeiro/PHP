# PHP Projects

A collection of projects I developed using **PHP**, mainly with the **Laravel** framework and the **Blade** template engine.

## 🎯 About

This repository gathers individual projects developed throughout my studies and hands-on practice in web development with PHP, each one in its own folder.

## 🛠️ Technologies

- **PHP**
- **Laravel** — main framework used
- **Blade** — template engine for the views
- Other project-specific technologies (databases, libraries, etc.) are detailed in each project's individual README, when available.

## 📁 Projects

| Project | Description |
|---|---|
| `BeeWork/` | A platform designed to connect clients with professionals who provide basic services, such as gardening, painting, and other home services. |
| `ProjetoPersonalAcademiaAluno/` | A platform designed to connect clients with gyms and personal trainers. |
| `ConjuntoDeProjetos/` | A set of projects built during a project-building marathon hosted by SENAI-MG. |

## 🚀 How to run

Each project is independent. To run one of them:

```bash
cd project-name
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

*(adjust according to each project's specific requirements)*

## 👤 Author

Alexandre Sampaio Guimarães Ribeiro
