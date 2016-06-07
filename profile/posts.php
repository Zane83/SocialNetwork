	<small><h2>Post recenti</h2></small>
	<hr>
	</form>
<?php
		$res = $mysqli->query("SELECT * FROM posts, users WHERE posts.id_user = $id AND users.id = $id ORDER BY posts.date_of_publication DESC");
			while($obj = $res->fetch_object()){
?>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-1"><a href="<?php echo "./profile.php?uid=" . $userid; ?>"><img src="<?php echo $obj->avatar; ?>" class="img-circle" alt="<?php echo $obj->name; ?>" width="60" height="60"></a></div>
							<div class="col-xs-11"><h3><?php echo $obj->name . " " . $obj->surname; ?></h3></div>
						</div>
						<h5><span class="glyphicon glyphicon-time"></span> Postato il giorno <?php echo $obj->date_of_publication; ?></h5>
						<p><?php echo $obj->text; ?></p>
					</div>
				</div>
<?php
			}
?>
		</div>
	</div>
</body>
</html>