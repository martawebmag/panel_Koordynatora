<header>
	<div class="header-img">
		<div class="header-text">
			<!-- <img class="header_logo" src="images/logo.jpg" alt="logo Fundacji"> -->
			<div class="header-text2">
				<h2>Fundacja Dzieło Nowego Tysiąclecia</h2>
				<p>Raporty obozowe - uczniowie / studenci / maturzyści </p>
			</div>
		</div>
		<div class="header-bg"></div>
	</div>
</header>
    
<nav class="nav">
	<ul>
		<div>
			<li class="nav-item"><a href="start.php" style="color:rgb(253, 234, 62)">STREFA KOORDYNATORA</a></li>
		</div>

		<div>
		<?php if ($user_logged_in): ?>
			<!-- Jeśli użytkownik jest zalogowany, pokaż menu z panelami -->
			<li class="nav-item"><a href="user_panel.php">Panel użytkownika</a></li>
			<li class="nav-item"><a href="logout.php">Wyloguj się</a></li>
		<?php else: ?>
			<!-- Jeśli użytkownik nie jest zalogowany, pokaż opcje logowania i rejestracji -->
			<li class="nav-item"><a href="start.php">Zaloguj się</a></li>
			<li class="nav-item"><a href="rejestracja.php">Zarejestruj się</a></li>
		<?php endif; ?>
		</div>


	</ul>
</nav>