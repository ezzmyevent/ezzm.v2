<div class="modal-content">
      
    <!-- Modal Header -->
    <div class="modal-header">
      <h1 class="modal-title">Import User</h1>
    </div>
    
    <!-- Modal body -->
  <form id="importdetails" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">

          <div class="row mb-adj">
          <div class="col-md-12">
              <p class="text-light reg-14">Import File<span style="color:red;">*</span></p>
              <input type="file" class="form-control" placeholder="Name" name="file">
          </div>
          </div>
          
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-main btn-full submit-btn-for-import">Upload</button>
          <a href="{{route('sampleExcel')}}" class="btn btn-main btn-full">Download Sample File</a>
      </div>
  </form>
</div>

