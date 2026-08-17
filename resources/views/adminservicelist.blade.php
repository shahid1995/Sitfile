<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Main content -->
  <section id="content_section" class="content">
    <!-- Your Page Content Here -->
    <div>
      <p><a title="Return" href="{{ url('/admin/users55') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data page List</a></p>       

      <div class="panel panel-default">
        <div class="panel-heading">
          <strong><i class="fa fa-list"></i> {{ $page_title }}</strong>
        </div> 

        <div class="panel-body" style="padding-top: 0px;">
          <h3 style="font-weight:600;">Selected Machine Service Types :</h3><hr style="margin-top:0px;">
          <div class="row">
            @if(count($machine_service_type)>0)
            @foreach($machine_service_type as $machine)
              <!-- {{ $machine_type = $serv->machine_service_type }} -->
              <div class="col-sm-2">
                <div style="text-align: center; border: 1px solid #d2cfcf; border-radius: 2px; box-shadow: 0px 0px 10px 0px #bbb8b8; background: #eee;">
                  <a data-lightbox="roadtrip" href="{{ asset($machine->image) }}">
                    <img src="{{ asset($machine->image) }}" class="img-responsive">
                  </a>
                  <label style="padding:5px;"><i class="fa fa-check-circle" style="color: #0b9c0b;"></i> {{ $machine->machine_type }}</label>
                </div>
              </div> 
            @endforeach
            @else
            <div class="col-sm-12">
                <p style="color:#e02b2b;"><i class="fa fa-info-circle"></i> Machine service type not selected</p>
            </div>
            @endif
          </div>
          <hr>
          <h3 style="font-weight:600;">Selected Services :</h3>
          <div class="row">
            <div class="col-sm-12">
              @if(count($service_types)>0)
              <hr style="margin-top:0px; margin-bottom: 0px;">
              <ul style="list-style: none; padding:10px; line-height: 25px;">
                @foreach($service_types as $service)
                  <li><i class="fa fa-check-circle" style="color: #0b9c0b;"></i> {{ $service->service_name }}</li>
                @endforeach
              </ul>
              @else
                <p style="color:#e02b2b;"><i class="fa fa-info-circle"></i> Service not selected</p>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div><!--END AUTO MARGIN-->
  </section>
@endsection