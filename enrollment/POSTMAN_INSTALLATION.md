# ✅ ENROLLMENT API - POSTMAN INSTALLATION & TESTING GUIDE

## 📋 PRE-INSTALLATION CHECKLIST

Before you start, make sure you have:

- [ ] XAMPP running with PHP
- [ ] Laravel project in `c:\xampp\htdocs\UTS_IAE\enrollment`
- [ ] Database configured in `.env`
- [ ] POSTMAN installed
- [ ] Authentication token from auth-service

---

## 🔧 INSTALLATION STEPS

### Step 1: Database Migration & Seeding
```bash
cd c:\xampp\htdocs\UTS_IAE\enrollment
php artisan migrate:fresh --seed
```

**Output:**
```
Fresh Migration
Migration table created successfully.
Migrated: 0001_01_01_000000_create_users_table
Migrated: 0001_01_01_000001_create_cache_table
Migrated: 2025_11_15_133231_create_enrollments_table

Seeding: Database\Seeders\DatabaseSeeder
Database seeding completed successfully.
```

✅ 2 users + 5 enrollments sudah siap!

### Step 2: Start Laravel Server
```bash
php artisan serve
```

**Expected Output:**
```
INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to quit
```

✅ Server is now running at: `http://127.0.0.1:8000`

### Step 3: Import Postman Collection
1. Open POSTMAN application
2. Click **File** menu → **Import**
3. Browse to: `c:\xampp\htdocs\UTS_IAE\enrollment\Enrollment_API.postman_collection.json`
4. Click **Import**
5. ✅ Collection imported successfully!

### Step 4: Set Environment Variables
1. In POSTMAN, click **Variables** (top right)
2. Add these variables:

| VARIABLE | VALUE | SCOPE |
|----------|-------|-------|
| base_url | http://127.0.0.1:8000/api | Global |
| token | (your_sanctum_token_here) | Global |

**Where to get token:**
- Call auth-service login endpoint
- Get token from response
- Paste it in POSTMAN variable

---

## 🎯 POSTMAN COLLECTION OVERVIEW

### Imported Structure
```
Enrollment Microservice API
├── ENROLLMENT CRUD
│   ├── Get All Enrollments (GET)
│   ├── Get Specific Enrollment (GET)
│   ├── Create Enrollment (POST)
│   ├── Update Enrollment (PUT)
│   └── Delete Enrollment (DELETE)
├── FILTER & SEARCH
│   ├── Get Enrollments by User (GET)
│   └── Get Enrollments by Course (GET)
├── STATISTICS & ANALYTICS
│   └── Get Enrollment Statistics (GET)
└── BULK OPERATIONS
    └── Bulk Update Enrollment Status (POST)
```

---

## 🧪 TESTING STEP-BY-STEP

### TEST 1: GET All Enrollments

1. In Postman, click **ENROLLMENT CRUD** → **Get All Enrollments**
2. Notice URL auto-fills: `{{base_url}}/enrollments`
3. Notice token auto-fills in Authorization header
4. Click **Send**
5. ✅ You should get 200 OK response with **5 enrollment data** dari seeder!

