<header class="topbar">
  <button class="topbar-icon-btn" id="sidebarToggle" onclick="toggleSidebar()" title="Toggle Sidebar" style="display:none;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>

  <div class="topbar-title">
    <h1><?= $pageTitle ?? 'Library Management System' ?></h1>
    <div class="breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep">›</span>
      <span><?= $pageTitle ?? 'Dashboard' ?></span>
    </div>
  </div>

  <div class="topbar-actions">

    <div class="topbar-search">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" placeholder="Search books, members…" id="globalSearch" />
    </div>

    <button class="topbar-icon-btn" title="Notifications">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      <span class="notif-dot"></span>
    </button>

    <button class="topbar-icon-btn" title="Calendar">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    </button>

    <div style="width:1px;height:28px;background:var(--border-light);margin:0 4px;"></div>

    <div style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:4px 8px;border-radius:8px;transition:var(--transition);"
         onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background='transparent'">
      <div style="width:34px;height:34px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.82rem;font-family:'Playfair Display',serif;">LA</div>
      <div style="line-height:1.2;">
        <div style="font-size:0.82rem;font-weight:600;color:var(--text);">Librarian Admin</div>
        <div style="font-size:0.7rem;color:var(--text-muted);">Head Librarian</div>
      </div>
    </div>

  </div>
</header>
