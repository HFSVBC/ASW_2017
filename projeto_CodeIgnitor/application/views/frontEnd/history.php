<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="coponentCont container">
    <div class="row page-header">
        <div id="titleGame" class="col-xs-12 col-md-8">
            <h2 id="TipoLetra"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Histórico</h2>
        </div>
    </div>
    <div class="TabelaJogos">
        <table id="jogos" class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Dono</th>
                    <th>Pessoas</th>
                    <th>Pessoas máximo</th>
                    <th>Primeira Aposta</th>
                    <th>Aposta Maxima</th>
                    <th>Timeout</th>
                    <th>Estado</th>
                    <th id="opDash">Opções</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<!-- custom js -->
<script type="text/javascript" src="custom/js/history.js"></script>