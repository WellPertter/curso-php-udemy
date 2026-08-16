<?php
  $nome = 'Bu';
  $especie = 'felino';
  $esperto = 'sim';

  $animal = compact('nome', 'especie', 'esperto');

  foreach ($animal as $chave => $valor) {
      echo strtoupper($chave ). ': ' . $valor . '<br>';

  }
?>