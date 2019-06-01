<?php 
require ("Conexion.php");


if ($_POST['id']) { 
    $idusuario=$_POST['id'];
    $sql= $pdo->prepare("SELECT * FROM usuario WHERE IdUsuario= $idusuario");
    $sql->execute();

    if ($result = $sql->fetch()) {?>
    <form id="editarusuario" class="dropzone dropzone-custom needsclick add-professors">
        <input type="hidden" name="IdUsuario" value="<?php echo $idusuario ?>">
        <div class="row">
            <!-- Apellido Paterno -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="login2">Apellido Paterno</label>
                    <input name="ApellidoPatu" id="ApellidoPatu" type="text" class="form-control"
                        placeholder="Apellido Paterno" value="<?php echo $result['ApellidoPaterno'];?>" required />
                </div>
            </div>

            <!-- Apellido Materno -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="login2">Apellido Materno</label>
                    <input name="ApellidoMatu" id="ApellidoMatu" type="text" class="form-control"
                        placeholder="Apellido Materno" value="<?php echo $result['ApellidoMaterno'];?>" required />
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Nombres -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="login2">Nombre (s)</label>
                    <input name="Nombreu" id="Nombreu" type="text" class="form-control" placeholder="Nombre (s)"
                        value="<?php echo $result['Nombres'];?>" required />
                </div>
            </div>

            <!-- Select Perfil -->
            <?php 
                $sql= $pdo->prepare("SELECT IdPerfil, Perfil FROM perfil ORDER BY IdPerfil");
                $sql->execute();
                $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
            ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="login2">Perfil</label>
                    <select name="Perfilu" id="Pefilu" class="form-control">
                        <?php
                        foreach ($resultado as $dato) { ?>
                        <option value="<?php echo $dato['IdPerfil']; ?>" selected>
                            <?php echo $dato['Perfil']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Usuario -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="login2">Nombre de Usuario</label>
                    <input name="Usuariou" id="Usuariou" type="text" class="form-control" placeholder="Usuario"
                        value="<?php echo $result['Usuario'];?>" required />
                </div>
            </div>

            <!-- Contraseña -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="login2">Contraseña</label>
                    <input name="Contraseniau" id="Contraseniau" type="text" class="form-control" placeholder="Contraseña"
                        value="<?php echo $result['Contrasenia'];?>" required />
                </div>
            </div>
        </div>
        <br>
        <button type="button" class="btn btn-custon-rounded-two btn-danger" data-dismiss="modal">
            <i class="fa fa-times edu-danger-error" aria-hidden="true"></i>
            Cancelar
        </button>
        <!-- <a data-dismiss="modal" href="#">Cancel</a> -->
        <button type="submit" id="Actualizar" class="btn btn-custon-rounded-two btn-success">
            <i class="fa fa-check edu-checked-pro" aria-hidden="true"></i>
            Actualizar
        </button>
    </form>

    <?php }

}
?>
