
    function agregaform(datos) {
        d = datos.split('||');

        $('#idUsuario').val(d[0]);
        $('#Nombree').val(d[1]);
        $('#ApellidoPate').val(d[2]);
        $('#ApellidoMate').val(d[3]);
        $('#Usuarioe').val(d[4]);
        $('#Contraseniae').val(d[5]);
        $('#Perfile').val(d[7]);
    }

    function actualizaDatos(){


        id=$('#idpersona').val();
        nombre=$('#nombreu').val();
        apellido=$('#apellidou').val();
        email=$('#emailu').val();
        telefono=$('#telefonou').val();
    
        cadena= "id=" + id +
                "&nombre=" + nombre + 
                "&apellido=" + apellido +
                "&email=" + email +
                "&telefono=" + telefono;
    
        $.ajax({
            type:"POST",
            url:"php/actualizaDatos.php",
            data:cadena,
            success:function(r){
                
                if(r==1){
                    $('#tabla').load('componentes/tabla.php');
                    alertify.success("Actualizado con exito :)");
                }else{
                    alertify.error("Fallo el servidor :(");
                }
            }
        });
    
    }