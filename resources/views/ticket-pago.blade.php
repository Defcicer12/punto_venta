<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('img/logo.png') }}">
      </div>
      <h1>Ticket de pago</h1>
      <div id="company" class="clearfix">
        <div>Siempre Fallan</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>Compañia</span> Siempre Fallan</div>
        <div><span>Cliente</span> {{ $orden->cliente->nombre }}</div>
        <div><span>Empleado a cargo</span>{{ $orden->empleado->name }}</div>
        <div><span>Email</span> <a href="mailto:john@example.com">{{$orden->empleado->email}}</a></div>
        <div><span>Fecha</span> {{ $orden->fecha }}</div>
        <div><span>Servicio</span> Reparación de equipo</div>
        <div><span>Falla</span> {{ $orden->falla }}</div>
        <center style="font-size: 20px">Cargos</center>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Nombre</th>
            <th class="desc">Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($orden->insumos as $insumo)
          <tr>
            <td class="service">{{$insumo->insumo->nombre}}</td>
            <td class="desc">{{$insumo->insumo->descripcion}}</td>
            <td class="unit">{{$insumo->precio}}</td>
            <td class="qty">{{$insumo->cantidad}}</td>
            <td class="total">{{$insumo->cantidad * $insumo->precio}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="service">Costo de servicio</td>
            <td class="desc">Reparación</td>
            <td class="unit">{{$orden->costo_servicio}}</td>
            <td class="qty">1</td>
            <td class="total">{{$orden->costo_servicio}}</td>
          </tr>
          <tr>
            <td class="service">Subtotal:{{$subtotal}}</td>
            <td class="desc">IVA: {{$subtotal * 0.16}}</td>
            <td class="unit">Total {{$subtotal * 1.16}}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Ticket de pago.</div>
      </div>
    </main>
    <footer>
      Sistema siempre falla
    </footer>
  </body>
</html>

<style>
    .clearfix:after {
    content: "";
    display: table;
    clear: both;
    }

    a {
    color: #5D6975;
    text-decoration: underline;
    }

    body {
    position: relative;
    width: 21cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #001028;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 12px;
    font-family: Arial;
    }

    header {
    padding: 10px 0;
    margin-bottom: 30px;
    }

    #logo {
    text-align: center;
    margin-bottom: 10px;
    }

    #logo img {
    width: 90px;
    }

    h1 {
    border-top: 1px solid  #5D6975;
    border-bottom: 1px solid  #5D6975;
    color: #5D6975;
    font-size: 2.4em;
    line-height: 1.4em;
    font-weight: normal;
    text-align: center;
    margin: 0 0 20px 0;
    background: url();
    }

    #project {
    float: left;
    }

    #project span {
    color: #5D6975;
    text-align: right;
    width: 52px;
    margin-right: 10px;
    display: inline-block;
    font-size: 0.8em;
    }

    #company {
    float: right;
    text-align: right;
    }

    #project div,
    #company div {
    white-space: nowrap;
    }

    table {
    width: 90%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
    background: #F5F5F5;
    }

    table th,
    table td {
    text-align: center;
    }

    table th {
    padding: 5px 20px;
    color: #5D6975;
    border-bottom: 1px solid #C1CED9;
    white-space: nowrap;
    font-weight: normal;
    }

    table .service,
    table .desc {
    text-align: left;
    }

    table td {
    padding: 20px;
    text-align: right;
    }

    table td.service,
    table td.desc {
    vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
    font-size: 1.2em;
    }

    table td.grand {
    border-top: 1px solid #5D6975;;
    }

    #notices .notice {
    color: #5D6975;
    font-size: 1.2em;
    }

    footer {
    color: #5D6975;
    width: 100%;
    height: 30px;
    position: absolute;
    bottom: 0;
    border-top: 1px solid #C1CED9;
    padding: 8px 0;
    text-align: center;
    }
</style>
