# 📋 ENROLLMENT API - COMPLETE ENDPOINT REFERENCE

**Base URL:** `http://127.0.0.1:8000/api`

**Authentication:** `Authorization: Bearer {{token}}`

---

## 🎯 ALL ENDPOINTS (10 Total)

### 1. GET ALL ENROLLMENTS

```
METHOD: GET
URL:    http://127.0.0.1:8000/api/enrollments
AUTH:   Yes (Bearer Token)
```

**Query Parameters:**
| Parameter | Type | Default | Example |
|-----------|------|---------|---------|
| per_page | int | 15 | ?per_page=20 |
| page | int | 1 | ?page=2 |
| status | string | - | ?status=active |
| user_id | int | - | ?user_id=1 |
| course_id | int | - | ?course_id=5 |

**Request:**
```
GET http://127.0.0.1:8000/api/enrollments?status=active&per_page=10
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

**Response (200):**
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
        "notes": "Student performing well",
        "enrolled_at": "2025-11-15T13:27:00.000000Z",
        "completed_at": null,
        "created_at": "2025-11-15T13:27:00.000000Z",
        "updated_at": "2025-11-15T13:27:00.000000Z"
      }
    ],
    "first_page_url": "...",
    "from": 1,
    "last_page": 1,
    "last_page_url": "...",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/enrollments",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 5
  }
}
```

---

### 2. CREATE ENROLLMENT

```
METHOD: POST
URL:    http://127.0.0.1:8000/api/enrollments
AUTH:   Yes (Bearer Token)
BODY:   JSON
```

**Request Body:**
```json
{
  "user_id": 1,
  "course_id": 5,
  "status": "active",
  "grade": null,
  "notes": "Student enrolled successfully"
}
```

**Required Fields:**
- `user_id` (integer, must exist in users table)
- `course_id` (integer)

**Optional Fields:**
- `status` (enum: pending, active, completed, cancelled) - default: pending
- `grade` (decimal, 0-100)
- `notes` (string)

**Response (201 Created):**
```json
{
  "success": true,
  "message": "Enrollment created successfully.",
  "data": {
    "user_id": 1,
    "course_id": 5,
    "status": "active",
    "grade": null,
    "notes": "Student enrolled successfully",
    "updated_at": "2025-11-15T13:27:00.000000Z",
    "created_at": "2025-11-15T13:27:00.000000Z",
    "id": 1
  }
}
```

**Error (422):**
```json
{
  "message": "User is already enrolled in this course.",
  "errors": {
    "enrollment": ["User is already enrolled in this course."]
  }
}
```

---

### 3. GET SPECIFIC ENROLLMENT

```
METHOD: GET
URL:    http://127.0.0.1:8000/api/enrollments/{id}
AUTH:   Yes (Bearer Token)
```

**Example:**
```
GET http://127.0.0.1:8000/api/enrollments/1
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "course_id": 5,
    "status": "active",
    "grade": null,
    "notes": "Student enrolled successfully",
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

**Error (404):**
```json
{
  "message": "Not found"
}
```

---

### 4. UPDATE ENROLLMENT (PUT)

```
METHOD: PUT
URL:    http://127.0.0.1:8000/api/enrollments/{id}
AUTH:   Yes (Bearer Token)
BODY:   JSON
```

**Example:**
```
PUT http://127.0.0.1:8000/api/enrollments/1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

**Request Body:**
```json
{
  "status": "completed",
  "grade": 85.5,
  "notes": "Course completed successfully",
  "completed_at": "2025-11-15"
}
```

**Updateable Fields:**
- `status` (enum: pending, active, completed, cancelled)
- `grade` (decimal, 0-100)
- `notes` (string)
- `completed_at` (date)

**Response (200):**
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
    "updated_at": "2025-11-15T13:27:00.000000Z"
  }
}
```

---

### 5. PARTIAL UPDATE (PATCH)

```
METHOD: PATCH
URL:    http://127.0.0.1:8000/api/enrollments/{id}
AUTH:   Yes (Bearer Token)
BODY:   JSON
```

**Same as PUT but can update partial fields**

**Example:**
```
PATCH http://127.0.0.1:8000/api/enrollments/1
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "status": "completed",
  "grade": 90
}
```

---

### 6. DELETE ENROLLMENT

```
METHOD: DELETE
URL:    http://127.0.0.1:8000/api/enrollments/{id}
AUTH:   Yes (Bearer Token)
```

**Example:**
```
DELETE http://127.0.0.1:8000/api/enrollments/1
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

**Response (200):**
```json
{
  "success": true,
  "message": "Enrollment deleted successfully."
}
```

---

### 7. GET USER ENROLLMENTS

```
METHOD: GET
URL:    http://127.0.0.1:8000/api/users/{userId}/enrollments
AUTH:   Yes (Bearer Token)
```

**Query Parameters:**
| Parameter | Type | Default |
|-----------|------|---------|
| per_page | int | 15 |
| page | int | 1 |
| status | string | - |

