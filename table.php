<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
</head>
    <?php
   
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sd208";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to fetch user data from the database
            $sql_users = "SELECT * FROM users";
            $result_users = mysqli_query($conn, $sql_users);
            if (!$result_users) {
                die("User data query failed: " . mysqli_error($conn));
            }
    ?>        



<style>
    .modal {
    justify-content:center;
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    border-radius: 10px;
    display:flex;
    align-items:center;
    background-color: white;
    width: 20%;
    height: 65%;
    margin: 100px auto;
    padding: 20px;
 
}

input {
  background-color: #f2f2f2;
  border: 1px solid #ccc;
  border-radius: 30px;
  padding: 10px;
  margin: 10px;
  width: 200px;
  height: 30px;
}

label{       
 color: #f0390f; 
 font-weight:bold;
 font-size: 15px;
}
h2{
 font-weight:bold;
 color: #3e0bce;

}
  th{
    background: #3e0bce;
    color:#fff;
  }
.mytable{
 border: 1px solid black;
border-collapse: collapse;
 width: 100%;
 text-align :center;
 font-family: Arial, sans-serif;
}
tr:nth-child(even) {
background-color: #D6EEEE;
}
</style>

<body>

<div class="container">
        <h1>Show All Users</h1><br>
        <table class="mytable">
            <thead>
                <tr>
                    <th>FullName</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Role</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_users)) { ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['dob'] ?></td>
                        <td><?php echo $row['role'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td>
                            <button onclick="openEditModal('<?php echo $row['id'] ?>')">Edit</button>
                            <button onclick="openDeleteModal('<?php echo $row['id'] ?>')">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Edit User Modal -->
    
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <h2>Edit User</h2>
            <form method="POST" action="edit_user.php">
                <input type="hidden" id="editUserId" name="editUserId"> <!-- Hidden field to store the user's ID -->
                
                <label for="editFullname">Full Name:</label>
                <input type="text" id="editFullname" name="editFullname" placeholder="Full Name" required><br>
                
                <label for="editUsername">Username:</label>
                <input type="text" id="editUsername" name="editUsername" placeholder="Username" required><br>
                
                <label for="editGender">Gender:</label>
                <select id="editGender" name="editGender"required><br>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>
                
                <label for="editDob">Date of Birth:</label>
                <input type="date" id="editDob" name="editDob"><br>
                
                <label for="editRole">Role:</label>
                <input type="text" id="editRole" name="editRole" placeholder="Role" required><br>
                
                <label for="editAge">Age:</label>
                <input type="number" id="editAge" name="editAge" placeholder="Age" required><br>
                
                <button type="submit">Save Changes</button>
                <button type="button" onclick="closeEditModal()">Cancel</button>
            </form>
        </div>
    </div>


    <!-- Delete User Modal -->
    
    <div id="deleteUserModal" class="modal">
        <div class="modal-content">
            <h2>Delete User</h2>
            <form method="POST" action="delete_user.php">
                <input type="hidden" id="deleteUserId" name="deleteUserId"> <!-- Hidden field to store the user's ID -->
                <p>Are you sure you want to delete this user?</p><br>
                <button type="submit">Delete User</button>
                <button type="button" onclick="closeDeleteModal()">Cancel</button>
            </form>
        </div>
    </div>

    <div id="chart_div" style="width: 800px; height: 400px;"></div>

    <script>
        function openEditModal(userId) {
            
            document.getElementById('editUserId').value = userId;
            document.getElementById('editUserModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editUserModal').style.display = 'none';
        }

        function openDeleteModal(userId) {
    
            document.getElementById('deleteUserId').value = userId;
            document.getElementById('deleteUserModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteUserModal').style.display = 'none';
        }
            function openAddUserModal() {
            document.getElementById('addUserModal').style.display = 'block';
        }
        function closeAddUserModal() {
            document.getElementById('addUserModal').style.display = 'none';
        }
    </script>
        
    </body>
</html>
