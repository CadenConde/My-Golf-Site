// Fetch employee data from your server or database
const employees = [
    { id: 1, name: 'John Doe', email: 'john@example.com', isManager: true },
    { id: 2, name: 'Jane Smith', email: 'jane@example.com', isManager: false },
    { id: 3, name: 'Bob Johnson', email: 'bob@example.com', isManager: false },
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
            ${employee.isManager ? 'Demote' : 'Promote'}
          </button>
          <button class="delete-button" onclick="deleteEmployee(${employee.id})">Delete</button>
        </td>
      `;
      tableBody.appendChild(row);
    });
  }
  
  // Function to toggle employee role (Manager/Employee)
  function toggleRole(employeeId) {
    const employee = employees.find(emp => emp.id === employeeId);
    if (employee) {
      employee.isManager = !employee.isManager;
      // Update the employee role on the server or database
      renderEmployeeRows();
    }
  }
  
  // Function to delete an employee
  function deleteEmployee(employeeId) {
    const employeeIndex = employees.findIndex(emp => emp.id === employeeId);
    if (employeeIndex !== -1) {
      employees.splice(employeeIndex, 1);
      // Delete the employee from the server or database
      renderEmployeeRows();
    }
  }
  
  // Initial render of employee rows
  renderEmployeeRows();