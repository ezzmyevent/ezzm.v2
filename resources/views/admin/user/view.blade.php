<div class="modal-content">
      
    <!-- Modal Header -->
    <div class="modal-header">
      <h1 class="modal-title">View User Details</h1>
    </div>
    
    <!-- Modal body -->
    <div class="modal-body">
          <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Employee Code</p>
                  <div>{{ $users->emp_code }}</div>
                  <p class="text-light reg-14 mt-3">Name</p>
                  <div>{{ $users->name }}</div>
                  <p class="text-light reg-14 mt-3">Adult 1</p>
                  <div>{{ $users->adult_1 }}</div>
                  <p class="text-light reg-14 mt-3">Adult 2</p>
                    <div>{{ $users->adult_2 }}</div>
                    <p class="text-light reg-14 mt-3">Adult 3</p>
                    <div>{{ $users->spouse }}</div>
                    <p class="text-light reg-14 mt-3">Kid 1</p>
                    <div>{{ $users->kid_1 }}</div>
                    <p class="text-light reg-14 mt-3">Kid 2</p>
                    <div>{{ $users->kid_2 }}</div>
              </div>


             
          </div>

          <!-- <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Lead Name</p>
                  <div>{{ $users->lead_name }}</div>
              </div>
          </div> -->

<!--           

          <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Date</p>
                  <div>{{ $users->date }}</div>
              </div>
          </div> -->

          <!-- <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Slot</p>
                  <div>{{ $users->slot }}</div>
              </div>
          </div> -->

          
          
      </div>
    
    
</div>

