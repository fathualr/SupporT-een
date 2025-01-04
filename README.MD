# SupporT-een

SupporT-een built out of concern for the challenges teens face, SupporT-een is an AI-based app that supports mental health safely and easily. The app offers a space to pour out feelings without fear of stigma, provides support through virtual consultations, and helps teens manage pressures in education, relationships, and self-discovery.

## Team Structures
**PBLIF-19**
- Muchamad Fajri Amirul Nasrullah, S.ST., M.Sc (Project Manager)

- Muhammad Fathu Al Razi (Team Leader)
- Ahmad Dzikra Nasuma
- Mirza Ardanas
- Michael Lee
- Maria Zesi Versia Hutabarat

## Table of Contents
- [Overview](#overview)
- [Features](#features)
- [Requirements](#requirements)
- [Setup](#setup)
  - [Laravel Application](#laravel-application)
  - [Python Scripts](#python-scripts)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [License](#license)

## Overview
This repository contains a Laravel application to manage web functionalities and Python scripts for computational tasks or data processing. The project is designed to demonstrate the integration of these two technologies for solving complex problems.

## Features
- **Laravel**:
  - User authentication and authorization.
  - Database management with migrations and Eloquent ORM.

- **Python**:
  - Data analysis and processing scripts.
  - Integration with Laravel for specific tasks (e.g., machine learning, automation).

## Requirements

- **Laravel**:
  - PHP >= 8.0
  - Composer
  - MySQL

- **Python**:
  - Python >= 3.10
  - Pip
  - Virtualenv (recommended)

## Setup

### Laravel Application
1. Clone the repository:
   ```bash
   git clone https://github.com/fathualr/SupporT-een.git
   cd SupporT-een/laravel-project
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up environment variables:
   ```bash
   cp .env.example .env
   ```
   Update `.env` with your database and other credentials.

4. Run migrations and seeder:
   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

6. Run scheduling worker:
   ```bash
   php artisan schedule:work
   ```

7. Run broadcasting server:
   ```bash
   php artisan queue:work
   ```

### Python Scripts
1. Navigate to the Python directory:
   ```bash
   cd SupporT-een/python-project
   ```

2. Create a virtual environment (recommended):
   ```bash
   python -m venv venv
   source venv/bin/activate   # For Windows: venv\Scripts\activate
   ```

3. Install dependencies:
   ```bash
   pip install -r requirements.txt
   ```

4. Run Python scripts as needed:
   ```bash
   python app.py
   ```

## Usage

- Use Laravel for web-based functionalities.
- Run Python scripts independently or integrate them with Laravel as background processes or APIs.

## Project Structure
```
repository-root/
├── laravel-project/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── tests/
│   └── ...
├── python-project/
│   ├── datasets/
│   ├── models/
│   ├── app.py
│   └── requirements.txt
└── README.md
```

## License

This project is licensed under the MIT License. See the LICENSE file for details.
