@extends('dashboard.admin.layout.layout.app')
@section('title')
  Admin - Dashboard
@endsection
<style>
    
    .dashboard-container h1 {
        text-align: center;
        margin-bottom: 40px;
        color: #333;
    }
    
    .stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 columns فقط */
    gap: 30px;
    max-width: 1000px;
    margin: 0 auto;
}
    
.stat-card {
    background-color: #8d1e1e;
    color: #fff;
    padding: 50px 30px;
    border-radius: 10px;
    text-align: center;
    font-size: 18px;
    transform: translateY(20px);
    opacity: 0;
    animation: fadeInUp 0.8s ease-out forwards;
    animation-delay: var(--delay);
    transition: transform 0.3s, box-shadow 0.3s;
}

    
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}
@keyframes fadeInUp {
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
    
    .stat-card i {
        font-size: 35px;
        margin-bottom: 10px;
        display: block;
    }
    
    .stat-card h2 {
        font-size: 22px;
        margin: 10px 0;
        color: #fff
    }
    
    .stat-card p {
        font-size: 30px;
        font-weight: bold;
    }

    @media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr; /* يخليها كارد واحد في الصف على الشاشات الصغيرة */
    }
}
    
    </style>
@section('content')
<div class="dashboard-container">
    <h1>Admin Dashboard</h1>
    <div class="stats-grid">
        <div class="stat-card" style="--delay: 0s;">
            <i class="fas fa-hospital"></i>
            <h2>Blood Banks</h2>
            <p class="count" data-target="{{$bloodbanks->count()}}">0</p>
        </div>
        <div class="stat-card" style="--delay: 0.1s;">
            <i class="fas fa-hand-holding-medical"></i>
            <h2>Donors</h2>
            <p class="count" data-target="{{$donors->count()}}">0</p>
        </div>
        <div class="stat-card" style="--delay: 0.2s;">
            <i class="fas fa-procedures"></i>
            <h2>Patients</h2>
            <p class="count" data-target="{{$patients->count()}}">0</p>
        </div>
        <div class="stat-card" style="--delay: 0.3s;">
            <i class="fas fa-droplet"></i>
            <h2>Blood Requests</h2>
            <p class="count" data-target="{{$requests->count()}}">0</p>
        </div>
        <div class="stat-card" style="--delay: 0.4s;">
            <i class="fas fa-heartbeat"></i>
            <h2>Donation Requests</h2>
            <p class="count" data-target="{{$donations->count()}}">0</p>
        </div>
    </div>
</div>

@endsection


