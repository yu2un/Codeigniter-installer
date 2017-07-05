<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Install Codeigniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $url ?>assets/install/css/jquery.steps.css">
    <link rel="stylesheet" href="<?php echo $url ?>assets/install/css/install.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  </head>
  <body class="">
    <h1>CodeIgniter - Instal Wizzard</h1>
    <form id="install-ci" action="" method="post">
        <h3>Site Settings</h3>
        <fieldset class="site-settings">
            <legend>Site Settings</legend>

            <label for="base_url">Base Url</label>
            <input id="base_url" name="base_url" type="text" value="<?php echo $url; ?>" class="required">

        </fieldset>

        <h3>Database</h3>
        <fieldset class="site-settings">
            <legend>Database</legend>

            <label for="server">Hostname</label>
            <input id="server" name="hostname" value="localhost" type="text" class="required">
            <label for="dbname">Database Name</label>
            <input id="dbname" name="database" type="text" class="required" >
            <label for="dbuser">Database User</label>
            <input id="dbuser" name="username" type="text" class="required" >
            <label for="dbpass">Database Password</label>
            <input id="dbpass" name="password" type="password" class="required" >

            <input type="button" id="test" value="Test Database">
        </fieldset>

    </form>
    <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>
    <script src="<?php echo $url."assets/install/js/jquery.steps.js" ?>"></script>
    <script src="<?php echo $url."assets/install/js/jquery.steps.min.js" ?>"></script>
    <script src="<?php echo $url."assets/install/js/install.js" ?>"></script>


  </body>
</html>
