# 🌱 ENROLLMENT DATABASE SEEDER

## Apa itu Seeder?

Seeder adalah script yang mengisi database dengan sample data. Saat testing, Anda tidak perlu manual create enrollment satu per satu.

---

## 📁 Files

### EnrollmentSeeder.php
- Membuat 5 enrollment data sample
- Mencakup semua status: pending, active, completed, cancelled
- User ID: 1 (John Doe)

### DatabaseSeeder.php
- Membuat 2 user sample:
  - John Doe (john@example.com)
  - Jane Smith (jane@example.com)
- Memanggil EnrollmentSeeder untuk membuat enrollment

---

## 🚀 Cara Menggunakan

### Step 1: Fresh Database
```bash
php artisan migrate:fresh
```

**Atau jika sudah ada:**
```bash
php artisan migrate:refresh
```

### Step 2: Jalankan Seeder
```bash
php artisan db:seed
```

**Output:**
```
Database seeding completed successfully.
```

### Step 3: Testing di Postman
```
GET http://127.0.0.1:8000/api/enrollments
```

**Response:** 
Anda akan langsung melihat 5 enrollment data yang sudah di-buat oleh seeder! ✅

---

## 📊 Sample Data yang Dibuat

### Users
| ID | Name | Email | Password |
|----|------|-------|----------|
| 1 | John Doe | john@example.com | password123 |
| 2 | Jane Smith | jane@example.com | password123 |

### Enrollments
| ID | User | Course | Status | Grade | Notes |
|----|------|--------|--------|-------|-------|
| 1 | 1 | 1 | active | null | Student is actively participating in the course |
| 2 | 1 | 2 | completed | 95.5 | Excellent performance throughout the course |
| 3 | 1 | 3 | pending | null | Enrollment pending approval |
| 4 | 1 | 4 | active | 87.0 | Good progress, keep up the work |
| 5 | 1 | 5 | cancelled | null | Student requested course cancellation |

---

## 🧪 Testing Scenarios

### Scenario 1: Get All Enrollments
```
GET http://127.0.0.1:8000/api/enrollments
```
✅ Akan menampilkan 5 enrollment dengan data dari seeder

### Scenario 2: Filter by Status
```
GET http://127.0.0.1:8000/api/enrollments?status=active
```
✅ Akan menampilkan 2 enrollment (ID 1 & 4)

### Scenario 3: Get User Enrollments
```
GET http://127.0.0.1:8000/api/users/1/enrollments
```
✅ Akan menampilkan 5 enrollment untuk user 1

### Scenario 4: Get Statistics
```
GET http://127.0.0.1:8000/api/enrollments/statistics/summary
```
✅ Response:
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

---

## 🎯 Complete Setup Flow

```bash
# 1. Fresh database
php artisan migrate:fresh

# 2. Seed database
php artisan db:seed

# 3. Start server
php artisan serve

# 4. Open Postman and test!
GET http://127.0.0.1:8000/api/enrollments
→ See 5 enrollment data ✅
```

---

## 🔄 Reset Database

### Option 1: Fresh & Seed (Recommended)
```bash
php artisan migrate:fresh --seed
```
✅ Hapus semua data + jalankan migration + jalankan seeder

### Option 2: Refresh & Seed
```bash
php artisan migrate:refresh --seed
```
✅ Jalankan ulang migration + jalankan seeder

### Option 3: Only Seed
```bash
php artisan db:seed
```
⚠️ Hanya jalankan seeder (jangan reset DB)

---

## 📝 Custom Seeding

Ingin tambah lebih banyak enrollment? Edit `EnrollmentSeeder.php`:

```php
Enrollment::create([
    'user_id' => 1,
    'course_id' => 10,
    'status' => 'active',
    'grade' => 92.0,
    'notes' => 'Your custom enrollment note',
    'enrolled_at' => now()->subDays(20),
]);
```

Kemudian jalankan:
```bash
php artisan migrate:fresh --seed
```

---

## ✅ QUICK COMMANDS

```bash
# Fresh + Seed (from scratch)
php artisan migrate:fresh --seed

# Only reset & seed (keep structure)
php artisan migrate:refresh --seed

# Only seed (add more data)
php artisan db:seed

# Seed specific seeder only
php artisan db:seed --class=EnrollmentSeeder
```

---

## 🎉 READY TO TEST!

Sekarang Anda bisa:
- ✅ GET all enrollments (akan ada 5 data)
- ✅ Filter by status
- ✅ Get user enrollments
- ✅ Get statistics
- ✅ Test semua endpoint dengan data yang ada!

---

## 📌 IMPORTANT

- Seeder membuat data dengan user_id = 1
- Pastikan migration sudah dijalankan sebelum seeding
- Jalankan `migrate:fresh --seed` untuk fresh start
- Seeder hanya jalankan di local/development, JANGAN di production

---

**Happy Testing! 🚀**
