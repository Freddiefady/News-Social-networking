<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project Overview

Social media platforms are digital tools that enable individuals and groups to interact, communicate, and share content such as text, images, and videos. They have become an integral part of daily life, serving social, professional, and educational purposes. ✨️✨️

## Features

The website provides the following features to help small business owners:

1. **Instant Communication**: Connect people worldwide in real time.
2. **Content Sharing**: Publish and share news, ideas, and media.
3. **Engagement**: Likes, comments, and discussions.
3. **Personalization**: Tailored content based on user interests.
3. **Marketing**: Powerful tools for promoting products and services.

## Challenges

1. Privacy and security concerns.
2. Spread of misinformation.
3. Overuse and addiction.

## How to Start Working on the Project

To get started with the project, you need to install and set up **Laravel**. Below are the instructions:

### Laravel Setup

1. **Install Composer**: Laravel uses Composer to manage its dependencies. You can install Composer by following the instructions [here](https://getcomposer.org/download/).

2. **Install Redis msi**: Redis is an in-memory database that persists on disk. [here](https://github.com/microsoftarchive/redis/releases).

3. **Clone the repository**:
   ```bash
   git clone https://github.com/Freddiefady/News-Social-networking.git
   cd News-Social-networking
   ```

4. **Install dependencies**:
   ```bash
   composer install
   ```

5. **Set up the environment**:
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

6. **Run database migrations**:
   ```bash
   php artisan migrate
   ```

7. **Start the Laravel development server**:
   ```bash
   php artisan serve
   ```

8. **Start Redis development server if you downloaded zip**:
   ```bash
   redis-server
   ```
9. **Use Queue to send notifications**:
   ```bash  
   php artisan queue:work
   ```
