# 🚀 ENROLLMENT API - TESTING DENGAN POSTMAN (Simple Guide)

## 4 LANGKAH CEPAT

### ✅ Langkah 1: Database Migration & Seeding
```bash
cd c:\xampp\htdocs\UTS_IAE\enrollment
php artisan migrate:fresh --seed
```
✅ Membuat tabel + mengisi dengan 5 sample data enrollment

### ✅ Langkah 2: Server
```bash
php artisan serve
```
Berjalan di: `http://127.0.0.1:8000`

### ✅ Langkah 3: Postman
1. Buka POSTMAN
2. **Import** → Pilih file: `Enrollment_API.postman_collection.json`
3. **DONE!** Mulai testing (tidak perlu token)

### ✅ Langkah 4: Test GET (Lihat Sample Data)
```
GET http://127.0.0.1:8000/api/enrollments
```
✅ Akan menampilkan 5 enrollment data dari seeder!

---

## 📋 10 ENDPOINTS (COPY-PASTE)

```
GET    http://127.0.0.1:8000/api/enrollments                              (Get all)
POST   http://127.0.0.1:8000/api/enrollments                              (Create)
GET    http://127.0.0.1:8000/api/enrollments/1                            (Get one)
PUT    http://127.0.0.1:8000/api/enrollments/1                            (Update)
DELETE http://127.0.0.1:8000/api/enrollments/1                            (Delete)
GET    http://127.0.0.1:8000/api/users/1/enrollments                      (User)
GET    http://127.0.0.1:8000/api/courses/5/enrollments                    (Course)
GET    http://127.0.0.1:8000/api/enrollments/statistics/summary           (Stats)
POST   http://127.0.0.1:8000/api/enrollments/bulk/update-status           (Bulk)
GET    http://127.0.0.1:8000/api/enrollments?status=active&per_page=10   (Filter)
```

---

## 🧪 TEST FLOW

1. **GET** `/api/enrollments` → See empty list
2. **POST** `/api/enrollments` with `{user_id: 1, course_id: 5}` → See 201 Created
3. **GET** `/api/enrollments` → See your enrollment
4. **PUT** `/api/enrollments/1` with `{status: "completed"}` → Update
5. **DELETE** `/api/enrollments/1` → Delete
6. **GET** `/api/enrollments/statistics/summary` → See stats

---

## 💡 TIPS

- **Token:** Tidak perlu (sudah dihapus)
- **Body:** For POST/PUT, use JSON format
- **Filter:** Add query params like `?status=active`
- **Pagination:** Use `?per_page=10&page=1`
- **Error:** If 404, check ID exists
- **Error:** If 422, check required fields

---

## 📚 FULL DOCS

- `00_START_HERE.md` - Overview
- `SIMPLE_START.md` - URLs quick ref
- `SEEDING_GUIDE.md` - **Seeder dengan 5 sample data**
- `ENDPOINTS_REFERENCE.md` - Detailed specs
- `API_DOCUMENTATION.md` - Complete docs
- `POSTMAN_INSTALLATION.md` - Step-by-step setup
- `TESTING_GUIDE.md` - Testing workflow
- `CURL_TESTING.md` - cURL commands

---

## ✨ ALL READY!

✅ Backend code complete  
✅ Database schema ready  
✅ 10 endpoints working  
✅ Documentation done  
✅ Postman collection ready  

**Start testing now!** 🎉
