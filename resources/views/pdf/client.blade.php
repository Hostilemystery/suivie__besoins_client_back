<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
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
    <h1 style="font-size:xx-large; text-align: center;" >Info sur le client</h1>
    <div style="margin-left:80px; ">

              @foreach ($clien as $c )
              <ul>
                <li><strong>Noms :</strong>{{ $c['name']}}</li>
                <li><strong>Email :</strong>{{$c['email']}}</li>
                <li><strong>Numero :</strong>{{$c['number']}}</li>
                <li><strong>Quartier :</strong>{{$c['neighborhood']}}</li>
                <li><strong>Service :</strong>{{$c['Service_Name']}}</li>
                <li><strong>Detaille du service :</strong>{{$c['detaille_service']}}</li>
              </ul>

              @endforeach


    </div>
    <footer style=" text-align:center;position: absolute; bottom: 0;left: 0; right: 0;background: #111;height: auto;color: #fff;    ">
        <p>Tous droits réservés. La copie de tout ou partie de ce document et l'exploitation ou la communication des informations qu'il contient sont interdites sans l'autorisation écrite de Life is Simple SARL</p>
    </footer>

  </body>
</html>
