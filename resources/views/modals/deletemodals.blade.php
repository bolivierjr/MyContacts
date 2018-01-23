{{-- Delete Email Modals --}}
<div class="modal fade" id="deleteEmailModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="deleteEmailForm" class="form-horizontal" method="POST"
            action="{{ route('contacts.deleteemail', ['id' => $contact->id, 'index' => 0]) }}">
        {{ csrf_field() }}

        <div class="modal-header">
          <h4 class="modal-title">Are you sure you want to delete?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-sm-2 offset-sm-3">
              <button id="deleteButton" type="submit" class="btn btn-lg btn-danger">
                Yes
              </button>
            </div>
            <div class="col-sm-2 offset-sm-2">
              <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>

        <div class="modal-body"></div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deletePhoneModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="deletePhoneForm" class="form-horizontal" method="POST"
            action="{{ route('contacts.deletephone', ['id' => $contact->id, 'index' => 0]) }}">
        {{ csrf_field() }}

        <div class="modal-header">
          <h4 class="modal-title">Are you sure you want to delete?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-sm-2 offset-sm-3">
              <button id="deleteButton1" type="submit" class="btn btn-lg btn-danger float-right">
                Yes
              </button>
            </div>
            <div class="col-sm-2 offset-sm-2">
              <button type="button" class="btn btn-lg btn-primary float-right" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>

        <div class="modal-body"></div>
      </form>
    </div>
  </div>
</div>