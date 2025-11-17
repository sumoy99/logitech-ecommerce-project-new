@extends('install.index')
   
@section('content')
<div class="row ins-two">
  <div class="col-md-8 col-md-offset-2">
    <div class="card">
      <div class="card-body">
        <div class="panel panel-default ins-three" data-collapsed="0">
          <!-- panel body -->
          <div class="panel-body ins-four">
            <center>
              <i class="entypo-thumbs-up ins-five"></i>
              <h3>Congratulations!! The installation was successfull</h3>
            </center>
            <br>
            <center>
              <strong>
                Before you start using your application, make it yours. Set your application name and title, admin login email and
                password. Remember the login credentials which you will need later on for signing into your account. After this step,
                you will be redirected to application's login page.
              </strong>
            </center>
            <br>
            <div class="row">
              <div class="col-md-12">
                <form class="form-horizontal form-groups" method="post"
                  action="{{ route('finalizing_setup') }}">
                  @csrf 
                  <hr>

                  <div class="form-group">
            				<label class="col-sm-3 control-label">System Name</label>
            				<div class="col-sm-5">
            					<input type="text" class="form-control eForm-control" name="system_name" placeholder="Digital Agency"
                        required autofocus>
            				</div>
                    <div class="col-sm-4 ins-six">
                      The name of your application
                    </div>
            			</div>
                  <hr>
                  <div class="form-group">
            				<label class="col-sm-3 control-label">Admin Name</label>
            				<div class="col-sm-5">
            					<input type="text" class="form-control eForm-control" name="name" placeholder="Ex: John Doe" required>
            				</div>
                    <div class="col-sm-4 ins-six">
                      Full name of Administrator
                    </div>
            			</div>
                  <hr>
                  <div class="form-group">
            				<label class="col-sm-3 control-label">Admin Email</label>
            				<div class="col-sm-5">
            					<input type="email" class="form-control eForm-control" name="email" placeholder="Ex: john@example.com" required>
            				</div>
                    <div class="col-sm-4 ins-six">
                      Email address for administrator login
                    </div>
            			</div>
                  <hr>
                  <div class="form-group">
            				<label class="col-sm-3 control-label">Password</label>
            				<div class="col-sm-5">
            					<input type="password" class="form-control eForm-control" name="password" placeholder=""
                        required>
            				</div>
                    <div class="col-sm-4 ins-six">
                      Superadmin login password
                    </div>
            			</div>
                  <hr>

                  {{-- <div class="form-group">
            				<label class="col-sm-3 control-label">{{ phrase('TimeZone') }}</label>
            				<div class="col-sm-5">
                      <select class="form-select eForm-select eChoice-multiple-with-remove" id="timezone" name="timezone">
                        <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
                        <?php foreach ($tzlist as $tz): ?>
                          <option value="{{ $tz  }}" {{ $tz == 'Asia/Dhaka' ?  'selected':'' }}>{{ $tz  }}</option>
                        <?php endforeach; ?>
                      </select>
            				</div>
                    <div class="col-sm-4 ins-six">
                      {{ phrase('Choose System TimeZone') }}
                    </div>
            			</div> --}}
                  <hr>
                  <div class="form-group">
            				<label class="col-sm-3 control-label"></label>
            				<div class="col-sm-7">
            					<button type="submit" class="btn btn-info">Set me up</button>
            				</div>
            			</div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection