@extends('layouts.form')

@section('css')
@append

@section('js')
@append

@section('scripts')
<script type="text/javascript">
	$(document).on('click', '.vertical.all', function(e){
		e.preventDefault();
		var container 	= $(this).closest('thead');
		var action 		= $(this).data('action');
		var selector	= $('.'+action+'.check');
		var checked		= true;

		container.next('tbody').find(selector).each(function(e){
			checked = !$(this).prop('checked') ? false : checked;
			// $(this).prop('checked', !$(this).prop('checked'));
		});

		container.next('tbody').find(selector).prop('checked', !checked);
	});

	$(document).on('click', '.horizontal.all', function(e){
		e.preventDefault();
		var container 	= $(this).closest('tr');
		var selector	= $('.check');
		var checked		= true;

		container.find(selector).each(function(e){
			checked = !$(this).prop('checked') ? false : checked;
			// $(this).prop('checked', !$(this).prop('checked'));
		});

		container.find(selector).prop('checked', !checked);
	});
</script>
@append

@section('content-body')
	<form id="dataForm" action="{{ url($pageUrl.$record->id.'/grant') }}" class="ui form" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<table class="ui small compact blue table">
			<thead>
				<tr>
					<th><i class="sidebar icon"></i> Menu</th>
					<th class="center aligned">View</th>
					<th class="center aligned">Add</th>
					<th class="center aligned">Edit</th>
					<th class="center aligned">Delete</th>
					<th class="center aligned">Approve</th>
					<th class="center aligned">Reviewer</th>
					<th class="center aligned">Supervisor</th>
					<th class="center aligned"></th>
				</tr>
			</thead>
			@foreach($mainMenu->roots() as $item)
			@php
				if(is_array($item->perms))
				{
					$perms = \App\Models\Authentication\Permission::where(function($query) use ($item) {
							for($i = 0; $i < count($item->perms); $i++)
							{
									$query->orWhere('name', 'like', $item->perms[$i].'%');
							}
					})->get();
				}else{
					$perms = \App\Models\Authentication\Permission::where('name', 'like', $item->perms.'%')->get();
				}
			@endphp
			<thead>
				<th><i class="{{ $item->icon }} icon"></i> {!! $item->title !!}</th>
				<th class="center aligned">
					@if($item->hasChildren())
					<button type="button" class="ui vertical all mini button" data-action="view"><i class="checkmark icon"></i> View All</button>
					@else
					@if (strpos($item->act,'r') !== false)
						@if($p = $perms->where('name', $item->perms.'-view')->first())
							<div class="ui fitted checkbox">
								<input name="check[]" class="view check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($item->perms.'-view')) checked @endif>
								<label></label>
							</div>
							@else
							<div class="ui fitted checkbox">
									<input name="check[]" class="view check" type="checkbox" value="{{ $item->perms.'-view' }}">
									<label></label>
							</div>
							@endif
						@endif
					@endif
				</th>
				<th class="center aligned">
					@if($item->hasChildren())
						<button type="button" class="ui vertical all mini button" data-action="add"><i class="checkmark icon"></i> Add All</button>
					@else
						@if (strpos($item->act,'c') !== false)
							@if($p = $perms->where('name', $item->perms.'-add')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="add check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($item->perms.'-add')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="add check" type="checkbox" value="{{ $item->perms.'-add' }}">
										<label></label>
								</div>
							@endif
						@endif
					@endif
				</th>
				<th class="center aligned">
					@if($item->hasChildren())
						<button type="button" class="ui vertical all mini button" data-action="edit"><i class="checkmark icon"></i> Edit All</button>
					@else
						@if (strpos($item->act,'u') !== false)
							@if($p = $perms->where('name', $item->perms.'-edit')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="edit check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($item->perms.'-edit')) checked @endif>
									<label></label>
								</div>
								@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="edit check" type="checkbox" value="{{ $item->perms.'-edit' }}">
										<label></label>
								</div>
							@endif
						@endif
					@endif
				</th>
				<th class="center aligned">
					@if($item->hasChildren())
						<button type="button" class="ui vertical all mini button" data-action="delete"><i class="checkmark icon"></i> Delete All</button>
					@else
						@if (strpos($item->act,'d') !== false)
							@if($p = $perms->where('name', $item->perms.'-delete')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="delete check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($item->perms.'-delete')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="delete check" type="checkbox" value="{{ $item->perms.'-delete' }}">
										<label></label>
								</div>
							@endif
						@endif
					@endif
				</th>
				<th class="center aligned">
					@if($item->hasChildren())
						<button type="button" class="ui vertical all mini button" data-action="approval"><i class="checkmark icon"></i> Approval All</button>
					@else
						@if (strpos($item->act,'a') !== false)
							@if($p = $perms->where('name', $item->perms.'-approval')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="approval check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($item->perms.'-approval')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
									<input name="check[]" class="approval check" type="checkbox" value="{{ $item->perms.'-approval' }}">
									<label></label>
								</div>
							@endif
						@endif
					@endif
				</th>
				<th class="center aligned">
					@if($item->hasChildren())
						<button type="button" class="ui vertical all mini button" data-action="review"><i class="checkmark icon"></i> Reviewer All</button>
					@else
						@if (strpos($item->act,'s') !== false)
							@if($p = $perms->where('name', $item->perms.'-review')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="review check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($item->perms.'-review')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="review check" type="checkbox" value="{{ $item->perms.'-review' }}">
										<label></label>
								</div>
							@endif
						@endif
					@endif
				</th>
				<th class="center aligned">
					@if($item->hasChildren())
						<button type="button" class="ui vertical all mini button" data-action="review"><i class="checkmark icon"></i> Supervisor All</button>
					@else
						@if (strpos($item->act,'v') !== false)
							@if($p = $perms->where('name', $item->perms.'-supervisor')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="supervisor check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($item->perms.'-supervisor')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="supervisor check" type="checkbox" value="{{ $item->perms.'-supervisor' }}">
										<label></label>
								</div>
							@endif
						@endif
					@endif
				</th>
				<th class="center aligned">
					@if(!$item->hasChildren())
						<button type="button" class="ui horizontal all mini button"><i class="checkmark icon"></i> Check All</button>
					@endif
				</th>
			</thead>
			@if($item->hasChildren())
				<tbody>
				@foreach($item->children() as $child)
					@php
						$perms = \App\Models\Authentication\Permission::where('name', 'like', $child->perms.'%')->get();
					@endphp
					<tr>
						<td><b><i class="{{ $child->icon }} icon"></i> {!! $child->title !!}</b></td>
						<td class="center aligned">
						@if (strpos($child->act,'r') !== false)
							@if($p = $perms->where('name', $child->perms.'-view')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="view check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($child->perms.'-view')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="view check" type="checkbox" value="{{ $child->perms.'-view' }}">
										<label></label>
								</div>
							@endif
						@endif
						</td>
						<td class="center aligned">
						@if (strpos($child->act,'c') !== false)
							@if($p = $perms->where('name', $child->perms.'-add')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="add check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($child->perms.'-add')) checked @endif>
									<label></label>
								</div>
								@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="add check" type="checkbox" value="{{ $child->perms.'-add' }}">
										<label></label>
								</div>
								@endif
							@endif
						</td>
						<td class="center aligned">
						@if (strpos($child->act,'u') !== false)
							@if($p = $perms->where('name', $child->perms.'-edit')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="edit check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($child->perms.'-edit')) checked @endif>
									<label></label>
								</div>
								@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="edit check" type="checkbox" value="{{ $child->perms.'-edit' }}">
										<label></label>
								</div>
							@endif
						@endif
						</td>
						<td class="center aligned">
						@if (strpos($child->act,'d') !== false)
							@if($p = $perms->where('name', $child->perms.'-delete')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="delete check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($child->perms.'-delete')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="delete check" type="checkbox" value="{{ $child->perms.'-delete' }}">
										<label></label>
								</div>
							@endif
						@endif
						</td>
						<td class="center aligned">
						@if (strpos($child->act,'a') !== false)
							@if($p = $perms->where('name', $child->perms.'-approval')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="approval check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($child->perms.'-approval')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="approval check" type="checkbox" value="{{ $child->perms.'-approval' }}">
										<label></label>
								</div>
							@endif
						@endif
						</td>
						<td class="center aligned">
						@if (strpos($child->act,'s') !== false)
							@if($p = $perms->where('name', $child->perms.'-review')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="review check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($child->perms.'-review')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="review check" type="checkbox" value="{{ $child->perms.'-review' }}">
										<label></label>
								</div>
							@endif
						@endif
						</td>
						<td class="center aligned">
						@if (strpos($child->act,'v') !== false)
							@if($p = $perms->where('name', $child->perms.'-supervisor')->first())
								<div class="ui fitted checkbox">
									<input name="check[]" class="supervisor check" type="checkbox" value="{{ $p->name }}" @if($record->hasPermissionTo($child->perms.'-supervisor')) checked @endif>
									<label></label>
								</div>
							@else
								<div class="ui fitted checkbox">
										<input name="check[]" class="supervisor check" type="checkbox" value="{{ $child->perms.'-supervisor' }}">
										<label></label>
								</div>
							@endif
						@endif
						</td>
						<td class="center aligned">
							<button type="button" class="ui horizontal all mini button"><i class="checkmark icon"></i> Check All</button>
						</td>
					</tr>
				@endforeach
				</tbody>
			@endif
			@endforeach
			<tfoot>
				<tr>
					<th colspan="9">
						<a href="{{ url($pageUrl) }}" class="ui button">
							<i class="left angle icon"></i> Back
						</a>
						<button type="button" class="ui blue right floated save page button">
							<i class="save icon"></i> Save
						</button>
					</th>
				</tr>
			</tfoot>
		</table>
	</form>
@endsection
