document.querySelector('.booking-form').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent the default form submission
    
    const bikeType = document.getElementById('bikeType').value;
    const startDate = new Date(document.getElementById('startDate').value);
    const returnDate = new Date(document.getElementById('returnDate').value);

    if (isNaN(startDate) || isNaN(returnDate)) {
        alert('Please enter valid start and return dates.');
        return;
    }

    const rentalDays = (returnDate - startDate) / (1000 * 60 * 60 * 24);
    
    if (rentalDays <= 0) {
        alert('Return date must be after the start date.');
        return;
    }

    const prices = {
        'blue': 10,
        'grey': 12,
        'green': 15,
        'yellow': 8
    };

    const totalPrice = rentalDays * prices[bikeType];

    document.getElementById('totalPrice').value = '$' + totalPrice.toFixed(2);
});

