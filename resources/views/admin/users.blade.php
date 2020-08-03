@extends('layouts.main')

@section('content')

<div class="header {{ env('BG','bg-primary') }} pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Users</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users Management</a></li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addUserModal">
            <i class="fas fa-plus"></i> New User
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
              <th scope="col">Email</th>
              <th scope="col">Contact No</th>
              <th scope="col">Roles</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach($users as $u)
            <tr>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>{{ $u->phone }}</td>
              <td>{{ $u->roles[0]->name }}</td>
              <td>
                <div class="dropdown show">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-160px, 40px, 0px);" x-placement="bottom-end">
                    <a class="dropdown-item editUser" 
                        data-id="{{ $u->id }}" 
                        data-name="{{ $u->name }}" 
                        data-email="{{ $u->email }}" 
                        data-phone="{{ $u->phone }}" 
                        data-role="{{ $u->roles[0]->id }}" 
                        data-toggle="modal" 
                        data-target="#editUserModal" 
                        href="#">Edit</a>
                    <a class="dropdown-item removeUser"
                        data-id="{{ $u->id }}" 
                        data-name="{{ $u->name }}" 
                        data-toggle="modal" 
                        data-target="#removeUserModal" 
                        href="#">Remove</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('/users') }}" method="POST">
          @csrf
          <input type="text" name="name" class="form-control" placeholder="Name">
          <br>
          <input type="text" name="email" class="form-control" placeholder="Email">
          <br>
          <input type="text" name="phone" class="form-control" placeholder="Phone">
          <br>
          <select name="role" class="form-control">
            <option value="">Select role</option>
            <option value="2">Teacher</option>
            <option value="3">Parent</option>
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
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('/users') }}" method="POST" id="editForm">
          @csrf
          @method('PUT')
          <input type="text" name="name" class="form-control" placeholder="Name" id="uname">
          <br>
          <input type="text" name="email" class="form-control" placeholder="Email" id="uemail">
          <br>
          <input type="text" name="phone" class="form-control" placeholder="Phone" id="uphone">
          <br>
          <select name="role" class="form-control" id="urole">
            <option value="">Select role</option>
            <option value="2">Teacher</option>
            <option value="3">Parent</option>
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
        <h5 class="modal-title" id="exampleModalLabel">Remove User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ url('/users') }}" method="POST" id="removeForm">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id" id="rid">
          <span>Remove user <span id="user_name"></span></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Remove</button>
        </form>
      </div>
    </div>
  </div>
</div>
      
  <!-- Footer -->
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center  text-lg-left  text-muted">
          &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</div>


<script>
  $('.editUser').click(function(){

    var url = '{{ url("/users") }}';
    var id = $(this).data('id');
    var name = $(this).data('name');
    var email = $(this).data('email');
    var phone = $(this).data('phone');
    var role = $(this).data('role');

    $('#editForm').attr('action', url + '/' + id);

    $('#uid').val(id);
    $('#uname').val(name);
    $('#uemail').val(email);
    $('#uphone').val(phone);
    $('#urole').val(role);
  });

  $('.removeUser').click(function(){

    var url = '{{ url("/users") }}';
    var id = $(this).data('id');
    var name = $(this).data('name');

    $('#removeForm').attr('action', url + '/' + id);

    $('#rid').val(id);
    $('#user_name').html(name);
  });
</script>

@stop