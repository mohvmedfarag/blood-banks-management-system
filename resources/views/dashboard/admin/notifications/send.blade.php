@extends('dashboard.admin.layout.layout.app')
@section('title')
    Admin - Send Notifications
@endsection
@section('content')
  <div class="card">
    <h2>Send Notification to Patient</h2>

    <form action="{{route('admin.notifications.send.post')}}" method="POST">
      @csrf

      <label for="patient_id">Patient</label>
      <select name="patient_id" id="patient_id" >
        <option value="">-- select patient --</option>
        @foreach($patients as $p)
          <option value="{{ $p->id }}"
            {{ old('patient_id') == $p->id ? 'selected' : '' }}>
            {{ $p->name }} (ID: {{ $p->id }})
          </option>
        @endforeach
      </select>
      @error('patient_id') <div class="text-danger">{{ $message }}</div> @enderror

      <label for="message">Message</label>
      <textarea name="message" id="message" rows="3" >{{ old('message') }}</textarea>
      @error('message') <div class="text-danger">{{ $message }}</div> @enderror

      <button type="submit" class="btn btn-primary">Send</button>
    </form>
  </div>
@endsection