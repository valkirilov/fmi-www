
<div class="info">
	<h1>Placeholder Images <span>for every case!</span></h1>
	<p>Webdesign or Print. It's simple and absolutely free! Just put the custom url in your code to get your FPO / dummy image like this:</p>
	<p class="highlight">
		&lt;img src="http://lorempixel.com/400/200" /&gt;
	</p>
</div>

<div class="examples">
	<h3>Examples</h3>
	<table>
		<tr>
			<td><a href="i.php?w=400&h=200">www.fmi-www.com/i.php?w=400&amp;h=200</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random picture of 400 x 200 pixels</td>
		</tr>
		<!-- <tr>
			<td><a href="#">www.fmi-www.com/c/400/200</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random colorfull picture of 400 x 200 pixels</td>
		</tr> -->
		<!-- <tr>
			<td><a href="#">www.fmi-www.com/g/400/200</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random gray picture of 400 x 200 pixels</td>
		</tr> -->
		<tr>
			<td><a href="i.php?w=400&h=200&c=food">www.fmi-www.com/i.php?w=400&amp;h=200&amp;c=food</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random picture of the food category</td>
		</tr>
		<tr>
			<td><a href="i.php?w=400&h=200&c=food&n=1">www.fmi-www.com/i.php?w=400&amp;h=200&amp;c=food&amp;n=1</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a the same picture of 400 x 200 pixels from the food category</td>
		</tr>
	</table>
	<div class="clearfix"></div>
</div>

<div class="generator">
	<h3>Use the generator</h3>
	<h4>Pick a category</h4>
	<ul>
		<?php	global $homepageController; ?>
		<?php foreach ($homepageController->context['categories'] as $category) { ?>
			<li><?php echo $category->name ?></li>
		<?php }	?>
	</ul>
</div>