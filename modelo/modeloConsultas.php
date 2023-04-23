<?php
class consultas extends bdconexion {
    public function select_grupos(){
        $sql = bdconexion::conexion()->prepare("SELECT * FROM Grupos;");
        $sql->execute();
        return $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar_grupo($programa, $periodo, $codigo, $nombre, $modalidad){
        $sql = bdconexion::conexion()->prepare("INSERT INTO Grupos (programa, periodo, codigo, nombre, modalidad) VALUES (".$programa.",".$periodo.",".$codigo.",".$nombre.",".$modalidad.")");
        if ($sql->execute()) {
            $resultado = self::select_grupos();
            return $resultado;
        }
    }

    public function select_estudiantes(){
        $sql = bdconexion::conexion()->prepare("SELECT * FROM Estudiantes;");
        $sql->execute();
        return $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar_estudiante($curso, $identificacion, $nombres, $apellidos, $correo){
        $sql = bdconexion::conexion()->prepare("INSERT INTO Estudiantes (curso, identificacion, nombres, apellidos, correo) VALUES (".$curso.",'".$identificacion."','".$nombres."','".$apellidos."','".$correo."')");
        if ($sql->execute()) {
            $resultado = self::select_estudiantes();
            return $resultado;
        }
    }

    public function select_gruEstudiante(){
        $sql = bdconexion::conexion()->prepare("SELECT g.programa, g.periodo, g.codigo, g.nombre, g.modalidad, e.identificacion, e.nombres, e.apellidos, e.correo, n.nota1, n.nota2, n.nota3 
        FROM Grupos g 
        JOIN Estudiantes e ON g.codigo = e.grupo_codigo 
        JOIN Notas n ON e.identificacion = n.estudiante_identificacion;");
        $sql->execute();
        return $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener_notasEstudiante($identificacion){
        $sql = bdconexion::conexion()->prepare("SELECT * FROM Notas WHERE estudiante_identificacion =".$identificacion.";");
        $sql->execute();
        return $notas = $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function obtener_notas(){
        $sql = bdconexion::conexion()->prepare("SELECT * FROM Notas");
        $sql->execute();
        return $notas = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar_notas($id_estudiante, $nota1, $nota2, $nota3){
        $sql = bdconexion::conexion()->prepare("SELECT identificacion FROM estudiantes WHERE identificacion =".$id_estudiante);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = bdconexion::conexion()->prepare("INSERT INTO Notas (estudiante_identificacion, nota1, nota2, nota3) VALUES ('".$id_estudiante."','".$nota1."','".$nota2."','".$nota3."')");
            if ($sql->execute()) {
                $resultado = self::obtener_notas();
                return $resultado;
            }
        }
    }

    public function actualizar_notas($id_nota, $nota1, $nota2, $nota3){
        $sql = bdconexion::conexion()->prepare("UPDATE Notas SET nota1=".$nota1.", nota2=".$nota2.", nota3=".$nota3." WHERE id=".$id_nota);
        $sql->execute();
    }

    public function calcular_nota($identificacion){
        $sql = bdconexion::conexion()->prepare("SELECT nota1, nota2, nota3 FROM Notas WHERE estudiante_identificacion =".$identificacion.";");
        $sql->execute();
        $notas = $sql->fetch(PDO::FETCH_ASSOC);
        $nota_final = ($notas['nota1'] * 0.3) + ($notas['nota2'] * 0.3) + ($notas['nota3'] * 0.4);
        return $nota_final = round($nota_final, 2);
    }
}
?>