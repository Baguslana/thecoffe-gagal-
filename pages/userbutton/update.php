<?php
include "./controller/connect.php";
// if (empty(isset($_GET['id']))){header('location:../user');} 

$id = $params['id'];
$sql = "SELECT * FROM user WHERE id=" . $id;
$result = mysqli_query($con ,$sql);
$row = mysqli_fetch_assoc($result);
$roles = ['admin', 'cashier', 'chef'];

if(isset($_POST["updateUser"])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // if(strlen($password) > 0) $sqlUpdate = "UPDATE FROM user SET nama='$nama', username='$username', password='$password', role='$role' WHERE id = '$id'";
    // else $sqlUpdate = "UPDATE FROM user SET nama='$nama', username='$username', role='$role' WHERE id = '$id'";
    $sqlUpdate = "UPDATE user SET nama='$nama', username='$username', role='$role'";
    if (strlen($password) > 0) {
        $sqlUpdate .= ", password='$password'";
    }

    $sqlUpdate .= "WHERE id='$id'";
    // echo $sqlUpdate;
    $result = mysqli_query($con, $sqlUpdate);
    if($result == 1) echo "<script>alert('SUKSES UPDATE!'); location.href='/user'</script>";
    else echo "<script>alert('GAGAL UPDATE!')</script>";
}

?>
<div class="konten col-lg rounded">
  <div class="card">
    <div class="card-header fw-bold">Page Edit User</div>
    <div class="card-body"></div>
      <h5 class="card-title"></h5>
      <form method="POST" action="">
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" name="nama" id="name" aria-describedby="name" value="<?= $row['nama'] ?>" />
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" aria-describedby="username" value="<?= $row['username'] ?>" />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" aria-describedby="password" />
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-control">
            <?php foreach ($roles as $role) : ?>
            <option value="<?= $role ?>"  <?= $role == $row['role'] ? 'selected' : '';  ?>><?= ucfirst($role) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" name="updateUser" class="btn btn-warning">Update</button>
      </form>
    </div>
  </div>
</div>
