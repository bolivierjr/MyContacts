<div class="modal fade" id="deletePhoneModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deletePhoneForm" class="form-horizontal" method="POST" action="{{ route('contacts.deletephone', ['id' => $contact->id, 'index' => 0]) }}">
        {{ csrf_field() }}

        <div class="modal-header">
          <h4 class="modal-title">Are you sure you want to delete?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <button type="submit" class="btn btn-lg btn-danger">
            Yes
          </button>
          <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal"> No </button>
        </div>

        <div class="modal-body"></div>
      </form>
    </div>
  </div>
</div>