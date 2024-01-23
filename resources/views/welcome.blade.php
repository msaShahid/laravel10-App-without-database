<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    </head>
    <body class="antialiased">
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <a href="{{ url('#') }}" class="btn btn-dark btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addRecordModal">New Add Record</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Name</th>
                              <th scope="col">Image</th>
                              <th scope="col">Address</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>Shahid</td>
                              <td>test.png</td>
                              <td>@Kolkata</td>
                              <td>Male</td>
                              <td>
                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editRecordModal" href="#">Edit</a>
                                <a class="btn btn-danger btn-sm" href="#">Delete</a>
                                <a class="btn btn-secondary btn-sm" href="#">View</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
      </div>

      <!-- Add Model -->
      
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addRecordModalLabel">Create New Record</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-1">
            <label for="empName" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="empName" id="empName">
          </div>
          <div class="mb-1">
            <label for="empImage" class="col-form-label">Image:</label>
            <input type="file" class="form-control" name="empImage" id="empImage">
          </div>
          <div class="mb-1">
            <label for="empAddress" class="col-form-label">Address:</label>
            <input type="text" class="form-control" name="empAddress" id="empAddress">
          </div>
          <div class="mb-1">
            <label class="col-form-label">Select Gender:</label>
            <select class="form-select">
              <option selected>-- Select --</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>
      <!-- End Add Model -->

            <!-- Add Model -->
      
<div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editRecordModalLabel">Update Record</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-1">
            <label for="empName" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="empName" id="empName">
          </div>
          <div class="mb-1">
            <label for="empImage" class="col-form-label">Image:</label>
            <input type="file" class="form-control" name="empImage" id="empImage">
          </div>
          <div class="mb-1">
            <label for="empAddress" class="col-form-label">Address:</label>
            <input type="text" class="form-control" name="empAddress" id="empAddress">
          </div>
          <div class="mb-1">
            <label class="col-form-label">Select Gender:</label>
            <select class="form-select">
              <option selected>-- Select --</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>
      <!-- End Add Model -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
