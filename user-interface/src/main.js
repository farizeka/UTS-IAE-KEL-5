const services = [
  { name: 'Auth Service', key: 'auth-service', url: 'http://127.0.0.1:8001' },
  { name: 'Course Access', key: 'course-access', url: 'http://127.0.0.1:8002' },
  { name: 'Course Management', key: 'course-management', url: 'http://127.0.0.1:8003' },
  { name: 'Enrollment', key: 'enrollment', url: 'http://127.0.0.1:8004' },
  { name: 'Rating', key: 'rating', url: 'http://127.0.0.1:8005' }
]

const app = document.getElementById('app')
app.innerHTML = `
  <header><h1>Microservices Dashboard</h1></header>
  <main>
    <div class="cards">
      ${services.map(s => `
        <div class="card" data-key="${s.key}">
          <h2>${s.name}</h2>
          <p><a href="${s.url}" target="_blank" class="btn">Open Service</a></p>
          <p><button class="btn preview" data-url="${s.url}">Preview (iframe)</button></p>
        </div>
      `).join('')}
    </div>
    <section id="previewArea" class="hidden">
      <button id="closePreview" class="btn">Close Preview</button>
      <iframe id="previewFrame" src="" frameborder="0"></iframe>
    </section>
  </main>
  <footer>Start services using <code>startServices.bat</code>, then click Open.</footer>
`

document.querySelectorAll('.preview').forEach(btn => {
  btn.addEventListener('click', e => {
    const url = e.currentTarget.dataset.url
    document.getElementById('previewFrame').src = url
    document.getElementById('previewArea').classList.remove('hidden')
  })
})

document.getElementById('closePreview').addEventListener('click', () => {
  document.getElementById('previewFrame').src = ''
  document.getElementById('previewArea').classList.add('hidden')
})
