<aside class="sidebar" id="sidebar">

  <!-- Brand -->
  <div class="sidebar-brand">
    <div class="brand-icon">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15zm2.5-5a.5.5 0 0 0 0 1H20v1H6.5A1.5 1.5 0 0 1 5 15V4.5A1.5 1.5 0 0 1 6.5 3H19v13H6.5z"/>
      </svg>
    </div>
    <div class="brand-text">
      <div class="brand-title">LibraryMS</div>
      <div class="brand-sub">Management System</div>
    </div>
  </div>

  <!-- Main Navigation -->
  <div class="sidebar-section">
    <div class="sidebar-section-label">Main Menu</div>
    <nav class="sidebar-nav">

      <div class="nav-item">
        <a href="index.php" class="nav-link <?= ($activePage ?? '') === 'dashboard' ? 'active' : '' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          Dashboard
        </a>
      </div>

      <div class="nav-item">
        <a href="view_books.php" class="nav-link <?= ($activePage ?? '') === 'view-books' ? 'active' : '' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          Book Catalog
          <span class="nav-badge">3,842</span>
        </a>
      </div>

      <div class="nav-item">
        <a href="add_book.php" class="nav-link <?= ($activePage ?? '') === 'add-book' ? 'active' : '' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Add New Book
        </a>
      </div>

    </nav>
  </div>

  <!-- Library Section -->
  <div class="sidebar-section">
    <div class="sidebar-section-label">Library</div>
    <nav class="sidebar-nav">

      <div class="nav-item">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Members
        </a>
      </div>

      <div class="nav-item">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>
          Borrowing
          <span class="nav-badge" style="background:var(--danger);color:#fff;">57</span>
        </a>
      </div>

      <div class="nav-item">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          Returns
        </a>
      </div>

      <div class="nav-item">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
          Reports
        </a>
      </div>

    </nav>
  </div>

  <!-- Settings -->
  <div class="sidebar-section">
    <div class="sidebar-section-label">System</div>
    <nav class="sidebar-nav">
      <div class="nav-item">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
          Settings
        </a>
      </div>
      <div class="nav-item">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Logout
        </a>
      </div>
    </nav>
  </div>

  <!-- Footer -->
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="avatar">LA</div>
      <div class="user-info">
        <div class="user-name">Librarian Admin</div>
        <div class="user-role">Head Librarian</div>
      </div>
    </div>
  </div>

</aside>

<!-- Mobile sidebar overlay -->
<div style="
  display:none;
  position:fixed;inset:0;
  background:rgba(0,0,0,0.5);
  z-index:99;
" id="sidebarOverlay" onclick="document.getElementById('sidebar').classList.remove('open');this.style.display='none'"></div>
