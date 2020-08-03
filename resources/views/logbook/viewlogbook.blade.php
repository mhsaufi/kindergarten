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

  .thead-grass {
    background-color: #43a047;
    color: #fff;
  }

  .thead-pink {
    background-color: #ec407a;
    color: #fff;
  }
</style>

<div class="header {{ env('BG','bg-primary') }} pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-9 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Students</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ url('/logbook') }}">Logbook Records</a></li>
              <li class="breadcrumb-item">Logbook <span class="text-muted">{{ $logbook->student->name }} - {{ $logbook->date }}</span></li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-3 col-5 text-right">
          @hasrole('parent')
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-print"></i> Print Logbook
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
      <div class="card-body pt-0">

        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#info" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="far fa-smile-beam"></i> Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#health" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-heartbeat"></i> Health</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#meal" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-utensils"></i> Meal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-running"></i> Activity</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#hygiene" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-leaf"></i> Hygiene</a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                          <table class="table">
                            
                            <tbody>
                              <tr>
                                <td width="20%">
                                  @if($logbook->student->gender == 'male')
                                    <img src="{{ asset('image/boy.png') }}">
                                  @else
                                    <img src="{{ asset('image/girl.png') }}">
                                  @endif
                                </td>
                                <td class="align-middle"><h2>{{ $logbook->student->name }}</h2></td>
                              </tr>
                              <tr>
                                <td width="20%" class="align-middle">
                                  <h4>Arrived at</h4>
                                </td>
                                <td class="align-middle"><h4>{{ $logbook->time }}</h4></td>
                              </tr>
                              <tr>
                                <td width="20%" class="align-middle">
                                  <h4>Sent by</h4>
                                </td>
                                <td class="align-middle"><h4>{{ $logbook->sender }}</h4></td>
                              </tr>
                              <tr>
                                <td width="20%" class="align-middle">
                                  <h4>Additional info</h4>
                                </td>
                                <td class="align-middle"><h4>{{ $logbook->additional_note }}</h4></td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="tab-pane fade" id="health" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                      @if($logbook->is_healthy == 'yes')
                        <h1 class="badge badge-success badge-lg display-1">{{ $logbook->student->name }} is healthy</h1>
                      @else
                        <h1 class="badge badge-danger badge-lg display-1">{{ $logbook->student->name }} is not healthy</h1>
                      @endif

                      <p class="mt-3">{{ $logbook->student->name }} brings : </p>
                      <p><b>{{ $logbook->equipment }}</b></p>

                      <p class="mt-3">Medicine provided : </p>
                      <p><b>{{ $logbook->medicine }}</b></p>
                    </div>
                    <div class="tab-pane fade" id="meal" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                        <table class="table table-bordered mb-2">
                          <thead class="thead-pink">
                            <tr>
                              <th width="19%"></th>
                              <th width="40%">Milk 1</th>
                              <th width="40%">Milk 2</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="text-center">
                              <td width="19%"><img src="{{ asset('image/milk.png') }}"></td>
                              <td width="40%" class="align-middle">
                                <h1>{{ $logbook->milk_1 }}</h1>
                              </td>
                              <td width="40%" class="align-middle">
                                <h1>{{ $logbook->milk_2 }}</h1>
                              </td>
                              <!-- <td width="30%"></td> -->
                            </tr>
                          </tbody>
                        </table>
                        <table class="table table-bordered">
                          <thead class="thead-pink">
                            <tr>
                              <th width="19%"></th>
                              <th width="27%">Breakfast</th>
                              <th width="27%">Lunch</th>
                              <th width="27%">Tea-time</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="text-center">
                              <td><img src="{{ asset('image/meal.png') }}"></td>
                              <td class="align-middle"><h3>{{ $logbook->breakfast }}</h3></td>
                              <td class="align-middle"><h3>{{ $logbook->lunch }}</h3></td>
                              <td class="align-middle"><h3>{{ $logbook->teatime }}</h3></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                        <div class="row">
                          <table class="table table-bordered">
                            <thead class="thead-grass">
                              <tr>
                                <th width="40%">Outdoor</th>
                                <th width="40%">Circle-Time</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{ $logbook->outdoor }}</td>
                                <td>{{ $logbook->circle_time }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hygiene" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                        <table class="table table-bordered">
                          <thead class="thead-pink">
                            <tr>
                              <th width="20%"></th>
                              <th width="40%"></th>
                              <th width="40%"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="text-left">
                              <td><img src="{{ asset('image/diaper.png') }}"></td>
                              <td class="align-middle">
                                @if(in_array('9-12',json_decode($logbook->dypers)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> 9 am - 12 noon
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> 9 am - 12 noon
                                    </label>
                                </div>
                                @endif

                                @if(in_array('12-3',json_decode($logbook->dypers)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> 12 noon - 3 pm
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> 12 noon - 3 pm
                                    </label>
                                </div>
                                @endif

                                @if(in_array('3-6',json_decode($logbook->dypers)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> 3 pm - 6pm
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> 3 pm - 6pm
                                    </label>
                                </div>
                                @endif
                              </td>
                              <td>Diapers Info : <br>{{ $logbook->dypers_info }}</td>
                            </tr>
                            <tr class="text-left">
                              <td><img src="{{ asset('image/teeth.png') }}"></td>
                              <td class="align-middle" colspan="2">
                                @if(in_array('morning',json_decode($logbook->brush_teeth)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> Morning
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> Morning
                                    </label>
                                </div>
                                @endif

                                @if(in_array('noon',json_decode($logbook->brush_teeth)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> Noon
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> Noon
                                    </label>
                                </div>
                                @endif

                                @if(in_array('evening',json_decode($logbook->brush_teeth)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> Evening
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> Evening
                                    </label>
                                </div>
                                @endif
                              </td>
                            </tr>
                            <tr class="text-left">
                              <td><img src="{{ asset('image/bath.png') }}"></td>
                              <td class="align-middle" colspan="2">
                                @if(in_array('morning',json_decode($logbook->bath)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> Morning
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> Morning
                                    </label>
                                </div>
                                @endif

                                @if(in_array('noon',json_decode($logbook->bath)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> Noon
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> Noon
                                    </label>
                                </div>
                                @endif

                                @if(in_array('evening',json_decode($logbook->bath)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> Evening
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> Evening
                                    </label>
                                </div>
                                @endif
                              </td>
                            </tr>
                            <tr class="text-left">
                              <td><img src="{{ asset('image/sleeping.png') }}"></td>
                              <td class="align-middle" colspan="2">
                                @if(in_array('9-12',json_decode($logbook->sleep)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> 9 am - 12 noon
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> 9 am - 12 noon
                                    </label>
                                </div>
                                @endif

                                @if(in_array('12-3',json_decode($logbook->sleep)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> 12 noon - 3 pm
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> 12 noon - 3 pm
                                    </label>
                                </div>
                                @endif

                                @if(in_array('3-6',json_decode($logbook->sleep)))
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" checked disabled> 3 pm - 6pm
                                    </label>
                                </div>
                                @else
                                <div class="checkbox">
                                    <label style="font-size: 16px;">
                                      <input type="checkbox" disabled> 3 pm - 6pm
                                    </label>
                                </div>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


      </div>
    </div>
  </div>
      
</div>

@stop