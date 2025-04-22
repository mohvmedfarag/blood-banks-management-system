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

    // Submit the blood request form
    document.querySelector('#requestBloodForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const bloodRequests = JSON.parse(localStorage.getItem('bloodRequests') || '[]');
        const newRequest = {
            name: document.querySelector('#fullName').value,
            age: document.querySelector('#age').value,
            phone: document.querySelector('#phoneNumber').value,
            nationalId: document.querySelector('#nationalId').value,
            bloodType: document.querySelector('#bloodType').value,
            quantity: document.querySelector('#bloodQuantity').value,
            date: new Date().toLocaleDateString(),
            time: new Date().toLocaleTimeString()
        };

        bloodRequests.push(newRequest);
        localStorage.setItem('bloodRequests', JSON.stringify(bloodRequests));

        alert('تم إرسال طلب الدم بنجاح!');

        const row = `<tr>
            <td>${newRequest.name}</td>
            <td>${newRequest.date}</td>
            <td>${newRequest.time}</td>
            <td>${newRequest.bloodType}</td>
            <td>${newRequest.quantity}</td>
        </tr>`;
        document.querySelector('#historyTableBody').innerHTML += row;
    });