<div class="pages-exams">
	<div class="bg-scroll"></div>
	<!-- TODO: Add a logout button on this view -->
	<div class="exams-head">
		<h1>Notenspiegel und Prüfungen</h1>
	</div>
	<div class="exam-add-wrapper">

		<?php if($errMsg !== null) : ?>
			<div class="error-message">
				<?=$errMsg?>
			</div>
		<?php endif; ?>

		<form action="index.php?c=pages&a=exams" method="post">
			<div class="grid">
				<div class="row">
					<div class="col-2">
						<div class="input">
							<label for="semester">
								Semester
							</label>
							<select id="semester" name="semester" required>
								<option disabled selected value="">Bitte auswählen</option>
								<option value="ws">Wintersemester</option>
								<option value="ss">Sommersemester</option>
							</select>
						</div>
					</div>
					<div class="col-1">
						<div class="input">
							<label for="module">
								Modul
							</label>
							<select id="module" name="module" required>
								<option disabled selected value="">Bitte auswählen</option>
								<!-- TODO: Fill the options with the date from the database -->
							</select>
						</div>
					</div>
					<div class="col-2">
						<div class="input">
							<label for="examdate">
								Prüfungstag
							</label>
							<input id="examdate" name="examdate" type="date" placeholder="10.05.2018" value="" required />
						</div>
					</div>
					<div class="col-1">
						<div class="input">
							<label for="room">
								Raum
							</label>
							<input id="room" name="room" type="text" placeholder="5.E.07" value="" required />
						</div>
					</div>
					<div class="col-1">
						<div class="input">
							<label for="building">
								Haus/Ort
							</label>
							<input id="building" name="building" type="text" placeholder="FHE Haus 5" value="" required />
						</div>
					</div>
					<div class="col-1">
						<div class="input">
							<label for="type">
								Typ
							</label>
							<select id="type" name="type" required>
								<option disabled selected value="">Bitte auswählen</option>
								<option value="exam">Prüfung</option>
								<option value="project">Projekt</option>
								<option value="viva">Mündlich</option>
								<option value="other">Sonstiges</option>
							</select>
						</div>
					</div>
					<div class="col-2">
						<div class="input">
							<label for="typeOtherName">
								Sonstiges Name
							</label>
							<input id="typeOtherName" name="typeOtherName" type="text" placeholder="Schein" value="" required />
						</div>
					</div>
					<div class="col-1">
						<div class="input">
							<label for="result">
								Note
							</label>
							<input id="result" name="result" type="number" placeholder="1.0" value="" required />
						</div>
					</div>
					<div class="col-1">
						<div class="input">
							<label for="percentage">
								Note %
							</label>
							<input id="percentage" name="percentage" type="number" placeholder="100" value="" required />
						</div>
					</div>
				</div>
			</div>

			<div class="input submit">
				<input name="submit" type="submit" value="Hinzufügen"/>
			</div>
		</form>
	</div>
	<div class="exams-table-header">
		<div class="grid">
			<div class="row">
				<div class="col-2">Semester</div>
				<div class="col-2">Modul</div>
				<div class="col-2">Prüfungstag</div>
				<div class="col-2">Raum/Haus</div>
				<div class="col-2">Typ</div>
				<div class="col-2">Note</div>
			</div>
		</div>
	</div>
	<div class="exams-table">
		<?php if(count($exams) === 0 ) : ?>
			<span>Es sind noch keine Noten eingetragen.</span>
		<?php else : ?>
			<div class="grid">
				<?php foreach($exams as $index => $exam) : ?>
					<div class="row">
						<div class="col-2"><!-- TODO: Add echo Semester --></div>
						<div class="col-2"><!-- TODO: Add echo Modul --></div>
						<div class="col-2"><!-- TODO: Add echo Prüfungstag --></div>
						<div class="col-2"><!-- TODO: Add echo Raum/Haus --></div>
						<div class="col-2"><!-- TODO: Add echo Typ --></div>
						<div class="col-2"><!-- TODO: Add echo Note --></div>
					</div>
				<?php endforeach; ?>

				<div class="row">
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-2">&nbsp;</div>
					<div class="col-2" style="text-align: right; font-weight: bold;">Gesamtnote:</div>
					<div class="col-2"><!-- Durchschnittsnote --></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>