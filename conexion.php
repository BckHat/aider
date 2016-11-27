<?php 
	date_default_timezone_set('America/El_Salvador');
	class mysql{
		public function extern(){
			$datos = array(
					'l' => 'localhost',
					'u' => 'root',
					'p' => '',
					'db' => 'myreader',
					'usernameWeb' => 'BtooomScan',
					'link' => "localhost/readerx"
				);
			return $datos;
		}
		public function alert($message){
			print "<script>alert('".$message."')</script>";
		}
		public function gId(){
			$num = 0;
			for($i = 1; $i <= 7; $i++){
				if($i == 1) $num .= rand(1,9);
				else $num .= rand(0,9);
			}
			return $num;
		}
		public function ir($destino){
			print "<script>location.href='".$destino."'</script>";
		}
		public function extension($NameImg){
			$num = strlen($NameImg);
			for($l = $num - 4;$l <= $num; $l++){
			    $R .= $NameImg[$l];
			}
			return $R;
		}
		public function carpetaLeer($zip){
			$num = strlen($zip);
			for($l = 0;$l < ($num - 4); $l++){
			    $R .= $zip[$l];
			}
			return $R;
		}
		public function noHash($code){
			$string = strlen($code);
			$nString = '';
			for($i = 1; $i <= $string; $i++){
				$nString .= $code[$i];
			}
			return $nString;
		}
		public function infoManga($id){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM mangas");
			while($dd = mysqli_fetch_array($result)){
				if($id == md5($dd['id'])){
					$data = array(
							'ido' => $dd['id'],
							'name' => $dd['nombre_capitulo'],
							'num' => $dd['numero_capitulo'],
							'zip' => $dd['nombre'],
							'pags' => $dd['num_pags'],
							'des' => $dd['carpeta_desempaque'],
							'ext' => $dd['extension'],
							'user' => $dd['user'],
							'vistas' => $dd['vistas'],
							'link' => $dd['link_descarga'],
							'uploader' => $dd['subidor_staff'],
							'nott' => $dd['notas'],
							'jt' => $dd['joint'],
							'fecha' => $dd['fecha_subida']
						);
					break;
				}
			}
			mysqli_close($cc);
			return $data;
		}
		public function infoUser($id){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM usuarios");
			while($dd = mysqli_fetch_array($result)){
				if($id == $dd['user']){
					$data = array(
							'id' => $dd['id'],
							'user' => $dd['user'],
							'pass' => $dd['pass'],
							'carpeta' => $dd['carpeta']
						);
					break;
				}
			}
			mysqli_close($cc);
			return $data;
		}
		public function infoM($id){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM manga");
			while($dd = mysqli_fetch_array($result)){
				if($id == $dd['nombre']){
					$data = array(
							'id' => $dd['id'],
							'name' => $dd['nombre'],
							'dir' => $dd['dir_imagen_referencia'],
							'desc' => $dd['descripcion'],
							'user' => $dd['user_perteneciente'],
							'generos' => $dd['generos'],
							'estado' => $dd['estado']
						);
					break;
				}
			}
			mysqli_close($cc);
			return $data;
		}
		public function Preferencias($id){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM preferencias");
			if(self::NumRow('preferencias') >= 1 && self::ExistUser($id) == 1){
				while($dd = mysqli_fetch_array($result)){
					if($id == $dd['id']){
						$data = array(
								'id' => $dd['id'],
								'color' => $dd['color'],
								'descrip' => $dd['descripcion'],
								'dirImage' => $dd['dir_image'],
								'lecSec' => $dd['lector_secun'],
								'descarga' => $dd['descarga'],
								'contacto' => $dd['contactanos_fb'],
								'web' => $dd['paginaweb']
							);
						break;
					}
				}
			}else return 0;
			mysqli_close($cc);
			return $data;
		}
		public function existManga($id){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM mangas");
			while($dd = mysqli_fetch_array($result)){
				if($id == md5($dd['id'])) return 1;
			}
			mysqli_close($cc);
			return 0;
		}
		public function User($id){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM usuarios");
			while($dd = mysqli_fetch_array($result)){
				if($id == md5($dd['id'])) return 1;
			}
			mysqli_close($cc);
			return 0;
		}
		public function existManga2($name){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM manga");
			while($dd = mysqli_fetch_array($result)){
				if($name == $dd['nombre']) return 1;
			}
			mysqli_close($cc);
			return 0;
		}
		public function NumRow($tabla){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$i = 0;
			$result = mysqli_query($cc, "SELECT * FROM $tabla");
			while($dd = mysqli_fetch_array($result)) $i++;
			mysqli_close($cc);
			return $i;
		}
		public function ExistUser($user){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$i = 0;
			$result = mysqli_query($cc, "SELECT * FROM preferencias WHERE id = '$user'");
			while($dd = mysqli_fetch_array($result)) $i++;
			mysqli_close($cc);
			return $i;
		}
		public function ExistUser2($user){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM preferencias WHERE id = '$user'");
			while($dd = mysqli_fetch_array($result)) return 1;
			mysqli_close($cc);
			return 0;
		}
		public function Listar($num){
			if($num < 10) return "00$num";
			elseif($num < 100) return "0$num";
			elseif($num >= 100) return "$num";
		}
		public function SinEspacios($string){
			$cont = strlen($string);
			$SinS = '';
			for($e = 0; $e <= $cont; $e++){
				if($string[$e] != ' ') $SinS .= $string[$e];
			}
			return $SinS;
		}
		public function AcortarTexto($string, $numeropermitido){
			$newString = '';
			$n = strlen($string);
			if($n > $numeropermitido){
				for($r = 0; $r <= $numeropermitido; $r++) $newString .= $string[$r];
				$newString .= '...';
			}else $newString = $string;
			return $newString;
		}
		public function colors($num){
			switch($num){
				case 0:
					return 'lightblue';
				break;
				case 2:
					return 'lightskyblue';
				break;
				case 3:
					return 'lightgreen';
				break;
				case 4:
					return 'lightgray';
				break;	
			default:
				return 'white';
			}
		}
		public function ExitsSigCap($numCapActual, $nombreCap){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM mangas WHERE nombre_capitulo = '$nombreCap' AND numero_capitulo > $numCapActual ORDER BY numero_capitulo ASC");
			while($Y = mysqli_fetch_array($result)) {
				if(self::VerFecha($Y['fecha_subida'])) return $Y['id'];
			}
			mysqli_close($cc);
			return 0;
		}
		public function ExitsAntCap($numCapActual, $nombreCap){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM mangas WHERE nombre_capitulo = '$nombreCap' AND numero_capitulo < $numCapActual ORDER BY numero_capitulo DESC");
			while($Y = mysqli_fetch_array($result)) {
				if(self::VerFecha($Y['fecha_subida'])) return $Y['id'];
			} 
			mysqli_close($cc);
			return 0;
		}
		public function CO__($id){
			$conex2 = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($conex2, "SELECT * FROM mangas WHERE id = $id");
			$vd = 0;
			while($U = mysqli_fetch_array($result)){
				if($U['id'] == $id){
					$vd = 1;
					$link = $U['id'];
					break;
				}
			}
			mysqli_close($conex2);
			if($vd) return md5($link);
			else return 0;
		}
		public function Limpiar($string){
			$nuevo = $string;
			for($e = 0;$e <= 10; $e++){
				$nuevo = strip_tags($nuevo);
			}
			return $nuevo;
		}
		public function Vista($idCap){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			mysqli_query($cc, "UPDATE mangas SET vistas = vistas + 1 WHERE id = $idCap");
			mysqli_close($cc);
			return;
		}
		
		public function ActalizarVistas($nombre){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$t = mysqli_query($cc, "SELECT SUM(vistas) FROM mangas WHERE nombre_capitulo = '$nombre'");
			$T = mysqli_fetch_array($t);
			$Num = $T[0];
			mysqli_query($cc, "UPDATE manga SET vistas_totales = $Num WHERE nombre = '$nombre'");
			mysqli_close($cc);
			return;
		}
		public function status($statu){
			switch($statu){
				case 'Activo':
					return '<label style="color:green;">Activo</label>';
				break;
				case 'Pausado':
					return '<label style="color:orange;">Pausado</label>';
				break;
				case 'Abandonado':
					return '<label style="color:red;">Abandonado</label>';
				break;
				case 'Finalizado':
					return '<label style="color:blue;">Finalizado</label>';
				break;
			}
		}
		/*		
					0 1 2 3 4 5 6 7 8 9 
					a b c d e f g h i j
					K L M N O P Q R S T
					t s r q p o n m l k
					J I H G F E D C B A
											
		*/
		public function _code__($R){
			$E = "$R";
			$Code = "";
			for($j=0;$j<=(strlen($E) - 1);$j++){
				$g = rand(1,4);
				switch($E[$j]){
					case '0':
						switch($g){
							case 1: $Code .= 'a'; break;
							case 2: $Code .= 'K'; break;
							case 3: $Code .= 't'; break;
							case 4: $Code .= 'J'; break;
						}
					break;
					case '1':
						switch($g){
							case 1: $Code .= 'b'; break;
							case 2: $Code .= 'L'; break;
							case 3: $Code .= 's'; break;
							case 4: $Code .= 'I'; break;
						}
					break;
					case '2':
						switch($g){
							case 1: $Code .= 'c'; break;
							case 2: $Code .= 'M'; break;
							case 3: $Code .= 'r'; break;
							case 4: $Code .= 'H'; break;
						}
					break;
					case '3':
						switch($g){
							case 1: $Code .= 'd'; break;
							case 2: $Code .= 'N'; break;
							case 3: $Code .= 'q'; break;
							case 4: $Code .= 'G'; break;
						}
					break;
					case '4':
						switch($g){
							case 1: $Code .= 'e'; break;
							case 2: $Code .= 'O'; break;
							case 3: $Code .= 'p'; break;
							case 4: $Code .= 'F'; break;
						}
					break;
					case '5':
						switch($g){
							case 1: $Code .= 'f'; break;
							case 2: $Code .= 'P'; break;
							case 3: $Code .= 'o'; break;
							case 4: $Code .= 'E'; break;
						}
					break;
					case '6':
						switch($g){
							case 1:
								$Code .= 'g';
							break;
							case 2:
								$Code .= 'Q';
							break;
							case 3:
								$Code .= 'n';
							break;
							case 4:
								$Code .= 'D';
							break;
						}
					break;
					case '7':
						switch($g){
							case 1:
								$Code .= 'h';
							break;
							case 2:
								$Code .= 'R';
							break;
							case 3:
								$Code .= 'm';
							break;
							case 4:
								$Code .= 'C';
							break;
						}
					break;
					case '8':
						switch($g){
							case 1:
								$Code .= 'i';
							break;
							case 2:
								$Code .= 'S';
							break;
							case 3:
								$Code .= 'l';
							break;
							case 4:
								$Code .= 'B';
							break;
						}
					break;
					case '9':
						switch($g){
							case 1:
								$Code .= 'k';
							break;
							case 2:
								$Code .= 'T';
							break;
							case 3:
								$Code .= 'k';
							break;
							case 4:
								$Code .= 'A';
							break;
						}
					break;
				}
			}
			return $Code;
		}
		public function _decode__($Code){
			if(!is_numeric($Code)){
				$Code = trim($Code);
				$Code = self::Limpiar($Code);
				$Renew = '';
				for($i=0;$i<=strlen($Code);$i++){
					switch($Code[$i]){
						case 'a':case 'K':case 't':case 'J': 
							$Renew .= '0';
						break;
						case 'b':case 'L':case 's':case 'I': 
							$Renew .= '1';
						break;
						case 'c':case 'M':case 'r':case 'H': 
							$Renew .= '2';
						break;
						case 'd':case 'N':case 'q':case 'G': 
							$Renew .= '3';
						break;
						case 'e':case 'O':case 'p':case 'F': 
							$Renew .= '4';
						break;
						case 'f':case 'P':case 'o':case 'E': 
							$Renew .= '5';
						break;
						case 'g':case 'Q':case 'n':case 'D': 
							$Renew .= '6';
						break;
						case 'h':case 'R':case 'm':case 'C': 
							$Renew .= '7';
						break;
						case 'i':case 'S':case 'l':case 'B': 
							$Renew .= '8';
						break;
						case 'j':case 'T':case 'k':case 'A': 
							$Renew .= '9';
						break;
					}
				}
				return $Renew;
			}else return '*';
		}
		public function onAlert($alert,$status,$redir){
			switch($status){
				case 'ERROR':
					print '<div class="autoAlert" style="display:inline;">
						<h2>Vaya problema :-(</h2>
						<br>
						<label>'.$alert.'</label><br>
						<br><br>
						<a style="color: lightblue; text-decoration: none; font-size: .8em; position: absolute; bottom: 20px; right: 15px; cursor: pointer; font-family:AiderTitles;" class="allt" onclick="location.href=\''.$redir.'\'">ACEPTAR</a>
					</div>';
				break;
				case 'SUCCESS':
					print '<div class="autoAlert" style="display:inline;">
						<h2>Perfecto :-)</h2>
						<br>
						<label>'.$alert.'</label><br>
						<br><br>
						<a style="color: lightblue; text-decoration: none; font-size: .8em; position: absolute; bottom: 20px; right: 15px; cursor: pointer; font-family:AiderTitles;" class="allt" onclick="location.href=\''.$redir.'\'">ACEPTAR</a>
					</div>';
				break;
			}
		}
		public function ConteoVistas($nombreManga){
			$cc = mysqli_connect(self::extern()['l'],self::extern()['u'],self::extern()['p'],self::extern()['db']);
			$result = mysqli_query($cc, "SELECT * FROM mangas");
			$Num = 0;
			while($b = mysqli_fetch_array($result)) if($b['nombre_capitulo'] == $nombreManga) $Num += $b['vistas'];
			mysqli_close($cc);
			return $Num;
		}
		public function VerFecha($fecha){
			$now = explode('-', date('d-m-Y'));
			$fecha = explode('-', $fecha);
			if(GregorianToJD($fecha[1], $fecha[0], $fecha[2]) <= GregorianToJD($now[1], $now[0], $now[2])) return 1;
			else return 0;
		}
	}

 ?>
