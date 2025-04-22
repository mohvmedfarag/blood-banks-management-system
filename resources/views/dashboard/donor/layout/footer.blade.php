<footer>
    <div class="footer-container">
      <div class="footer-links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#about-us">About Us</a></li>
          <li><a href="#Campaigns">Campaigns</a></li>
          <li><a href="#contact-us">Contact Us</a></li>
        </ul>
      </div>

      <div class="footer-social">
        <h3>Follow Us</h3>
        <ul>
          <li>
            <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
          </li>
          <li>
            <a href="https://wa.me/01024146510?text=Hello, I am interested in your services!"><i class="fab fa-whatsapp"></i> WhatsApp</a>
          </li>
        </ul>
      </div>
      <!-- New section for login and sign up -->
      <div class="footer-auth">
        <h3>Account</h3>
        @if (Auth::guard('donor')->check())
        <div class="auth-buttons">
          <form method="post" action="{{route('donor.logout')}}">
              @csrf
              <button type="submit" class="auth-button signup">logout</button>
          </form>
        </div>
        @elseif (Auth::guard('patient')->check())
        <div class="auth-buttons">
          <form method="post" action="{{route('patient.logout')}}">
              @csrf
              <button type="submit" class="auth-button signup">logout</button>
          </form>
        </div>
        @else
        <div class="auth-buttons">
          <a href="{{route('chooseLogin')}}" class="auth-button login">Login</a>
          <a href="{{route('chooseRegistration')}}" class="auth-button signup">Sign Up</a>
        </div>
        @endif
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 Blood Bank. All rights reserved.</p>
    </div>
  </footer> 