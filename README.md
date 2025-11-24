📘 EduConnect – Online Learning Platform
EduConnect adalah platform pembelajaran online berbasis arsitektur microservices yang menghubungkan mahasiswa, dosen, dan institusi pendidikan melalui layanan API yang berjalan secara terpisah namun terintegrasi melalui API Gateway. Seluruh interaksi dilakukan melalui endpoint API (Postman), dan juga melalui frontend. Dan user bisa mengembangkan lebih lanjut.

📂 Struktur Proyek
Folder utama berisi beberapa microservice:
```
auth-service – proses autentikasi & otorisasi
course-access – akses materi, daftar kursus
course-management – pengelolaan kursus oleh dosen
enrollment – pendaftaran kursus oleh mahasiswa
feedback – pemberian ulasan/penilaian non-akademik
user-interface – (opsional) interface jika dibuat
startServices.bat – script untuk menjalankan semua service sekaligus
```
```
educonnect-microservices-php/
├── api-gateway/                         # API Gateway (PHP)
│   ├── public/
│   │   └── index.php                    # Router utama
│   ├── src/
│   │   ├── Routes/
│   │   ├── Middleware/
│   │   └── Controllers/
│   ├── vendor/                          # Composer dependencies
│   ├── composer.json
│   └── README.md
│
├── auth-service/                        # Service 1: Auth / Student Service
│   ├── public/
│   │   └── index.php
│   ├── src/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   └── Routes/
│   ├── docs/                            # Dokumentasi API (Postman)
│   ├── database/
│   │   └── auth.db                      # SQLite atau MySQL dump
│   ├── composer.json
│   └── README.md
│
├── course-service/                      # Service 2: Course Service
│   ├── public/
│   │   └── index.php
│   ├── src/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   └── Routes/
│   ├── docs/
│   ├── database/
│   │   └── courses.db
│   ├── composer.json
│   └── README.md
│
├── enrollment-service/                  # Service 3: Enrollment Service
│   ├── public/
│   │   └── index.php
│   ├── src/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   └── Routes/
│   ├── docs/
│   ├── database/
│   │   └── enrollments.db
│   ├── composer.json
│   └── README.md
│
├── notification-service/                # Service 4: Notification Service
│   ├── public/
│   │   └── index.php
│   ├── src/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   └── Routes/
│   ├── docs/
│   ├── database/
│   │   └── notifications.db
│   ├── composer.json
│   └── README.md
│
├── grade-service/                       # Service 5: Grade Service
│   ├── public/
│   │   └── index.php
│   ├── src/
│   │   ├── Controllers/
│   │   ├── Models/
│   │   └── Routes/
│   ├── docs/
│   ├── database/
│   │   └── grades.db
│   ├── composer.json
│   └── README.md
│
├── frontend/                            # Frontend Sederhana (HTML+JS)
│   ├── index.html
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── README.md
│
├── docs/
│   ├── api-documentation/               # Export Postman / Swagger
│   │   └── educonnect.postman_collection.json
│   └── architecture/
│       ├── sequence-diagram.png
│       └── system-architecture.png
│
├── scripts/                             # Helper scripts
│   ├── start-all.sh                     # Menjalankan semua service
│   └── stop-all.sh                      # Menghentikan semua service
│
├── docker-compose.yml                   # Opsional jika ingin Docker
└── README.md                            # Dokumentasi utama
```

▶️ Cara Menjalankan Proyek
1. Clone Project
git clone <repo-url>
cd UTS_IAE

2. Menjalankan API Gateway
cd auth-service   # atau folder gateway jika Anda punya
composer install
cp .env.example .env
php artisan key:generate
php artisan serve --port=8000

📌 Gateway Port: 8000
```
Contoh routing di gateway:
/auth/... → auth-service
/courses/... → course-access
/manage/... → course-management
/enrollment/... → enrollment
/feedback/... → feedback
```

3. Menjalankan Masing-Masing Service (Contoh Format Umum)
Setiap service mengikuti pola yang sama:
cd <nama-service>
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve --port=<port-service>

🌐 Pengaturan ENV
```
ENV Gateway
AUTH_SERVICE_URL=http://127.0.0.1:8001
COURSE_ACCESS_URL=http://127.0.0.1:8002
COURSE_MANAGEMENT_URL=http://127.0.0.1:8003
ENROLLMENT_SERVICE_URL=http://127.0.0.1:8004
FEEDBACK_SERVICE_URL=http://127.0.0.1:8005

ENV Tiap Service
DB_CONNECTION=sqlite
APP_SERVICE_NAME=<nama-service>

Contoh:
APP_SERVICE_NAME=auth-service
```

📄 Dokumentasi API
Ringkasan endpoint + dokumentasi lengkap tersedia di folder:
docs/api/

🗂️ Struktur Postman Collection
```
EduConnect API
│
├── Auth Service
│   ├── Register User
│   ├── Login User
│   ├── Logout
│   └── Get Profile
│
├── Course Access Service
│   ├── Get All Courses
│   ├── Get Course Detail
│   ├── Get Materials
│   └── Search Course
│
├── Course Management Service
│   ├── Create Course
│   ├── Update Course
│   ├── Delete Course
│   └── Manage Materials
│
├── Enrollment Service
│   ├── Enroll to Course
│   ├── Check Enrollment Status
│   └── Get User Enrollments
│
├── Feedback Service
│   ├── Submit Feedback
│   ├── Get Feedback per Course
│   └── Delete Feedback
│
└── Gateway (All Routed Requests)
    ├── /auth/...
    ├── /courses/...
    ├── /manage/...
    ├── /enrollment/...
    └── /feedback/...
```


| Nama                | Peran             | Fitur                                |
| ------------------- | ----------------- | ------------------------------------ |
| Aura Haya Azka      | Backend Developer | Course Access , Course Management, Feedback, Course Management, Enrollment, Feedback, Auth                 |
| Aulia Indah Nuriaji | Backend Developer | Course Access , Course Management, Feedback, Course Management, Enrollment, Feedback, Auth                     |
| Noviardha Fitri Yuldhari| Backend Developer | Course Access , Course Management, Feedback, Course Management, Enrollment, Feedback, Auth
| Billy Aditya        | System Analyst    | Grades                   |
| M. Fariz Eka        | System Analyst    | Notification |
