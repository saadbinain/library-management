<?php
// view_books.php — Book Catalog
$pageTitle = "Book Catalog";
$activePage = "view-books";

// Sample book data (replace with DB query: $books = $pdo->query("SELECT * FROM books")->fetchAll())
$books = [
  ["id"=>1,  "title"=>"The Great Gatsby",             "author"=>"F. Scott Fitzgerald", "isbn"=>"978-0-7432-7356-5", "genre"=>"Classic",    "year"=>1925, "copies"=>4, "available"=>3, "status"=>"available",  "color"=>"#2e6b4c"],
  ["id"=>2,  "title"=>"To Kill a Mockingbird",         "author"=>"Harper Lee",          "isbn"=>"978-0-06-112008-4", "genre"=>"Classic",    "year"=>1960, "copies"=>3, "available"=>0, "status"=>"borrowed",   "color"=>"#6b2e2e"],
  ["id"=>3,  "title"=>"1984",                          "author"=>"George Orwell",        "isbn"=>"978-0-452-28423-4", "genre"=>"Dystopian",  "year"=>1949, "copies"=>5, "available"=>4, "status"=>"available",  "color"=>"#2e2e6b"],
  ["id"=>4,  "title"=>"Dune",                          "author"=>"Frank Herbert",        "isbn"=>"978-0-441-01359-7", "genre"=>"Sci-Fi",     "year"=>1965, "copies"=>2, "available"=>2, "status"=>"available",  "color"=>"#6b5a2e"],
  ["id"=>5,  "title"=>"Rich Dad Poor Dad",             "author"=>"Robert Kiyosaki",     "isbn"=>"978-1-61268-017-3", "genre"=>"Finance",    "year"=>1997, "copies"=>6, "available"=>0, "status"=>"reserved",   "color"=>"#2e5e6b"],
  ["id"=>6,  "title"=>"Atomic Habits",                 "author"=>"James Clear",         "isbn"=>"978-0-7352-1129-5", "genre"=>"Self-Help",  "year"=>2018, "copies"=>4, "available"=>3, "status"=>"available",  "color"=>"#4a2e6b"],
  ["id"=>7,  "title"=>"Sapiens",                       "author"=>"Yuval Noah Harari",   "isbn"=>"978-0-06-231609-7", "genre"=>"History",    "year"=>2011, "copies"=>3, "available"=>0, "status"=>"borrowed",   "color"=>"#6b4a2e"],
  ["id"=>8,  "title"=>"The Midnight Library",          "author"=>"Matt Haig",           "isbn"=>"978-0-525-55947-4", "genre"=>"Fiction",    "year"=>2020, "copies"=>2, "available"=>2, "status"=>"available",  "color"=>"#1a5c6b"],
  ["id"=>9,  "title"=>"Deep Work",                     "author"=>"Cal Newport",         "isbn"=>"978-1-4555-8669-1", "genre"=>"Self-Help",  "year"=>2016, "copies"=>3, "available"=>1, "status"=>"available",  "color"=>"#3a6b2e"],
  ["id"=>10, "title"=>"The Alchemist",                 "author"=>"Paulo Coelho",        "isbn"=>"978-0-06-231500-7", "genre"=>"Fiction",    "year"=>1988, "copies"=>5, "available"=>5, "status"=>"available",  "color"=>"#6b3a5c"],
  ["id"=>11, "title"=>"Harry Potter and the Sorcerer's Stone", "author"=>"J.K. Rowling","isbn"=>"978-0-439-70818-8", "genre"=>"Fantasy",    "year"=>1997, "copies"=>7, "available"=>3, "status"=>"available",  "color"=>"#2e4e6b"],
  ["id"=>12, "title"=>"The Psychology of Money",       "author"=>"Morgan Housel",       "isbn"=>"978-0-857-19780-2", "genre"=>"Finance",    "year"=>2020, "copies"=>2, "available"=>0, "status"=>"lost",       "color"=>"#6b6b2e"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LibraryMS — Book Catalog</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <?php include 'includes/sidebar.php'; ?>

  <div class="main-wrapper">
    <?php include 'includes/topbar.php'; ?>

    <main class="page-content">

      <!-- Page Header -->
      <div class="page-header">
        <div>
          <h2>Book Catalog</h2>
          <p>Browse and manage all <?= count($books) ?> books in the library collection.</p>
        </div>
        <div class="flex gap-8">
          <a href="add_book.php" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Book
          </a>
          <button class="btn btn-outline" onclick="exportTable()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export CSV
          </button>
          <button class="btn btn-outline" id="toggleView" title="Toggle View">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Grid View
          </button>
        </div>
      </div>

      <!-- Summary Stats -->
      <div class="quick-stats">
        <div class="quick-stat">
          <div class="q-val"><?= count($books) ?></div>
          <div class="q-lbl">Total Books</div>
        </div>
        <div class="quick-stat">
          <div class="q-val"><?= count(array_filter($books, fn($b) => $b['status'] === 'available')) ?></div>
          <div class="q-lbl">Available</div>
        </div>
        <div class="quick-stat">
          <div class="q-val"><?= count(array_filter($books, fn($b) => $b['status'] === 'borrowed')) ?></div>
          <div class="q-lbl">Borrowed</div>
        </div>
        <div class="quick-stat">
          <div class="q-val"><?= count(array_filter($books, fn($b) => $b['status'] === 'reserved')) ?></div>
          <div class="q-lbl">Reserved</div>
        </div>
        <div class="quick-stat">
          <div class="q-val"><?= count(array_filter($books, fn($b) => $b['status'] === 'lost')) ?></div>
          <div class="q-lbl">Lost</div>
        </div>
        <div class="quick-stat">
          <div class="q-val"><?= array_sum(array_column($books, 'copies')) ?></div>
          <div class="q-lbl">Total Copies</div>
        </div>
      </div>

      <!-- Books Table Card -->
      <div class="section-card">

        <!-- Toolbar -->
        <div class="section-header">
          <div class="table-toolbar" style="width:100%;">

            <!-- Filter Tabs -->
            <div class="filter-tabs">
              <button class="filter-tab active" data-filter="all" onclick="filterBooks('all', this)">All</button>
              <button class="filter-tab" data-filter="available" onclick="filterBooks('available', this)">Available</button>
              <button class="filter-tab" data-filter="borrowed" onclick="filterBooks('borrowed', this)">Borrowed</button>
              <button class="filter-tab" data-filter="reserved" onclick="filterBooks('reserved', this)">Reserved</button>
              <button class="filter-tab" data-filter="lost" onclick="filterBooks('lost', this)">Lost</button>
            </div>

            <!-- Search -->
            <div class="table-search">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
              <input type="text" id="tableSearch" placeholder="Search title, author, ISBN…" oninput="searchBooks(this.value)" />
            </div>

            <!-- Genre Filter -->
            <select class="table-filter-select" onchange="filterGenre(this.value)" id="genreFilter">
              <option value="">All Genres</option>
              <option value="Classic">Classic</option>
              <option value="Fiction">Fiction</option>
              <option value="Sci-Fi">Sci-Fi</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Dystopian">Dystopian</option>
              <option value="Self-Help">Self-Help</option>
              <option value="Finance">Finance</option>
              <option value="History">History</option>
            </select>

            <!-- Sort -->
            <select class="table-filter-select" onchange="sortBooks(this.value)" id="sortOrder">
              <option value="title">Sort: Title (A–Z)</option>
              <option value="title-desc">Sort: Title (Z–A)</option>
              <option value="year">Sort: Oldest First</option>
              <option value="year-desc">Sort: Newest First</option>
              <option value="author">Sort: Author</option>
            </select>

            <div class="ml-auto" style="font-size:0.8rem;color:var(--text-muted);" id="resultCount">
              Showing <strong><?= count($books) ?></strong> books
            </div>

          </div>
        </div>

        <!-- Table View -->
        <div id="tableView">
          <div class="table-wrapper">
            <table class="lib-table" id="booksTable">
              <thead>
                <tr>
                  <th style="width:40px;">
                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)" style="cursor:pointer;width:15px;height:15px;" />
                  </th>
                  <th>
                    <button class="sort-btn" onclick="sortBooks('title')">
                      Book
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                  </th>
                  <th>
                    <button class="sort-btn" onclick="sortBooks('author')">
                      Author
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                  </th>
                  <th>Genre</th>
                  <th>
                    <button class="sort-btn" onclick="sortBooks('year')">
                      Year
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                  </th>
                  <th>Copies</th>
                  <th>Status</th>
                  <th style="text-align:center;">Actions</th>
                </tr>
              </thead>
              <tbody id="booksBody">
                <?php foreach ($books as $book): ?>
                <tr data-status="<?= $book['status'] ?>"
                    data-genre="<?= $book['genre'] ?>"
                    data-title="<?= strtolower($book['title']) ?>"
                    data-author="<?= strtolower($book['author']) ?>"
                    data-isbn="<?= $book['isbn'] ?>"
                    data-year="<?= $book['year'] ?>">
                  <td>
                    <input type="checkbox" class="row-check" style="cursor:pointer;width:15px;height:15px;" />
                  </td>
                  <td>
                    <div class="book-cell">
                      <div class="book-cover-placeholder" style="background: <?= htmlspecialchars($book['color']) ?>;">
                        <?= strtoupper(substr($book['title'], 0, 2)) ?>
                      </div>
                      <div class="book-meta">
                        <div class="title"><?= htmlspecialchars($book['title']) ?></div>
                        <div class="isbn"><?= htmlspecialchars($book['isbn']) ?></div>
                      </div>
                    </div>
                  </td>
                  <td style="font-size:0.85rem;"><?= htmlspecialchars($book['author']) ?></td>
                  <td><span class="tag"><?= htmlspecialchars($book['genre']) ?></span></td>
                  <td class="text-sm text-muted"><?= $book['year'] ?></td>
                  <td>
                    <div style="font-size:0.83rem;">
                      <span style="font-weight:700;color:<?= $book['available'] > 0 ? 'var(--success)' : 'var(--danger)' ?>;"><?= $book['available'] ?></span>
                      <span style="color:var(--text-muted);"> / <?= $book['copies'] ?></span>
                    </div>
                    <div style="height:4px;background:var(--border-light);border-radius:4px;width:60px;margin-top:4px;overflow:hidden;">
                      <div style="height:100%;width:<?= $book['copies'] > 0 ? round(($book['available'] / $book['copies']) * 100) : 0 ?>%;background:<?= $book['available'] > 0 ? 'var(--success)' : 'var(--danger)' ?>;border-radius:4px;transition:.3s;"></div>
                    </div>
                  </td>
                  <td>
                    <?php
                      $statusMap = [
                        'available'   => 'badge-available',
                        'borrowed'    => 'badge-borrowed',
                        'reserved'    => 'badge-reserved',
                        'lost'        => 'badge-lost',
                        'maintenance' => 'badge-reserved',
                      ];
                      $badgeClass = $statusMap[$book['status']] ?? 'badge-new';
                      $statusLabel = ucfirst($book['status']);
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= $statusLabel ?></span>
                  </td>
                  <td>
                    <div class="actions-cell" style="justify-content:center;">
                      <button class="action-btn view" title="View Details" onclick="viewBook(<?= $book['id'] ?>, '<?= htmlspecialchars(addslashes($book['title'])) ?>', '<?= htmlspecialchars(addslashes($book['author'])) ?>', '<?= $book['isbn'] ?>', '<?= $book['genre'] ?>', <?= $book['year'] ?>, <?= $book['copies'] ?>, <?= $book['available'] ?>, '<?= $book['status'] ?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                      </button>
                      <button class="action-btn edit" title="Edit Book" onclick="editBook(<?= $book['id'] ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                      </button>
                      <button class="action-btn delete" title="Delete Book" onclick="confirmDelete(<?= $book['id'] ?>, '<?= htmlspecialchars(addslashes($book['title'])) ?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                      </button>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <!-- No results -->
          <div id="noResults" class="empty-state" style="display:none;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <h3>No books found</h3>
            <p>Try adjusting your search terms or filters to find what you're looking for.</p>
          </div>
        </div>

        <!-- Grid View (hidden by default) -->
        <div id="gridView" style="display:none;padding:24px;">
          <div id="gridContainer" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:20px;">
            <?php foreach ($books as $book): ?>
            <div class="book-grid-card"
                 data-status="<?= $book['status'] ?>"
                 data-genre="<?= $book['genre'] ?>"
                 data-title="<?= strtolower($book['title']) ?>"
                 data-author="<?= strtolower($book['author']) ?>"
                 style="background:var(--surface);border:1px solid var(--border-light);border-radius:12px;overflow:hidden;box-shadow:var(--shadow-sm);transition:var(--transition);cursor:pointer;"
                 onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow)'"
                 onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'"
                 onclick="viewBook(<?= $book['id'] ?>, '<?= htmlspecialchars(addslashes($book['title'])) ?>', '<?= htmlspecialchars(addslashes($book['author'])) ?>', '<?= $book['isbn'] ?>', '<?= $book['genre'] ?>', <?= $book['year'] ?>, <?= $book['copies'] ?>, <?= $book['available'] ?>, '<?= $book['status'] ?>')">
              <!-- Book spine artwork -->
              <div style="height:160px;background:<?= htmlspecialchars($book['color']) ?>;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
                <div style="text-align:center;padding:12px;">
                  <div style="font-size:2rem;font-weight:900;color:rgba(255,255,255,0.25);font-family:'Playfair Display',serif;line-height:1;"><?= strtoupper(substr($book['title'],0,2)) ?></div>
                  <div style="font-size:0.65rem;color:rgba(255,255,255,0.7);margin-top:8px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;line-height:1.3;padding:0 4px;"><?= htmlspecialchars(mb_substr($book['title'],0,28)) ?></div>
                </div>
                <div style="position:absolute;bottom:8px;right:8px;">
                  <?php
                    $statusMap = ['available'=>'badge-available','borrowed'=>'badge-borrowed','reserved'=>'badge-reserved','lost'=>'badge-lost'];
                    $bc = $statusMap[$book['status']] ?? 'badge-new';
                  ?>
                  <span class="badge <?= $bc ?>" style="font-size:0.62rem;"><?= ucfirst($book['status']) ?></span>
                </div>
              </div>
              <div style="padding:12px;">
                <div style="font-size:0.82rem;font-weight:700;color:var(--text);line-height:1.3;margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= htmlspecialchars($book['title']) ?></div>
                <div style="font-size:0.72rem;color:var(--text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= htmlspecialchars($book['author']) ?></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:8px;">
                  <span class="tag" style="font-size:0.62rem;"><?= htmlspecialchars($book['genre']) ?></span>
                  <span style="font-size:0.72rem;color:var(--text-muted);"><?= $book['year'] ?></span>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
          <div>Showing <strong>1–12</strong> of <strong><?= count($books) ?></strong> books</div>
          <div class="pagination-pages">
            <button class="page-btn" disabled>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span style="padding:0 4px;color:var(--text-muted);">…</span>
            <button class="page-btn">12</button>
            <button class="page-btn">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
          </div>
        </div>

      </div>

    </main>
  </div>

  <!-- View Book Modal -->
  <div class="modal-overlay" id="viewModal">
    <div class="modal" style="max-width:600px;">
      <div class="modal-header">
        <div class="modal-title" id="modalBookTitle">Book Details</div>
        <button class="modal-close" onclick="closeModal('viewModal')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="flex gap-20" style="align-items:flex-start;">
          <div id="modalBookCover" style="width:90px;height:120px;border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:900;color:rgba(255,255,255,0.3);font-family:'Playfair Display',serif;"></div>
          <div style="flex:1;" id="modalBookInfo"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>
        <button class="btn btn-primary" id="modalEditBtn">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          Edit Book
        </button>
      </div>
    </div>
  </div>

  <!-- Delete Confirm Modal -->
  <div class="modal-overlay" id="deleteModal">
    <div class="modal" style="max-width:440px;">
      <div class="modal-header">
        <div class="modal-title">Delete Book</div>
        <button class="modal-close" onclick="closeModal('deleteModal')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" style="margin-bottom:16px;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <div>
            <strong>This action cannot be undone!</strong>
            You are about to permanently delete "<span id="deleteBookName" style="font-style:italic;"></span>" from the catalog.
          </div>
        </div>
        <p style="font-size:0.87rem;color:var(--text-muted);">All associated records including borrowing history will be archived.</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline" onclick="closeModal('deleteModal')">Cancel</button>
        <button class="btn btn-danger" onclick="deleteBook()">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/></svg>
          Yes, Delete Book
        </button>
      </div>
    </div>
  </div>

  <div class="toast-container" id="toastContainer"></div>

  <script src="assets/js/app.js"></script>
</body>
</html>
