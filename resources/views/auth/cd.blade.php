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
              <li class="breadcrumb-item">Change Password</li>
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
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Change Password </h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('reset') }}" method="POST">
            @CSRF
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">Current Password</label>
                    <input name="pwd" type="password" id="pwd" class="form-control" placeholder="Current Password" value="{{ old('pwd') }}" required>
                  </div>
                </div>
                <div class="col-lg-6 text-center">
                  <br>

                    @if($msg != '')
                      <h3 class="badge badge-success badge-xl">{{ $msg }}</h3><br>
                    @endif
                  
                    @error('pwd')
                      <h3 class="badge badge-danger badge-xl">Password does not match</h3><br>
                    @enderror
                    @error('newpwd')
                        <h3 class="badge badge-danger badge-xl">New Password is required</h3><br>
                    @enderror
                    @error('newpwd2')
                        <h3 class="badge badge-danger badge-xl">New password does not match</h3>
                    @enderror
                  </h3>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name">New Password</label>
                    <input type="password" name="newpwd" id="newpwd" class="form-control" placeholder="New Password" value="{{ old('newpwd') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-first-name">Re enter new password</label>
                    <input type="password" name="newpwd2" id="newpwd2" class="form-control" placeholder="Re enter password" value="{{ old('newpwd2') }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Change Password</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>


@stop