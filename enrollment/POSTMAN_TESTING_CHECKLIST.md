# 🎯 POSTMAN Testing Checklist - Enrollment Microservice

**Base URL:** `http://127.0.0.1:8000/api`

**Authentication:** Semua request memerlukan header `Authorization: Bearer {{token}}`

---

## ✅ SETUP CHECKLIST

- [ ] Database migration sudah dijalankan (`php artisan migrate`)
- [ ] Laravel server berjalan (`php artisan serve`)
- [ ] Postman sudah install
- [ ] Token sudah didapatkan dari auth-service login
- [ ] Variable `{{token}}` sudah di-set di Postman
- [ ] File `Enrollment_API.postman_collection.json` sudah di-import

---

## 📋 CRUD OPERATIONS

### 1️⃣ CREATE ENROLLMENT (POST)

**URL:** `http://127.0.0.1:8000/api/enrollments`

**Method:** POST

**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
  "user_id": 1,
  "course_id": 5,
  "status": "active",
  "notes": "Test enrollment"
}
```

**Expected Response:** `201 Created`
```json
{
  "success": true,
  "message": "Enrollment created successfully.",
  "data": { ... }
}
```

- [ ] Create enrollment successful (status: 201)

---

### 2️⃣ GET ALL ENROLLMENTS (GET)

**URL:** `http://127.0.0.1:8000/api/enrollments`

**Method:** GET

**Headers:**
```
Authorization: Bearer {{token}}
Accept: application/json
```

**Query Parameters (Optional):**
- `per_page=15`
- `status=active`
- `user_id=1`
- `course_id=5`

**Expected Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "total": X,
    ...
  }
}
```

**Test URLs:**
- [ ] `http://127.0.0.1:8000/api/enrollments` (basic)
- [ ] `http://127.0.0.1:8000/api/enrollments?per_page=5` (with pagination)
- [ ] `http://127.0.0.1:8000/api/enrollments?status=active` (with status filter)
- [ ] `http://127.0.0.1:8000/api/enrollments?user_id=1` (with user filter)
- [ ] `http://127.0.0.1:8000/api/enrollments?course_id=5` (with course filter)

---

### 3️⃣ GET SPECIFIC ENROLLMENT (GET)

**URL:** `http://127.0.0.1:8000/api/enrollments/{id}`

**Example:** `http://127.0.0.1:8000/api/enrollments/1`

**Method:** GET

**Headers:**
```
Authorization: Bearer {{token}}
Accept: application/json
```

**Expected Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "course_id": 5,
    "status": "active",
    ...
  }
}
```

- [ ] Get enrollment by ID successful
- [ ] Response includes user data
- [ ] Get non-existent ID returns 404

---

### 4️⃣ UPDATE ENROLLMENT (PUT/PATCH)

**URL:** `http://127.0.0.1:8000/api/enrollments/{id}`

**Example:** `http://127.0.0.1:8000/api/enrollments/1`

**Method:** PUT or PATCH

**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
  "status": "completed",
  "grade": 85.5,
  "notes": "Completed with good performance",
  "completed_at": "2025-11-15"
}
```

**Expected Response:** `200 OK`
```json
{
  "success": true,
  "message": "Enrollment updated successfully.",
  "data": { ... }
}
```

- [ ] Update enrollment status successful
- [ ] Update grade field successful
- [ ] Update notes field successful
- [ ] PATCH (partial update) works
- [ ] PUT (full update) works

---

### 5️⃣ DELETE ENROLLMENT (DELETE)

**URL:** `http://127.0.0.1:8000/api/enrollments/{id}`

**Example:** `http://127.0.0.1:8000/api/enrollments/1`

**Method:** DELETE

**Headers:**
```
Authorization: Bearer {{token}}
Accept: application/json
```

**Expected Response:** `200 OK`
```json
{
  "success": true,
  "message": "Enrollment deleted successfully."
}
```

- [ ] Delete enrollment successful
- [ ] Get deleted enrollment returns 404

---

## 🔍 FILTER & SEARCH ENDPOINTS

### 6️⃣ GET USER ENROLLMENTS (GET)

**URL:** `http://127.0.0.1:8000/api/users/{userId}/enrollments`

**Example:** `http://127.0.0.1:8000/api/users/1/enrollments`

**Method:** GET

**Headers:**
```
Authorization: Bearer {{token}}
Accept: application/json
```

**Query Parameters (Optional):**
- `per_page=15`
- `status=active`

**Test URLs:**
- [ ] `http://127.0.0.1:8000/api/users/1/enrollments` (basic)
- [ ] `http://127.0.0.1:8000/api/users/1/enrollments?status=active` (with filter)
- [ ] `http://127.0.0.1:8000/api/users/1/enrollments?per_page=10` (with pagination)

**Expected Response:** `200 OK` dengan enrollments untuk user tertentu

---

### 7️⃣ GET COURSE ENROLLMENTS (GET)

**URL:** `http://127.0.0.1:8000/api/courses/{courseId}/enrollments`

**Example:** `http://127.0.0.1:8000/api/courses/5/enrollments`

**Method:** GET

**Headers:**
```
Authorization: Bearer {{token}}
Accept: application/json
```

**Query Parameters (Optional):**
- `per_page=15`
- `status=completed`

