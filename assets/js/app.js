function getSession(){ return JSON.parse(localStorage.getItem('ptarkmalSession') || 'null'); }
function setSession(user){ localStorage.setItem('ptarkmalSession', JSON.stringify(user)); }
function logout(){ localStorage.removeItem('ptarkmalSession'); location.href = 'index.html'; }
function requireLogin(){
  const s = getSession();
  if(!s){ location.href='login.html'; return null; }
  document.body.classList.add(s.role === 'admin' ? 'role-admin' : 'role-user');
  const userName = document.querySelectorAll('[data-user-name]');
  userName.forEach(el => el.textContent = s.name);
  return s;
}
function initPublicNav(){
  const s = getSession();
  if(s){ document.body.classList.add(s.role === 'admin' ? 'role-admin' : 'role-user'); }
}
function navHtml(active=''){
  return `<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">📚 PTARKMAL</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link ${active==='home'?'active':''}" href="index.html">Home</a></li>
          <li class="nav-item nav-admin"><a class="nav-link ${active==='dashboard'?'active':''}" href="dashboard.html">Dashboard</a></li>
          <li class="nav-item nav-user"><a class="nav-link ${active==='dashboard'?'active':''}" href="dashboard.html">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link ${active==='books'?'active':''}" href="books.html">Books</a></li>
          <li class="nav-item nav-admin"><a class="nav-link ${active==='users'?'active':''}" href="users.html">Users</a></li>
          <li class="nav-item"><a class="nav-link ${active==='borrowings'?'active':''}" href="borrowings.html">Borrowings</a></li>
          <li class="nav-item nav-admin"><a class="nav-link ${active==='reports'?'active':''}" href="reports.html">Reports</a></li>
          <li class="nav-item nav-user"><a class="nav-link ${active==='profile'?'active':''}" href="profile.html">Profile</a></li>
          <li class="nav-item" id="loginLink"><a class="btn btn-light btn-sm fw-bold rounded-pill px-3" href="login.html">Login</a></li>
          <li class="nav-item d-none" id="logoutLink"><button class="btn btn-warning btn-sm fw-bold rounded-pill px-3" onclick="logout()">Logout</button></li>
        </ul>
      </div>
    </div>
  </nav>`;
}
function renderNav(active=''){
  document.getElementById('navMount').innerHTML = navHtml(active);
  const s = getSession();
  if(s){ document.getElementById('loginLink')?.classList.add('d-none'); document.getElementById('logoutLink')?.classList.remove('d-none'); }
}
function footerHtml(){ return `<footer class="footer"><div class="container"><div class="glass-card p-3 d-flex flex-column flex-md-row justify-content-between gap-2"><span>© 2026 PTARKMAL Library Management System</span><span>Bootstrap 5 · Chart.js · GitHub Pages Static Prototype</span></div></div></footer>`; }
function renderFooter(){ document.getElementById('footerMount').innerHTML = footerHtml(); }
function badge(status){
  const map = { Available:'success', Borrowed:'primary', Reserved:'warning', Returned:'secondary', Active:'success', Blocked:'danger' };
  return `<span class="badge text-bg-${map[status] || 'secondary'}">${status}</span>`;
}
function renderBooks(containerId, card=false){
  const el = document.getElementById(containerId);
  if(!el) return;
  if(card){
    el.innerHTML = PTARKMAL.books.map(b => `<div class="col-md-6 col-xl-4"><div class="glass-card book-card p-4"><div class="d-flex gap-3 align-items-start"><div class="book-icon">${b.id.replace('B','')}</div><div><h5 class="fw-black mb-2">${b.title}</h5><p class="mb-1"><strong>Title:</strong> ${b.title}</p><p class="mb-1"><strong>Author:</strong> ${b.author}</p><p class="mb-2"><strong>Category:</strong> ${b.category}</p>${badge(b.status)}</div></div><p class="text-muted mt-3 mb-0">${b.description}</p></div></div>`).join('');
  } else {
    el.innerHTML = PTARKMAL.books.map(b => `<tr><td class="fw-bold">${b.id}</td><td><strong>Title:</strong> ${b.title}<br><span class="text-muted">${b.description}</span></td><td><strong>Author:</strong> ${b.author}</td><td>${b.category}</td><td>${badge(b.status)}</td></tr>`).join('');
  }
}
function renderUsers(){
  const el = document.getElementById('usersRows'); if(!el) return;
  el.innerHTML = PTARKMAL.users.map(u => `<tr><td class="fw-bold">${u.id}</td><td>${u.name}</td><td>${u.role}</td><td>${u.email}</td><td>${badge(u.status)}</td></tr>`).join('');
}
function renderBorrowings(){
  const el = document.getElementById('borrowRows'); if(!el) return;
  el.innerHTML = PTARKMAL.borrowings.map(b => `<tr><td class="fw-bold">${b.id}</td><td>${b.book}</td><td>${b.borrower}</td><td>${b.date}</td><td>${b.due}</td><td>${badge(b.status)}</td></tr>`).join('');
}
function initCharts(){
  const pie = document.getElementById('statusChart');
  if(pie){
    const counts = ['Available','Borrowed','Reserved'].map(s => PTARKMAL.books.filter(b => b.status === s).length);
    new Chart(pie, { type:'doughnut', data:{ labels:['Available','Borrowed','Reserved'], datasets:[{ data:counts }] }, options:{ responsive:true, plugins:{ legend:{ position:'bottom' } } } });
  }
  const bar = document.getElementById('monthlyChart');
  if(bar){
    new Chart(bar, { type:'bar', data:{ labels:PTARKMAL.months, datasets:[{ label:'Monthly Borrowings', data:PTARKMAL.monthly, borderWidth:1 }] }, options:{ responsive:true, scales:{ y:{ beginAtZero:true } }, plugins:{ legend:{ display:false } } } });
  }
  const cat = document.getElementById('categoryChart');
  if(cat){
    const cats = [...new Set(PTARKMAL.books.map(b=>b.category))];
    new Chart(cat, { type:'polarArea', data:{ labels:cats, datasets:[{ data:cats.map(c => PTARKMAL.books.filter(b => b.category === c).length) }] }, options:{ responsive:true, plugins:{ legend:{ position:'bottom' } } } });
  }
}
