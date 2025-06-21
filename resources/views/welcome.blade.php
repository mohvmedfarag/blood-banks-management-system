@extends('layouts.website.app')
@section('content')
    <!-- Main Section -->
    <main class="home">
        <div class="background" id="background"></div>
        <div class="dark-overlay">
            <div class="content-text">
                <h1>
                    {{__('words.smallDesc1')}} <br />
                    {{__('words.smallDesc2')}}
                </h1>
                @if (Auth::guard('donor')->check())
                  
                <a href="{{route('donor.new.donate.request')}}" class="auth-button login">{{__('words.donationNow')}}</a>
                @else
                <a href="{{route('chooseLogin')}}" class="auth-button login">{{__('words.donationNow')}}</a>
                @endif
            </div>
        </div>
    </main>
    <!-- Donation Process Section -->
    <section class="donation-process">
      <div class="continer">
        <h2>{{__('words.donationProcess')}}</h2>
        <div class="steps-container">
          <div class="step">
            <div class="step-oll">
              <div class="circle"><span>1</span></div>
              <h3>{{__('words.registration')}}</h3>
            </div>
            <p>
              {{__('words.registrationDesc')}}
            </p>
          </div>

          <div class="step">
            <div class="step-oll">
              <div class="circle"><span>2</span></div>
              <h3>{{__('words.medicalCheckUp')}}</h3>
            </div>
            <p>
              {{__('words.medicalCheckUpDesc')}}
            </p>
          </div>

          <div class="step">
            <div class="step-oll">
              <div class="circle"><span>3</span></div>
              <h3>{{__('words.donation')}}</h3>
            </div>
            <p>
              {{__('words.donationDesc')}}
            </p>
          </div>

          <div class="step">
            <div class="step-oll">
              <div class="circle"><span>4</span></div>
              <h3>{{__('words.restAndRefreshment')}}</h3>
            </div>
            <p>
              {{__('words.restAndRefreshmentDesc')}}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Campaigns Section -->
    <section class="campaigns" id="Campaigns">
      <div class="continer">
        <div class="up">
          <h2>{{__('words.ourCampaigns')}}</h2>
          <p>{{__('words.ourCampaignsDesc')}}</p>
        </div>
        <div class="campaign-container">
          <div class="campaign-card">
            <img src="{{asset('assets/website/photo/23.png')}}" style="padding: 20px 15px 0px 15px;" alt="Campaign image" />
            <div class="campaign-info">
              <p class="description">
                {{__('words.campaign1')}}
              </p>
            </div>
          </div>
          <div class="campaign-card">
            <img src="{{asset('assets/website/photo/22.jpg')}}" style="padding: 20px 15px 0px 15px;" alt="Campaign image" />
            <div class="campaign-info">
              <p class="description">
                {{__('words.campaign2')}}
              </p>
            </div>
          </div>
          <div class="campaign-card">
            <img src="{{asset('assets/website/photo/24.jpg')}}" style="padding: 20px 15px 0px 15px;" alt="Campaign image" />
            <div class="campaign-info">
              <p class="description">
                {{__('words.campaign3')}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact-us">
      <div class="container">
        <h2>{{__('words.contact')}}</h2>
        <form method="POST" action="{{route('welcome.contact')}}" id="contactForm" class="contact-form">
          @csrf
          <div class="input-group">
            <input type="text" id="firstName" name="first_name" placeholder="First Name"/>
            <input type="text" id="lastName" name="last_name" placeholder="Last Name" />
          </div>
          <input type="email" id="email" name="email" placeholder="E-mail" />
          <input type="number" id="phone" name="phone" placeholder="Number" />
          <textarea id="message" name="message" placeholder="Message" required rows="5" ></textarea>
          @error('message')
            {{$message}}
          @enderror
          <button type="submit" class="submit-btn">submit</button>
        </form>
      </div>
    </section>

    <!-- About Us Section -->
    <section id="about-us">
      <div class="container">
        <h2>{{__('words.about')}}</h2>
        <p class="txt">{{__('words.aboutDesc')}}</p>

        <div class="content">
          <div class="mission">
            <h3>{{__('words.mission')}}</h3>
            <p>
              {{__('words.missionDesc')}}
            </p>
          </div>

          <div class="vision">
            <h3>{{__('words.vision')}}</h3>
            <p>
              {{__('words.visionDesc')}}
            </p>
          </div>

          <div class="values">
            <h3>{{__('words.values')}}</h3>
            <ul>
              <li>
                <strong>{{__('words.compassion')}}</strong>
                 {{__('words.compassionDesc')}}
              </li>
              <li>
                <strong>{{__('words.integrity')}}</strong>
                 {{__('words.integrityDesc')}}
              </li>
              <li>
                <strong>{{__('words.excellence')}}</strong> 
                {{__('words.excellenceDesc')}}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section> 
@endsection