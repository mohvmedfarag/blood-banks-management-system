const tabs = document.querySelectorAll('.tab');
const links = document.querySelectorAll('.sidebar ul li a');

// Navigation logic
links.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const target = document.querySelector(link.getAttribute('href'));

        tabs.forEach(tab => tab.classList.remove('active'));
        links.forEach(l => l.classList.remove('active'));

        target.classList.add('active');
        link.classList.add('active');
    });
});

// Validate donation date
document.querySelector('#donateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const lastDonations = JSON.parse(localStorage.getItem('donations') || '[]');
    const newDonationDate = document.querySelector('#donationDate').value;
    const today = new Date().toISOString().split('T')[0];

    if (new Date(newDonationDate) < new Date(today)) {
        alert('لا يمكن تسجيل تاريخ قديم للتبرع.');
        return;
    }

    if (lastDonations.some(d => d.date === newDonationDate)) {
        alert('عذرًا، لا يمكنك التبرع في هذا التاريخ لأنه تم تسجيل تبرع مسبق.');
        return;
    }

    const donation = {
        name: document.querySelector('#fullName').value,
        date: newDonationDate,
        time: document.querySelector('#donationTime').value,
    };

    lastDonations.push(donation);
    localStorage.setItem('donations', JSON.stringify(lastDonations));
    alert('تم تسجيل التبرع بنجاح!');

    const row = `<tr>
        <td>${donation.name}</td>
        <td>${donation.date}</td>
        <td>${donation.time}</td>
    </tr>`;
    document.querySelector('#historyTableBody').innerHTML += row;
});