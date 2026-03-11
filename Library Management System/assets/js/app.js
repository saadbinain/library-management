/* ============================================================
   LibraryMS — Frontend JavaScript
   ============================================================ */

'use strict';

/* ── Book Data ────────────────────────────────────────────── */
const BOOKS = [
  { id:1,  title:"The Great Gatsby",                   author:"F. Scott Fitzgerald", isbn:"978-0-7432-7356-5", genre:"Classic",   year:1925, copies:4, available:3, status:"available",  color:"#2e6b4c" },
  { id:2,  title:"To Kill a Mockingbird",               author:"Harper Lee",          isbn:"978-0-06-112008-4", genre:"Classic",   year:1960, copies:3, available:0, status:"borrowed",   color:"#6b2e2e" },
  { id:3,  title:"1984",                                author:"George Orwell",       isbn:"978-0-452-28423-4", genre:"Dystopian", year:1949, copies:5, available:4, status:"available",  color:"#2e2e6b" },
  { id:4,  title:"Dune",                                author:"Frank Herbert",       isbn:"978-0-441-01359-7", genre:"Sci-Fi",    year:1965, copies:2, available:2, status:"available",  color:"#6b5a2e" },
  { id:5,  title:"Rich Dad Poor Dad",                   author:"Robert Kiyosaki",     isbn:"978-1-61268-017-3", genre:"Finance",   year:1997, copies:6, available:0, status:"reserved",   color:"#2e5e6b" },
  { id:6,  title:"Atomic Habits",                       author:"James Clear",         isbn:"978-0-7352-1129-5", genre:"Self-Help", year:2018, copies:4, available:3, status:"available",  color:"#4a2e6b" },
  { id:7,  title:"Sapiens",                             author:"Yuval Noah Harari",   isbn:"978-0-06-231609-7", genre:"History",   year:2011, copies:3, available:0, status:"borrowed",   color:"#6b4a2e" },
  { id:8,  title:"The Midnight Library",                author:"Matt Haig",           isbn:"978-0-525-55947-4", genre:"Fiction",   year:2020, copies:2, available:2, status:"available",  color:"#1a5c6b" },
  { id:9,  title:"Deep Work",                           author:"Cal Newport",         isbn:"978-1-4555-8669-1", genre:"Self-Help", year:2016, copies:3, available:1, status:"available",  color:"#3a6b2e" },
  { id:10, title:"The Alchemist",                       author:"Paulo Coelho",        isbn:"978-0-06-231500-7", genre:"Fiction",   year:1988, copies:5, available:5, status:"available",  color:"#6b3a5c" },
  { id:11, title:"Harry Potter and the Sorcerer's Stone", author:"J.K. Rowling",     isbn:"978-0-439-70818-8", genre:"Fantasy",   year:1997, copies:7, available:3, status:"available",  color:"#2e4e6b" },
  { id:12, title:"The Psychology of Money",             author:"Morgan Housel",       isbn:"978-0-857-19780-2", genre:"Finance",   year:2020, copies:2, available:0, status:"lost",       color:"#6b6b2e" },
];

/* ── Genre chart data ─────────────────────────────────────── */
const GENRE_DATA = [
  { label:"Classic",   count:520,  color:"#2e6b4c" },
  { label:"Fiction",   count:680,  color:"#4a2e6b" },
  { label:"Sci-Fi",    count:390,  color:"#2e4e7a" },
  { label:"Self-Help", count:460,  color:"#6b4a2e" },
  { label:"Fantasy",   count:310,  color:"#6b2e5a" },
  { label:"History",   count:280,  color:"#6b5a2e" },
  { label:"Finance",   count:210,  color:"#2e5e6b" },
  { label:"Dystopian", count:190,  color:"#2e2e6b" },
  { label:"Other",     count:802,  color:"#888"    },
];

/* ── State ────────────────────────────────────────────────── */
let currentFilter   = 'all';
let currentSearch   = '';
let currentGenre    = '';
let currentSort     = 'title';
let pendingDeleteId = null;
let isGridView      = false;

/* ============================================================
   INIT
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
  animateCounters();
  renderGenreBars();
  renderBooksTable();
  renderGridCards();
  initSidebarToggle();
});

/* ============================================================
   COUNTER ANIMATION (dashboard stat cards)
   ============================================================ */
