# User Interface (Microservices Dashboard)

Simple Vite-based frontend to access and preview the microservices in this repository.

Quick start:

1. From repository root, start all microservices (each opens in its own cmd window):

```powershell
startServices.bat
```

2. Install dependencies for the UI and run Vite dev server:

```powershell
cd user-interface
npm install
npm run dev
```

3. Open the UI at `http://127.0.0.1:5173` (default Vite port) and click service links or Preview.

Notes:
- Services are expected on ports 8001..8005. If a service folder is missing, `startServices.bat` will skip it and print a message.
- This UI is intentionally minimal — it only helps open service URLs and preview via an iframe.
