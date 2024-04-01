<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time off Requests</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php include('partials/menu.php'); ?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
<div id="calendar-container">
  <div id="calendar-header">
    <button id="prev-month">&larr;</button>
    <h2 id="month-year"></h2>
    <button id="next-month">&rarr;</button>
  </div>
  <div id="calendar">
    <div id="day-headers"></div>
    <div id="calendar-days"></div>
  </div>
</div>

<div id="date-modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Submit Availability Change for:</h2>
    <h2 id="selected-date"></h2>
    <button class="log-button"id="confirm-date">Confirm</button>
  </div>
</div>

<script>
  // calendar.js
  const calendarDays = document.getElementById('calendar-days');
  const dayHeaders = document.getElementById('day-headers');
  const dateModal = document.getElementById('date-modal');
  const selectedDateDisplay = document.getElementById('selected-date');
  const confirmDateButton = document.getElementById('confirm-date');
  const closeModalButtons = document.querySelectorAll('.close');
  const prevMonthButton = document.getElementById('prev-month');
  const nextMonthButton = document.getElementById('next-month');
  const monthYearDisplay = document.getElementById('month-year');

  const dayAbbreviations = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];

  let currentDate = new Date();
  let selectedDate = null;

  // Array of dates to highlight
  const highlightedDates = [
    <?php
      $id = $_SESSION['ID'];
      $sql = "SELECT * FROM timeoffrequests WHERE EmployeeID = '$id';";
      $res = mysqli_query($conn, $sql);
      while($rows = mysqli_fetch_assoc($res)){
        $date = $rows['TimeOffDate'];
        $year = intval(substr($date, 0, 4));
        $month = (intval(substr($date, 5, 2)) - 1);
        $day = intval(substr($date, 8, 2));
        echo "new Date($year, $month, $day),";
      }
    ?>
  ];

  function renderCalendar() {
    const currentMonth = currentDate.getMonth();
    const currentYear = currentDate.getFullYear();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    monthYearDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;

    calendarDays.innerHTML = '';
    dayHeaders.innerHTML = '';

    for (let i = 0; i < 7; i++) {
      const dayHeader = document.createElement('div');
      dayHeader.textContent = dayAbbreviations[i];
      dayHeaders.appendChild(dayHeader);
    }

    let currentDay = 1;
    for (let i = 0; i < 6; i++) {
      for (let j = 0; j < 7; j++) {
        if (i === 0 && j < firstDayOfMonth) {
          const emptyDay = document.createElement('div');
          emptyDay.classList.add('day', 'empty');
          calendarDays.appendChild(emptyDay);
        } else if (currentDay > daysInMonth) {
          break;
        } else {
          const dayElement = document.createElement('div');
          dayElement.classList.add('day');
          dayElement.textContent = currentDay;
          dayElement.addEventListener('click', selectDay);

          const date = new Date(currentYear, currentMonth, currentDay);

          if (date.getTime() === selectedDate?.getTime()) {
            dayElement.classList.add('selected');
          }

          if (highlightedDates.some(highlightedDate => highlightedDate.getTime() === date.getTime())) {
            dayElement.classList.add('highlighted');
          }

          calendarDays.appendChild(dayElement);
          currentDay++;
        }
      }
    }
  }

  renderCalendar();

  prevMonthButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
  });

  nextMonthButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
  });

  function selectDay(event) {
    const selectedDay = event.target;
    const newSelectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), selectedDay.textContent);

    if (selectedDate) {
      const prevSelectedDay = document.querySelector('.selected');
      prevSelectedDay.classList.remove('selected');
    }

    selectedDay.classList.add('selected');
    selectedDate = newSelectedDate;
    selectedDateDisplay.textContent = selectedDate.toLocaleDateString();
    showDateModal();
  }

  function showDateModal() {
    dateModal.style.display = 'block';
  }

  confirmDateButton.addEventListener('click', () => {
    if (selectedDate) {
      location.href = "toggleTimeOff.php?id=" +<?php echo $_SESSION['ID'];?> + "&date=" + selectedDate.toISOString().substring(0,10);
      console.log('Selected Date:', selectedDate.toISOString().substring(0,10));
      dateModal.style.display = 'none';
      clearSelectedDate();
    }
  });

  function clearSelectedDate() {
    selectedDate = null;
    selectedDateDisplay.textContent = '';
    const selectedDay = document.querySelector('.selected');
    if (selectedDay) {
      selectedDay.classList.remove('selected');
    }
  }

  closeModalButtons.forEach(button => {
    button.addEventListener('click', () => {
      dateModal.style.display = 'none';
      clearSelectedDate();
    });
  });

  window.addEventListener('click', function(event) {
    if (event.target == dateModal) {
      dateModal.style.display = 'none';
      clearSelectedDate();
    }
  });
</script>

<style>
  .highlighted {
    background-color: red;
    color: white;
  }
</style>
  
</body>
<?php include('partials/footer.php'); ?>

</html>