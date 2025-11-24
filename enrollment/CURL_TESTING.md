# Enrollment API - cURL Testing Commands

Base URL: `http://127.0.0.1:8000/api`

Replace `YOUR_TOKEN_HERE` dengan token yang Anda dapatkan dari login.

---

## 1. GET All Enrollments

```bash
curl -X GET "http://127.0.0.1:8000/api/enrollments" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**With Filters:**
```bash
curl -X GET "http://127.0.0.1:8000/api/enrollments?per_page=10&status=active&user_id=1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 2. GET Specific Enrollment

```bash
curl -X GET "http://127.0.0.1:8000/api/enrollments/1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 3. CREATE New Enrollment

```bash
curl -X POST "http://127.0.0.1:8000/api/enrollments" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 1,
    "course_id": 5,
    "status": "active",
    "notes": "Student enrolled successfully"
  }'
```

**Minimal (required fields only):**
```bash
curl -X POST "http://127.0.0.1:8000/api/enrollments" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 1,
    "course_id": 5
  }'
```

---

## 4. UPDATE Enrollment

```bash
curl -X PUT "http://127.0.0.1:8000/api/enrollments/1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "status": "completed",
    "grade": 85.5,
    "notes": "Course completed successfully",
    "completed_at": "2025-11-15"
  }'
```

**Partial Update (PATCH):**
```bash
curl -X PATCH "http://127.0.0.1:8000/api/enrollments/1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "status": "completed",
    "grade": 90
  }'
```

---

## 5. DELETE Enrollment

```bash
curl -X DELETE "http://127.0.0.1:8000/api/enrollments/1" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 6. GET Enrollments by User

```bash
curl -X GET "http://127.0.0.1:8000/api/users/1/enrollments" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**With Filters:**
```bash
curl -X GET "http://127.0.0.1:8000/api/users/1/enrollments?per_page=10&status=active" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 7. GET Enrollments by Course

```bash
curl -X GET "http://127.0.0.1:8000/api/courses/5/enrollments" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**With Filters:**
```bash
curl -X GET "http://127.0.0.1:8000/api/courses/5/enrollments?per_page=10&status=completed" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 8. GET Enrollment Statistics

```bash
curl -X GET "http://127.0.0.1:8000/api/enrollments/statistics/summary" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

## 9. BULK Update Enrollment Status

```bash
curl -X POST "http://127.0.0.1:8000/api/enrollments/bulk/update-status" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "enrollment_ids": [1, 2, 3, 4, 5],
    "status": "active"
  }'
```

---

## PowerShell Commands (untuk Windows)

### GET All Enrollments
```powershell
$token = "YOUR_TOKEN_HERE"
$headers = @{
    "Authorization" = "Bearer $token"
    "Accept" = "application/json"
}
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/enrollments" -Headers $headers -Method Get
```

### CREATE Enrollment
```powershell
$token = "YOUR_TOKEN_HERE"
$headers = @{
    "Authorization" = "Bearer $token"
    "Content-Type" = "application/json"
}
$body = @{
    user_id = 1
    course_id = 5
    status = "active"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/enrollments" `
    -Headers $headers `
    -Method Post `
    -Body $body
```

### UPDATE Enrollment
```powershell
$token = "YOUR_TOKEN_HERE"
$enrollmentId = 1
$headers = @{
    "Authorization" = "Bearer $token"
    "Content-Type" = "application/json"
}
$body = @{
    status = "completed"
    grade = 90
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/enrollments/$enrollmentId" `
    -Headers $headers `
    -Method Put `
    -Body $body
```

### DELETE Enrollment
```powershell
$token = "YOUR_TOKEN_HERE"
$enrollmentId = 1
$headers = @{
    "Authorization" = "Bearer $token"
    "Accept" = "application/json"
}

Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/enrollments/$enrollmentId" `
    -Headers $headers `
    -Method Delete
```

---

## Test Scenarios

### Scenario 1: Create and Complete an Enrollment

```bash
# 1. Create enrollment
TOKEN="YOUR_TOKEN_HERE"
CREATE_RESPONSE=$(curl -s -X POST "http://127.0.0.1:8000/api/enrollments" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 1,
    "course_id": 5,
    "status": "pending"
  }')

# Extract ID from response
ENROLLMENT_ID=$(echo $CREATE_RESPONSE | grep -o '"id":[0-9]*' | grep -o '[0-9]*')

# 2. Update to active
curl -X PUT "http://127.0.0.1:8000/api/enrollments/$ENROLLMENT_ID" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"status": "active"}'

# 3. Mark as completed
curl -X PUT "http://127.0.0.1:8000/api/enrollments/$ENROLLMENT_ID" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"status": "completed", "grade": 95}'
```

### Scenario 2: Get User Progress

```bash
TOKEN="YOUR_TOKEN_HERE"
USER_ID=1

# Get user's active enrollments
curl -X GET "http://127.0.0.1:8000/api/users/$USER_ID/enrollments?status=active" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json"

# Get user's completed enrollments
curl -X GET "http://127.0.0.1:8000/api/users/$USER_ID/enrollments?status=completed" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json"
```

### Scenario 3: Get Course Statistics

```bash
TOKEN="YOUR_TOKEN_HERE"
COURSE_ID=5

# Get how many students enrolled
curl -X GET "http://127.0.0.1:8000/api/courses/$COURSE_ID/enrollments" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json"

# Get completed enrollments
curl -X GET "http://127.0.0.1:8000/api/courses/$COURSE_ID/enrollments?status=completed" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json"
```

---

## Response Examples

### Success (200 OK)
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "course_id": 5,
    "status": "active",
    "grade": null,
    "notes": "Student enrolled",
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

### Created (201 Created)
```json
{
  "success": true,
  "message": "Enrollment created successfully.",
  "data": { ... }
}
```

### Error (422 Unprocessable Entity)
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

### Unauthorized (401)
```json
{
  "message": "Unauthenticated."
}
```

### Not Found (404)
```json
{
  "message": "Not found"
}
```

---

## Tips & Tricks

1. **Save Token to File**:
   ```bash
   echo "YOUR_TOKEN_HERE" > token.txt
   TOKEN=$(cat token.txt)
   ```

2. **Pretty Print JSON**:
   ```bash
   curl -s "..." | jq '.'
   ```

3. **Get Response Headers**:
   ```bash
   curl -i "http://127.0.0.1:8000/api/enrollments" \
     -H "Authorization: Bearer $TOKEN"
   ```

4. **Show Request Details**:
   ```bash
   curl -v "http://127.0.0.1:8000/api/enrollments" \
     -H "Authorization: Bearer $TOKEN"
   ```

5. **Save Response to File**:
   ```bash
   curl "http://127.0.0.1:8000/api/enrollments" \
     -H "Authorization: Bearer $TOKEN" \
     -o response.json
   ```

---

## Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| 401 Unauthorized | Pastikan token di Authorization header |
| 404 Not Found | Check enrollment ID apakah benar |
| 422 Validation Error | Cek required fields dan format |
| Connection refused | Pastikan Laravel server running |
| CORS Error | Check CORS middleware di Laravel |

---

Happy Testing! 🚀
