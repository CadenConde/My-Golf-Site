// availability.js
const dayButtons = document.querySelectorAll('.day-button');
const availabilityInfo = document.getElementById('availability-info');
const saveAvailabilityButton = document.getElementById('save-availability');

let unavailableDays = [];

dayButtons.forEach(button => {
  button.addEventListener('click', () => {
    const day = button.dataset.day;
    toggleAvailability(day, button);
    updateAvailabilityInfo();
  });
});

function toggleAvailability(day, button) {
  const isUnavailable = button.classList.contains('unavailable');

  if (isUnavailable) {
    button.classList.remove('unavailable');
    unavailableDays = unavailableDays.filter(d => d !== day);
  } else {
    button.classList.add('unavailable');
    unavailableDays.push(day);
  }
}

function updateAvailabilityInfo() {
  if (unavailableDays.length === 0) {
    availabilityInfo.textContent = 'You are available all days.';
  } else {
    const unavailableDaysList = unavailableDays.join(', ');
    availabilityInfo.textContent = `You are not available on: ${unavailableDaysList}.`;
  }
}

saveAvailabilityButton.addEventListener('click', () => {
  // Here, you can save the unavailable days (unavailableDays array) to a database or perform any necessary action
  console.log('Unavailable Days:', unavailableDays);
  alert('Availability saved!');
});