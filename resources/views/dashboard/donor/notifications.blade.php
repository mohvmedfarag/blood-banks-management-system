@extends('dashboard.donor.layout.app')
@section('title')
  Donor - Notifications
@endsection

<style>
    .notification:last-child {
      border-bottom: none;
    }
    .notification-header {
      font-weight: bold;
      color: #007bff;
      margin-bottom: 5px;
    }
    .notification-content {
      color: #555;
      margin-bottom: 8px;
    }
    .notification-timestamp {
      font-size: 12px;
      color: #999;
      text-align: right;
    }
    .no-notifications {
      text-align: center;
      color: #777;
      font-size: 16px;
      padding: 20px;
    }
</style>

@section('content')
<div class="dashboard-container" style="width: 53pc;">
    <h1>Notifications</h1>

    @auth('donor')
    @forelse (auth('donor')->user()->notifications as $notification)
    <!-- Example Notification -->
    <div class="notification" style="margin-top: 15px">
      <div class="notification-header">{{ $notification->data['message'] }}</div>
      {{-- <div class="notification-content">
        {{ $notification->data['message'] }}
      </div> --}}
      <div class="notification-timestamp">{{ $notification->data['date'] }} 

        <a href="javascript:void(0)"
         onclick="document.getElementById('deleteNotify{{$notification->id}}').submit()" 
         class="action-link delete">
         <i class="fa-regular fa-trash-can"></i>
        </a>
        <form id="deleteNotify{{$notification->id}}" action="{{route('donor.deleteNotification', $notification->id)}}" method="POST">
          @csrf
          @method('DELETE')
        </form>

      </div>
    </div>
    <br/>
    <hr/>
  @empty
    <!-- In case there are no notifications -->
      <div class="no-notifications">No notifications available.</div> 
  @endforelse
  @endauth
    
  
      

</div>
@endsection