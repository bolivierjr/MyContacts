<!-- The Email Modal -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addForm" class="form-horizontal" method="POST" action="{{ route('contacts.email', ['id' => $contact->id]) }}">
        {{ csrf_field() }}
        <!-- Email Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add another email</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Email Modal body -->
        <div class="modal-body">

          <div class="form-group row">
            <label for="newemail" class="col-lg-3 col-form-label text-lg-right">New Email</label>

            <div class="col-lg-6">
              <input
                  id="newemail"
                  type="text"
                  class="form-control"
                  name="newemail"
                  value="{{ old('newemail') }}"
                  autofocus
              >

              {{--@if ($errors->has('newemail'))--}}
                <span class="invalid-feedback">
                  <strong id="email-error"></strong>
                </span>
              {{--@endif--}}
            </div>
          </div>
        </div>

        <!-- Email Modal footer -->
        <div class="modal-footer">
          <button id="submitForm" type="submit" class="btn btn-primary float-right">
            Save
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </form>
    </div>
  </div>
</div>