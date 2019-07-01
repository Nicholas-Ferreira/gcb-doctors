<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Custom Style -->
    <link href="<?php echo base_url('assets/css/main.css') ?>" rel="stylesheet">

</head>
<body>

<div class="container" style="margin-top:50px">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="card">
                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Dashboard</strong>
                </h5>
                <div class="card-body px-lg-5 pt-0">
                    <div class="row" style="padding-top:10px;padding-bottom:10px">
                        <div class="col-auto mr-auto">
                            <input id="search_text" name="search_text" type="text" class="form-control"  placeholder="Pesquisar...">
                        </div>
                        <div class="col-auto">
                            <a href="<?php echo base_url('doctor/new') ?>" role="button" class="btn btn-outline-success float-right">Novo</a>
                        </div>
                    </div>
                    <div class="row" id='table'>
                        Carregando...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>

</body>
</html>

<script>        
$(document).ready(function(){
    setBaseUrl('<?php echo base_url() ?>');
    load_data();
});
</script>