@extends('dashboard.admin.layout.layout.app')
<style>
  .form-container {
      max-width: 900px;
      margin: 50px auto;
      padding: 20px;
      background: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .form-container label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #333;
  }

  .form-container select,
  .form-container textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
  }

  .form-container textarea {
      resize: vertical;
  }

  .form-container .error {
      color: #8d1e1e;
      font-size: 13px;
      margin-top: -15px;
      margin-bottom: 15px;
  }

  .form-container .btn {
      background-color: #8d1e1e;
      color: #fff;
      border: none;
      padding: 12px 20px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
  }

  .form-container .btn:hover {
      background-color: #e74c3c;
  }
</style>
@section('title')
    Admin - Send Notifications
@endsection
@section('content')
  <div class="dashboard-container" >
    <h1>Send Notification to Patient</h1>

    <form action="{{ route('admin.notifications.send.post') }}" method="POST" class="form-container">
      @csrf
  
      <label for="patient_id">Patient</label>
      <select name="patient_id" id="patient_id">
          <option value="">-- select patient --</option>
          @foreach($patients as $p)
              <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                  {{ $p->name }} (ID: {{ $p->id }})
              </option>
          @endforeach
      </select>
      @error('patient_id') <div class="error">{{ $message }}</div> @enderror
  
      <label for="message">Message</label>
      <textarea name="message" id="message" rows="3">{{ old('message') }}</textarea>
      @error('message') <div class="error">{{ $message }}</div> @enderror
  
      <button type="submit" class="btn">Send</button>
  </form>
  </div>
@endsection