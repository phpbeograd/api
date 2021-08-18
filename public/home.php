<?php view('include/head') ?>

<h1>Welcome to my API</h1>

<p>Please click <a href="/report/read">here</a> to get the report.</p>

<p>Choose diferent report responses:</p>

<a href="/report/read/json">JSON</a>, 
<a href="/report/read/xml">XML</a>, 
<a href="/report/read/array">Array</a>

<p>Get only a report from one:</p>

<ol>
<?php 
foreach($companies as $name=>$count)
{
	?>
	<li>
		<a href="/report/show/<?php echo $name ?>"><?php echo $name ?></a>
	</li><br/>
	<?php
}
?>
</ol>

<?php view('include/footer') ?>