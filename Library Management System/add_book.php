<?php
// add_book.php — Add New Book
$pageTitle = "Add New Book";
$activePage = "add-book";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LibraryMS — Add New Book</title>
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
          <h2>Add New Book</h2>
          <p>Fill in the details below to add a new book to the library catalog.</p>
        </div>
        <div class="flex gap-8">
          <a href="view_books.php" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Catalog
          </a>
        </div>
      </div>

      <!-- Step Indicator -->
      <div class="section-card" style="padding:20px 28px;">
        <div class="steps">
          <div class="step active">
            <div class="step-num">1</div>
            <div class="step-label">Book Details</div>
          </div>
          <div class="step">
            <div class="step-num">2</div>
            <div class="step-label">Publishing Info</div>
          </div>
          <div class="step">
            <div class="step-num">3</div>
            <div class="step-label">Availability</div>
          </div>
          <div class="step">
            <div class="step-num">4</div>
            <div class="step-label">Review</div>
          </div>
        </div>
      </div>

      <!-- Form -->
      <form id="addBookForm" action="process/save_book.php" method="POST" enctype="multipart/form-data" novalidate>

        <!-- Section 1: Basic Book Info -->
        <div class="section-card">
          <div class="section-header">
            <div class="section-header-left">
              <div class="section-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
              </div>
              <div>
                <div class="section-title">Book Information</div>
                <div class="section-subtitle">Primary details about the book</div>
              </div>
            </div>
            <span class="badge badge-new">Step 1</span>
          </div>
          <div class="section-body">
            <div class="form-grid cols-2">

              <!-- Title -->
              <div class="form-group span-2">
                <label class="form-label" for="title">
                  Book Title <span class="required">*</span>
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       class="form-control"
                       placeholder="e.g. The Great Gatsby"
                       required
                       maxlength="255" />
                <div class="form-hint">Enter the full title as it appears on the book cover.</div>
              </div>

              <!-- Author -->
              <div class="form-group">
                <label class="form-label" for="author">
                  Author(s) <span class="required">*</span>
                </label>
                <input type="text"
                       id="author"
                       name="author"
                       class="form-control"
                       placeholder="e.g. F. Scott Fitzgerald"
                       required />
                <div class="form-hint">Separate multiple authors with a comma.</div>
              </div>

              <!-- ISBN -->
              <div class="form-group">
                <label class="form-label" for="isbn">
                  ISBN <span class="required">*</span>
                </label>
                <div class="input-group">
                  <span class="input-prefix">ISBN</span>
                  <input type="text"
                         id="isbn"
                         name="isbn"
                         class="form-control"
                         placeholder="978-3-16-148410-0"
                         pattern="[\d\-X]{10,17}"
                         required />
                </div>
                <div class="form-hint">ISBN-10 or ISBN-13 format.</div>
              </div>

              <!-- Genre -->
              <div class="form-group">
                <label class="form-label" for="genre">
                  Genre / Category <span class="required">*</span>
                </label>
                <select id="genre" name="genre" class="form-control" required>
                  <option value="" disabled selected>Select a genre</option>
                  <optgroup label="Fiction">
                    <option value="fiction">Fiction</option>
                    <option value="sci-fi">Science Fiction</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="mystery">Mystery & Thriller</option>
                    <option value="romance">Romance</option>
                    <option value="horror">Horror</option>
                    <option value="classic">Classic Literature</option>
                    <option value="dystopian">Dystopian</option>
                    <option value="adventure">Adventure</option>
                    <option value="historical-fiction">Historical Fiction</option>
                  </optgroup>
                  <optgroup label="Non-Fiction">
                    <option value="biography">Biography & Memoir</option>
                    <option value="history">History</option>
                    <option value="self-help">Self-Help</option>
                    <option value="business">Business & Finance</option>
                    <option value="science">Science & Technology</option>
                    <option value="philosophy">Philosophy</option>
                    <option value="psychology">Psychology</option>
                    <option value="politics">Politics & Society</option>
                    <option value="travel">Travel</option>
                    <option value="cooking">Cooking & Lifestyle</option>
                    <option value="health">Health & Wellness</option>
                  </optgroup>
                  <optgroup label="Academic">
                    <option value="textbook">Textbook</option>
                    <option value="reference">Reference</option>
                    <option value="research">Research</option>
                    <option value="law">Law</option>
                    <option value="medicine">Medicine</option>
                    <option value="engineering">Engineering</option>
                  </optgroup>
                  <optgroup label="Children & YA">
                    <option value="children">Children's Books</option>
                    <option value="young-adult">Young Adult</option>
                  </optgroup>
                </select>
              </div>

              <!-- Sub-genre / Tags -->
              <div class="form-group">
                <label class="form-label" for="tags">Tags / Keywords</label>
                <input type="text"
                       id="tags"
                       name="tags"
                       class="form-control"
                       placeholder="e.g. classic, american dream, 1920s" />
                <div class="form-hint">Comma-separated keywords for easier search.</div>
              </div>

              <!-- Description -->
              <div class="form-group span-2">
                <label class="form-label" for="description">Book Description / Synopsis</label>
                <textarea id="description" name="description" class="form-control" placeholder="Write a brief synopsis or description of the book…"></textarea>
              </div>

            </div>
          </div>
        </div>

        <!-- Section 2: Publishing Details -->
        <div class="section-card">
          <div class="section-header">
            <div class="section-header-left">
              <div class="section-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
              </div>
              <div>
                <div class="section-title">Publishing Details</div>
                <div class="section-subtitle">Publisher and edition information</div>
              </div>
            </div>
            <span class="badge badge-new">Step 2</span>
          </div>
          <div class="section-body">
            <div class="form-grid cols-3">

              <!-- Publisher -->
              <div class="form-group">
                <label class="form-label" for="publisher">Publisher</label>
                <input type="text"
                       id="publisher"
                       name="publisher"
                       class="form-control"
                       placeholder="e.g. Penguin Books" />
              </div>

              <!-- Year -->
              <div class="form-group">
                <label class="form-label" for="year">
                  Publication Year <span class="required">*</span>
                </label>
                <input type="number"
                       id="year"
                       name="year"
                       class="form-control"
                       placeholder="e.g. 2024"
                       min="1000"
                       max="2026"
                       required />
              </div>

              <!-- Edition -->
              <div class="form-group">
                <label class="form-label" for="edition">Edition</label>
                <input type="text"
                       id="edition"
                       name="edition"
                       class="form-control"
                       placeholder="e.g. 3rd Edition" />
              </div>

              <!-- Language -->
              <div class="form-group">
                <label class="form-label" for="language">Language</label>
                <select id="language" name="language" class="form-control">
                  <option value="english" selected>English</option>
                  <option value="filipino">Filipino</option>
                  <option value="spanish">Spanish</option>
                  <option value="french">French</option>
                  <option value="german">German</option>
                  <option value="japanese">Japanese</option>
                  <option value="chinese">Chinese</option>
                  <option value="arabic">Arabic</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <!-- Pages -->
              <div class="form-group">
                <label class="form-label" for="pages">Number of Pages</label>
                <input type="number"
                       id="pages"
                       name="pages"
                       class="form-control"
                       placeholder="e.g. 320"
                       min="1" />
              </div>

              <!-- Price -->
              <div class="form-group">
                <label class="form-label" for="price">Acquisition Price</label>
                <div class="input-group">
                  <span class="input-prefix">₱</span>
                  <input type="number"
                         id="price"
                         name="price"
                         class="form-control"
                         placeholder="0.00"
                         step="0.01"
                         min="0" />
                </div>
              </div>

              <!-- Location / Shelf -->
              <div class="form-group">
                <label class="form-label" for="shelf">Shelf / Location</label>
                <input type="text"
                       id="shelf"
                       name="shelf"
                       class="form-control"
                       placeholder="e.g. Shelf A-3, Row 2" />
                <div class="form-hint">Physical location in the library.</div>
              </div>

              <!-- Call Number -->
              <div class="form-group">
                <label class="form-label" for="call_number">Call Number (DDC)</label>
                <input type="text"
                       id="call_number"
                       name="call_number"
                       class="form-control"
                       placeholder="e.g. 813.52" />
                <div class="form-hint">Dewey Decimal Classification number.</div>
              </div>

              <!-- Accession Number -->
              <div class="form-group">
                <label class="form-label" for="accession">Accession Number</label>
                <input type="text"
                       id="accession"
                       name="accession"
                       class="form-control"
                       placeholder="e.g. ACC-2026-0001" />
              </div>

            </div>
          </div>
        </div>

        <!-- Section 3: Availability & Copies -->
        <div class="section-card">
          <div class="section-header">
            <div class="section-header-left">
              <div class="section-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
              </div>
              <div>
                <div class="section-title">Availability & Copies</div>
                <div class="section-subtitle">Set stock and lending rules</div>
              </div>
            </div>
            <span class="badge badge-new">Step 3</span>
          </div>
          <div class="section-body">
            <div class="form-grid cols-3">

              <!-- Total Copies -->
              <div class="form-group">
                <label class="form-label" for="total_copies">
                  Total Copies <span class="required">*</span>
                </label>
                <input type="number"
                       id="total_copies"
                       name="total_copies"
                       class="form-control"
                       value="1"
                       min="1"
                       max="9999"
                       required />
              </div>

              <!-- Available Copies -->
              <div class="form-group">
                <label class="form-label" for="available_copies">
                  Available Copies <span class="required">*</span>
                </label>
                <input type="number"
                       id="available_copies"
                       name="available_copies"
                       class="form-control"
                       value="1"
                       min="0"
                       max="9999"
                       required />
              </div>

              <!-- Loan Period -->
              <div class="form-group">
                <label class="form-label" for="loan_days">Loan Period (Days)</label>
                <div class="input-group">
                  <input type="number"
                         id="loan_days"
                         name="loan_days"
                         class="form-control"
                         value="14"
                         min="1"
                         max="365" />
                  <span class="input-suffix">days</span>
                </div>
              </div>

              <!-- Status -->
              <div class="form-group span-3">
                <label class="form-label">Book Status</label>
                <div class="check-group">
                  <label class="check-item">
                    <input type="radio" name="status" value="available" checked />
                    <span class="check-box"></span>
                    Available
                  </label>
                  <label class="check-item">
                    <input type="radio" name="status" value="reserved" />
                    <span class="check-box"></span>
                    Reserved
                  </label>
                  <label class="check-item">
                    <input type="radio" name="status" value="borrowed" />
                    <span class="check-box"></span>
                    Borrowed
                  </label>
                  <label class="check-item">
                    <input type="radio" name="status" value="maintenance" />
                    <span class="check-box"></span>
                    Under Maintenance
                  </label>
                  <label class="check-item">
                    <input type="radio" name="status" value="lost" />
                    <span class="check-box"></span>
                    Lost
                  </label>
                </div>
              </div>

              <!-- Can Be Borrowed? -->
              <div class="form-group">
                <label class="form-label">Borrowable</label>
                <div class="check-group">
                  <label class="check-item">
                    <input type="radio" name="borrowable" value="1" checked />
                    <span class="check-box"></span>
                    Yes – Can be borrowed
                  </label>
                  <label class="check-item">
                    <input type="radio" name="borrowable" value="0" />
                    <span class="check-box"></span>
                    No – Reference only
                  </label>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Section 4: Cover Image -->
        <div class="section-card">
          <div class="section-header">
            <div class="section-header-left">
              <div class="section-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              </div>
              <div>
                <div class="section-title">Cover Image</div>
                <div class="section-subtitle">Upload a book cover photo (optional)</div>
              </div>
            </div>
          </div>
          <div class="section-body">
            <div class="form-grid cols-2">

              <div class="form-group">
                <label class="form-label" for="cover_image">Upload Cover Image</label>
                <div class="file-upload" id="fileDropZone" onclick="document.getElementById('cover_image').click()">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                  <p>Drag &amp; drop image here, or <span>browse file</span></p>
                  <p style="font-size:0.74rem;margin-top:4px;">PNG, JPG, WEBP up to 2MB</p>
                </div>
                <input type="file"
                       id="cover_image"
                       name="cover_image"
                       accept="image/png,image/jpeg,image/webp"
                       style="display:none;"
                       onchange="previewCover(event)" />
              </div>

              <div class="form-group" id="coverPreviewGroup" style="display:none;">
                <label class="form-label">Preview</label>
                <div style="display:flex;align-items:flex-start;gap:16px;">
                  <img id="coverPreview"
                       src=""
                       alt="Cover Preview"
                       style="width:100px;height:140px;object-fit:cover;border-radius:6px;border:1.5px solid var(--border);box-shadow:var(--shadow-sm);" />
                  <div style="flex:1;">
                    <div id="coverFileName" style="font-size:0.83rem;color:var(--text);font-weight:500;margin-bottom:6px;"></div>
                    <button type="button" class="btn btn-outline btn-sm" onclick="removeCover()">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                      Remove
                    </button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Additional Notes -->
        <div class="section-card">
          <div class="section-header">
            <div class="section-header-left">
              <div class="section-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </div>
              <div class="section-title">Additional Notes</div>
            </div>
          </div>
          <div class="section-body">
            <div class="form-group">
              <label class="form-label" for="notes">Internal Notes</label>
              <textarea id="notes" name="notes" class="form-control" placeholder="Any additional notes for library staff…" style="min-height:80px;"></textarea>
              <div class="form-hint">These notes are for internal use only and will not be visible to members.</div>
            </div>
          </div>
        </div>

        <!-- Action Bar -->
        <div class="section-card" style="padding:0;">
          <div style="padding:20px 26px;" class="form-actions">
            <button type="button" class="btn btn-outline" onclick="resetForm()">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-5.09"/></svg>
              Reset Form
            </button>
            <button type="button" class="btn btn-outline" onclick="saveDraft()">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Save as Draft
            </button>
            <button type="submit" class="btn btn-accent btn-lg" id="submitBtn">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              Save Book to Catalog
            </button>
          </div>
        </div>

      </form>

    </main>
  </div>

  <div class="toast-container" id="toastContainer"></div>

  <script src="assets/js/app.js"></script>
</body>
</html>
