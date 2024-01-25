<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
  
        </head>
    @php
    session_start();

    @endphp
    <body class="antialiased">
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

            <div id="success_message"></div>

                <div class="card">
                    <div class="card-header">
                    <h4>
                        Add New Data
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#AddModal">Add Employee</button>
                    </h4>
                    </div>
                  <div class="card-body">
                    <table id="employeeTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div>

                </div>
            </div>
        </div>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<!-- Add Model -->
<!-- =============================================== -->
<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalLabel">Add New Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="employeeForm" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <ul id="save_msgList"></ul>

                  <div class="form-group mb-3">
                      <label for="">Full Name</label>
                      <input type="text" required name="name" class="name form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Image</label>
                      <input type="file" name="image" class="image form-control">
                  </div>
                  <div class="form-group mb-3">
                      <label for="">Address</label>
                      <input type="text" required name="address" class="address form-control">
                  </div>
                  <div class="mb-1">
                      <label class="col-form-label">Select Gender:</label>
                      <select class="form-select gender" name="gender" id="gender" required>
                          <option>-- Select --</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                      </select>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary  add_emp_session">Save</button>
          </div>

        </div>
    </div>
</div>
<!-- End Add Model -->

<!-- Edit Model -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit & Update Employee Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="updateEmployeeForm" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                    <ul id="update_msgList"></ul>

                    <input type="hidden" id="empID" />

                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <input type="text" id="name" name="name" required class="form-control name">
                    </div>
                    <div class="form-group mb-3 row">
                        <div class="col-6">
                            <label for="">Image</label>
                            <input type="file" id="image" name="image" required class="form-control image">
                        </div>
                        <div class="col-6">
                            <img id="image-preview"  style="height: 100px; width: 100px;">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Address</label>
                        <input type="text" id="address" name="address" required class="form-control address">
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Select Gender:</label>
                        <select class="form-select gender" name="gender" id="gender" required>
                            <option>-- Select --</option>
                            <option value="male" >Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update_emp_session">Update</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- End Edit Model -->

<!-- Delete Model -->

<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Confirm to Delete Data ?</h4>
                <input type="hidden" id="empID">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete_emp_session">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- End Delete Model -->

<script>
  $(document).ready(function () {

    var table = $('#employeeTable').dataTable();

      $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* Display data into Datatable */ 
        fetchemployee();

        function fetchemployee() {
            $.ajax({
                type: "GET",
                url: "/fetch-emp",
                dataType: "json",
                success: function (response) {

                    $('#employeeTable').DataTable().clear().destroy();

                    $('tbody').html("");
                    $.each(response.data, function (key, item) {
                        $('tbody').append(
                        `<tr>
                            <td>${key+1}</td>
                            <td>${item.name}</td>
                            <td><img src="${item.image_path}" alt="Image" style="width: 50px; height: 50px;"></td>
                            <td>${item.address}</td>
                            <td>${item.gender}</td>
                            <td>
                                <a value="${key}" class="btn btn-primary editbtn btn-sm">Edit</a>
                                <a value="${key}" class="btn btn-danger deletebtn btn-sm">Delete</a>
                                <a value="${key}" class="btn btn-success viewbtn btn-sm">View</a>
                            </td>
                        </tr>`
                        );
                    });

                    $('#employeeTable').DataTable();
                }
            });
        }


        /* End Display data into DataTable */

    /* Insert data into Session */
    $(document).on('click', '.add_emp_session', function (e) {

        e.preventDefault();
        var formData = new FormData($('#employeeForm')[0]);

        var requiredFields = ['name','image','address', 'gender'];

        for (var i = 0; i < requiredFields.length; i++) {
            var fieldName = requiredFields[i];
            if (!formData.has(fieldName) || !formData.get(fieldName)) {
                alert('Please enter a ' + fieldName + '. Its required !'); return;
            }
        }
  
        $.ajax({
            type: 'POST',
            url: '/employee',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                  if (response.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_value) {
                        $('#save_msgList').append(`<li> ${err_value}</li>`);
                    });
                } else {
                    $('#save_msgList').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#AddModal').find('input').val('');
                    $('#AddModal').modal('hide');
                    fetchemployee();
                }
            },  
        });
        $('.btn-close').find('input').val('');
    });
    /* End Insert data into Session */

    /* Show Data for Edit */
    $(document).on('click', '.editbtn', function (e) {
            e.preventDefault();
            var empID = $(this).attr('value');
             $('#editModal').modal('show');
             $.ajax({
                 type: "GET",
                 url: "/edit-emp?empID="+empID,
                 dataType: "json",
                 success: function (response) {
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                        $('#editModal').modal('hide');
                    } else {
                        $('#empID').val(response.empID);
                        $('#name').val(response.data.name);
                        var imageUrl = response.data.image_path;
                        $('#image-preview').attr('src', imageUrl);
                        $('#address').val(response.data.address);
                        var genderValue = response.data.gender;
                        $('#gender').val(genderValue);
                        $('#gender option[value="' + genderValue + '"]').prop('selected', true);
                    }
                 }
             });
             $('.btn-close').find('input').val('');

        });
  });

  /* End Show Data for Edit */

  /* Update Data */
  $(document).on('click', '.update_emp_session', function (e) {
            e.preventDefault();

            var data = {
                'empID': $('#empID').val(),
                'name': $('#name').val(),
                'address': $('#address').val(),
                'gender': $('#gender').val(),
            }

            $.ajax({
                type: "PUT",
                url: "/update-emp",
                data: data,
                dataType: "json",
                cache: false,
                success: function (response) {
                    if (response.status == 400) {
                        $('#update_msgList').html("");
                        $('#update_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#update_msgList').append(`<li> ${err_value} </li>`);
                        });
                    } else {
                        $('#update_msgList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').find('input').val('');
                        $('#editModal').modal('hide');
                        fetchemployee();
                    } 
                    
                }
            }); 

        });

  /* End Update Data */

  /* Delete Data */

        $(document).on('click', '.deletebtn', function () {
            var empID = $(this).attr('value');
            $('#DeleteModal').modal('show');
            $('#empID').val(empID);
        });

        $(document).on('click', '.delete_emp_session', function (e) {
            e.preventDefault();

            var empID = $('#empID').val();
            alert(empID);

            $.ajax({
                type: "DELETE",
                url: "/delete-emp?empID=" +empID ,
                dataType: "json",
                success: function (response) {
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                    } else {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteModal').modal('hide');
                        fetchstudent();
                    } 
                }
            });
        });

  /* Delete Data */





 




</script>
    </body>
</html>
