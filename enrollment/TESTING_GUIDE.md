# Enrollment Microservice - Setup & Testing Guide

## Quick Start

### 1. Setup Database Migration & Seeding

Jalankan migration + seeding untuk membuat tabel `enrollments` + 5 sample data:

```bash
cd c:\xampp\htdocs\UTS_IAE\enrollment
php artisan migrate:fresh --seed
```

**Output:**
```
Fresh Migration
Migration table created successfully.
Migrating: 0001_01_01_000000_create_users_table
Migrating: 2025_11_15_133231_create_enrollments_table

Seeding: Database\Seeders\DatabaseSeeder
Seeding: Database\Seeders\EnrollmentSeeder
Database seeding completed successfully.
```

✅ Database siap dengan sample data (5 enrollments, 2 users)!

### 2. Verify Endpoints

Pastikan Laravel development server sudah berjalan:

```bash
php artisan serve
```

Server akan berjalan di: `http://127.0.0.1:8000`

### 3. Import Postman Collection

1. Buka POSTMAN
2. Klik **Import** → pilih file `Enrollment_API.postman_collection.json`
3. Koleksi akan ter-import dengan semua endpoints

### 4. Setup Variables di Postman

Di Postman, set environment variables:
- **base_url**: `http://127.0.0.1:8000/api`
- **token**: Dapatkan dari login auth-service dengan user `john@example.com` / `password123`

---

## Testing Flow

### Step 1: Get Authentication Token

1. **Endpoint**: `POST http://127.0.0.1:8000/api/login` (dari auth-service)
2. **Body**:
```json
{
  "email": "user@example.com",
  "password": "password"
}
```
3. **Copy token** dari response
4. **Paste di Postman** variable `{{token}}`

### Step 2: Test GET All Enrollments

**URL**: `http://127.0.0.1:8000/api/enrollments`

**Method**: GET

**Headers**:
```
Authorization: Bearer YOUR_TOKEN_HERE
Accept: application/json
```

**Response**: JSON array dengan pagination info

---

### Step 3: Test Create Enrollment

**URL**: `http://127.0.0.1:8000/api/enrollments`

**Method**: POST

**Headers**:
```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Body**:
```json
{
  "user_id": 1,
  "course_id": 5,
  "status": "active"
}
```

**Expected Response (201 Created)**:
```json
{
  "success": true,
  "message": "Enrollment created successfully.",
  "data": {
    "id": 1,
    "user_id": 1,
    "course_id": 5,
    "status": "active",
    "grade": null,
    "notes": null,
    "enrolled_at": "2025-11-15T13:27:00.000000Z",
    "created_at": "2025-11-15T13:27:00.000000Z",
    "updated_at": "2025-11-15T13:27:00.000000Z",
    "user": { ... }
  }
}
```

---

### Step 4: Test Update Enrollment

**URL**: `http://127.0.0.1:8000/api/enrollments/1`

**Method**: PUT

**Headers**:
```
Authorization: Bearer YOUR_TOKEN_HERE
Content-Type: application/json
```

**Body**:
```json
{
  "status": "completed",
  "grade": 90,
  "notes": "Great performance!"
}
```

**Expected Response (200 OK)**:
```json
{
  "success": true,
  "message": "Enrollment updated successfully.",
  "data": { ... }
}
```

---

### Step 5: Test Get User Enrollments

**URL**: `http://127.0.0.1:8000/api/users/1/enrollments`

**Method**: GET

**Response**: Semua enrollments untuk user dengan ID 1

---

### Step 6: Test Statistics

**URL**: `http://127.0.0.1:8000/api/enrollments/statistics/summary`

**Method**: GET

**Expected Response**:
```json
{
  "success": true,
  "data": {
    "total": 10,
    "active": 5,
    "completed": 3,
    "pending": 2,
    "cancelled": 0
  }
}
```

---

### Step 7: Test Delete Enrollment