function animateCounters() {
  document.querySelectorAll('[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count, 10);
    const duration = 900;
    const step = Math.ceil(target / (duration / 16));
    let current = 0;
    const timer = setInterval(() => {
      current = Math.min(current + step, target);
      el.textContent = current.toLocaleString();
      if (current >= target) clearInterval(timer);
    }, 16);
  });
}

/* ============================================================
   GENRE BARS (dashboard)
   ============================================================ */
function renderGenreBars() {
  const container = document.getElementById('genreBars');
  if (!container) return;
  const max = Math.max(...GENRE_DATA.map(g => g.count));
  container.innerHTML = GENRE_DATA.map(g => {
    const pct = Math.round((g.count / max) * 100);
    return `
      <div style="display:flex;align-items:center;gap:14px;margin-bottom:14px;">
        <div style="width:110px;font-size:0.82rem;font-weight:600;color:var(--text);text-align:right;flex-shrink:0;">${g.label}</div>
        <div style="flex:1;height:28px;background:var(--border-light);border-radius:6px;overflow:hidden;position:relative;">
          <div style="height:100%;width:0%;background:${g.color};border-radius:6px;transition:width 0.8s ease;display:flex;align-items:center;justify-content:flex-end;padding-right:8px;"
               data-width="${pct}">
          </div>
        </div>
        <div style="width:44px;font-size:0.8rem;color:var(--text-muted);font-weight:600;flex-shrink:0;">${g.count.toLocaleString()}</div>
      </div>`;
  }).join('');

  /* Animate bars after paint */
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      container.querySelectorAll('[data-width]').forEach(bar => {
        bar.style.width = bar.dataset.width + '%';
      });
    });
  });
}

/* ============================================================
   BOOKS TABLE (view_books.html)
   ============================================================ */
function getStatusBadge(status) {
  const map = {
    available: 'badge-available',
    borrowed:  'badge-borrowed',
    reserved:  'badge-reserved',
    lost:      'badge-lost',
  };
  return `<span class="badge ${map[status] || 'badge-new'}">${capitalize(status)}</span>`;
}

