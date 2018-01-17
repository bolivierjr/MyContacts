<!-- Modal -->
<div class="modal fade" id="{{$people->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{$people->firstname}} {{$people->lastname}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      @if(empty($people->email))
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">Email:</div>
            <div class="col-md-6" data-toggle="collapse" data-target="#add-email">
              <a class="btn btn-sm btn-primary">
                <strong><i class="icon ion-plus-round"></i></strong>
              </a>
            </div>
          </div>
          @endif

          @foreach($people->email as $email)
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">Email: {{$email}}</div>
                <div class="col-md-6" data-toggle="collapse" data-target="#add-email">
                  <a class="btn btn-sm btn-primary">
                    <strong><i class="icon ion-plus-round"></i></strong>
                  </a>
                </div>
              </div>
              @endforeach

              @if(empty($people->phone))
                <div class="row">
                  <div class="col-md-6">Phone:</div>
                </div>
              @endif

              @foreach($people->phone as $phone)
                <div class="row">
                  <div class="col-md-6">Phone: {{$phone}}</div>
                </div>
              @endforeach

              <div class="row">
                <div class="col-md-6">Address: {{$people->address}}</div>
              </div>

              <div class="row">
                <div class="col-md-6">City: {{$people->city}}</div>
              </div>

              <div class="row">
                <div class="col-md-6">State: {{$people->state}}</div>
              </div>

              <div class="row">
                <div class="col-md-6">Zip: {{$people->zipcode}}</div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
