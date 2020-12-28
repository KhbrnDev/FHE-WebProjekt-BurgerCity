<div class="pages-signup">
	<div class="signup-wrapper">
		<h1>Konto erstellen</h1>

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
		<form action="index.php?c=pages&a=signup" method="post">
			<div class="grid">
				<div class="row">
					<div class="col">
						<div class="input">
							<label for="email">
								E-Mail-Adress
							</label>
							<input id="email" name="email" type="email" placeholder="max@fh-erfurt.de" value="" required />
						</div>
					</div>
					<!-- TODO: Add all needed fields for login and student in the project -->
					<!-- Here Stats TODO -->

					<div class="col">
						<div class="input">
							<label for="password">
								Passwort
							</label>
							<input id="password" name="password" type="password" placeholder="passwort1234" value="" required />
						</div>
					</div>

					<!-- Here Ends TODO -->
				</div>
			</div>

			<div class="input submit">
				<input name="submit" type="submit" value="Erstellen"/>
			</div>

			<div class="signup-footer">
				<a href="index.php?c=pages&a=login">« zurück zum Login</a>
			</div>
		</form>
	</div>
</div>