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
  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    </head>
    @php
    session_start();
    @endphp
    <body class="antialiased">
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <div class="card-header">
                        <h3>
                            <a href="{{ url('#') }}" class="btn btn-dark btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addRecordModal">New Add Record</a>
                        </h3>
                    </div>
                    <div class="card-body">

                     <table id="tableList" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Image</th>
                              <th scope="col">Address</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                        @if(isset($empData))
                          @foreach ($empData as $epm)
                            <tr>
                                <td>{{ $epm['empName'] }}</td>
                                <td>{{ $epm['empImage'] }}</td>
                                <td>{{ $epm['empAddress']  }}</td>
                                <td>{{ $epm['empGender'] }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editRecordModal" href="#">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="#">Delete</a>
                                    <a class="btn btn-secondary btn-sm" href="#">View</a>
                                </td>
                            </tr> 
                          @endforeach
                        @else
                            <p>No data available in session.</p>
                        @endif
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
        <form action="#" method="POST" id="saveModel" enctype="multipart/form-data">@csrf
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
            <select class="form-select" id="empGender">
              <option selected>-- Select --</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button  class="btn btn-success" id="saveButton">Save</button>
      </div>
    </div>
  </div>
</div>
      <!-- End Add Model -->

<script>
  $(document).ready(function () {


$("#tableList").DataTable({
    paging: true,
    pagingType: "full_numbers",
    lengthMenu: [[10, 50], [10, 50]],
    autoWidth: true,
    columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
    }],
});

    $('#saveButton').click(function () {

      var empName = $('#empName').val();
      var empImage = $('#empImage').val();
      var empAddress = $('#empAddress').val();
      var empGender = $('#empGender').val();

      $.ajax({
        url: '/session-save',
        method: 'POST',
        data: {
          empName: empName,
          empImage: empImage,
          empAddress: empAddress,
          empGender: empGender,
          _token: $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: 'JSON',
        success: function (response) {
          $('#addRecordModal').modal('hide');
          if (response.status == true) {
              alert(response.message);
              window.location.reload();
          }
          //console.log('Data saved to session:', response);
        },
        error: function (error) {
          console.error('Error saving data to session:', error);
        }
      });
    });
  });
</script>



    </body>
</html>
