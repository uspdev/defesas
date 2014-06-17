<?php
# Informa qual o conjunto de caracteres será usado.
//header('Content-Type: text/html; charset=utf-8');

echo '
<div id="list4">
		<ul class="menu">

		 <li class="negrito">Usuários</li>
			<ul class="menu">
				<li class="expanded"><a href="./criarUsuario.php">Criar novo usuário</a></li>
				<li class="expanded"><a href="./verUsuarios.php">Listar usuários</a></li>
			</ul>

		 <li class="negrito">Configurações</li>
			<ul class="menu">
				<li class="expanded"><a href="./ConfigDocs.php">Textos</a></li>
			</ul>

		<li class="negrito">Programas</li>
		<ul class="menu">
			<li class="expanded"><a href="./criarArea.php">Cadastrar programa</a></li>
			<li class="expanded"><a href="./verAreas.php">Listar programas</a></li>
		</ul>

		<li class="negrito">Salas</li>
		<ul class="menu">
			<li class="expanded"><a href="./criarSala.php">Cadastrar sala</a></li>
			<li class="expanded"><a href="./verSalas.php">Listar salas</a></li>
		</ul>

		<li class="negrito">Docentes</li>
			<ul class="menu">
				<li class="expanded"><a href="./criarDocente.php">Cadastar docente</a></li>
				<li class="expanded"><a href="./buscarDocente.php">Buscar docente</a></li>
				<li class="expanded"><a href="./verDocentes.php">Listar docentes</a></li>
				<li class="expanded"><a href="./docentesExternosHTML.php">Docentes externos</a></li>
			</ul>

		<li class="negrito">Candidatos</li>
			<ul class="menu">
				<li><a href="./criarCandidato.php">Cadastrar candidato</a></li>
				<li><a href="./verCandidatos.php">Listar todos candidatos</a></li>
				<li><a href="./proximasDefesas.php">Pŕoximas defesas</a></li>
			</ul>

		<li><a href="../logout.php">Sair</a></li>

	</ul>
</div>
	';
?>
