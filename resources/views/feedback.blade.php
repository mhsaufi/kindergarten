@extends('layouts.main')

@section('content')

<style type="text/css">
  #addLogbookMOdal {
    width: 100%;
  }

  .btn-rounded {
    border-radius: 40%;
  }

 .mt-200 {
     margin-top: 200px
 }

 .sw-theme-arrows > ul.step-anchor > li.active > a {
      border-color: #536dfe !important;
      color: #fff !important;
      background: #536dfe !important;
  }

  .sw-theme-arrows > ul.step-anchor > li.active > a::after {
      border-left: 30px solid #536dfe !important;
  }

  .sw-theme-arrows > ul.step-anchor > li.done > a {
      border-color: #8c9eff !important;
      color: #fff !important;
      background: #8c9eff !important;
  }

  .sw-theme-arrows > ul.step-anchor > li.done > a::after {
      border-left: 30px solid #8c9eff !important;
  }
</style>

<div class="header {{ env('BG','bg-primary') }} pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Students</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ url('/feedback') }}">Feedback</a></li>
            </ol>
          </nav>
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
        <table class="table table-hover align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Student</th>
              <th scope="col">Subject</th>
              @hasrole('parent')
              <th>Teacher</th>
              <th>Contact No</th>
              @endhasrole
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($feedbacks as $feed)
            <tr>
              <td>{{ $feed->id }}</td>
              <td>{{ $feed->student->name }}</td>
              <td>{{ $feed->subject }}</td>
              @hasrole('parent')
              <td>{{ $feed->teacher->name }}</td>
              <td>{{ $feed->teacher->phone }}</td>
              @endhasrole
              <td>
                <a class="dropdown-item editUser" 
                  data-subject="{{ $feed->subject }}" 
                  data-content="{{ $feed->content }}" 
                  data-teacher="{{ $feed->teacher->name }}"  
                  data-toggle="modal" 
                  data-target="#viewInboxModal" 
                  href="#"><i class="fas fa-search mr-4"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tbody class="list">
          </tbody>
        </table>
      </div>
      <!-- Card footer -->
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewInboxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <h5 class="modal-title" id="subject"></h5><br>
          <small class="text-muted">From</small> <p id="sender"></p>
          <hr class="my-4">
          <p id="content"></p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script>
    $('.editUser').click(function(){

      var subject = $(this).data('subject');
      var sender = $(this).data('teacher');
      var content = $(this).data('content');

      $('#subject').html(subject);
      $('#sender').html(sender);
      $('#content').html(content);
    });
</script>


@stop