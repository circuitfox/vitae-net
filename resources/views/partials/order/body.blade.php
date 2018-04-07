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
    <form method="POST" action="{{ route('complete') }}">
      {{ csrf_field() }}
      <input type="hidden" name="order_id" value="{{ $order->id }}">
      <button type="submit" class="btn btn-primary">Complete Order</button>
    </form>
  @endif
</div>
