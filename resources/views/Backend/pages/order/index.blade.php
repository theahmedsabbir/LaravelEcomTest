@extends('Backend.layouts.master')


@section('content')

<style>
.table th {
	height: unset;
}
div.dataTables_wrapper div.dataTables_length select {
	width: 61px;
}
div#dataTables_wrapper {
    font-size: 0.875rem;
}
table.dataTable thead .sorting_asc:before,table.dataTable thead .sorting:before{
	display: none;
}
table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting:after{
	display: none;
}

</style>

<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Manage Orders</div>
			<div class="card-body">
				<!-- displaying messages here -->
				@include('Backend.partials.messages')
				
				<table class="table table-hover py-3" id="dataTables">
					<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Order ID</th>
							<th scope="col">User Name</th>
							<th scope="col">User Phone</th>
							<th scope="col">Order Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>

						@php $i = 0; @endphp

						@foreach ($orders as $order)
						@php $i++; @endphp				  		
						<tr>
							<th scope="row">{{ $loop->index + 1 }}</th>
							<td>#LE{{ $order->id }}</td>
							<td>{{ $order->name }}</td>
							<td>{{ $order->phone }}</td>
							<td>
								<p>					      		
									@if ( $order->is_seen_by_admin)
									<span class="badge badge-success text-white">seen</span>
									@else
									<span class="badge badge-warning text-white">not seen</span>
									@endif
								</p>
								<p>					      		
									@if ( $order->is_completed)
									<span class="badge badge-success text-white">completed</span>
									@else
									<span class="badge badge-warning text-white">pending</span>
									@endif
								</p>
								<p>					      		
									@if ( $order->is_paid)
									<span class="badge badge-success text-white">paid</span>
									@else
									<span class="badge badge-warning text-white">unpaid</span>
									@endif
								</p>
							</td>
							<td>
								<a href="{{ route('admin.order.show', $order->id ) }}" class="btn btn-success">View Order</a>
								<a href="{{ route('admin.order.delete', $order->id ) }}" class="btn btn-danger"  data-toggle="modal" data-target="#deleteProduct{{ $order->id }}">Delete</a>
							</td>
						</tr>

						<!-- Modal Confirmation to delete start-->

						<!-- Modal -->
						<div class="modal fade" id="deleteProduct{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										Are you sure you want to delete this order??
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
										<form action="{{ route('admin.order.delete', $order->id) }}" method="POST" class="form-inline">
											@csrf
											<input type="submit" class="btn btn-danger" value="Yes">
										</form>
									</div>
								</div>
							</div>
						</div>	
						<!-- Modal Confirmation to delete end-->

						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection


