<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8" />
    <style type="text/css">
      @font-face {
        font-family: 'Conv_manteka';
        src: url('fonts/manteka.eot');
        src: local('☺'), url('fonts/manteka.woff') format('woff'), url('fonts/manteka.ttf') format('truetype'), url('fonts/manteka.svg') format('svg');
        font-weight: normal;
        font-style: normal;
      }

      body {
        font-family: Conv_manteka;
        font-size: 14pt;
      }

      .contenu {
        width: 700px;
        height: 300px;
        margin: 100px auto;
      }

      table {
        width: 100%;
        height: 100%;
        border: 1px solid black;
        border-spacing: 0;
        border-collapse: collapse;
      }

      td {
        background-color: lightGray;
        padding: 0;
      }

      .header {
        background-color: white;
        height: 50px;
      }

      .header td {
        background-color: white;
        height: 75px;
      }

      .logo {
        width: 150px;
        height: 150px;
        background: white url("images/logo.png") no-repeat center;
      }

      .logo-text {
        background: white url("images/logo_text.png") no-repeat center;
      }

      .deco-1 {
        width: 75px;
        height: 75px;
        background: lightGray url("images/deco1.png") no-repeat center;
      }

      .reglage {
        width: 255px;
        text-align: center;
      }

      .qrcode {
        width: 200px;
        text-align: center;
      }

      .qrcode img {
        height: 200px;
      }

      .data {
        height: 50px;
        padding-left: 20px;
      }

      .titre {
        font-size: 18pt;
        font-weight: bold;
      }

      .infos {
        text-align: center;
        font-style: italic;
      }

      .mini {
        font-size: 10pt;
      }

      .purple {
        color: #412c79;
      }
    </style>
  </head>
  <body>

    <div id="ticket" class="contenu">
      <table>
        <tr class="header">
          <td rowspan="2" class="logo">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="3" class="logo-text">&nbsp;</td>
        </tr>
        <tr>
          <td class="deco-1">&nbsp;</td>
          <td class="reglage">Du 6 au 8 Mai 2016</td>
          <td rowspan="4" colspan="2" class="qrcode">
            <img src="data:image/png;base64, {$qr_code}" alt="QR Code FestiGeek" />
          </td>
        </tr>
        <tr>
          <td colspan="3" class="data titre">
            <span class="purple">E</span>ntree <span class="purple">u</span>nique <span class="purple">L</span>AN <span class="purple">2</span>016
          </td>
        </tr>
        <tr>
          <td colspan="3" class="data">
            {$pseudo} <span class="mini">({$mail})</span></td>
          </td>
        </tr>
        <tr>
          <td colspan="3" class="data infos mini">
            Commande No. {$no_commande}
          </td>
        </tr>
      </table>
    </div>

    <div id="infos" class="contenu">
      Code d'acces au reseau de la LAN : {$ad_password}
    </div>
  </body>
</html>