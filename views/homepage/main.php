<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
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
			<td><a href="i.php?w=400&h=200"><?php echo $actual_link; ?>i.php?w=400&amp;h=200</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random picture of 400 x 200 pixels</td>
		</tr>
		<tr>
			<td><a href="i.php?w=400&h=200&c=food"><?php echo $actual_link; ?>i.php?w=400&amp;h=200&amp;c=food</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random picture of the food category</td>
		</tr>
		<tr>
			<td><a href="t.php?l=short&p=5"><?php echo $actual_link; ?>t.php?l=short&amp;p=5</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random text with short 5 paragraphs</td>
		</tr>
		<tr>
			<td><a href="t.php?l=medium&p=5"><?php echo $actual_link; ?>t.php?l=medium&amp;p=5</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random text with medium 5 paragraphs</td>
		</tr>
		<tr>
			<td><a href="t.php?l=long&p=10"><?php echo $actual_link; ?>t.php?l=long&amp;p=10</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random text with long 10 paragraphs</td>
		</tr>
		<tr>
			<td><a href="t.php?l=verylong&p=15"><?php echo $actual_link; ?>t.php?l=verylong&amp;p=15</a></td>
			<td>&nbsp; &nbsp; &nbsp;</td>
			<td>to get a random text with verylong 10 paragraphs</td>
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