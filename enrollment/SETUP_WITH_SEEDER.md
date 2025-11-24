# 🚀 ENROLLMENT API - COMPLETE SETUP WITH SEEDER

## ✅ SETUP LENGKAP (One Command!)

```bash
cd c:\xampp\htdocs\UTS_IAE\enrollment
php artisan migrate:fresh --seed
```

**Output:**
```
Dropping all tables
Creating migration table
Running migrations:
  - 0001_01_01_000000_create_users_table
  - 0001_01_01_000001_create_cache_table
  - 0001_01_01_000002_create_jobs_table
  - 2025_11_15_132713_create_personal_access_tokens_table
  - 2025_11_15_133231_create_enrollments_table

Seeding database:
  - Database\Seeders\EnrollmentSeeder

Database seeding completed successfully ✅
```

---

## 📊 DATA YANG DIBUAT

### Users (2 User)
```
ID | Name | Email | Password
1  | John Doe | john@example.com | password123
2  | Jane Smith | jane@example.com | password123
```

### Enrollments (5 Enrollment)
```
ID | User | Course | Status | Grade | Notes
1  | 1 | 1 | active | null | Student is actively participating in the course
2  | 1 | 2 | completed | 95.5 | Excellent performance throughout the course
3  | 1 | 3 | pending | null | Enrollment pending approval
4  | 1 | 4 | active | 87.0 | Good progress, keep up the work
5  | 1 | 5 | cancelled | null | Student requested course cancellation
```

---

## 🎯 LANGKAH LENGKAP SETUP

### 1. Navigate to Enrollment Folder
```bash
cd c:\xampp\htdocs\UTS_IAE\enrollment
```

### 2. Run Migration + Seeding
```bash
php artisan migrate:fresh --seed
```
✅ Database + 5 sample enrollments ready!

### 3. Start Server
```bash
php artisan serve
```
Server di: `http://127.0.0.1:8000`

### 4. Test GET Endpoint
```
GET http://127.0.0.1:8000/api/enrollments
```

✅ Hasilnya akan menampilkan 5 enrollment data!

---

## 🧪 QUICK TEST FLOW

```bash
# 1. Setup DB (migration + seeding)
php artisan migrate:fresh --seed

# 2. Start server
php artisan serve

# 3. Di terminal baru, test endpoint:
curl -H "Authorization: Bearer YOUR_TOKEN" \
  http://127.0.0.1:8000/api/enrollments

# 4. Lihat 5 enrollment data dalam JSON format ✅
```

---

## 📋 SEEDING COMMANDS

### Fresh Start (Recommended)
```bash
php artisan migrate:fresh --seed
```
✅ Bersihkan database + jalankan ulang migration + seeding

### Reset & Reseed
```bash
php artisan migrate:refresh --seed
```
✅ Ulang migration + jalankan seeding

### Only Seed
```bash
php artisan db:seed
```
⚠️ Hanya jalankan seeder (database structure tetap)

### Seed Specific Seeder
```bash
php artisan db:seed --class=EnrollmentSeeder
```

---

## ✨ SAMPLE RESPONSES

### GET All Enrollments
```bash
GET http://127.0.0.1:8000/api/enrollments
```

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "user_id": 1,
        "course_id": 1,
        "status": "active",
        "grade": null,
        "notes": "Student is actively participating in the course",
        "enrolled_at": "2025-10-16 13:27:00",
        "completed_at": null,
        "created_at": "2025-11-15T13:27:00.000000Z",
        "updated_at": "2025-11-15T13:27:00.000000Z"
      },
      {
        "id": 2,
        "user_id": 1,
        "course_id": 2,
        "status": "completed",
        "grade": "95.50",
        "notes": "Excellent performance throughout the course",
        "enrolled_at": "2025-08-16 13:27:00",
        "completed_at": "2025-11-01T13:27:00.000000Z",
        "created_at": "2025-11-15T13:27:00.000000Z",
        "updated_at": "2025-11-15T13:27:00.000000Z"
      },
      ...
    ],
    "first_page_url": "http://127.0.0.1:8000/api/enrollments?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/enrollments?page=1",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/enrollments",
    "per_page": 15,
    "prev_page_url": null,
    "to": 5,
    "total": 5
  }
}
```

### GET Statistics
```bash
GET http://127.0.0.1:8000/api/enrollments/statistics/summary
```

**Response:**
```json
{
  "success": true,
  "data": {
    "total": 5,
    "active": 2,
    "completed": 1,
    "pending": 1,
    "cancelled": 1
  }
}
```

### Filter by Status
```bash
GET http://127.0.0.1:8000/api/enrollments?status=active
```

**Response:** 2 enrollments (active)

---

## 🎯 POSTMAN TESTING

1. **Import Collection**
   - File → Import → `Enrollment_API.postman_collection.json`

2. **Set Variables**
   - `{{base_url}}`: `http://127.0.0.1:8000/api`
   - `{{token}}`: Token dari login

3. **Test Endpoints**
   - GET `/enrollments` → Lihat 5 data ✅
   - GET `/enrollments/1` → Lihat enrollment 1 ✅
   - GET `/enrollments?status=active` → Filter ✅
   - GET `/enrollments/statistics/summary` → Stats ✅

---

## 📁 SEEDER FILES

### EnrollmentSeeder.php
- Membuat 5 enrollment dengan berbagai status
- User ID: 1 (dari DatabaseSeeder)
- Course ID: 1-5

### DatabaseSeeder.php
- Membuat 2 test users
- John Doe (john@example.com)
- Jane Smith (jane@example.com)
- Memanggil EnrollmentSeeder

**Location:** `database/seeders/`

---

## ✅ CHECKLIST

- [ ] Run migration: `php artisan migrate:fresh --seed`
- [ ] Start server: `php artisan serve`
- [ ] Check database has 5 enrollments
- [ ] Login auth-service dengan john@example.com
- [ ] Get token dan set di Postman
- [ ] Test GET /api/enrollments
- [ ] Lihat 5 enrollment data ✅

---

## 🎉 READY!

Everything is set up:
- ✅ Database dengan 5 sample enrollments
- ✅ 2 test users
- ✅ All endpoints ready to test
- ✅ Sample data untuk development

**Langsung bisa testing di POSTMAN! 🚀**

---

## 📚 RELATED DOCS

- `SEEDING_GUIDE.md` - Detailed seeding guide
- `SIMPLE_START.md` - Quick start
- `POSTMAN_INSTALLATION.md` - Postman setup
- `TESTING_GUIDE.md` - Testing workflow

---

**Happy Testing! 🎯**

*Last Updated: 2025-11-15*
