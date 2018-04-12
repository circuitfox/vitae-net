<div class="col-sm-3">
  <!-- order info -->
  <h5><b><u>Name:</u></b></h5>
  <p>{{ $order->name }}</p>
  <h5><b><u>Description:</u></b></h5>
  <p>{{ $order->description }}</p>
  <h5><b><u>Patient MRN:</u></b></h5>
  @if($order->patient_id == null)
    <p>Not assigned to patient</p>
  @else
    <p>{{ $order->patient_id }}</p>
  @endif
  <h5><b><u>Completed:</u></b></h5>
  <p>{{ $order->completed ? 'Yes' : 'No' }}</p>
  @if($order->patient_id != null)
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#order-complete-modal" data-id="{{ $order->id }}">Complete</button>
  @endif
</div>
