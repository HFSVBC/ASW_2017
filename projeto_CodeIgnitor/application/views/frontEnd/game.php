<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>


<div id="main">
	<div id="cont-Body">
		<div id="gameBody">

			<table id="table_game" class="table">
		    <tbody>
		      <tr>
		        <td><b>Início</b></td>
		        <td>Doe</td>
		      </tr>
		      <tr>
		        <td><b>Jogador atual</b></td>
		        <td>Moe</td>
		      </tr>
		      <tr>
		        <td><b>Cartas da mesa</b></td>
		        <td>Dooley</td>
		      </tr>
					<tr>
						<td><b>Minhas cartas</b></td>
						<td>Dooley</td>
					</tr>
					<tr>
						<td><b>Aposta atual</b></td>
						<td>Dooley</td>
					</tr>
					<tr>
						<td><b>Aposta de cada jogador</b></td>
						<td>
							<tr>
								<td>
									<b>user_123</b>:12 creditos
								</td>
								<td>
									<b>abacate</b>: 30 créditos
								</td>
							</tr>
						</td>
					</tr>
		    </tbody>
	  	</table>

		</div>
	</div>
	<div class="footer">
		<div class="side-bar">
			<div id="botoes_game" class="btn-group-vertical" role="group" aria-label="...">
				<button type="button" id="desistir" class="btn">Desistir</button>
				<button type="button" id="cobrir_aposta" class="btn">Cobrir a aposta(10 créditos)</button>
				<p>Aumentar para</p><input type="text"><button type="button" class="btn">Enviar</button>
			</div>

			<button class="btn btn-primary" id="chat" type="button">
				Chat <span class="badge">4</span>
			</button>
		</div>
	</div>
</div>