**Expected Response:**
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
        ...
      },
      {
        "id": 2,
        "user_id": 1,
        "course_id": 2,
        "status": "completed",
        "grade": "95.50",
        "notes": "Excellent performance throughout the course",
        ...
      },
      ...
    ],
    "total": 5,
    ...
  }
}
```

**✅ 5 enrollment data sudah tampil!**

---

### TEST 2: CREATE Enrollment

1. Click **ENROLLMENT CRUD** → **Create Enrollment**
2. Click **Body** tab
3. Pre-filled request body:
```json
{
  "user_id": 1,
  "course_id": 5,
  "status": "active",
  "notes": "Student is performing well"
}
```

4. ⚠️ **IMPORTANT:** User ID 1 sudah ada dari seeder!
5. Ganti `course_id` menjadi 6 (agar berbeda dari seeder data)
6. Click **Send**
7. ✅ You should get 201 Created

**Expected Response:**
```json
{
  "success": true,
  "message": "Enrollment created successfully.",
  "data": {
    "id": 6,
    "user_id": 1,
    "course_id": 6,
    "status": "active",
    ...
  }
}
```

**Note:** Sekarang total enrollment jadi 6 (5 dari seeder + 1 baru)!

---

### TEST 3: GET Specific Enrollment

1. Click **ENROLLMENT CRUD** → **Get Specific Enrollment**
2. URL: `{{base_url}}/enrollments/1`
   - This will get the FIRST enrollment from seeder (course_id: 1, active)
3. Click **Send**
4. ✅ You should get 200 OK with enrollment details

**Response:** Enrollment dengan ID 1 dari seeder data

---

### TEST 4: UPDATE Enrollment

1. Click **ENROLLMENT CRUD** → **Update Enrollment**
2. URL: `{{base_url}}/enrollments/1` (use ID from CREATE)
3. Click **Body** tab
4. Pre-filled:
```json
{
  "status": "completed",
  "grade": 85.5,
  "notes": "Course completed successfully",
  "completed_at": "2025-11-15"
}
```

5. Modify values as needed
6. Click **Send**
7. ✅ You should get 200 OK

---

### TEST 5: DELETE Enrollment

1. Click **ENROLLMENT CRUD** → **Delete Enrollment**
2. URL: `{{base_url}}/enrollments/1`
3. Click **Send**
4. ✅ You should get 200 OK

**Response:**
```json
{
  "success": true,
  "message": "Enrollment deleted successfully."
}
```

---

### TEST 6: Get User Enrollments

1. Click **FILTER & SEARCH** → **Get Enrollments by User**
2. URL: `{{base_url}}/users/1/enrollments`
   - Replace `/1` with user ID
3. Click **Params** tab to see optional filters
4. Click **Send**
5. ✅ You should get all enrollments for user 1

---

### TEST 7: Get Course Enrollments

1. Click **FILTER & SEARCH** → **Get Enrollments by Course**
2. URL: `{{base_url}}/courses/5/enrollments`
   - Replace `/5` with course ID
3. Click **Send**
4. ✅ You should get all enrollments for course 5

---

### TEST 8: Get Statistics

1. Click **STATISTICS & ANALYTICS** → **Get Enrollment Statistics**
2. URL: `{{base_url}}/enrollments/statistics/summary`
3. Click **Send**
4. ✅ You should get enrollment statistics

**Response:**
```json
{
  "success": true,
  "data": {
    "total": 5,
    "active": 2,
    "completed": 1,
    "pending": 2,
    "cancelled": 0
  }
}
```

---

### TEST 9: Bulk Update Status

1. Click **BULK OPERATIONS** → **Bulk Update Enrollment Status**
2. Click **Body** tab
3. Pre-filled:
```json
{
  "enrollment_ids": [1, 2, 3],
  "status": "active"
}
```

4. Modify IDs and status as needed
5. Click **Send**
6. ✅ You should get 200 OK

---

## 🔍 TESTING WITH QUERY PARAMETERS

### In Postman, click **Params** tab

### Example 1: Pagination
```
KEY          VALUE
───────────  ──────
per_page     10
page         1
```
URL becomes: `http://127.0.0.1:8000/api/enrollments?per_page=10&page=1`

### Example 2: Filter by Status
```
KEY          VALUE
───────────  ──────
status       active
per_page     15
```
URL becomes: `http://127.0.0.1:8000/api/enrollments?status=active&per_page=15`

### Example 3: Multiple Filters
```
KEY          VALUE
───────────  ──────
status       active
user_id      1
course_id    5
per_page     20
```
URL becomes: `http://127.0.0.1:8000/api/enrollments?status=active&user_id=1&course_id=5&per_page=20`

---

## 📊 RESPONSE STATUS CODES

After each request, check the status code:

| Code | Meaning | Success? |
|------|---------|----------|
| 200 | OK | ✅ Yes |
| 201 | Created | ✅ Yes |
| 400 | Bad Request | ❌ No |
| 401 | Unauthorized | ❌ No - Check token |
| 404 | Not Found | ❌ No - Check ID |
| 422 | Validation Error | ❌ No - Check data |
| 500 | Server Error | ❌ No - Check server |

---

## ⚠️ COMMON ISSUES & FIXES

### Issue: 401 Unauthorized
**Problem:** Invalid or missing token

