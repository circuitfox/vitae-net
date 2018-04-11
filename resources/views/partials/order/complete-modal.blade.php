<div class="modal fade" id="order-complete-modal" tabindex=-1 role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Complete Order</h4>
      </div>
      <div class="modal-body">
        <p>Would you like to complete this order?</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default col-md-offset-7 col-md-2" data-dismiss="modal">No</button>
          <form method="POST" action="{{ route('complete') }}">
             {{ csrf_field() }}
             <input id="complete-id" type="hidden" name="order_id" value="">
             <button type="submit" class="btn btn-primary col-md-3">Complete Order</button>
          </form>
          <!-- This gets filled in by jquery -->
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
