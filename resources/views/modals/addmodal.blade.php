{{-- The Email Modal --}}
<div class="modal fade" id="addEmailModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addEmailForm" class="form-horizontal" method="POST" action="{{ route('contacts.email', ['id' => $contact->id]) }}">
        {{ csrf_field() }}
        {{-- Email Modal Header --}}
        <div class="modal-header">
          <h4 class="modal-title">Add another email</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        {{-- Email Modal body --}}
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

                <span class="invalid-feedback">
                  <strong id="email-error"></strong>
                </span>
            </div>
          </div>
        </div>

        {{-- Email Modal footer --}}
        <div class="modal-footer">
          <button id="submitEmail" type="submit" class="btn btn-primary float-right">
            Save
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="addPhoneModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addPhoneForm" class="form-horizontal" method="POST" action="{{ route('contacts.phone', ['id' => $contact->id]) }}">
      {{ csrf_field() }}
      {{-- Phone Modal Header --}}
        <div class="modal-header">
          <h4 class="modal-title">Add phone number</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        {{-- Phone Modal body --}}
        <div class="modal-body">

          <div class="form-group row">
            <label for="newphone" class="col-lg-3 col-form-label text-lg-right">New Phone</label>

            <div class="col-lg-6">
              <input
                  id="newphone"
                  type="text"
                  class="form-control"
                  name="newphone"
                  value="{{ old('newphone') }}"
                  autofocus
              >

              <span class="invalid-feedback">
                <strong id="phone-error"></strong>
              </span>
            </div>
          </div>
        </div>

        {{-- Phone Modal footer --}}
        <div class="modal-footer">
          <button id="submitPhone" type="submit" class="btn btn-primary float-right">
            Save
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </form>
    </div>
  </div>
</div>