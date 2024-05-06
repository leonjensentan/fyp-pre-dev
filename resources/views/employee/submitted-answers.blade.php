<h1>Submitted Answers for "{{ $quiz->title }}"</h1>

@if (count($userResponses) > 0)
  <ul>
    @foreach ($userResponses as $response)
      <li>
        <b>Question:</b> {{ $response->question->question }}<br>
        <b>Your Answer:</b> {{ json_decode($response->answer) }} </li>
    @endforeach
  </ul>
@else
  <p>You haven't submitted any answers for this quiz yet.</p>
@endif
