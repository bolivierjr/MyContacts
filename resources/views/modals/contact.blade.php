<!-- Contact Modal -->
<div class="modal fade first-modal-class" id="{{$people->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Contact Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{$people->firstname}} {{$people->lastname}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Contact Modal body -->
      <div class="row">
        <div class="col-md-6 offset-md-1">
          @forelse($people->email as $email)
            @if($loop->index < 1)
              <strong>Email:</strong> {{$email}}</div></div>

            @elseif($loop->index >= 1)
              <div class="row">
                <div class="col-md-6 offset-md-1">
                  <div class="emailIndent">{{$email}}</div>
                </div>
              </div>
            @endif

          @empty
            <strong>Email:</strong></div></div>
          @endforelse


      <div class="row">
        <div class="col-md-6 offset-md-1">
          @forelse($people->phone as $phone)
            @if($loop->index < 1)
              <strong>Phone:</strong> {{$phone}}</div></div>

            @elseif($loop->index >= 1)
              <div class="row">
                <div class="col-md-6 offset-md-1">
                  <div class="phoneIndent">{{$phone}}</div>
                </div>
              </div>
            @endif

          @empty
            <strong>Phone:</strong></div></div>
          @endforelse

      <div class="row">
        <div class="col-md-6 offset-md-1">
          @if($people->address)
            <strong>Address:</strong> {{$people->address}}
          @else
            <strong>Address:</strong>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 offset-md-1">
          @if($people->address)
            <strong>City/State:</strong> {{$people->city}}, {{$people->state}}, {{$people->zipcode}}
          @else
            <strong>City/State:</strong>
          @endif
        </div>
      </div>

      <!-- Contact Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
