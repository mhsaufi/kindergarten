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
              <li class="breadcrumb-item"><a href="{{ url('/logbook') }}">Logbook Records</a></li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          @hasrole('teacher')
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i> New Logbook
          </button>
          @endhasrole
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
              <th scope="col">Logbook Date</th>
              <th scope="col">Student</th>
              @hasrole('parent')
              <th>Teacher</th>
              <th>Contact No</th>
              @endhasrole
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach($logbooks as $logbook)
              <tr>
                <td>{{ $logbook->id }}</td>
                <td>{{ $logbook->date }}</td>
                <td>{{ $logbook->student->name }}</td>
                @hasrole('parent')
                <th>{{ $logbook->teacher->name }}</th>
                <th>{{ $logbook->teacher->phone }}</th>
                @endhasrole
                <td>
                  <a href="{{ url('logbook/'.$logbook->id) }}" role="button"><i class="fas fa-search mr-4"></i></a>
                  @hasrole('teacher')
                  <a href="" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-trash-alt text-danger"></i></a>
                  @endhasrole
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- Card footer -->
      
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-top" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">New Logbook Form</h5> 
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                  <span aria-hidden="true">&times;</span> 
                </button>
             </div>
             <div class="modal-body">
                <form action="{{ url('logbook') }}" method="POST">
                  @csrf
                 <div id="smartwizard">
                     <ul>
                         <li><a href="#step-1">Step 1<br /><small>Basic Info</small></a></li>
                         <li><a href="#step-2">Step 2<br /><small>Health Info</small></a></li>
                         <li><a href="#step-3">Step 3<br /><small>Meal Info</small></a></li>
                         <li><a href="#step-4">Step 4<br /><small>Activity Info</small></a></li>
                         <li><a href="#step-5">Step 4<br /><small>Hygiene Info</small></a></li>
                         <li><a href="#step-6">Step 5<br /><small>Additional Notes</small></a></li>
                     </ul>
                     <div class="mt-4">
                         <div id="step-1">
                             <div class="row">
                                 <div class="col-md-12">
                                      <p><b>Student name : </b></p> 
                                      <select name="id" class="form-control">
                                        <option value="">Select student</option>
                                        @if($students != '')
                                          @foreach($students as $student)
                                          <option value="{{ $student->id }}">{{ $student->name }}</option>
                                          @endforeach
                                        @endif
                                      </select>
                                      <br>
                                  </div>
                             </div>
                             <div class="row">
                                <div class="col-md-6"> 
                                  <p><b>Arrival date : </b></p>
                                  <input type="date" class="form-control" name="date" required> 
                                </div>
                                <div class="col-md-6"> 
                                  <p><b>Arrival time : </b></p>
                                  <input type="time" class="form-control" name="time" required> 
                                </div>
                             </div>
                             <div class="row mt-3">
                              <div class="col-md-12"> 
                                  <p><b>Send by : </b></p>
                                  <div class="radio">
                                    <label><input type="radio" name="sender" value="Parent" checked> Parent</label>
                                  </div>
                                  <div class="radio">
                                    <label><input type="radio" name="sender" value="Family Member"> Family Member</label>
                                  </div>
                                  <div class="radio">
                                    <label><input type="radio" name="sender" value="Caretaker"> Caretaker</label>
                                  </div> 
                                  <div class="radio">
                                    <label><input type="radio" name="sender" value="Others"> Others</label>
                                  </div> 
                              </div>
                             </div>
                         </div>
                         <div id="step-2">
                             <div class="row">
                                <div class="col-md-6"> 
                                  <p>Is your child healthy?</p>
                                  <div class="radio">
                                    <label><input type="radio" name="is_healthy" value="yes" checked> Yes</label>
                                  </div>
                                  <div class="radio">
                                    <label><input type="radio" name="is_healthy" value="no"> No</label>
                                  </div>
                                </div>
                                <div class="col-md-6"> 
                                  <p>If no, check related</p>
                                   <div class="checkbox">
                                    <label><input type="checkbox" name="illness[]" value="Cough"> Cough</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="illness[]" value="Fever"> Fever</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="illness[]" value="Flu"> Flu</label>
                                  </div> 
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="illness[]" value="Others"> Others</label>
                                  </div> 
                                </div>
                             </div>
                             <div class="row mt-3">
                                <div class="col-md-12"> 
                                  <p>Senarai Barangan yang dibawa</p>
                                  <textarea name="equipment" class="form-control" rows="3"></textarea>
                                </div>
                             </div>
                             <div class="row mt-3">
                                <div class="col-md-12"> 
                                  <p>Senarai Ubatan yang dibawa</p>
                                  <textarea name="medicine" class="form-control" rows="3"></textarea>
                                </div>
                             </div>
                         </div>
                         <div id="step-3" class="">
                             <div class="row">
                                <div class="col-md-6"> 
                                  <p>Milk (first take and second take): </p>
                                  <input type="time" name="milk_1" class="form-control">
                                </div>
                                <div class="col-md-6"> 
                                  <p style="opacity: 0;">Milk 2</p>
                                  <input type="time" name="milk_2" class="form-control">
                                </div>
                             </div>
                             <div class="row mt-3">
                                <div class="col-md-4"> 
                                  <p>Breakfast : </p>
                                  <input type="text" class="form-control" name="breakfast"> 
                                </div>
                                <div class="col-md-4"> 
                                  <p>Lunch : </p>
                                  <input type="text" class="form-control" name="lunch"> 
                                </div>
                                <div class="col-md-4"> 
                                  <p>Tea-time : </p>
                                  <input type="text" class="form-control" name="teatime"> 
                                </div>
                             </div>
                         </div>
                         <div id="step-4">
                             <div class="row">
                                <div class="col-md-12"> 
                                  <p>Circle time : </p>
                                  <input type="text" name="circle_time" class="form-control">
                                </div>
                             </div>
                             <div class="row mt-3">
                                <div class="col-md-12"> 
                                  <p>Outdoor</p>
                                  <input type="text" name="outdoor" class="form-control">
                                </div>
                             </div>
                         </div>

                         <div id="step-5">
                             <div class="row">
                                <div class="col-md-3"> 
                                  <p>Dypers : </p>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="dypers[]" value="9-12"> 9 - 12 Noon</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="dypers[]" value="12-3"> 12 - 3 Noon</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="dypers[]" value="3-6"> 3 - 6 Evening</label>
                                  </div> 
                                </div>
                                <div class="col-md-6"> 
                                  <p>Additional info (regarding dypers) :</p>
                                  <textarea name="dypers_info" rows="3" class="form-control"></textarea>
                                </div>
                             </div>
                             <div class="row mt-3">
                                <div class="col-md-4"> 
                                  <p>Brush Teeth</p>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="brush_teeth[]" value="morning"> Morning</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="brush_teeth[]" value="noon"> Noon</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="brush_teeth[]" value="evening"> Evening</label>
                                  </div> 
                                </div>
                                <div class="col-md-4"> 
                                  <p>Bath : </p>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="bath[]" value="morning"> Morning</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="bath[]" value="evening"> Evening</label>
                                  </div> 
                                </div>

                                <div class="col-md-4"> 
                                  <p>Sleep : </p>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="sleep[]" value="9-12"> 9 - 12 Noon</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="sleep[]" value="12-3"> 12 - 3 Noon</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="checkbox" name="sleep[]" value="3-6"> 3 - 6 Evening</label>
                                  </div> 
                                </div>
                             </div>
                         </div>
                         <div id="step-6" class="">
                             <div class="row">
                                <div class="col-md-12"> 
                                  <p>Additional notes :</p>
                                  <textarea name="additional_note" rows="3" class="form-control"></textarea><br>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-md-12">
                                  <button type="submit" class="btn btn-success btn-lg btn-block">Add Logbook</button>
                                </div>
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

<script>
  $(document).ready(function(){

    $('#smartwizard').smartWizard({
      selected: 0,
      theme: 'arrows',
      autoAdjustHeight:true,
      transitionEffect:'fade',
      showStepURLhash: false,

    });
  });
</script>

@stop