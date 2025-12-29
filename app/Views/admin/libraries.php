  <main id="main" class="main">

      <div class="pagetitle d-flex justify-content-between align-items-center">
          <h1>Libraries</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                  <li class="breadcrumb-item">Libraries List</li>
              </ol>
          </nav>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
              Library
          </button>
      </div><!-- End Page Title -->


      <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">
                          <!-- Table with stripped rows -->
                          <table class="table datatable">
                              <thead>
                                  <tr>
                                      <th>
                                          <b>N</b>ame
                                      </th>
                                      <th>Ext.</th>
                                      <th>City</th>
                                      <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                      <th>Completion</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

                      </div>
                  </div>

              </div>
          </div>

          <div class="modal fade" id="largeModal" tabindex="-1">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Create new Library</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form class="row g-3">
                              <div class="col-6">
                                  <label for="name" class="form-label">Your Name</label>
                                  <input type="text" class="form-control" id="name">
                              </div>
                              <div class="col-6">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email">
                              </div>
                              <div class="col-4">
                                  <label for="phone" class="form-label">Phone NO</label>
                                  <input type="number" maxlength="10" pattern="[0-9]{10}" class="form-control" id="phone">
                              </div>
                              <div class="col-4">
                                  <label for="registeredNo" class="form-label">Registered No</label>
                                  <input type="text" class="form-control" id="registeredNo">
                              </div>
                              <div class="col-4">
                                  <label for="inputState" class="form-label">Type</label>
                                  <select id="inputState" class="form-select">
                                      <option selected="">Choose...</option>
                                      <option value="SCHOOL">School</option>
                                      <option value="COLLAGE">Collage</option>
                                      <option value="INDEPENDENT">Independent</option>
                                  </select>
                              </div>
                              <div class="col-12">
                                  <label for="address" class="form-label">Address</label>
                                  <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button onclick="checkToast()" type="button" class="btn btn-primary">Save</button>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </main>
  <script>
      function checkToast() {
          let message = "This is success message";
          console.log("Toast Message:", message);
          notificationMessage(message, "error");
      }
  </script>