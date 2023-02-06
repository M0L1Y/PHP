<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Formulario para la creación de estudiantes y asignación de materias</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
  </head>

  <body>
  <h1>Bienvenido a mi aplicación</h1>
    <?php
      if (isset($_GET['page']) && $_GET['page'] == 'form_create_student_and_subject') {
        include 'form_create_student_and_subject.php';
      } else if (isset($_GET['page']) && $_GET['page'] == 'form_add_subject') {
        include 'form_add_subject.php';
      } else if (isset($_GET['page']) && $_GET['page'] == 'form_delete_subject') {
        include 'form_delete_subject.php';
      } else {
        echo "Selecciona una opción para continuar.";
        echo "<br><br>";
        echo "<a href='index.php?page=form_create_student_and_subject'>Crear estudiante y asignar materia</a>";
        echo "<br><br>";
        echo "<a href='index.php?page=form_add_subject'>Agregar materia</a>";
        echo "<br><br>";
        echo "<a href='index.php?page=form_delete_subject'>Eliminar materia</a>";
      }
    ?>

    

    <?php
      // Conexión a la base de datos
      $host = "127.0.0.1";
      $username = "root";
      $password = "";
      $dbname = "materias";

      $conn = mysqli_connect($host, $username, $password, $dbname);

      // Verifica si la conexión a la base de datos es exitosa
      if (!$conn) {
          die("Conexión fallida: " . mysqli_connect_error());
      }

      if (isset($_POST['add_subject'])) {
        $subject_name = $_POST['subject_name'];

        // Agregar una materia
        $sql = "INSERT INTO subjects (name) VALUES ('$subject_name')";
        if (mysqli_query($conn, $sql)) {
          echo "Materia agregada correctamente.";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
    ?>
 

<?php
if (isset($_POST['delete_subject'])) {
  $subject_id = $_POST['subject_id'];

  // Verifica si la materia tiene estudiantes asignados
  $sql = "SELECT * FROM students_subjects WHERE subject_id = '$subject_id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo "No se puede eliminar la materia porque tiene estudiantes asignados.";
  } else {
    // Elimina la materia
    $sql = "DELETE FROM subjects WHERE id = '$subject_id'";
    if (mysqli_query($conn, $sql)) {
      echo "Materia eliminada correctamente.";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}
?>





<?php
// Conexión a la base de datos
$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "materias";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Verifica si la conexión a la base de datos es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
if (isset($_POST['create_student_and_subject'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject_name = $_POST['subject_name'];

  // Crear un estudiante
  $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
  if (mysqli_query($conn, $sql)) {
    $student_id = mysqli_insert_id($conn);
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Crear una materia
  $sql = "INSERT INTO subjects (name) VALUES ('$subject_name')";
  if (mysqli_query($conn, $sql)) {
    $subject_id = mysqli_insert_id($conn);
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Asignar una materia a un estudiante
  $sql = "INSERT INTO students_subjects (student_id, subject_id) VALUES ('$student_id', '$subject_id')";
  if (mysqli_query($conn, $sql)) {
    echo "Materia asignada correctamente.";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
if (isset($_POST['delete_subject'])) {
  $subject_id = $_POST['subject_id'];

  // Verifica si la materia tiene estudiantes asignados
  $sql = "SELECT * FROM students_subjects WHERE subject_id = '$subject_id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo "No se puede eliminar la materia porque tiene estudiantes asignados.";
  } else {
    // Elimina la materia
    $sql = "DELETE FROM subjects WHERE id = '$subject_id'";
    if (mysqli_query($conn, $sql)) {
      echo "Materia eliminada correctamente.";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}





  ?>