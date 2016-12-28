<!-- Modal -->
<div class = "modal fade" id = "createModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            
            <h4 class = "modal-title" id = "myModalLabel">
               Create New User
            </h4>
         </div>
         
         <div class = "modal-body">
            <form>
              
              <div class="form-group">
                <label for="text">Full Name</label>
                <input type="text" class="form-control" id="name">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="type">Account Type</label>
                <input type="type" class="form-control" id="type">
              </div>
              <div class="form-group">
                <label for="actived">Active</label>
                <input type="checkbox" class="form-control" id="type">
              </div>
            </form>
         </div>
         
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
            
            <button type = "submit" class = "btn btn-primary">
               Add
            </button>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->