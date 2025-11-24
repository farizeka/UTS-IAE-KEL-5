# Enrollment Microservice - API Documentation

**Base URL:** `http://127.0.0.1:8000/api`

**Authentication:** Semua endpoint memerlukan token Sanctum. Tambahkan header berikut pada setiap request:
```
Authorization: Bearer YOUR_TOKEN_HERE
```

---

## 1. GET ALL ENROLLMENTS (dengan pagination & filter)

**Endpoint:** `GET /enrollments`

**URL:** `http://127.0.0.1:8000/api/enrollments`

**Query Parameters (Optional):**
- `per_page` (default: 15) - Jumlah record per halaman
- `status` - Filter by status (pending, active, completed, cancelled)
- `user_id` - Filter by user ID
- `course_id` - Filter by course ID

**Example URLs:**
```
http://127.0.0.1:8000/api/enrollments
http://127.0.0.1:8000/api/enrollments?per_page=10
http://127.0.0.1:8000/api/enrollments?status=active
http://127.0.0.1:8000/api/enrollments?user_id=1
http://127.0.0.1:8000/api/enrollments?course_id=5
http://127.0.0.1:8000/api/enrollments?status=active&user_id=1&per_page=20
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "user_id": 1,
        "course_id": 5,
        "status": "active",
        "grade": null,
        "notes": "Student is performing well",
        "enrolled_at": "2025-11-15T13:27:00.000000Z",
        "completed_at": null,
        "created_at": "2025-11-15T13:27:00.000000Z",
        "updated_at": "2025-11-15T13:27:00.000000Z",
        "user": {
          "id": 1,
          "name": "John Doe",
          "email": "john@example.com"
        }
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/enrollments?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/enrollments?page=1",
    "links": [],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/enrollments",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
  }
}
```

---

## 2. GET SPECIFIC ENROLLMENT

**Endpoint:** `GET /enrollments/{id}`

**URL:** `http://127.0.0.1:8000/api/enrollments/1`

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "course_id": 5,
    "status": "active",
    "grade": null,
    "notes": "Student is performing well",
    "enrolled_at": "2025-11-15T13:27:00.000000Z",
    "completed_at": null,
    "created_at": "2025-11-15T13:27:00.000000Z",
    "updated_at": "2025-11-15T13:27:00.000000Z",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
  }
}
```

**Response (404 Not Found):**
```json
{
  "message": "Not found"
}
```

---

## 3. CREATE NEW ENROLLMENT

**Endpoint:** `POST /enrollments`

**URL:** `http://127.0.0.1:8000/api/enrollments`

**Method:** POST

**Content-Type:** `application/json`

**Request Body:**
```json
{
  "user_id": 1,
  "course_id": 5,
  "status": "active",
  "grade": null,
  "notes": "Student is performing well"
}
```

**Request Body (Minimal):**
```json
{
  "user_id": 1,
  "course_id": 5
}
```

**Response (201 Created):**
```json
{
  "success": true,
  "message": "Enrollment created successfully.",
  "data": {
    "user_id": 1,
    "course_id": 5,
    "status": "pending",
    "grade": null,
    "notes": null,
    "updated_at": "2025-11-15T13:27:00.000000Z",
    "created_at": "2025-11-15T13:27:00.000000Z",
    "id": 1,
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
  }
}
```

**Response (422 Unprocessable Entity - Validation Error):**
```json
{
  "message": "User is already enrolled in this course.",
  "errors": {
    "enrollment": [
      "User is already enrolled in this course."
    ]
  }
}
```

---

## 4. UPDATE ENROLLMENT

**Endpoint:** `PUT /enrollments/{id}` atau `PATCH /enrollments/{id}`

**URL:** `http://127.0.0.1:8000/api/enrollments/1`

**Method:** PUT or PATCH

**Content-Type:** `application/json`

**Request Body:**
```json
{
  "status": "completed",
  "grade": 85.5,
  "notes": "Course completed successfully",
  "completed_at": "2025-11-15"
}
```

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Enrollment updated successfully.",
  "data": {
    "id": 1,
    "user_id": 1,
    "course_id": 5,
    "status": "completed",
    "grade": "85.50",
    "notes": "Course completed successfully",
    "enrolled_at": "2025-11-15T13:27:00.000000Z",
    "completed_at": "2025-11-15T00:00:00.000000Z",
    "created_at": "2025-11-15T13:27:00.000000Z",
    "updated_at": "2025-11-15T13:27:00.000000Z",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
  }
}
```

---

## 5. DELETE ENROLLMENT

**Endpoint:** `DELETE /enrollments/{id}`

**URL:** `http://127.0.0.1:8000/api/enrollments/1`

**Method:** DELETE

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Enrollment deleted successfully."
}
```

---

## 6. GET ENROLLMENTS BY USER

**Endpoint:** `GET /users/{userId}/enrollments`

**URL:** `http://127.0.0.1:8000/api/users/1/enrollments`

