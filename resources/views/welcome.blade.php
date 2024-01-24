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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Edit</th>
                                <th>Delete</th>
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

<script>
  $(document).ready(function () {

      $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* Display data into Datatable  '<td><img src="' + item.image_path + '" alt="Employee Image" style="width: 100px; height: auto;"></td>'
*/ 
        fetchstudent();
        function fetchstudent() {
            $.ajax({
                type: "GET",
                url: "/fetch-emp",
                dataType: "json",
                success: function (response) {
                     console.log(response.data['name']);
                    $('tbody').html("");
                    $.each(response.data, function (key, item) {
                        $('tbody').append('<tr>\
                            <td>' + key + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + item.image_path + '</td>\
                            <td>' + item.address + '</td>\
                            <td>' + item.gender + '</td>\
                            <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                            <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                        \</tr>');
                    });
                }
            });
        }


        /* End Display data into DataTable */

    /* Insert data into Session */
    $(document).on('click', '.add_emp_session', function (e) {
              e.preventDefault();
              var formData = new FormData($('#employeeForm')[0]);

        // Check if the required fields are present and not empty
        if (!formData.has('name') || !formData.get('name')) {
            alert('Please enter a name.');
            return;
        }
        if (!formData.has('image') || !formData.get('image')) {
            alert('Please enter a image.');
            return;
        }
        if (!formData.has('address') || !formData.get('address')) {
            alert('Please enter a address.');
            return;
        }
        if (!formData.has('gender') || !formData.get('gender')) {
            alert('Please enter a gender.');
            return;
        }
  

        $.ajax({
            type: 'POST',
            url: '/employee',
            data: formData,
            cache: false, // Set cache to false
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log('Employee and image saved to session successfully:', response);
                  if (response.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_value) {
                        $('#save_msgList').append('<li>' + err_value + '</li>');
                    });
                    $('.add_emp_session').text('Save');
                } else {
                    $('#save_msgList').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#AddModal').find('input').val('');
                    $('.add_emp_session').text('Save');
                    $('#AddModal').modal('hide');
                    fetchstudent();
                }
            },
            
        });
    });
    /* End Insert data into Session */



  });

  //   $(document).on('click', '.add_emp_session', function (e) {
  //           e.preventDefault();

  //           $(this).text('Sending..');

  //           var data = {
  //               'name': $('.name').val(),
  //               'image': $('.image').val(),
  //               'address': $('.address').val(),
  //               'gender': $('.gender').val(),
  //           }

  //           $.ajax({
  //               type: "POST",
  //               url: "/employee",
  //               data: data,
  //               success: function (response) {
  //                   // console.log(response);
  //                   if (response.status == 400) {
  //                       $('#save_msgList').html("");
  //                       $('#save_msgList').addClass('alert alert-danger');
  //                       $.each(response.errors, function (key, err_value) {
  //                           $('#save_msgList').append('<li>' + err_value + '</li>');
  //                       });
  //                       $('.add_emp_session').text('Save');
  //                   } else {
  //                       $('#save_msgList').html("");
  //                       $('#success_message').addClass('alert alert-success');
  //                       $('#success_message').text(response.message);
  //                       $('#AddModal').find('input').val('');
  //                       $('.add_emp_session').text('Save');
  //                       $('#AddModal').modal('hide');
  //                      // fetchstudent();
  //                   }
  //               }
  //           });

  //       });




 




</script>
    </body>
</html>
