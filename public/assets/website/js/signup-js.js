// Populating day, month, and year dropdowns for date of birth
document.addEventListener("DOMContentLoaded", function() {
  // Populating day dropdown
  const daySelect = document.getElementById('day');
  for (let i = 1; i <= 31; i++) {
      let option = document.createElement('option');
      option.value = i;
      option.text = i;
      daySelect.appendChild(option);
  }

  document.addEventListener('DOMContentLoaded', function () {
    const signupForm = document.getElementById('signupForm');
    const dobInput = document.getElementById('dob');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const MIN_AGE = 18;

    dobInput.addEventListener('change', function () {
        const dob = new Date(this.value);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        const isOldEnough = age > MIN_AGE || (age === MIN_AGE && today >= new Date(dob.setFullYear(dob.getFullYear() + MIN_AGE)));

        if (!isOldEnough) {
            alert(`You must be at least ${MIN_AGE} years old to sign up.`);
            this.value = ''; 
        }
    });

    // التحقق من كلمة المرور
    signupForm.addEventListener('submit', function (event) {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password.length < 8) {
            alert('Password must be at least 8 characters long.');
            event.preventDefault();
            return;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            event.preventDefault();
        }
    });
});

  // Populating year dropdown
  const yearSelect = document.getElementById('year');
  const currentYear = new Date().getFullYear();
  for (let i = currentYear; i >= 1900; i--) {
      let option = document.createElement('option');
      option.value = i;
      option.text = i;
      yearSelect.appendChild(option);
  }
});