**Test URLs:**
- [ ] `http://127.0.0.1:8000/api/courses/5/enrollments` (basic)
- [ ] `http://127.0.0.1:8000/api/courses/5/enrollments?status=completed` (with filter)
- [ ] `http://127.0.0.1:8000/api/courses/5/enrollments?per_page=10` (with pagination)

**Expected Response:** `200 OK` dengan enrollments untuk course tertentu

---

## 📊 STATISTICS & ANALYTICS

### 8️⃣ GET ENROLLMENT STATISTICS (GET)

**URL:** `http://127.0.0.1:8000/api/enrollments/statistics/summary`

**Method:** GET

**Headers:**
```
Authorization: Bearer {{token}}
Accept: application/json
```

**Expected Response:** `200 OK`
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

- [ ] Statistics endpoint returns correct data
- [ ] All status counts are included
- [ ] Total matches sum of all statuses

---

## 🚀 BULK OPERATIONS

### 9️⃣ BULK UPDATE STATUS (POST)

**URL:** `http://127.0.0.1:8000/api/enrollments/bulk/update-status`

**Method:** POST

**Headers:**
```
Authorization: Bearer {{token}}
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
  "enrollment_ids": [1, 2, 3],
  "status": "active"
}
```

**Expected Response:** `200 OK`
```json
{
  "success": true,
  "message": "3 enrollments updated successfully.",
  "updated_count": 3
}
```

- [ ] Bulk update multiple enrollments successful
- [ ] Update count is correct
- [ ] All specified enrollments have new status

---

## ⚠️ ERROR HANDLING TESTS

### Test 401 Unauthorized
- [ ] GET `/api/enrollments` tanpa token → Response: 401
- [ ] POST `/api/enrollments` dengan token invalid → Response: 401

**Expected:**
```json
{
  "message": "Unauthenticated."
}
```

### Test 404 Not Found
- [ ] GET `/api/enrollments/99999` (ID tidak ada) → Response: 404

**Expected:**
```json
{
  "message": "Not found"
}
```

### Test 422 Validation Error
- [ ] POST `/api/enrollments` tanpa `user_id` → Response: 422

**Expected:**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "user_id": ["The user id field is required."]
  }
}
```

### Test Duplicate Enrollment
- [ ] POST same enrollment twice → Response: 422

**Expected:**
```json
{
  "message": "User is already enrolled in this course.",
  "errors": {
    "enrollment": ["User is already enrolled in this course."]
  }
}
```

---

## 📝 VALIDATION RULES

### CREATE/UPDATE Request Validation

| Field | Rules | Example |
|-------|-------|---------|
| user_id | required, integer, exists:users,id | 1 |
| course_id | required, integer | 5 |
| status | nullable, in: pending,active,completed,cancelled | "active" |
| grade | nullable, numeric, between:0,100 | 85.5 |
| notes | nullable, string | "Good performance" |
| completed_at | nullable, date | "2025-11-15" |

---

## 🔄 TESTING WORKFLOW

### Complete Test Flow

1. **Setup**
   - [ ] Start Laravel server
   - [ ] Get authentication token
   - [ ] Set token in Postman

2. **CRUD Operations**
   - [ ] Test Create (POST)
   - [ ] Test Read (GET all)
   - [ ] Test Read (GET specific)
   - [ ] Test Update (PUT/PATCH)
   - [ ] Test Delete (DELETE)

3. **Filtering**
   - [ ] Test filter by status
   - [ ] Test filter by user_id
   - [ ] Test filter by course_id
   - [ ] Test pagination

4. **Advanced Queries**
   - [ ] Get user enrollments
   - [ ] Get course enrollments
   - [ ] Get statistics

5. **Bulk Operations**
   - [ ] Bulk update status

6. **Error Cases**
   - [ ] Test unauthorized (no token)
   - [ ] Test not found (invalid ID)
   - [ ] Test validation errors
   - [ ] Test duplicate enrollment

---

## 📊 Response Format Check

**All responses harus memiliki format JSON:**

✅ Struktur Response:
```json
{
  "success": true,
  "message": "...",
  "data": {}
}
```

- [ ] All responses return valid JSON
- [ ] `success` field selalu present
- [ ] Error responses memiliki `message` dan `errors` fields
- [ ] Pagination responses memiliki `current_page`, `data`, `total`

---

## 🎯 Final Checklist

- [ ] Semua 9 endpoints sudah di-test
- [ ] Semua error scenarios sudah di-test
- [ ] Semua query parameters sudah di-test
- [ ] Response format sesuai dengan dokumentasi
- [ ] No console errors di Postman
- [ ] Status codes sesuai (201 for create, 200 for success, 4xx for errors)

---

## 📚 Documentation Files

Dokumentasi lengkap tersedia di:
- `API_DOCUMENTATION.md` - Dokumentasi lengkap semua endpoints
- `TESTING_GUIDE.md` - Panduan setup dan testing
- `CURL_TESTING.md` - cURL commands untuk testing
- `Enrollment_API.postman_collection.json` - Postman collection ready to import

---

**Happy Testing! 🚀**

Jika ada yang tidak sesuai atau error, check:
1. Laravel server status
2. Token validity
3. Database migration status
4. Request body format (JSON)
5. Header values
