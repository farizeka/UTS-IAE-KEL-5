@echo off
setlocal enableextensions
set BASEDIR=%~dp0

echo Starting microservices (each will open in a new window)...

if exist "%BASEDIR%auth-service" (
  start "auth-service" cmd /k "cd /d "%BASEDIR%auth-service" & php artisan serve --host=127.0.0.1 --port=8001"
) else echo auth-service not found at "%BASEDIR%auth-service"

if exist "%BASEDIR%course-access" (
  start "course-access" cmd /k "cd /d "%BASEDIR%course-access" & php artisan serve --host=127.0.0.1 --port=8002"
) else echo course-access not found at "%BASEDIR%course-access"

if exist "%BASEDIR%course-management" (
  start "course-management" cmd /k "cd /d "%BASEDIR%course-management" & php artisan serve --host=127.0.0.1 --port=8003"
) else echo course-management not found at "%BASEDIR%course-management"

if exist "%BASEDIR%enrollment" (
  start "enrollment" cmd /k "cd /d "%BASEDIR%enrollment" & php artisan serve --host=127.0.0.1 --port=8004"
) else echo enrollment not found at "%BASEDIR%enrollment"

if exist "%BASEDIR%rating" (
  start "rating" cmd /k "cd /d "%BASEDIR%rating" & php artisan serve --host=127.0.0.1 --port=8005"
) else echo rating not found at "%BASEDIR%rating" (skipping)

echo Done. Open the UI at http://127.0.0.1:5173 after running `npm run dev` in `user-interface`.
