@extends('layouts.main')

@section('content')

<div class="header {{ env('BG','bg-primary') }} pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Students</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ url('/students') }}">Student Records</a></li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addUserModal">
            <i class="fas fa-plus"></i> New Student
          </button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  
  <div class="col">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
      </div>
      <!-- Light table -->
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Age</th>
              <th scope="col">Gender</th>
              <th scope="col">Parent Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach($students as $st)
            <tr>
              <td>{{ $st->name }}</td>
              <td>{{ $st->age }}</td>
              <td>{{ $st->gender }}</td>
              <td>{{ $st->parent->name }}</td>
              <td>
                <div class="dropdown show">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-160px, 40px, 0px);" x-placement="bottom-end">
                    <a class="dropdown-item editUser" 
                        data-id="{{ $st->id }}" 
                        data-name="{{ $st->name }}" 
                        data-gender="{{ $st->gender }}" 
                        data-age="{{ $st->age }}" 
                        data-parent="{{ $st->parent->id }}"
                        data-toggle="modal" 
                        data-target="#editUserModal" 
                        href="#">Edit</a>
                    <a class="dropdown-item removeUser"
                        data-id="{{ $st->id }}" 
                        data-name="{{ $st->name }}" 
                        data-toggle="modal" 
                        data-target="#removeUserModal" 
                        href="#">Remove</a>
                    <a class="dropdown-item messageUser"
                        data-id="{{ $st->id }}" 
                        data-name="{{ $st->name }}" 
                        data-parent="{{ $st->parent_id }}" 
                        data-toggle="modal" 
                        data-target="#messageUserModal"  
                        href="#">Message</a>    
                  </div>
                </div>
                        
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- Card footer -->
      
    </div>
  </div>


  <!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('/students') }}" method="POST">
          @csrf
          <input type="text" name="name" class="form-control" placeholder="Name">
          <br>
          <input type="text" name="age" class="form-control" placeholder="Age">
          <br>
          <select name="gender" class="form-control">
            <option value=""></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <br>
          <select name="parent_id" class="form-control">
            <option value="">Select parent</option>
            @foreach($parents as $p)
              <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- Modal -->
<div class="modal fade" id="messageUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-body">

        <h5 class="modal-title" id="exampleModalLabel">Message Student</h5><br>
        @if($errors->any())
        <p class="badge badge-success">{{ $errors->first() }}</p>
        @endif

        <form action="{{ url('/feedback') }}" method="POST">
          @csrf
          <input type="hidden" name="student_id" id="mstud" value="">
          <input type="hidden" name="parent_id" id="mpar" value="">
          <input type="text" name="subject" class="form-control" placeholder="Subject" required>
          <br>
          <textarea name="content" class="form-control" rows="3" required></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('/students') }}" method="POST" id="editForm">
          @csrf
          @method('PUT')
          <input type="text" name="name" class="form-control" placeholder="Name" id="uname">
          <br>
          <input type="text" name="age" class="form-control" placeholder="Age" id="uage">
          <br>
          <select name="gender" id="ugender" class="form-control">
            <option value=""></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <br>
          <select name="parent_id" class="form-control" id="uparent">
            <option value="">Select parent</option>
            @foreach($parents as $p)
              <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
          </select>
          <input type="hidden" name="id" id="uid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('/students') }}" method="POST" id="removeForm">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id" id="rid">
          <span>Remove student <span id="user_name"></span></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Remove</button>
        </form>
      </div>
    </div>
  </div>
</div>
      
</div>


@if($errors->any())
  <script>
    $('#messageUserModal').modal('show');
  </script>
@endif

<script>
  $('.editUser').click(function(){

    var url = '{{ url("/students") }}';
    var id = $(this).data('id');
    var name = $(this).data('name');
    var age = $(this).data('age');
    var gender = $(this).data('gender');
    var parent = $(this).data('parent');

    $('#editForm').attr('action', url + '/' + id);

    $('#uid').val(id);
    $('#uname').val(name);
    $('#uage').val(age);
    $('#ugender').val(gender);
    $('#uparent').val(parent);
  });

  $('.messageUser').click(function(){

    var id = $(this).data('id');
    var parent = $(this).data('parent');

    $('#mstud').val(id);
    $('#mpar').val(parent);
  });

  $('.removeUser').click(function(){

    var url = '{{ url("/student") }}';
    var id = $(this).data('id');
    var name = $(this).data('name');

    $('#removeForm').attr('action', url + '/' + id);

    $('#rid').val(id);
    $('#user_name').html(name);
  });
</script>

@stop