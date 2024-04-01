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
<div class="manage-wrapper">
  <h1 class="manage">Employee Management</h1>
    
    <table id="employeeTable">
      
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
    <div class="container">
      <button class="delete-button" onclick="newEmployee()">Add Employee</button>
    </div>
</div>

  <script>
      // Fetch employee data from your server or database
      const employees = [
        <?php
          $id = $_SESSION['ID'];
          $sql = "SELECT * FROM employees";
          $res = mysqli_query($conn,$sql);
          if ($res == TRUE) {
              while($rows=mysqli_fetch_assoc($res))
              {
                  $id = $rows['EmployeeID'];
                  $name = $rows['FirstName'] . " " . $rows['LastName'];
                  $email = $rows['Email'];
                  if($rows['AccountType'] == "Manager"){
                    $isManager = "true";
                  }
                  else{
                    $isManager = "false";
                  }
                  echo "{ id: $id, name: '$name', email: '$email', isManager: $isManager },";
              }
          }
                
            
        ?>
          // Add more employee data here
      ];
        
        const employeeTable = document.getElementById('employeeTable');
        const tableBody = employeeTable.getElementsByTagName('tbody')[0];
        
        // Function to render employee rows
        function renderEmployeeRows() {
          tableBody.innerHTML = '';
          employees.forEach(employee => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${employee.name}</td>
              <td>${employee.email}</td>
              <td>${employee.isManager ? 'Manager' : 'Employee'}</td>
              <td>
                <button class="toggle-button" onclick="toggleRole(${employee.id})">
                  Edit Employee Data
                </button>
              </td>
            `;
            tableBody.appendChild(row);
          });
        }
        
        // Function to toggle employee role (Manager/Employee)
        function toggleRole(employeeId) {
          location.href = "updateAccount.php?id="+employeeId;
        }

        function newEmployee(){
          location.href = "newEmployee.php";
        }
        
        // Function to delete an employee
        /*function deleteEmployee(employeeId) {
          const employeeIndex = employees.findIndex(emp => emp.id === employeeId);
          if (employeeIndex !== -1) {
            employees.splice(employeeIndex, 1);
            // Delete the employee from the server or database
            renderEmployeeRows();
          }
        }*/
        
        // Initial render of employee rows
        renderEmployeeRows();

  </script>

</body>
<?php include('partials/footer.php'); ?>

</html>