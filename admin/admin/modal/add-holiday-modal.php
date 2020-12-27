
<!-- Add Holiday Modal -->
<div class="modal fade" id="addHoliday" tabindex="-1" aria-labelledby="addHolidayModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #3A3A3A;">
      <div class="modal-header text-center">
        <h5 class="modal-title text-muted text-center" id="addHolidayModal">Add New Holiday</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="container" id="loginForm" method="POST">
            <div class="col-sm-12">
              <div class="alert text-right" role="alert"></div>

                <div class="form-group row">
                  <label for="username" class="col-sm-4 col-form-label text-muted">Holiday Name</label>
                  <div class="col-sm-8 pl-0">
                    <input type="text" class="form-control" id="username" name="holidayName" style="width:100%">
                  </div>
                </div>
                <div class="form-group row mt-4">
                  <label for="username" class="col-sm-4 col-form-label text-muted">Select the Date</label>
                  <div class="col-sm-8 pl-0">
                    <input type="date" class="form-control" id="username" name="holidayDate" style="width:100%">
                  </div>
                </div>
                <div class="form-group row mt-4">
                  <label for="username" class="col-sm-4 col-form-label">&nbsp;</label>
                  <div class="col-sm-8 pl-0">
                    <button type="submit" name="addHoliday" class="btn btn-primary" style="color:#DAC08E;border: 1px solid #DAC08E;border-radius: 4px"><i class="fa fa-plus"></i> Add Holiday</button>
                </div>
              </div>
            </form>
      </div>
 <!--      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" style="color:#DAC08E">Close</button>
      </div> -->
    </div>
  </div>
</div>