function getInitials(title) {
  return title.slice(0, 2).toUpperCase();
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function getFilteredBooks() {
  let books = [...BOOKS];

  if (currentFilter !== 'all') {
    books = books.filter(b => b.status === currentFilter);
  }
  if (currentSearch) {
    const q = currentSearch.toLowerCase();
    books = books.filter(b =>
      b.title.toLowerCase().includes(q) ||
      b.author.toLowerCase().includes(q) ||
      b.isbn.includes(q)
    );
  }
  if (currentGenre) {
    books = books.filter(b => b.genre === currentGenre);
  }

  books.sort((a, b) => {
    switch (currentSort) {
      case 'title':      return a.title.localeCompare(b.title);
      case 'title-desc': return b.title.localeCompare(a.title);
      case 'author':     return a.author.localeCompare(b.author);
      case 'year':       return a.year - b.year;
      case 'year-desc':  return b.year - a.year;
      default:           return 0;
    }
  });

  return books;
}

function renderBooksTable() {
  const tbody = document.getElementById('booksBody');
  if (!tbody) return;

  const books = getFilteredBooks();
  const noResults = document.getElementById('noResults');
  const resultCount = document.getElementById('resultCount');

  if (books.length === 0) {
    tbody.innerHTML = '';
    if (noResults) noResults.style.display = 'flex';
  } else {
    if (noResults) noResults.style.display = 'none';
    tbody.innerHTML = books.map(book => {
      const availPct = book.copies > 0 ? Math.round((book.available / book.copies) * 100) : 0;
      const availColor = book.available > 0 ? 'var(--success)' : 'var(--danger)';
      return `
        <tr data-status="${book.status}" data-id="${book.id}">
          <td><input type="checkbox" class="row-check" style="cursor:pointer;width:15px;height:15px;" /></td>
          <td>
            <div class="book-cell">
              <div class="book-cover-placeholder" style="background:${book.color};">${getInitials(book.title)}</div>
              <div class="book-meta">
                <div class="title">${escHtml(book.title)}</div>
                <div class="isbn">${escHtml(book.isbn)}</div>
              </div>
            </div>
          </td>
          <td style="font-size:0.85rem;">${escHtml(book.author)}</td>
          <td><span class="tag">${escHtml(book.genre)}</span></td>
          <td class="text-sm text-muted">${book.year}</td>
          <td>
            <div style="font-size:0.83rem;">
              <span style="font-weight:700;color:${availColor};">${book.available}</span>
              <span style="color:var(--text-muted);"> / ${book.copies}</span>
            </div>
            <div style="height:4px;background:var(--border-light);border-radius:4px;width:60px;margin-top:4px;overflow:hidden;">
              <div style="height:100%;width:${availPct}%;background:${availColor};border-radius:4px;"></div>
            </div>
          </td>
          <td>${getStatusBadge(book.status)}</td>
          <td>
            <div class="actions-cell" style="justify-content:center;">
              <button class="action-btn view" title="View Details"
                onclick="viewBook(${book.id})">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
              <button class="action-btn edit" title="Edit Book"
                onclick="editBook(${book.id})">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </button>
              <button class="action-btn delete" title="Delete Book"
                onclick="confirmDelete(${book.id}, '${escJs(book.title)}')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
              </button>
            </div>
          </td>
        </tr>`;
    }).join('');
  }

  if (resultCount) {
    resultCount.innerHTML = `Showing <strong>${books.length}</strong> book${books.length !== 1 ? 's' : ''}`;
  }
}

function renderGridCards() {
  const container = document.getElementById('gridContainer');
  if (!container) return;

  const books = getFilteredBooks();
  container.innerHTML = books.map(book => `
    <div class="book-grid-card" style="background:var(--surface);border:1px solid var(--border-light);border-radius:12px;overflow:hidden;box-shadow:var(--shadow-sm);transition:var(--transition);cursor:pointer;"
         onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow)'"
         onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'"
         onclick="viewBook(${book.id})">
      <div style="height:160px;background:${book.color};display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
        <div style="text-align:center;padding:12px;">
          <div style="font-size:2rem;font-weight:900;color:rgba(255,255,255,0.25);font-family:'Playfair Display',serif;line-height:1;">${getInitials(book.title)}</div>
          <div style="font-size:0.65rem;color:rgba(255,255,255,0.7);margin-top:8px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;line-height:1.3;padding:0 4px;">${escHtml(book.title.substring(0, 28))}</div>
        </div>
        <div style="position:absolute;bottom:8px;right:8px;">${getStatusBadge(book.status)}</div>
      </div>
      <div style="padding:12px;">
        <div style="font-size:0.82rem;font-weight:700;color:var(--text);line-height:1.3;margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${escHtml(book.title)}</div>
        <div style="font-size:0.72rem;color:var(--text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${escHtml(book.author)}</div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:8px;">
          <span class="tag" style="font-size:0.62rem;">${escHtml(book.genre)}</span>
          <span style="font-size:0.72rem;color:var(--text-muted);">${book.year}</span>
        </div>
      </div>
    </div>`
  ).join('');
}

/* ── Filters & Search ──────────────────────────────────────── */
function filterBooks(status, btn) {
  currentFilter = status;
  document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
  if (btn) btn.classList.add('active');
  renderBooksTable();
  renderGridCards();
}

function searchBooks(query) {
  currentSearch = query.trim();
  renderBooksTable();
  renderGridCards();
}

function filterGenre(genre) {
  currentGenre = genre;
  renderBooksTable();
  renderGridCards();
}

function sortBooks(order) {
  currentSort = order;
  const sel = document.getElementById('sortOrder');
  if (sel) sel.value = order;
  renderBooksTable();
  renderGridCards();
}

/* ── Toggle View ───────────────────────────────────────────── */
function toggleViewMode() {
  isGridView = !isGridView;
  const tableView = document.getElementById('tableView');
  const gridView  = document.getElementById('gridView');
  const btn       = document.getElementById('toggleView');

  if (isGridView) {
    tableView.style.display = 'none';
    gridView.style.display  = 'block';
    if (btn) btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg> List View`;
    renderGridCards();
  } else {
    tableView.style.display = 'block';
    gridView.style.display  = 'none';
    if (btn) btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg> Grid View`;
    renderBooksTable();
  }
}

/* ── Select All ────────────────────────────────────────────── */
function toggleSelectAll(master) {
  document.querySelectorAll('.row-check').forEach(cb => {
    cb.checked = master.checked;
  });
}

/* ── Modals ────────────────────────────────────────────────── */
function openModal(id) {
  const overlay = document.getElementById(id);
  if (overlay) overlay.classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeModal(id) {
  const overlay = document.getElementById(id);
  if (overlay) overlay.classList.remove('open');
  document.body.style.overflow = '';
}

/* Close modal on overlay click */
document.addEventListener('click', e => {
  if (e.target.classList.contains('modal-overlay')) {
    closeModal(e.target.id);
  }
});

/* ── View Book Modal ───────────────────────────────────────── */
function viewBook(id) {
  const book = BOOKS.find(b => b.id === id);
  if (!book) return;

  const titleEl = document.getElementById('modalBookTitle');
  const coverEl = document.getElementById('modalBookCover');
  const infoEl  = document.getElementById('modalBookInfo');

  if (titleEl) titleEl.textContent = book.title;
  if (coverEl) {
    coverEl.style.background = book.color;
    coverEl.textContent = getInitials(book.title);
  }
  if (infoEl) {
    const availColor = book.available > 0 ? 'var(--success)' : 'var(--danger)';
    infoEl.innerHTML = `
      <div style="margin-bottom:6px;">${getStatusBadge(book.status)}</div>
      <div style="font-size:1rem;font-weight:700;color:var(--text);margin-bottom:4px;">${escHtml(book.title)}</div>
      <div style="font-size:0.85rem;color:var(--text-muted);margin-bottom:16px;">by ${escHtml(book.author)}</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:0.83rem;">
        <div><span style="color:var(--text-muted);">ISBN</span><br><strong>${escHtml(book.isbn)}</strong></div>
        <div><span style="color:var(--text-muted);">Genre</span><br><strong>${escHtml(book.genre)}</strong></div>
        <div><span style="color:var(--text-muted);">Year</span><br><strong>${book.year}</strong></div>
        <div><span style="color:var(--text-muted);">Copies</span><br><strong style="color:${availColor};">${book.available} available</strong> / ${book.copies} total</div>
      </div>`;
  }

  openModal('viewModal');
}

/* ── Edit Book ─────────────────────────────────────────────── */
function editBook(id) {
  showToast(`Edit mode for book #${id} — connect to backend to save changes.`, 'info');
  window.location.href = 'add_book.html';
}

/* ── Delete Book ───────────────────────────────────────────── */
function confirmDelete(id, title) {
  pendingDeleteId = id;
  const nameEl = document.getElementById('deleteBookName');
  if (nameEl) nameEl.textContent = title;
  openModal('deleteModal');
}

function deleteBook() {
  const idx = BOOKS.findIndex(b => b.id === pendingDeleteId);
  if (idx !== -1) {
    const title = BOOKS[idx].title;
    BOOKS.splice(idx, 1);
    renderBooksTable();
    renderGridCards();
    showToast(`"${title}" has been removed from the catalog.`, 'success');
  }
  closeModal('deleteModal');
  pendingDeleteId = null;
}

/* ── Export CSV ────────────────────────────────────────────── */
function exportTable() {
  const rows = [['ID','Title','Author','ISBN','Genre','Year','Copies','Available','Status']];
  BOOKS.forEach(b => rows.push([b.id, b.title, b.author, b.isbn, b.genre, b.year, b.copies, b.available, b.status]));
  const csv = rows.map(r => r.map(c => `"${String(c).replace(/"/g,'""')}"`).join(',')).join('\n');
  const blob = new Blob([csv], { type: 'text/csv' });
  const url  = URL.createObjectURL(blob);
  const a    = Object.assign(document.createElement('a'), { href:url, download:'library_catalog.csv' });
  a.click();
  URL.revokeObjectURL(url);
  showToast('Catalog exported as CSV successfully!', 'success');
}

/* ============================================================
   ADD BOOK FORM (add_book.html)
   ============================================================ */
function handleSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const title  = form.querySelector('#title')?.value.trim();
  const author = form.querySelector('#author')?.value.trim();
  const isbn   = form.querySelector('#isbn')?.value.trim();
  const year   = form.querySelector('#year')?.value.trim();

  if (!title || !author || !isbn || !year) {
    showToast('Please fill in all required fields.', 'warning');
    return;
  }

  /* Simulate save */
  const btn = document.getElementById('submitBtn');
  if (btn) {
    btn.disabled = true;
    btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 0.8s linear infinite;"><path d="M21 12a9 9 0 1 1-6.2-8.56"/></svg> Saving…`;
  }

  setTimeout(() => {
    showToast(`"${title}" has been added to the catalog!`, 'success');
    form.reset();
    removeCover();
    if (btn) {
      btn.disabled = false;
      btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Save Book to Catalog`;
    }
  }, 1200);
}

function resetForm() {
  const form = document.getElementById('addBookForm');
  if (form) {
    form.reset();
    removeCover();
    showToast('Form has been reset.', 'info');
  }
}

function saveDraft() {
  const title = document.getElementById('title')?.value.trim() || 'Untitled';
  showToast(`Draft saved for "${title}".`, 'success');
}

/* ── Cover Image Preview ───────────────────────────────────── */
function previewCover(e) {
  const file  = e.target.files[0];
  if (!file) return;
  if (file.size > 2 * 1024 * 1024) {
    showToast('File too large. Maximum size is 2MB.', 'warning');
    return;
  }
  const reader = new FileReader();
  reader.onload = ev => {
    const preview = document.getElementById('coverPreview');
    const group   = document.getElementById('coverPreviewGroup');
    const fname   = document.getElementById('coverFileName');
    if (preview) preview.src = ev.target.result;
    if (group)   group.style.display = 'block';
    if (fname)   fname.textContent = file.name;
  };
  reader.readAsDataURL(file);
}

function removeCover() {
  const input   = document.getElementById('cover_image');
  const preview = document.getElementById('coverPreview');
  const group   = document.getElementById('coverPreviewGroup');
  if (input)   input.value = '';
  if (preview) preview.src = '';
  if (group)   group.style.display = 'none';
}

/* ── Drag & Drop on cover upload ───────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  const dropZone = document.getElementById('fileDropZone');
  if (!dropZone) return;
  dropZone.addEventListener('dragover', e => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--primary)';
    dropZone.style.background  = 'rgba(26,60,52,0.04)';
  });
  dropZone.addEventListener('dragleave', () => {
    dropZone.style.borderColor = '';
    dropZone.style.background  = '';
  });
  dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.borderColor = '';
    dropZone.style.background  = '';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
      const input = document.getElementById('cover_image');
      const dt = new DataTransfer();
      dt.items.add(file);
      if (input) {
        input.files = dt.files;
        previewCover({ target: input });
      }
    }
  });
});

/* ============================================================
   SIDEBAR TOGGLE
   ============================================================ */
function initSidebarToggle() {
  const toggleBtn = document.getElementById('sidebarToggle');
  if (toggleBtn) toggleBtn.style.display = '';
  handleResize();
  window.addEventListener('resize', handleResize);
}

function handleResize() {
  const sidebar  = document.getElementById('sidebar');
  const overlay  = document.getElementById('sidebarOverlay');
  if (window.innerWidth <= 768) {
    if (sidebar) sidebar.classList.remove('open');
    if (overlay) overlay.style.display = 'none';
  }
}

function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  if (!sidebar) return;
  const isOpen = sidebar.classList.toggle('open');
  if (overlay) overlay.style.display = isOpen ? 'block' : 'none';
}

function closeSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  if (sidebar) sidebar.classList.remove('open');
  if (overlay) overlay.style.display = 'none';
}

/* ============================================================
   TOAST NOTIFICATIONS
   ============================================================ */
function showToast(message, type = 'success') {
  const container = document.getElementById('toastContainer');
  if (!container) return;

  const icons = {
    success: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>`,
    warning: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`,
    danger:  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
    info:    `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>`,
  };

  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `${icons[type] || icons.info} <span>${escHtml(message)}</span>`;
  container.appendChild(toast);

  setTimeout(() => {
    toast.style.transition = 'opacity 0.4s, transform 0.4s';
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    setTimeout(() => toast.remove(), 400);
  }, 3500);
}

/* ============================================================
   UTILITIES
   ============================================================ */
function escHtml(str) {
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

function escJs(str) {
  return String(str).replace(/'/g, "\\'").replace(/"/g, '\\"');
}

/* Spinner keyframe (injected once) */
(function injectSpinnerCSS() {
  if (document.getElementById('lib-spinner-style')) return;
  const s = document.createElement('style');
  s.id = 'lib-spinner-style';
  s.textContent = '@keyframes spin { to { transform:rotate(360deg); } }';
  document.head.appendChild(s);
})();
