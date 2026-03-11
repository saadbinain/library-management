<?php
// index.php — Dashboard
$pageTitle = "Dashboard";
$activePage = "dashboard";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LibraryMS — Dashboard</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <!-- ===== SIDEBAR ===== -->
  <?php include 'includes/sidebar.php'; ?>

  <!-- ===== MAIN WRAPPER ===== -->
  <div class="main-wrapper">

    <!-- Topbar -->
    <?php include 'includes/topbar.php'; ?>

    <!-- Page Content -->
    <main class="page-content">

      <!-- Page Header -->
      <div class="page-header">
        <div>
          <h2>Dashboard Overview</h2>
          <p>Welcome back, Librarian. Here's what's happening in the library today.</p>
        </div>
        <div class="flex gap-8">
          <a href="add_book.php" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Book
          </a>
          <button class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export Report
          </button>
        </div>
      </div>

      <!-- Stat Cards -->
      <div class="stats-grid">

        <div class="stat-card green">
          <div class="stat-icon green">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          </div>
          <div class="stat-info">
            <div class="stat-value">3,842</div>
            <div class="stat-label">Total Books</div>
            <div class="stat-change up">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="18 15 12 9 6 15"/></svg>
              +48 this month
            </div>
          </div>
        </div>

        <div class="stat-card gold">
          <div class="stat-icon gold">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </div>
          <div class="stat-info">
            <div class="stat-value">1,209</div>
            <div class="stat-label">Registered Members</div>
            <div class="stat-change up">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="18 15 12 9 6 15"/></svg>
              +17 this month
            </div>
          </div>
        </div>

        <div class="stat-card red">
          <div class="stat-icon red">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div class="stat-info">
            <div class="stat-value">57</div>
            <div class="stat-label">Overdue Books</div>
            <div class="stat-change down">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
              +8 since last week
            </div>
          </div>
        </div>

        <div class="stat-card blue">
          <div class="stat-icon blue">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          </div>
          <div class="stat-info">
            <div class="stat-value">284</div>
            <div class="stat-label">Active Borrows</div>
            <div class="stat-change up">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="18 15 12 9 6 15"/></svg>
              +23 this week
            </div>
          </div>
        </div>

      </div>

      <!-- Two Column Row: Recent Books + Activity -->
      <div class="grid-2" style="align-items:start;">

        <!-- Recent Books Added -->
        <div class="section-card">
          <div class="section-header">
            <div class="section-header-left">
              <div class="section-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
              </div>
              <div>
                <div class="section-title">Recently Added Books</div>
                <div class="section-subtitle">Last 5 entries</div>
              </div>
            </div>
            <a href="view_books.php" class="btn btn-outline btn-sm">View All</a>
          </div>

          <div class="section-body" style="padding:0;">
            <table class="lib-table">
              <thead>
                <tr>
                  <th>Book</th>
                  <th>Genre</th>
                  <th>Status</th>
                  <th>Added</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="book-cell">
                      <div class="book-cover-placeholder" style="background:#3a6b4c;">BK</div>
                      <div class="book-meta">
                        <div class="title">The Great Gatsby</div>
                        <div class="isbn">F. Scott Fitzgerald</div>
                      </div>
                    </div>
                  </td>
                  <td><span class="tag">Fiction</span></td>
                  <td><span class="badge badge-available">Available</span></td>
                  <td class="text-sm text-muted">Mar 10, 2026</td>
                </tr>
                <tr>
                  <td>
                    <div class="book-cell">
                      <div class="book-cover-placeholder" style="background:#6b3a3a;">TB</div>
                      <div class="book-meta">
                        <div class="title">To Kill a Mockingbird</div>
                        <div class="isbn">Harper Lee</div>
                      </div>
                    </div>
                  </td>
                  <td><span class="tag">Classic</span></td>
                  <td><span class="badge badge-borrowed">Borrowed</span></td>
                  <td class="text-sm text-muted">Mar 9, 2026</td>
                </tr>
                <tr>
                  <td>
                    <div class="book-cell">
                      <div class="book-cover-placeholder" style="background:#2e4e7a;">DM</div>
                      <div class="book-meta">
                        <div class="title">Dune</div>
                        <div class="isbn">Frank Herbert</div>
                      </div>
                    </div>
                  </td>
                  <td><span class="tag">Sci-Fi</span></td>
                  <td><span class="badge badge-available">Available</span></td>
                  <td class="text-sm text-muted">Mar 8, 2026</td>
                </tr>
                <tr>
                  <td>
                    <div class="book-cell">
                      <div class="book-cover-placeholder" style="background:#7a5e2a;">RP</div>
                      <div class="book-meta">
                        <div class="title">Rich Dad Poor Dad</div>
                        <div class="isbn">Robert Kiyosaki</div>
                      </div>
                    </div>
                  </td>
                  <td><span class="tag">Finance</span></td>
                  <td><span class="badge badge-reserved">Reserved</span></td>
                  <td class="text-sm text-muted">Mar 7, 2026</td>
                </tr>
                <tr>
                  <td>
                    <div class="book-cell">
                      <div class="book-cover-placeholder" style="background:#4a2e6b;">NP</div>
                      <div class="book-meta">
                        <div class="title">1984</div>
                        <div class="isbn">George Orwell</div>
                      </div>
                    </div>
                  </td>
                  <td><span class="tag">Dystopian</span></td>
                  <td><span class="badge badge-available">Available</span></td>
                  <td class="text-sm text-muted">Mar 6, 2026</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Activity Feed -->
        <div class="flex flex-col gap-20">

          <!-- Quick Stats -->
          <div class="section-card">
            <div class="section-header">
              <div class="section-header-left">
                <div class="section-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                </div>
                <div class="section-title">Library at a Glance</div>
              </div>
            </div>
            <div class="quick-stats">
              <div class="quick-stat">
                <div class="q-val">24</div>
                <div class="q-lbl">Categories</div>
              </div>
              <div class="quick-stat">
                <div class="q-val">6</div>
                <div class="q-lbl">New Today</div>
              </div>
              <div class="quick-stat">
                <div class="q-val">12</div>
                <div class="q-lbl">Returns Due</div>
              </div>
              <div class="quick-stat">
                <div class="q-val">98%</div>
                <div class="q-lbl">Accuracy</div>
              </div>
            </div>
          </div>

          <!-- Recent Activity -->
          <div class="section-card">
            <div class="section-header">
              <div class="section-header-left">
                <div class="section-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <div>
                  <div class="section-title">Recent Activity</div>
                  <div class="section-subtitle">Library events log</div>
                </div>
              </div>
            </div>
            <div class="section-body">
              <div class="activity-list">
                <div class="activity-item">
                  <div class="activity-dot" style="background:var(--success)"></div>
                  <div class="activity-content">
                    <div class="act-title">Book returned: <strong>Atomic Habits</strong></div>
                    <div class="act-meta">Returned by Maria Santos · Member #1042</div>
                  </div>
                  <div class="activity-time">2m ago</div>
                </div>
                <div class="activity-item">
                  <div class="activity-dot" style="background:var(--accent)"></div>
                  <div class="activity-content">
                    <div class="act-title">New book added: <strong>The Midnight Library</strong></div>
                    <div class="act-meta">Added by Librarian Admin</div>
                  </div>
                  <div class="activity-time">15m ago</div>
                </div>
                <div class="activity-item">
                  <div class="activity-dot" style="background:var(--info)"></div>
                  <div class="activity-content">
                    <div class="act-title">Book borrowed: <strong>Deep Work</strong></div>
                    <div class="act-meta">Borrowed by Juan dela Cruz · Member #0891</div>
                  </div>
                  <div class="activity-time">1h ago</div>
                </div>
                <div class="activity-item">
                  <div class="activity-dot" style="background:var(--danger)"></div>
                  <div class="activity-content">
                    <div class="act-title">Overdue notice sent: <strong>Sapiens</strong></div>
                    <div class="act-meta">Sent to Ana Reyes · 3 days overdue</div>
                  </div>
                  <div class="activity-time">3h ago</div>
                </div>
                <div class="activity-item">
                  <div class="activity-dot" style="background:var(--primary-light)"></div>
                  <div class="activity-content">
                    <div class="act-title">New member registered: <strong>Carlos Mendoza</strong></div>
                    <div class="act-meta">Member #1210 · Student</div>
                  </div>
                  <div class="activity-time">5h ago</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Genre Distribution -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-header-left">
            <div class="section-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            </div>
            <div>
              <div class="section-title">Collection by Genre</div>
              <div class="section-subtitle">Distribution across all categories</div>
            </div>
          </div>
        </div>
        <div class="section-body">
          <div class="genre-bars" id="genreBars">
            <!-- rendered by JS -->
          </div>
        </div>
      </div>

    </main>
  </div>

  <!-- Toast Container -->
  <div class="toast-container" id="toastContainer"></div>

  <!-- Sidebar toggle overlay (mobile) -->
  <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

  <script src="assets/js/app.js"></script>
</body>
</html>
