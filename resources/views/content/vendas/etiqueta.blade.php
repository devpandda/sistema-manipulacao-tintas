<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Etiqueta - {{ $item->produto->nome }}</title>
  <style>
    @media print {
      @page {
        size: 80mm 30mm;
        margin: 0;
      }

      body {
        margin: 0;
        padding: 0;
      }

      .no-print {
        display: none;
      }
    }

    body {
      font-family: Arial, sans-serif;
      width: 80mm;
      height: 30mm;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      background-color: white;
      padding: 2mm;
      box-sizing: border-box;
    }

    .product-name {
      font-size: 14px;
      font-weight: bold;
      margin-bottom: 2px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 100%;
    }

    .formula {
      font-size: 12px;
      margin-bottom: 4px;
    }

    .message {
      font-size: 10px;
      font-style: italic;
    }
  </style>
</head>

<body onload="window.print()">
  <div class="product-name">{{ $item->produto->nome }}</div>
  <div class="formula">Fórmula: <strong>{{ $item->manipulacao->id_formula }}</strong></div>
  <div class="message">{{ $msgPadrao }}</div>
</body>

</html>
