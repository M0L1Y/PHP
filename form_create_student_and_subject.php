<!-- Archivo form_create_student_and_subject.php -->
<h2>Crear estudiante y asignar materia</h2>
<form action="index.php" method="post">
  <label for="name">Nombre:</label>
  <input type="text" id="name" name="name" required>
  <br><br>
  <label for="email">Correo electrónico:</label>
  <input type="email" id="email" name="email" required>
  <br><br>
  <label for="subject_name">Nombre de la materia:</label>
  <input type="text" id="subject_name" name="subject_name" required>
  <br><br>
  <input type="submit" name="create_student_and_subject" value="Crear estudiante y asignar materia">
  
</form>
<br><br>
<a href="form_add_subject.php">Agregar materia</a>

