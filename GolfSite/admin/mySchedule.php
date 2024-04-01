<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Availabilty</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php include('partials/menu.php'); ?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <h1>My Schedule</h1>
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

    <div id="shift-overlay">
        <div id="shift-window">
        <h3></h3>
        <ul></ul>
        <button id="close-btn">&times;</button>
        </div>
    </div>

    <script>
        // schedule.js
        const calendarDays = document.getElementById('calendar-days');
        const dayHeaders = document.getElementById('day-headers');
        const prevMonthButton = document.getElementById('prev-month');
        const nextMonthButton = document.getElementById('next-month');
        const monthYearDisplay = document.getElementById('month-year');
        const shiftOverlay = document.getElementById('shift-overlay');
        const shiftWindow = document.getElementById('shift-window');
        const closeBtn = document.getElementById('close-btn');

        const dayAbbreviations = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];

        let currentDate = new Date();

        // Sample schedule data (you can replace this with your actual data)
        const schedule = {
        <?php
            $id = $_SESSION['ID'];
            $sql = "SELECT * FROM schedule WHERE employeeID='$id'";
            $res = mysqli_query($conn,$sql);
            if ($res == TRUE) {
                while($rows=mysqli_fetch_assoc($res))
                {
                    $date = $rows['ShiftDate'];
                    $type = $rows['ShiftType'];
                    echo "'$date': ['$type'],";
                }
            }
        ?>
        /*
        '2024-03-01': ['morning', 'afternoon'],
        '2024-03-02': ['evening'],
        '2024-03-03': ['morning', 'afternoon', 'evening'],
        '2024-03-05': ['afternoon'],
        '2024-03-07': ['morning'],
        '2024-03-10': ['evening'],
        '2024-03-12': ['morning', 'afternoon'],
        '2024-03-15': ['afternoon', 'evening'],*/
        };

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

                const dayNumber = document.createElement('div');
                dayNumber.classList.add('day-number');
                dayNumber.textContent = currentDay;
                dayElement.appendChild(dayNumber);

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

                // Add click event listener to show shift window
                dayElement.addEventListener('click', () => showShiftWindow(date));
            }
            }
        }
        }

        function showShiftWindow(date) {
        const shifts = schedule[`${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`];

        if (shifts) {
            const shiftList = shiftWindow.querySelector('ul');
            shiftList.innerHTML = '';

            shifts.forEach(shift => {
            const shiftItem = document.createElement('li');
            shiftItem.textContent = getShiftText(shift);
            if (getShiftText(shift) == '12pm - 3pm') {
                shiftItem.classList.add('morning-shift' ,'active');
            }
            else if (getShiftText(shift) == '3pm - 6pm') {
                shiftItem.classList.add('afternoon-shift' ,'active');
            }
            else if (getShiftText(shift) == '6pm - 9pm') {
                shiftItem.classList.add('night-shift' ,'active');
            }
            shiftList.appendChild(shiftItem);
            });

            const dateString = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
            shiftWindow.querySelector('h3').textContent = `Shifts for ${dateString}`;

            shiftOverlay.style.display = 'flex';
        }
        }

        function getShiftText(shift) {
        if (shift === 'morning') {
            return '12pm - 3pm';
        } else if (shift === 'afternoon') {
            return '3pm - 6pm';
        } else if (shift === 'evening') {
            return '6pm - 9pm';
        }
        }

        function hideShiftWindow() {
        shiftOverlay.style.display = 'none';
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

        closeBtn.addEventListener('click', hideShiftWindow);
        shiftOverlay.addEventListener('click', hideShiftWindow);
        shiftWindow.addEventListener('click', (event) => event.stopPropagation());

    </script>
    
</body>
<?php include('partials/footer.php'); ?>

</html>