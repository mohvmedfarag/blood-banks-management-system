document.getElementById('signupForm').addEventListener('submit', function (event) {
  event.preventDefault();

  const age = document.getElementById('age').value;
  const weight = document.getElementById('weight').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  if (age < 18 || age > 60) {
    alert('Age must be between 18 and 60 years.');
    return;
  }

  if (weight < 50) {
    alert('Weight must be at least 50 kg.');
    return;
  }

  if (password !== confirmPassword) {
    alert('Passwords do not match.');
    return;
  }

  // Form is valid, submit the form
  alert('Form submitted successfully!');
});