**Query Parameters (Optional):**
- `per_page` (default: 15)
- `status` - Filter by status

**Example URLs:**
```
http://127.0.0.1:8000/api/users/1/enrollments
http://127.0.0.1:8000/api/users/1/enrollments?per_page=10
http://127.0.0.1:8000/api/users/1/enrollments?status=active
http://127.0.0.1:8000/api/users/1/enrollments?status=completed&per_page=5
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "user_id": 1,
        "course_id": 5,
        "status": "active",
        "grade": null,
        "notes": "Student is performing well",
        "enrolled_at": "2025-11-15T13:27:00.000000Z",
        "completed_at": null,
        "created_at": "2025-11-15T13:27:00.000000Z",
        "updated_at": "2025-11-15T13:27:00.000000Z"
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/users/1/enrollments?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/users/1/enrollments?page=1",
    "links": [],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/users/1/enrollments",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
  }
}
```

---

## 7. GET ENROLLMENTS BY COURSE

**Endpoint:** `GET /courses/{courseId}/enrollments`

**URL:** `http://127.0.0.1:8000/api/courses/5/enrollments`

**Query Parameters (Optional):**
- `per_page` (default: 15)
- `status` - Filter by status

**Example URLs:**
```
http://127.0.0.1:8000/api/courses/5/enrollments
http://127.0.0.1:8000/api/courses/5/enrollments?per_page=10
http://127.0.0.1:8000/api/courses/5/enrollments?status=completed
http://127.0.0.1:8000/api/courses/5/enrollments?status=active&per_page=5
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "user_id": 1,
        "course_id": 5,
        "status": "active",
        "grade": null,
        "notes": "Student is performing well",
        "enrolled_at": "2025-11-15T13:27:00.000000Z",
        "completed_at": null,
        "created_at": "2025-11-15T13:27:00.000000Z",
        "updated_at": "2025-11-15T13:27:00.000000Z"
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/courses/5/enrollments?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/courses/5/enrollments?page=1",
    "links": [],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/courses/5/enrollments",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
  }
}
```

---

## 8. GET ENROLLMENT STATISTICS

**Endpoint:** `GET /enrollments/statistics/summary`

**URL:** `http://127.0.0.1:8000/api/enrollments/statistics/summary`

**Response (200 OK):**
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

## 9. BULK UPDATE ENROLLMENT STATUS

**Endpoint:** `POST /enrollments/bulk/update-status`

**URL:** `http://127.0.0.1:8000/api/enrollments/bulk/update-status`

**Method:** POST

**Content-Type:** `application/json`

**Request Body:**
```json
{
  "enrollment_ids": [1, 2, 3],
  "status": "active"
}
```

**Response (200 OK):**
```json
{
  "success": true,
  "message": "3 enrollments updated successfully.",
  "updated_count": 3
}
```

**Response (422 Unprocessable Entity - Validation Error):**
```json
{
  "message": "The status field is required.",
  "errors": {
    "status": [
      "The status field is required."
    ]
  }
}
```

---

## Testing Tips untuk POSTMAN

### 1. Setup Authorization Token
- Setiap request ke endpoint yang dilindungi harus menyertakan token di header
- Di POSTMAN, pergi ke tab **Authorization**
- Pilih tipe: **Bearer Token**
- Copy-paste token dari endpoint login auth-service

### 2. Headers yang diperlukan
```
Authorization: Bearer YOUR_TOKEN_HERE
Accept: application/json
Content-Type: application/json
```

### 3. Testing Flow
1. **Login dulu ke auth-service** untuk mendapatkan token
2. **Copy token** dan gunakan di semua endpoint enrollment
3. **Test GET endpoints** tanpa request body
4. **Test POST/PUT endpoints** dengan request body JSON
5. **Check response** apakah format JSON dan sesuai dokumentasi

### 4. Common Status Values
- `pending` - Baru didaftar, belum dimulai
- `active` - Sedang berlangsung
- `completed` - Selesai
- `cancelled` - Dibatalkan

---

## Error Responses

### 401 Unauthorized
```json
{
  "message": "Unauthenticated."
}
```
**Solusi:** Pastikan token sudah ada di Authorization header

### 404 Not Found
```json
{
  "message": "Not found"
}
```
**Solusi:** Cek ID enrollment/user/course apakah benar

### 422 Unprocessable Entity
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "user_id": [
      "The user id field is required."
    ]
  }
}
```
**Solusi:** Pastikan semua required field sudah diisi dengan benar

---

## Notes
- Semua timestamp menggunakan format ISO 8601 (UTC)
- Grade adalah decimal dengan 2 decimal places (0-100)
- Pagination default 15 items per page
- Semua responses memiliki `success` field untuk mudah di-parse
