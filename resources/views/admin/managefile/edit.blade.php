<!-- Modal -->
<div class = "modal fade" id = "editModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <h4 class = "modal-title" id = "myModalLabel">
               Edit File
            </h4>
         </div>
         
         <div class = "modal-body">
            <form>
              <div class="form-group">
                <label for="text">File ID</label>
                <input type="text" disabled="true" class="form-control" id="id">
              </div>
              <div class="form-group">
                <label for="text">Name</label>
                <input type="text" class="form-control" id="name">
              </div>
              <div class="form-group">
                <label for="email">Importer</label>
                <input type="text" class="form-control" id="importer">
              </div>
            </form>
         </div>
         
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
            
            <button id="submit_edit" type = "submit" class = "btn btn-primary" data-dismiss = "modal">
               Submit changes
            </button>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
  var token = '{{ Session::token() }}';
  var url = '{{route('update')}}';
  
</script>