**URL**: `http://127.0.0.1:8000/api/enrollments/1`

**Method**: DELETE

**Expected Response (200 OK)**:
```json
{
  "success": true,
  "message": "Enrollment deleted successfully."
}
```

---

## All Available Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/enrollments` | Get all enrollments (paginated) |
| POST | `/api/enrollments` | Create new enrollment |
| GET | `/api/enrollments/{id}` | Get specific enrollment |
| PUT | `/api/enrollments/{id}` | Update enrollment |
| PATCH | `/api/enrollments/{id}` | Partial update |
| DELETE | `/api/enrollments/{id}` | Delete enrollment |
| GET | `/api/users/{userId}/enrollments` | Get user's enrollments |
| GET | `/api/courses/{courseId}/enrollments` | Get course enrollments |
| GET | `/api/enrollments/statistics/summary` | Get statistics |
| POST | `/api/enrollments/bulk/update-status` | Bulk update status |

---

## Query Parameters

### `/api/enrollments`
- `per_page` (default: 15) - Items per page
- `status` - Filter: `pending`, `active`, `completed`, `cancelled`
- `user_id` - Filter by user ID
- `course_id` - Filter by course ID

### `/api/users/{userId}/enrollments`
- `per_page` (default: 15)
- `status` - Filter status

### `/api/courses/{courseId}/enrollments`
- `per_page` (default: 15)
- `status` - Filter status

---

## Status Values

- **pending** - Enrollment baru, belum dimulai
- **active** - Sedang berlangsung
- **completed** - Sudah selesai
- **cancelled** - Dibatalkan

---

## Database Fields

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key to users |
| course_id | bigint | Course ID (reference to course-management) |
| status | enum | pending, active, completed, cancelled |
| grade | decimal(5,2) | Nilai/grade (0-100) |
| notes | text | Catatan tambahan |
| enrolled_at | timestamp | Waktu enrollment |
| completed_at | timestamp | Waktu completion (nullable) |
| created_at | timestamp | Record created |
| updated_at | timestamp | Record updated |

---

## Error Handling

### 401 Unauthorized
```json
{
  "message": "Unauthenticated."
}
```
**Penyebab**: Token tidak ada atau invalid

### 404 Not Found
```json
{
  "message": "Not found"
}
```
**Penyebab**: Enrollment/User/Course tidak ditemukan

### 422 Unprocessable Entity
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "user_id": ["The user id field is required."]
  }
}
```
**Penyebab**: Validation error

---

## Troubleshooting

### CORS Error
Jika terjadi CORS error, pastikan:
1. Frontend dan backend di domain/port yang berbeda
2. CORS middleware sudah dikonfigurasi di Laravel

### Token Expired
- Generate token baru dari auth-service
- Update di Postman variable `{{token}}`

### Migration Error
Jalankan:
```bash
php artisan migrate:rollback
php artisan migrate
```

---

## Performance Tips

1. **Filtering** - Gunakan filter query untuk data yang besar
2. **Pagination** - Default 15 items, sesuaikan dengan kebutuhan
3. **Include Relations** - Endpoints sudah include user data otomatis
4. **Bulk Operations** - Gunakan bulk update untuk multiple records

---

## Files Structure

```
enrollment/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php
│   │       └── EnrollmentController.php ✅
│   └── Models/
│       ├── Enrollment.php ✅
│       └── User.php
├── database/
│   └── migrations/
│       └── 2025_11_15_133231_create_enrollments_table.php ✅
├── routes/
│   ├── api.php ✅
│   └── web.php ✅
├── API_DOCUMENTATION.md ✅
└── Enrollment_API.postman_collection.json ✅
```

---

## Next Steps

1. ✅ Setup database migration
2. ✅ Start Laravel server
3. ✅ Get authentication token
4. ✅ Import Postman collection
5. ✅ Test all endpoints
6. ✅ Integrate with UI (user-interface folder)

Siap untuk development! 🚀
