<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script defer src="<?php echo base_url('assets/js/fontawesome/js/solid.js') ?>"></script>
    <script defer src="<?php echo base_url('assets/js/fontawesome/js/fontawesome.js') ?>"></script>

    <!-- Custom Style -->
    <link href="<?php echo base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>
<body>

<div class="container" style="margin-top:50px">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="card">
                <h5 class="row card-header info-color white-text py-4">
                    <div class="col-6 col-md-4">
                        <a href="<?php echo base_url() ?>" role="button" class="btn btn-outline-dark float-left">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="col-6 col-md-4">
                        <strong>Médico</strong>
                    </div>
                    <?php $id_doctor = isset($doctor->crm) ? $doctor->crm : ''; ?>
                    <div class="col-6 col-md-4">
                        <button type="submit" form="docform" class="btn btn-outline-success float-right">
                            <i class="fas fa-save"></i>
                        </button>
                        <?php if(isset($doctor)): ?>
                        <a href="<?php echo base_url('doctor/delete/').$id_doctor ?>" role="button" class="btn btn-outline-danger float-right" style="margin-right:10px">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </h5>
                <div class="card-body px-lg-5 pt-0">

                    <!-- Default form register -->
                     <form action="save" class="text-center border border-light p-5" id="docform" method="post" accept-charset="utf-8">

                        <div class="form-row mb-4">
                            <div class="col-md-3">
                                <!-- CRM -->
                                <?php 
                                $data = array(
                                    'name'          => 'crm',
                                    'id'            => 'crm',
                                    'placeholder'   => 'CRM',
                                    'class'         => 'form-control needs-validation',
                                    'required'      => 'true'
                                );
                                if($action != "new"){
                                    $isDisabled = array('disabled' => 'true');
                                    echo form_hidden('crm', $doctor->crm);
                                }else{
                                    $isDisabled = array();
                                }
                                
                                echo form_input(array_merge($data, $isDisabled), isset($doctor->crm) ? $doctor->crm : set_value('crm')); 
                                ?>
                                <small class="form-text text-muted mb-12 invalid">
                                    <?php  echo isset($error) ? $error : '';?>
                                </small>
                            </div>
                            <div class="col">
                                <!-- Name -->
                                <?php 
                                $data = array(
                                    'name'          => 'name',
                                    'id'            => 'name',
                                    'placeholder'   => 'Nome Completo',
                                    'class'         => 'form-control',
                                    'required'      => 'true'
                                );
                                echo form_input($data, isset($doctor->name) ? $doctor->name : set_value('name')); 
                                ?>
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col">
                                <!-- Phone -->
                                <?php 
                                $data = array(
                                    'name'          => 'phone',
                                    'id'            => 'phone',
                                    'placeholder'   => 'Telefone',
                                    'class'         => 'form-control',
                                    'required'      => 'true'
                                );
                                echo form_input($data, isset($doctor->phone) ? $doctor->phone : set_value('phone')); 
                                ?>
                            </div>
                            <div class="col">
                                <!-- State -->
                                <?php 
                                $data = array(
                                    'name'          => 'uf',
                                    'id'            => 'uf',
                                    'class'         => 'form-control',
                                    'disabled'      => 'true',
                                    'data-target'   => '#cidade',
                                    'required'      => 'true',
                                    'meta-uf'       => isset($doctor->state) ? $doctor->state : set_value('uf')
                                );
                                echo form_dropdown($data); 
                                ?>
                            </div>
                            <div class="col">
                                <!-- City -->
                                <?php 
                                $data = array(
                                    'name'          => 'cidade',
                                    'id'            => 'cidade',
                                    'class'         => 'form-control',
                                    'disabled'      => 'true',
                                    'required'      => 'true',
                                    'meta-city'     => isset($doctor->city) ? $doctor->city : set_value('cidade')
                                );
                                
                                echo form_dropdown($data, 'Cidade'); 
                                ?>
                            </div>
                        </div>
                        
                        <!-- Especialidades -->
                        <div class="form-row">
                            <label class="form-row">Especialidades</label>
                        </div>
                        <div class="form-row">
                            <?php 

                            foreach($specialties->result() as $spec): 

                                $isSpec = FALSE;
                                if(isset($doctorSpecialty)){
                                    foreach($doctorSpecialty->result() as $specDoc){
                                        if ($spec->id_specialty == $specDoc->id_specialty){ $isSpec=TRUE; }
                                    }
                                }

                                ?>
                                <div class="col-4" style="margin-bottom:10px">
                                    <div class="custom-control custom-checkbox">
                                        <?php echo form_checkbox('specialty[]', $spec->id_specialty, $isSpec, 'class="custom-control-input check" id="spec-'.$spec->id_specialty.'"'); ?>
                                        <label class="custom-control-label" for="spec-<?php echo $spec->id_specialty ?>"><?php echo $spec->specialty ?></label>
                                    </div> 
                                </div>

                            <?php endforeach;
                            echo form_hidden('action', $action);
                            ?>

                        </div>
                        <div class="form-row">
                            <small class="form-text text-muted mb-12" id="check_valid">
                                * Selecione no minimo duas especialidades
                            </small>
                        </div>
                        </form>
                    </form>
                    <!-- Default form register -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>

</body>
</html>

<script>        
$(document).ready(function(){
    setBaseUrl('<?php echo base_url() ?>');
    loadStatesCity();

    $('#phone').mask('(00) 0000-0000');
    $('#crm').mask('00000');

    $( "#docform" ).submit(function( event ) {
        if(contCheckbox() <= 1){
            event.preventDefault();
            $('#check_valid').addClass("invalid");
        }
    });
   
});
</script>