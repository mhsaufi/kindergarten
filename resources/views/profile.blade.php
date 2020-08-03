@extends('layouts.main')

@section('content')
<style>
  .cp a {
    color: #42a5f5;
  }
</style>

<div class="header {{ env('BG','bg-primary') }} pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Home</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ url('/profile') }}">Profile</a></li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- Card stats -->
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-xl-10 center order-xl-1 mt--6">
      <div class="card">
        <div class="card-header">
          <form action="{{ url('users/'.auth()->user()->id) }}" method="POST">
          <div class="row align-items-center">
            <div class="col-4">
              <h3 class="mb-0">Edit profile </h3>
            </div>
            <div class="col-4">
              @if($errors->any())
                <p class="badge badge-success">{{ $errors->first() }}</p>
              @endif
            </div>
            <div class="col-4 text-right">
              <button type="submit" class="btn btn-sm btn-success">Update</button>
            </div>
          </div>
        </div>
        <div class="card-body">
            <h6 class="heading-small text-muted mb-4">User information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                      @csrf
                      @method('PUT')
                    <label class="form-control-label" for="input-username">Username</label>
                    <input type="text" name="username" id="input-username" class="form-control" placeholder="Username" value="{{ auth()->user()->name }}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-email">Email address</label>
                    <input type="email" name="email" id="input-email" class="form-control" placeholder="jesse@example.com" value="{{ auth()->user()->email }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name">Fullname</label>
                    <input type="text" name="fullname" id="input-first-name" class="form-control" placeholder="Fullname" value="{{ auth()->user()->fullname }}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-last-name">Occupation</label>
                    <input type="text" name="occupation" id="input-last-name" class="form-control" placeholder="Occupation" value="{{ auth()->user()->occupation }}">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Contact information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="input-address">Address</label>
                    <textarea id="input-address" class="form-control" name="address">{{ auth()->user()->address }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="input-city">Phone</label>
                    <input type="text" id="input-city" name="phone" class="form-control" placeholder="City" value="{{ auth()->user()->phone }}">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
          </form>
          <div class="row">
            <div class="col-lg-3 col-md-12">
              <small class="cp"><a href="{{ url('change') }}">Change Password</a></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


@stop