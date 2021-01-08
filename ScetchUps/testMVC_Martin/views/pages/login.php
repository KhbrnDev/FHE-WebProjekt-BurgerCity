<div class="pages-login">
	<div class="login-wrapper">
		<h1>Login</h1>

		<?php if($errMsg !== null) : ?>
			<div class="error-message">
 				<?php
				 foreach($errMsg as $Message)
				 {
					 echo $Message;
				 }
				 ?>
				 <!-- <?=$errMsg?>     -->
			</div>
		<?php endif; ?>
		<form action="index.php?c=pages&a=login" method="post">
			<div class="input">
				<label for="username">
					Nutzername
				</label>
				<input id="username" name="username" type="username" placeholder="max@mustermann.de" value="<?=htmlspecialchars($username)?>" required />
			</div>

			<div class="input">
				<label for="password">
					Passwort:
				</label>
				<input id="password" name="password" type="password" placeholder="supergeheim" required />
			</div>

			<div class="input submit">
				<input name="submit" type="submit" value="Login"/>
			</div>
			<div class="login-footer">
				<a href="index.php?c=pages&a=signup">Konto erstellen</a>
			</div>
		</form>
	</div>
</div>