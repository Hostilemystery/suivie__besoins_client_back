<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
        table, td, th {
         border: 1px solid;
        }
        table {
            border-collapse: collapse;
        }
    </style>
  </head>
  <body>
    <header>
        <div style="display: flex; margin-left: 10%; padding-top:20px;">
            <img src="<?php echo $pic ?>" alt="" style="border-radius: 50%; height:120px; float: left;">
            <div style="margin-left: 50px; border-left: groove; padding-left: 10px;" >
                <p>N°:M0118126758852</p>
                <p>RCCM:RC/YAE/2018/B/444</p>
                <p>B.P : 13295 YAOUNDE-CAMEROUN</p>
            </div>
        </div>
    </header>
    <br>
    <br>
    <h1 style="font-size:xx-large; text-align: center;" >Liste des Clients</h1>
    <div style="text-align:center; ">
        <table class="table table-bordered" style="margin-left:auto;margin-right:auto;width:100%">
            <thead>
              <tr>
                <td><b>Name</b></td>
                <td><b>Email</b></td>
                <td><b>Service Name</b></td>
              </tr>
              </thead>
              <tbody>
              @foreach ($client as $c )
              <tr>
                <td>
                  {{ $c->name}}
                </td>
                <td>
                  {{$c->email}}
                </td>
                <td>
                  {{$c->Service_Name}}
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>

    </div>
    <footer style=" text-align:center;position: absolute; bottom: 0;left: 0; right: 0;background: #111;height: auto;color: #fff;">
        <p>Tous droits réservés. La copie de tout ou partie de ce document et l'exploitation ou la communication des informations qu'il contient sont interdites sans l'autorisation écrite de Life is Simple SARL</p>
    </footer>

  </body>
</html>
