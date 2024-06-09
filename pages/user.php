<!-- <?php
  if($_SESSION["role_thecoffe"] == "Founder"){
    header('location:../dashboard');
  }
?> -->

<div class="konten col-lg rounded">
  <div class="card">
    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
      <span>Halaman User</span>
      <a href="/add?page=add" class="btn btn-primary">Add User</a>
    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <table class="table table-striped">
        <thead>
          <tr>
            <?php
              include "controller/connect.php";
      
              $sql = "SELECT id, nama as Nama, username as Username, role as Role FROM user";
              $result = mysqli_query($con, $sql);
              $columns = mysqli_fetch_fields($result);
              echo "<th>#</th>";
              foreach ($columns as $col) {
                if ($col->name != 'id') { // Jangan tampilkan kolom id
                  echo "<th>" . $col->name . "</th>";
                }
              }
              echo "<th>Aksi</th>"; // Menambahkan kolom aksi di sini
              mysqli_free_result($result);
              $result = mysqli_query($con, $sql);
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
            $rows = "";
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              $rows .= "<tr>";
              $rows .= "<td>" . $no . "</td>";
              foreach ($row as $key => $value) {
                if ($key != 'id') { // Jangan tampilkan kolom id
                  $rows .= "<td>" . $value . "</td>";
                }
              }
              // Menambahkan tombol edit dan hapus di sini
              $rows .= "<td>
                          <a href='/update?page=update&id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a> 
                          <a href='/delete?page=delete&id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Hapus</a>
                        </td>";
              $rows .= "</tr>";
              $no++;
            }
            echo $rows;
            mysqli_free_result($result);
            mysqli_close($con);
          ?>
        </tbody>
      </table>
      
    </div>
  </div>
</div>
