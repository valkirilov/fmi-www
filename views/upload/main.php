<?php	global $uploadController; ?>
<form action="upload.php" method="POST" enctype="multipart/form-data">
	<?php if (isset($_POST['message'])) { ?>
		<p class="alert <?php echo $_POST['status'] ? 'success' : 'error' ?>">
			<?php echo $_POST['message']; ?>
		</p>
	<?php } ?>

  Select image to upload:
  <input type="file" name="image">
  Category:
  <select id="category-id" name="category-id">
    <?php foreach ($uploadController->context['categories'] as $category) { ?>
    	<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
    <?php }	?>
  </select>
  <input type="submit" value="Upload Image" name="submit">
</form>



<h1>Images Library</h1>
<hr>

<table>
	<thead>
		<th>#ID</th>
		<th>Path</th>
		<th>Width</th>
		<th>Height</th>
		<th>Preview</th>
	</thead>
	<tbody>
		<?php foreach ($uploadController->context['images'] as $image) { ?>
			<tr>
				<td><?php echo $image->id ?></td>
				<td><a href="<?php echo $image->path; ?>" target="_blank"><?php echo $image->path ?></a></td>
				<td><?php echo $image->width ?>px</td>
				<td><?php echo $image->height ?>px</td>
				<td><img src="<?php echo $image->path; ?>" width="120"></td>
			</tr>
		<?php }	?>
	</tbody>
</table>