**Examples:**
```
GET http://127.0.0.1:8000/api/users/1/enrollments
GET http://127.0.0.1:8000/api/users/1/enrollments?status=active
GET http://127.0.0.1:8000/api/users/1/enrollments?per_page=10&page=1
GET http://127.0.0.1:8000/api/users/1/enrollments?status=completed&per_page=5
```

**Response (200):** Paginated enrollments for user

---

### 8. GET COURSE ENROLLMENTS

```
METHOD: GET
URL:    http://127.0.0.1:8000/api/courses/{courseId}/enrollments
AUTH:   Yes (Bearer Token)
```

**Query Parameters:**
| Parameter | Type | Default |
|-----------|------|---------|
| per_page | int | 15 |
| page | int | 1 |
| status | string | - |

**Examples:**
```
GET http://127.0.0.1:8000/api/courses/5/enrollments
GET http://127.0.0.1:8000/api/courses/5/enrollments?status=active
GET http://127.0.0.1:8000/api/courses/5/enrollments?per_page=20
GET http://127.0.0.1:8000/api/courses/5/enrollments?status=completed&per_page=10
```

**Response (200):** Paginated enrollments for course

---

### 9. GET STATISTICS

```
METHOD: GET
URL:    http://127.0.0.1:8000/api/enrollments/statistics/summary
AUTH:   Yes (Bearer Token)
```

**Example:**
```
GET http://127.0.0.1:8000/api/enrollments/statistics/summary
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

**Response (200):**
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

### 10. BULK UPDATE STATUS

```
METHOD: POST
URL:    http://127.0.0.1:8000/api/enrollments/bulk/update-status
AUTH:   Yes (Bearer Token)
BODY:   JSON
```

**Request Body:**
```json
{
  "enrollment_ids": [1, 2, 3, 4, 5],
  "status": "active"
}
```

**Required Fields:**
- `enrollment_ids` (array of integers)
- `status` (enum: pending, active, completed, cancelled)

**Example:**
```
POST http://127.0.0.1:8000/api/enrollments/bulk/update-status
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "enrollment_ids": [1, 2, 3],
  "status": "active"
}
```

**Response (200):**
```json
{
  "success": true,
  "message": "3 enrollments updated successfully.",
  "updated_count": 3
}
```

---

## 🔍 FILTER EXAMPLES

### Filter by Status
```
GET http://127.0.0.1:8000/api/enrollments?status=pending
GET http://127.0.0.1:8000/api/enrollments?status=active
GET http://127.0.0.1:8000/api/enrollments?status=completed
GET http://127.0.0.1:8000/api/enrollments?status=cancelled
```

### Filter by User
```
GET http://127.0.0.1:8000/api/enrollments?user_id=1
GET http://127.0.0.1:8000/api/users/1/enrollments
```

### Filter by Course
```
GET http://127.0.0.1:8000/api/enrollments?course_id=5
GET http://127.0.0.1:8000/api/courses/5/enrollments
```

### Combine Filters
```
GET http://127.0.0.1:8000/api/enrollments?status=active&user_id=1&course_id=5
GET http://127.0.0.1:8000/api/users/1/enrollments?status=completed&per_page=10
GET http://127.0.0.1:8000/api/courses/5/enrollments?status=active&per_page=5
```

---

## ⚡ QUICK TEST (COPY-PASTE)

### 1. Create
```bash
curl -X POST http://127.0.0.1:8000/api/enrollments \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"user_id":1,"course_id":5}'
```

### 2. Read All
```bash
curl http://127.0.0.1:8000/api/enrollments \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### 3. Update
```bash
curl -X PUT http://127.0.0.1:8000/api/enrollments/1 \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"status":"completed","grade":90}'
```

### 4. Delete
```bash
curl -X DELETE http://127.0.0.1:8000/api/enrollments/1 \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## 📌 IMPORTANT NOTES

1. **All responses are JSON** ✅
2. **All endpoints require authentication** ✅
3. **Pagination is built-in** (default 15/page) ✅
4. **Status codes are semantic** (201 for create, 200 for success, 4xx for errors) ✅
5. **Duplicate enrollments are prevented** ✅
6. **Query parameters are case-sensitive** ✅

---

## 🎯 HTTP STATUS CODES

| Code | Meaning | When |
|------|---------|------|
| 200 | OK | Successful GET, PUT, PATCH, DELETE |
| 201 | Created | Successful POST |
| 400 | Bad Request | Invalid request format |
| 401 | Unauthorized | No valid token |
| 404 | Not Found | Resource doesn't exist |
| 422 | Unprocessable Entity | Validation error |
| 500 | Server Error | Server-side error |

---

## 📊 DATA TYPES

| Field | Type | Range/Format |
|-------|------|--------------|
| id | Integer | Auto-generated |
| user_id | Integer | Reference to users |
| course_id | Integer | External reference |
| status | String (Enum) | pending, active, completed, cancelled |
| grade | Decimal | 0.00 - 100.00 |
| notes | Text | Any string |
| enrolled_at | DateTime | ISO 8601 |
| completed_at | DateTime (nullable) | ISO 8601 |

---

**Version:** 1.0  
**Last Updated:** 2025-11-15  
**Status:** Production Ready ✅
