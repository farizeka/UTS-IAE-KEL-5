# 🔗 ENROLLMENT API - QUICK REFERENCE URLs

**Base:** `http://127.0.0.1:8000/api`

---

## 📌 CRUD OPERATIONS

### CREATE (POST)
```
POST http://127.0.0.1:8000/api/enrollments
```
**Body:** `{ user_id, course_id, status?, grade?, notes? }`

### READ (GET)
```
GET http://127.0.0.1:8000/api/enrollments                    # Get all (paginated)
GET http://127.0.0.1:8000/api/enrollments/{id}               # Get specific
```

**Query Params:**
- `?per_page=15` (default: 15)
- `?status=active` (pending|active|completed|cancelled)
- `?user_id=1`
- `?course_id=5`

### UPDATE (PUT/PATCH)
```
PUT   http://127.0.0.1:8000/api/enrollments/{id}
PATCH http://127.0.0.1:8000/api/enrollments/{id}
```
**Body:** `{ status?, grade?, notes?, completed_at? }`

### DELETE (DELETE)
```
DELETE http://127.0.0.1:8000/api/enrollments/{id}
```

---

## 🔍 FILTER & SEARCH

```
GET http://127.0.0.1:8000/api/users/{userId}/enrollments
    ?per_page=15&status=active

GET http://127.0.0.1:8000/api/courses/{courseId}/enrollments
    ?per_page=15&status=completed
```

---

## 📊 STATISTICS

```
GET http://127.0.0.1:8000/api/enrollments/statistics/summary
```

Response:
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

## 🚀 BULK OPERATIONS

```
POST http://127.0.0.1:8000/api/enrollments/bulk/update-status
```
**Body:** 
```json
{
  "enrollment_ids": [1, 2, 3],
  "status": "active"
}
```

---

## 📋 EXAMPLE CURL COMMANDS

### Get All
```bash
curl -H "Authorization: Bearer TOKEN" \
  http://127.0.0.1:8000/api/enrollments
```

### Create
```bash
curl -X POST http://127.0.0.1:8000/api/enrollments \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"user_id":1,"course_id":5}'
```

### Update
```bash
curl -X PUT http://127.0.0.1:8000/api/enrollments/1 \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"status":"completed","grade":90}'
```

### Delete
```bash
curl -X DELETE http://127.0.0.1:8000/api/enrollments/1 \
  -H "Authorization: Bearer TOKEN"
```

---

## 🧪 COMMON TEST URLs (Copy-Paste Ready)

```
✅ GET ALL:
http://127.0.0.1:8000/api/enrollments

✅ GET ONE:
http://127.0.0.1:8000/api/enrollments/1

✅ GET ACTIVE:
http://127.0.0.1:8000/api/enrollments?status=active

✅ GET USER'S:
http://127.0.0.1:8000/api/users/1/enrollments

✅ GET COURSE'S:
http://127.0.0.1:8000/api/courses/5/enrollments

✅ GET STATS:
http://127.0.0.1:8000/api/enrollments/statistics/summary

✅ PAGINATED:
http://127.0.0.1:8000/api/enrollments?per_page=5&page=1

✅ FILTER:
http://127.0.0.1:8000/api/enrollments?status=completed&user_id=1&per_page=10
```

---

## 📦 POSTMAN IMPORT

1. Open Postman
2. Click **Import**
3. Select: `Enrollment_API.postman_collection.json`
4. Collection imported automatically ✅

Set variables:
- `{{base_url}}`: `http://127.0.0.1:8000/api`
- `{{token}}`: Your Sanctum token

---

## 🔐 HEADERS (All Requests)

```
Authorization: Bearer {{token}}
Accept: application/json
Content-Type: application/json (for POST/PUT)
```

---

## ✨ STATUS VALUES

- `pending` - Belum dimulai
- `active` - Sedang berlangsung
- `completed` - Selesai
- `cancelled` - Dibatalkan

---

## 🛠️ TROUBLESHOOTING

| Error | Fix |
|-------|-----|
| 401 Unauthorized | Add valid token to Authorization header |
| 404 Not Found | Check enrollment ID exists |
| 422 Validation | Check required fields (user_id, course_id) |
| 500 Server Error | Check Laravel logs: `storage/logs/` |
| Connection refused | Start server: `php artisan serve` |

---

## 📚 More Info

- Full docs: `API_DOCUMENTATION.md`
- Testing guide: `TESTING_GUIDE.md`
- cURL examples: `CURL_TESTING.md`
- Checklist: `POSTMAN_TESTING_CHECKLIST.md`

---

**Ready to test! 🚀**
