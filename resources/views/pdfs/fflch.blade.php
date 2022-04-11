<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
	<style>
        @page { margin-top: 120px; margin-bottom: 120px}
		header { position: fixed; left: 0px; top: -90px; right: 0px; height: 150px; text-align: center; }
		#footer { position: fixed; left: 0px; bottom: -145px; right: 0px; height: 150px; }
        .page-break {
            page-break-after: always;
            margin-top:160px;
        }
        .page-break:last-child { page-break-after: never; }
        .content {
            margin-top:0px;
        }
    </style>
	@yield('other_styles')
</head>

<body>
	<header style="width: 100%; margin-top: 0px; margin-bottom: 10px;">
		<table style='width:100%'>
			<tr>
				<td style='width:20%' style='text-align:left;'>
					<img src='https://www.fflch.usp.br/themes/contrib/fflch-theme/images/logo.png' width='100px'/>
				</td>
				<td style='width:80%'; style='text-align:center;'>
					<p align='center'><b>FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS</b>
					<br>Universidade de São Paulo<br>
					{{ config('laravel-fflch-pdf.setor') }}</p>
				</td>
			</tr>
		</table>
	<hr>
	</header>

	<footer style="width: 100%;" id="footer">
    	<hr>
    	@yield('footer')
	</footer>

	<div class="content" style="margin-bottom: 52px; margin-right: 15px; overflow-wrap: break-word"> 
		<main>
			@yield('content')
		</main>
	</div>
</body>
</html>
