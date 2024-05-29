<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Detail Question And Answer User</div>
<div class="content">
	<input type="hidden" name="materi_id" value="{{ $record->materi->id }}">
	<input type="hidden" name="plan_id" value="{{ $record->id }}">
	<div class="ui top attached tabular menu">
		@foreach ($record->materi->question as $key => $question)
			<a class="item {{ $key == 0 ? 'active':'' }}" data-tab="{{$key+1}}">Question {{$key+1}}</a>
		@endforeach
	</div>
	@foreach ($record->materi->question as $key => $question)
	<div class="ui bottom attached tab segment {{ $key == 0 ? 'active':'' }}" data-tab="{{$key+1}}">
		<table class="ui celled structured fixed table">
			<tbody>
				@if ($question->files)
					<tr>
						<td colspan="4" class="center aligned">
							<div class="ui centered cards">
								{!! $question->showCardFileOnce('detil') !!}
							</div>
						</td>
					</tr>
				@endif
				<tr style="height: 200px">
					<td class="center aligned" colspan="4">
						<div class="card">
							<div class="content">
								<div class="center aligned description">
									<h3>{{ $question->desc }}</h3>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="center aligned field" colspan="4">
						<input type="hidden" name="answer[{{ $question->id }}]" value="">
						@if ($question->status == 1)
							<div class="ui link two cards">
								<div class="card" data-id="1" data-parent="{{ $question->id }}">
									<div class="content">
										<div class="description">
											<b>A. </b>TRUE
										</div>
									</div>
									{!! $question->answer->result == 1 ? '<a class="ui red ribbon label">Answer Key</a>':'' !!}
									@if ($record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->get()->count() > 0)
										{!! $record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->first()->answer == 1 ? '<a class="ui blue ribbon label">User Answer</a>':'' !!}
									@endif
								</div>
								<div class="card" data-id="2" data-parent="{{ $question->id }}">
									<div class="content">
										<div class="description">
											<b>B. </b>FALSE
										</div>
									</div>
									{!! $question->answer->result == 2 ? '<a class="ui red ribbon label">Answer Key</a>':'' !!}
									@if ($record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->get()->count() > 0)
										{!! $record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->first()->answer == 2 ? '<a class="ui blue ribbon label">User Answer</a>':'' !!}
									@endif
								</div>
							</div>
						@else
							<div class="ui link four cards">
								<div class="card" data-id="1" data-parent="{{ $question->id }}">
									<div class="content">
										<div class="description">
											<b>A. </b>{{ $question->answer->answer_1 }}
										</div>
									</div>
									{!! $question->answer->result == 1 ? '<a class="ui red ribbon label">Answer Key</a>':'' !!}
									@if ($record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->get()->count() > 0)
										{!! $record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->first()->answer == 1 ? '<a class="ui blue ribbon label">User Answer</a>':'' !!}
									@endif
								</div>
								<div class="card" data-id="2" data-parent="{{ $question->id }}">
									<div class="content">
										<div class="description">
											<b>B. </b>{{ $question->answer->answer_2 }}
										</div>
									</div>
									{!! $question->answer->result == 2 ? '<a class="ui red ribbon label">Answer Key</a>':'' !!}
									@if ($record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->get()->count() > 0)
										{!! $record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->first()->answer == 2 ? '<a class="ui blue ribbon label">User Answer</a>':'' !!}
									@endif
								</div>
								<div class="card" data-id="3" data-parent="{{ $question->id }}">
									<div class="content">
										<div class="description">
											<b>C. </b>{{ $question->answer->answer_3 }}
										</div>
									</div>
									{!! $question->answer->result == 3 ? '<a class="ui red ribbon label">Answer Key</a>':'' !!}
									@if ($record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->get()->count() > 0)
										{!! $record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->first()->answer == 3 ? '<a class="ui blue ribbon label">User Answer</a>':'' !!}
									@endif
								</div>
								<div class="card" data-id="4" data-parent="{{ $question->id }}">
									<div class="content">
										<div class="description">
											<b>D. </b>{{ $question->answer->answer_4 }}
										</div>
									</div>
									{!! $question->answer->result == 4 ? '<a class="ui red ribbon label">Answer Key</a>':'' !!}
									@if ($record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->get()->count() > 0)
										{!! $record->answer()->where('question_id',$question->id)->where('user_id',$user_id)->first()->answer == 4 ? '<a class="ui blue ribbon label">User Answer</a>':'' !!}
									@endif
								</div>
							</div>
						@endif
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	@endforeach
</div>
<div class="actions">
	<div class="ui black deny button">
		Close
	</div>
</div>
