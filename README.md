# 🚀 CandidatureTracker

**CandidatureTracker** is a modern, professional web application designed to help job seekers organize and monitor their job hunt. Built with **Laravel 13**, it provides a streamlined interface to track job applications, manage interviews, and maintain a history of your professional journey.

---

## ✨ Features

### 📋 Application Management
- **Full CRUD:** Create, view, update, and archive job applications.
- **Advanced Filtering:** Filter your applications by status and priority to focus on what matters.
- **Detailed Tracking:** Store company names, job titles, offer URLs, and application dates.
- **Status & Priority:** Categorize applications using type-safe Enums (Sent, In Progress, Rejected, etc.) and priority levels (Low, Medium, High).
- **CV/Resume Management:** Upload, store, and download specific CVs used for each application.
- **Soft Deletes:** Archive applications without permanent deletion, with the ability to restore them later.

### 🗓️ Interview Tracking
- **Linked Interviews:** Schedule multiple interviews for each job application.
- **Detailed Scheduling:** Track interview types (Technical, HR, Managerial), date/time, and location.
- **Preparation Notes:** Keep track of specific notes and preparation materials for each meeting.
- **Result Tracking:** Record and review the outcome of each interview.

### 📊 Dashboard & Insights
- **Key Statistics:** At-a-glance view of total applications, upcoming interviews, and received offers.
- **Status Breakdown:** Visual representation of your application funnel.
- **Upcoming Events:** List of the next 5 scheduled interviews.
- **Recent Activity:** Quick access to the most recently updated applications.

---

## 🛠️ Technologies Used

### Backend
- **Framework:** [Laravel 13](https://laravel.com/)
- **Language:** PHP 8.3
- **Authentication:** [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze)
- **Database:** Compatible with MySQL, PostgreSQL, or SQLite

### Frontend
- **Styling:** [Tailwind CSS](https://tailwindcss.com/)
- **Interactivity:** [Alpine.js](https://alpinejs.dev/)
- **Build Tool:** [Vite](https://vitejs.dev/)

### Testing
- **Framework:** [Pest PHP](https://pestphp.com/)

---

## 🚀 Installation

Follow these steps to get the project running locally:

### 1. Clone the repository
```bash
git clone <repository-url>
cd candidaturetracker
```

### 2. Install dependencies
```bash
composer install
npm install
```

### 3. Environment configuration
Copy the example environment file and generate an application key:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
Update your `.env` file with your database credentials, then run the migrations:
```bash
php artisan migrate
```

### 5. Build Assets
Compile the frontend assets using Vite:
```bash
npm run build
# OR for development
npm run dev
```

### 6. Start the server
```bash
php artisan serve
```

---

## 📂 Project Structure

```text
candidaturetracker/
├── app/
│   ├── Enums/          # Type-safe Statut, Priorite, TypeEntretien, etc.
│   ├── Http/
│   │   ├── Controllers/ # Business logic for Dashboard, Candidatures, and Entretiens
│   │   └── Requests/    # Form validation logic
│   └── Models/          # Eloquent models (User, Candidature, Entretien)
├── database/
│   └── migrations/      # Database schema definitions
├── resources/
│   ├── js/             # JavaScript & Alpine.js logic
│   ├── css/            # Tailwind CSS source
│   └── views/          # Blade templates (Dashboard, CRUD views, Auth)
├── routes/
│   └── web.php          # Main application routes
└── tests/               # Pest test suite
```

---

## 🛣️ API & Routes

The application follows standard RESTful routing for its core resources:

- **Dashboard:** `/dashboard`
- **Candidatures:** `/candidatures` (Index, Create, Edit, Show)
- **Archives:** `/archives` (Manage soft-deleted applications)
- **Entretiens:** Nested routes under candidatures for creation, standalone for management.

---

## 🔮 Future Improvements

- [ ] Email notifications for upcoming interviews.
- [ ] Calendar view for interview scheduling.
- [ ] Support for multiple languages (Localization).
- [ ] Exporting data to CSV or PDF reports.
- [ ] Integration with LinkedIn or other job boards via API.

---

## 👤 Author

**Gemini CLI** (On behalf of the developer)

---

*This project was documented automatically by Gemini CLI based on the existing codebase.*
