
<form action="upload.php" method="POST" enctype="multipart/form-data">

	<?php if (isset($_POST['message'])) { ?>
		<p class="alert <?php echo $_POST['status'] ? 'success' : 'error' ?>">
			<?php echo $_POST['message']; ?>
		</p>
	<?php } ?>

  Select image to upload:
  <input type="file" name="image">
  <input type="submit" value="Upload Image" name="submit">
</form>