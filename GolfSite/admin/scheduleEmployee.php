<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Employees</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php include('partials/menu.php'); ?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
<h1>Schedule Employees</h1>
<?php
    if(isset($_GET['error'])){
      echo "<div class='container'><p class='error'>Sorry, that employee is unavailable for that shift.<p></div>";
    }
  ?>
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

  <div id="shift-selection" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Select a shift:</h2>
      <button id="morning-shift" onclick="setShift('morning')" class="shift-button">12:00-3:00</button>
      <button id="afternoon-shift" onclick="setShift('afternoon')" class="shift-button">3:00-6:00</button>
      <button id="night-shift" onclick="setShift('evening')" class="shift-button">6:00-9:00</button>
    </div>
  </div>
  <div id="employee-name" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Enter employee name:</h2>
      <select name="employee-input" id="employee-input">
        
      </select>
      <button id="submit-employee">Submit</button>
    </div>
  </div>
  

  <script>
    // calendar.js

    // Get references to relevant HTML elements
    const calendarDays = document.getElementById('calendar-days');
    const dayHeaders = document.getElementById('day-headers');
    const shiftSelection = document.getElementById('shift-selection');
    const employeeName = document.getElementById('employee-name');
    const employeeInput = document.getElementById('employee-input');

    //append additional options to the select object

    <?php
      $sql = "SELECT * FROM employees";
      $res = mysqli_query($conn,$sql);
      while($rows=mysqli_fetch_assoc($res))
      {
        $id = $rows['EmployeeID'];
        $name = $rows['FirstName'] . " " . $rows['LastName'];

        echo "var option = document.createElement('option');";
        echo "option.value = '$id';";
        echo "option.innerHTML = '$name';";
        echo "employeeInput.appendChild(option);";
      }
    ?>

    const submitEmployee = document.getElementById('submit-employee');
    const closeModalButtons = document.querySelectorAll('.close');
    const prevMonthButton = document.getElementById('prev-month');
    const nextMonthButton = document.getElementById('next-month');
    const monthYearDisplay = document.getElementById('month-year');
    const schedule = {
        <?php
            $id = $_SESSION['ID'];
            $sql = "SELECT * FROM schedule";
            $res = mysqli_query($conn,$sql);

            if ($res == TRUE) {
                while($rows=mysqli_fetch_assoc($res))
                {
                    $date = $rows['ShiftDate'];
                    $type = "";
                    $sql2 = "SELECT * FROM schedule WHERE ShiftDate = '$date'";
                    $res2 = mysqli_query($conn,$sql2);
                   

                    while($rows2=mysqli_fetch_assoc($res2))
                    {
                      $type .= ",'" . $rows2['ShiftType'] . "'";
                    }

                    $type = substr($type, 1); 
                    echo "'$date': [$type],";
                }
            }
        ?>
        
        //'2024-03-01': ['morning', 'afternoon'],
        
        };

    // Array of day abbreviations for the headers
    const dayAbbreviations = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];

    // Initialize current date and selected day variables
    let currentDate = new Date();
    let selectedDay = null;
    let shift = "unset";
    
    function setShift(day){
      shift = day;
    }

    // Function to render the calendar
    function renderCalendar() {
      const currentMonth = currentDate.getMonth();
      const currentYear = currentDate.getFullYear();
      const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
      const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

      const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      monthYearDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;

      // Clear the calendar days and headers
      calendarDays.innerHTML = '';
      dayHeaders.innerHTML = '';

      // Add day abbreviation headers
      for (let i = 0; i < 7; i++) {
        const dayHeader = document.createElement('div');
        dayHeader.textContent = dayAbbreviations[i];
        dayHeaders.appendChild(dayHeader);
      }

      // Generate calendar days
      let currentDay = 1;
      for (let i = 0; i < 6; i++) {
        for (let j = 0; j < 7; j++) {
          if (i === 0 && j < firstDayOfMonth) {
            // Add empty day for days before the first day of the month
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('day', 'empty');
            calendarDays.appendChild(emptyDay);
          } else if (currentDay > daysInMonth) {
            // Stop generating days after the last day of the month
            break;
          } else {
            // Add a day element with an event listener to show the shift selection modal
            const dayElement = document.createElement('div');
            dayElement.classList.add('day');
            
            if((currentMonth+1)<10){
              month = "0" + (currentMonth+1);
            }
            else{
              month = (currentMonth+1)
            }

            dayElement.setAttribute("id", currentYear + "-" + month +  "-" +  currentDay);
            dayElement.textContent = currentDay;
            dayElement.addEventListener('click', showShiftSelection);

            const date = new Date(currentYear, currentMonth, currentDay);
            const shifts = schedule[`${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`];

            if (shifts) {
            shifts.forEach(shift => {
                const shiftElement = document.createElement('div');
                shiftElement.classList.add('shift', shift);

                if (shift === 'morning') {
                shiftElement.textContent = '12pm - 3pm';
                } else if (shift === 'afternoon') {
                shiftElement.textContent = '3pm - 6pm';
                } else if (shift === 'evening') {
                shiftElement.textContent = '6pm - 9pm';
                }

                dayElement.appendChild(shiftElement);
            });
            }


            calendarDays.appendChild(dayElement);
            currentDay++;
          }
        }
      }
    }

    // Render the initial calendar
    renderCalendar();

    // Event listeners for previous and next month buttons
    prevMonthButton.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar();
    });

    nextMonthButton.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar();
    });

    // Function to show the shift selection modal
    function showShiftSelection(event) {
      selectedDay = event.target;
      shiftSelection.style.display = 'block';
    }

    // Event listeners for shift buttons
    const shiftButtons = shiftSelection.querySelectorAll('.shift-button');
    shiftButtons.forEach(button => {
      button.addEventListener('click', showEmployeeNameInput);
    });

    // Function to show the employee name input modal
    function showEmployeeNameInput() {
      shiftSelection.style.display = 'none';
      employeeName.style.display = 'block';
    }

    // Event listener for submit employee button
    submitEmployee.addEventListener('click', saveSchedule);

    // Function to save the schedule information
    function saveSchedule() {
      const employeeName = employeeInput.value
      if (employeeName) {
        // Here, you can save the schedule information (day, shift, employee name) to a database or local storage
        //console.log('Schedule saved:', employeeName, selectedDay.id);
        window.location.href = "sendSchedule.php?id=" + employeeName +"&date=" +selectedDay.id+"&shift=" + shift;
        employeeInput.value = '';
        employeeName.style.display = 'none';
        
      } else {
        alert('Please enter an employee name.');
      }
    }

    // Event listeners for close modal buttons
    closeModalButtons.forEach(button => {
      button.addEventListener('click', closeModal);
    });

    // Function to close the modals
    function closeModal() {
      shiftSelection.style.display = 'none';
      employeeName.style.display = 'none';
    }

    // Event listener to close modals when clicking outside
    window.addEventListener('click', function(event) {
      if (event.target == shiftSelection || event.target == employeeName) {
        closeModal();
      }
    });

  </script>
  
</body>
<?php include('partials/footer.php'); ?>

</html>