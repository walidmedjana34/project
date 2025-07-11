@extends('layouts.user_type.auth')
 
@section('title') Virtual Reality  @endsection

@section('content')

  <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-7">
    <div class="container">
      <div class="row pt-10">
        <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-5 text-center">
          <a href="javascript:;" class="avatar avatar-md border-0" data-bs-toggle="tooltip" data-bs-placement="left" title="My Profile">
            <img class="border-radius-lg" alt="Image placeholder" src="../assets/img/team-1.jpg">
          </a>
          <button class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Home">
            <i class="fas fa-home p-2"></i>
          </button>
          <button class="btn btn-white border-radius-lg p-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Search">
            <i class="fas fa-search p-2"></i>
          </button>
          <button class="btn btn-white border-radius-lg p-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Minimize">
            <i class="fas fa-ellipsis-h p-2"></i>
          </button>
        </div>
        <div class="col-lg-8 col-md-11">
          <div class="d-flex">
            <div class="me-auto">
              <h1 class="display-1 font-weight-bold mt-n4 mb-0">28°C</h1>
              <h6 class="text-uppercase mb-0 ms-1">Cloudy</h6>
            </div>
            <div class="ms-auto">
              <img class="w-50 float-end mt-lg-n4" src="../assets/img/small-logos/icon-sun-cloud.png" alt="image sun">
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-4 col-md-4">
              <div class="card move-on-hover overflow-hidden">
                <div class="card-body">
                  <div class="d-flex">
                    <h6 class="mb-0 me-3">08:00</h6>
                    <h6 class="mb-0">Synk up with Mark
                      <small class="text-secondary font-weight-normal">Hangouts</small>
                    </h6>
                  </div>
                  <hr class="horizontal dark">
                  <div class="d-flex">
                    <h6 class="mb-0 me-3">09:30</h6>
                    <h6 class="mb-0">Gym <br />
                      <small class="text-secondary font-weight-normal">World Class</small>
                    </h6>
                  </div>
                  <hr class="horizontal dark">
                  <div class="d-flex">
                    <h6 class="mb-0 me-3">11:00</h6>
                    <h6 class="mb-0">Design Review<br />
                      <small class="text-secondary font-weight-normal">Zoom</small>
                    </h6>
                  </div>
                </div>
                <a href="javascript:;" class="bg-gray-100 w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                  <i class="fas fa-chevron-down text-primary"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 mt-4 mt-sm-0">
              <div class="card bg-gradient-dark move-on-hover">
                <div class="card-body">
                  <div class="d-flex">
                    <h5 class="mb-0 text-white">To Do</h5>
                    <div class="ms-auto">
                      <h1 class="text-white text-end mb-0 mt-n2">7</h1>
                      <p class="text-sm mb-0 text-white">items</p>
                    </div>
                  </div>
                  <p class="text-white mb-0">Shopping</p>
                  <p class="mb-0 text-white">Meeting</p>
                </div>
                <a href="javascript:;" class="w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                  <i class="fas fa-chevron-down text-white"></i>
                </a>
              </div>
              <div class="card move-on-hover mt-4">
                <div class="card-body">
                  <div class="d-flex">
                    <p class="mb-0">Emails (21)</p>
                    <a href="javascript:;" class="ms-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Check your emails">
                      Check
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 mt-4 mt-sm-0">
              <div class="card card-background card-background-mask-primary move-on-hover align-items-start">
                <div class="cursor-pointer">
                  <div class="full-background" style="background-image: url('../assets/img/curved-images/curved1.jpg')"></div>
                  <div class="card-body">
                    <h5 class="text-white mb-0">Some Kind Of Blues</h5>
                    <p class="text-white text-sm">Deftones</p>
                    <div class="d-flex mt-5">
                      <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev">
                        <i class="fas fa-backward p-2"></i>
                      </button>
                      <button class="btn btn-outline-white rounded-circle p-2 mx-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Pause">
                        <i class="fas fa-play p-2"></i>
                      </button>
                      <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next">
                        <i class="fas fa-forward p-2"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card move-on-hover mt-4">
                <div class="card-body">
                  <div class="d-flex">
                    <p class="my-auto">Messages</p>
                    <div class="ms-auto">
                      <div class="avatar-group">
                        <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="2 New Messages">
                          <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="1 New Message">
                          <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="13 New Messages">
                          <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                        </a>
                        <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="7 New Messages">
                          <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
