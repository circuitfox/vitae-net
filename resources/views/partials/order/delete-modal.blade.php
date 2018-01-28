<div class="modal fade" id="order-delete-modal" tabindex=-1 role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Order</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this order?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default col-md-offset-8 col-md-2" data-dismiss="modal">No</button>
          <form name="delete-order" action="" method="post" id="delete-order">
            {{ csrf_field() }}
            {{ method_field("delete") }}
            <button type="submit" class="btn btn-danger col-md-2">Yes</button>
          </form>
          <!-- This gets filled in by jquery -->
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