**Fix:**
1. Get new token from auth-service login
2. Copy the token
3. In Postman, set variable `{{token}}` to the new token
4. Try again

### Issue: 404 Not Found
**Problem:** Enrollment doesn't exist

**Fix:**
1. First create an enrollment (TEST 2)
2. Use that ID in other tests
3. Try again

### Issue: 422 Validation Error
**Problem:** Invalid data in request body

**Fix:**
1. Check required fields: `user_id`, `course_id`
2. Make sure user_id exists in database
3. Grade should be 0-100
4. Status should be: pending, active, completed, or cancelled
5. Try again

### Issue: Connection Refused
**Problem:** Server not running

**Fix:**
1. Open terminal in enrollment folder
2. Run: `php artisan serve`
3. Wait for "Server running" message
4. Try again

### Issue: "User is already enrolled"
**Problem:** Duplicate enrollment

**Fix:**
1. Use different user_id or course_id
2. Or delete existing enrollment first
3. Try again

---

## 🎯 COMPLETE TEST FLOW (15 minutes)

```
⏱️ TIMER START

1️⃣ Setup (2 min)
   └─ Start server, set variables

2️⃣ Create Test (2 min)
   ├─ Create enrollment
   ├─ Save ID from response
   └─ Verify 201 status

3️⃣ Read Tests (3 min)
   ├─ Get all enrollments (200)
   ├─ Get specific enrollment (200)
   └─ Add query parameters

4️⃣ Update Test (2 min)
   ├─ Update enrollment
   ├─ Change status/grade
   └─ Verify 200 status

5️⃣ Advanced Tests (4 min)
   ├─ User enrollments
   ├─ Course enrollments
   ├─ Statistics
   └─ Bulk update

6️⃣ Delete Test (1 min)
   ├─ Delete enrollment
   └─ Verify 200 status

7️⃣ Verification (1 min)
   └─ All responses are JSON ✓

⏱️ TOTAL TIME: ~15 minutes
```

---

## ✅ FINAL VERIFICATION CHECKLIST

After testing, verify all these work:

**CRUD**
- [ ] Create enrollment (201)
- [ ] Read all (200)
- [ ] Read one (200)
- [ ] Update (200)
- [ ] Delete (200)

**Filtering**
- [ ] Filter by status (200)
- [ ] Pagination works (200)
- [ ] Multiple filters work (200)

**Advanced**
- [ ] User enrollments (200)
- [ ] Course enrollments (200)
- [ ] Statistics (200)
- [ ] Bulk update (200)

**Errors**
- [ ] 401 without token
- [ ] 404 for invalid ID
- [ ] 422 for invalid data

**Format**
- [ ] All responses are JSON
- [ ] All have success field
- [ ] Status codes are correct

---

## 📝 NOTES

1. **First request might be slow** - Laravel is initializing
2. **Token expires** - Get new one if you get 401
3. **Database persists** - Data saved between requests
4. **Order matters** - Create before Update/Delete
5. **IDs are auto-increment** - First enrollment is likely ID 1

---

## 🎓 NEXT STEPS

After successful testing:

1. ✅ Test from frontend (integrate with API)
2. ✅ Test from other microservices
3. ✅ Add more endpoints as needed
4. ✅ Deploy to production
5. ✅ Monitor and maintain

---

## 📚 ADDITIONAL RESOURCES

In your enrollment folder, find:

- `00_START_HERE.md` - Overview
- `QUICK_REFERENCE.md` - URLs quick lookup
- `ENDPOINTS_REFERENCE.md` - Detailed specs
- `API_DOCUMENTATION.md` - Complete docs
- `CURL_TESTING.md` - Alternative testing method

---

## 🚀 YOU'RE READY!

Everything is set up and ready to test.

**Start now:**
1. Open POSTMAN ✅
2. Import collection ✅
3. Set token ✅
4. Click Send ✅
5. See JSON responses ✅

---

**Happy Testing! 🎉**

*Need help?* Check the documentation files in the enrollment folder.  
*Something not working?* Check the "Common Issues & Fixes" section above.  
*Want to go deeper?* Read `API_DOCUMENTATION.md` for full specifications.

---

**Last Updated:** 2025-11-15  
**Status:** Ready for Testing ✅
