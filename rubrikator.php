<?php
/*class stylist 09.04.2012 sqllite 2.8   update 05.03.2014*/


class createIMAGE{
//===================================================================
/*
Спецификация к классу createIMAGE v.1.01 _03.03.2009

$myIMG= new createIMAGE($tmpfoto, $XXX, $YYY, $lide_foto, $size_param);

	$tmpfoto - это загружаемое фото (тмп название, создается из $_FILES['photo']['tmp_name'])
	$XXX - ширина создаваемой фотографии
	$YYY - высота создаваемой фотографии
	$lide_foto - название создаваемой фотографии (т.е. куда нужно будет скинуть фотку)
	$size_param - параметры создаваемой фото:
		0 - фотка создается в прямоугольнике $XXX на $YYY - пустые поля заливаются белым цветом
		1 - фотка подгоняется под максимальный размер из XXX и YYY.
		2 - фотка создается в прямоугольнике $XXX на $YYY - обрезается если не влазиет 
*/
//========================================================
	var $tmpfoto, $XXX, $YYY, $lide_foto, $size_param;
//========================================================	
	var $im, $im_dst, $mX, $mY, $Xsmall, $Ysmall, $mKXzoom, $mKYzoom, $tmpmin, $microX, $microY, $ink, $aX, $aY;
//========================================================
	public function __construct($tmpfoto, $XXX, $YYY, $lide_foto, $size_param){
		$this->tmpfoto		= $tmpfoto;
		$this->XXX			= $XXX;
		$this->YYY			= $YYY;
		$this->lide_foto	= $lide_foto;
		$this->size_param	= $size_param;
		
		//$this->imgCREATOR();
	}
//========================================================
	public function imgCREATOR(){
		
				$this->im		= imageCreateFromJpeg($this->tmpfoto);
				$this->mX		= imageSx($this->im);
				$this->mY		= imageSy($this->im);
				
				$this->Xsmall	= $this->XXX;
				$this->Ysmall	= $this->YYY;
				
				
				
				
				if ($this->size_param==2){
				
				
				if ($this->mX/$this->mY>3){
					$this->mKXzoom= ceil($this->mX/$this->Xsmall)-1.5;//менее точно
					$this->mKYzoom= ceil($this->mY/$this->Ysmall)-1.5;
				}else{
					$this->mKXzoom= ceil($this->mX/$this->Xsmall)-1.5;//менее точно
					$this->mKYzoom= ceil($this->mY/$this->Ysmall)-1.5;
				}
				
				
				}else{
					$this->mKXzoom= $this->mX/$this->Xsmall;
					$this->mKYzoom= $this->mY/$this->Ysmall;
				}		
				
			
				
				$this->tmpmin=max($this->mKXzoom,$this->mKYzoom);
				
				if ($this->tmpmin<=0){$this->tmpmin=1;}
				$this->microX= $this->mX/$this->tmpmin;
				$this->microY= $this->mY/$this->tmpmin;
			
				$this->ink = imagecolorallocate($this->im, 255, 255, 255);
			
				if ($this->size_param==0){	
					$this->im_dst=imagecreatetruecolor($this->Xsmall,$this->Ysmall);
					imagefilledrectangle($this->im_dst,0,0,$this->Xsmall,$this->Ysmall,$this->ink);
					$this->aX=(-$this->microX+$this->Xsmall)/2;
					$this->aY=(-$this->microY+$this->Ysmall)/2;
				}
			
				if ($this->size_param==1){		
					$this->im_dst=imagecreatetruecolor($this->microX,$this->microY);
					imagefilledrectangle($this->im_dst,0,0,$this->microX,$this->microY,$this->ink);
					$this->aX=0;
					$this->aY=0;
				}		
			
			
				if ($this->size_param==2){	
					$this->im_dst=imagecreatetruecolor($this->Xsmall,$this->Ysmall);
					imagefilledrectangle($this->im_dst,0,0,$this->Xsmall,$this->Ysmall,$this->ink);
					$this->aX=(-$this->microX+$this->Xsmall)/2;
					$this->aY=(-$this->microY+$this->Ysmall)/2;
				}
			
			
				imagecopyresampled($this->im_dst,$this->im,$this->aX,$this->aY,0,0,$this->microX,$this->microY,$this->mX,$this->mY);
				imageJpeg($this->im_dst,$this->lide_foto,95);
				imageDestroy($this->im);
			}
			
			
	public function imgCREATORpng(){
		
				$this->im=imageCreateFromPng($this->tmpfoto);
				$this->mX=imageSx($this->im);
				$this->mY=imageSy($this->im);
				
				$this->Xsmall=$this->XXX;
				$this->Ysmall=$this->YYY;
				
				
				
				
				if ($this->size_param==2){
				
				
				if ($this->mX/$this->mY>3){
					$this->mKXzoom= ceil($this->mX/$this->Xsmall)-1.5;//менее точно
					$this->mKYzoom= ceil($this->mY/$this->Ysmall)-1.5;
				}else{
					$this->mKXzoom= ceil($this->mX/$this->Xsmall)-1.5;//менее точно
					$this->mKYzoom= ceil($this->mY/$this->Ysmall)-1.5;
				}
				
				
				}else{
					$this->mKXzoom= $this->mX/$this->Xsmall;
					$this->mKYzoom= $this->mY/$this->Ysmall;
				}		
				
			
				
				$this->tmpmin=max($this->mKXzoom,$this->mKYzoom);
				
				if ($this->tmpmin<=0){$this->tmpmin=1;}
				$this->microX= $this->mX/$this->tmpmin;
				$this->microY= $this->mY/$this->tmpmin;
			
				$this->ink = imagecolorallocate($this->im, 255, 255, 255);
			
				if ($this->size_param==0){	
					$this->im_dst=imagecreatetruecolor($this->Xsmall,$this->Ysmall);
					imagefilledrectangle($this->im_dst,0,0,$this->Xsmall,$this->Ysmall,$this->ink);
					$this->aX=(-$this->microX+$this->Xsmall)/2;
					$this->aY=(-$this->microY+$this->Ysmall)/2;
				}
			
				if ($this->size_param==1){		
					$this->im_dst=imagecreatetruecolor($this->microX,$this->microY);
					imagefilledrectangle($this->im_dst,0,0,$this->microX,$this->microY,$this->ink);
					$this->aX=0;
					$this->aY=0;
				}		
			
			
				if ($this->size_param==2){	
					$this->im_dst=imagecreatetruecolor($this->Xsmall,$this->Ysmall);
					imagefilledrectangle($this->im_dst,0,0,$this->Xsmall,$this->Ysmall,$this->ink);
					$this->aX=(-$this->microX+$this->Xsmall)/2;
					$this->aY=(-$this->microY+$this->Ysmall)/2;
				}
			
			
				imagecopyresampled($this->im_dst,$this->im,$this->aX,$this->aY,0,0,$this->microX,$this->microY,$this->mX,$this->mY);
				imageJpeg($this->im_dst,$this->lide_foto,95);
				imageDestroy($this->im);
			}			
			
//========================================================
}



//=================================================================================================
class rubrikator{
	var $mainpath, $mydbase, $mytable;
	var $result, $db, $totalrecs;
	var $side, $mover;
	
	var $row = array();
	
	var $id, $msgid, $active, $razdel, $mainrazdel, $opisanie, $itempix, $bann001, $bann002, $bann003;

####################################################################################

	public function moveRubrik($side, $mover){
		$this->side=$side;
		$this->mover=$mover;
		
		$this->initRubrik();

		$this->db->query("UPDATE ".$this->mytable." 
				SET 
					msgid		= '".$this->row[$this->mover+$this->side][msgid]."',
					active		= '".$this->row[$this->mover+$this->side][active]."',
					razdel		= '".$this->row[$this->mover+$this->side][razdel]."',
					mainrazdel	= '".$this->row[$this->mover+$this->side][mainrazdel]."', 
					opisanie	= '".$this->row[$this->mover+$this->side][opisanie]."',
					itempix		= '".$this->row[$this->mover+$this->side][itempix]."',
					bann001		= '".$this->row[$this->mover+$this->side][bann001]."',
					bann002		= '".$this->row[$this->mover+$this->side][bann002]."',
					bann003		= '".$this->row[$this->mover+$this->side][bann003]."'
				WHERE 
					".$this->mytable.".id='".$this->row[$this->mover][id]."';");

		$this->db->query("UPDATE ".$this->mytable." 
				SET 
					msgid		= '".$this->row[$this->mover][msgid]."',
					active		= '".$this->row[$this->mover][active]."',
					razdel		= '".$this->row[$this->mover][razdel]."',
					mainrazdel	= '".$this->row[$this->mover][mainrazdel]."', 
					opisanie	= '".$this->row[$this->mover][opisanie]."',
					itempix		= '".$this->row[$this->mover][itempix]."',
					bann001		= '".$this->row[$this->mover][bann001]."',
					bann002		= '".$this->row[$this->mover][bann002]."',
					bann003		= '".$this->row[$this->mover][bann003]."'
				WHERE 
					".$this->mytable.".id='".$this->row[$this->mover+$this->side][id]."';");
		
	}

####################################################################################
	
	public function __construct($mainpath, $mydbase, $mytable){
		$this->mainpath = $mainpath;
		$this->mydbase = $mydbase;
		$this->mytable = $mytable;	
	}	
	
	public function saveRubrik($id, $msgid, $active, $razdel, $mainrazdel,  $opisanie, $itempix, $bann001, $bann002, $bann003){
		$this->id 			= $id;
		$this->msgid 		= $msgid;
		$this->active 		= $active;
		$this->razdel 		= $razdel;
		
		$this->mainrazdel 	= $mainrazdel;
		$this->opisanie 	= $opisanie;
		
		$this->itempix 		= $itempix;
		
		$this->bann001 		= $bann001;
		$this->bann002 		= $bann002;
		$this->bann003 		= $bann003;
		
		$this->db   = new PDO('sqlite:../../'.$this->mainpath.'/'.$this->mydbase.'.db');
		$this->row	= $this->db->query("SELECT * FROM ".$this->mytable. " WHERE ".$this->mytable.".msgid=".$this->msgid.";")->fetchAll(PDO::FETCH_ASSOC);

		if ($this->row){
			
			
			$this->db->query("UPDATE ".$this->mytable." 
					SET 
						msgid		='".$this->msgid."',
						active		='".$this->active."',
						razdel		='".$this->razdel."',
						mainrazdel	='".$this->mainrazdel."', 
						opisanie	='".$this->opisanie."',
						itempix		='".$this->itempix."',
						bann001		='".$this->bann001."',
						bann002		='".$this->bann002."',
						bann003		='".$this->bann003."'
					WHERE 
						".$this->mytable.".msgid=".$this->msgid.";");

		}else{
			
			$this->db->query("INSERT INTO ".$this->mytable."(
																msgid,
																active,
																razdel,
																mainrazdel,
																opisanie,
																itempix,
																bann001,
																bann002,
																bann003
															) VALUES (
															   '".$this->msgid."', 
															   '".$this->active."', 
															   '".$this->razdel."',
															   '".$this->mainrazdel."', 
															   '".$this->opisanie."',
															   '".$this->itempix."',
															   '".$this->bann001."',
															   '".$this->bann002."',
															   '".$this->bann003."');");			

		}
		$this->closePG();
	}
	
	public function readRubrik($msgid){
		$this->msgid=$msgid;
		
		$this->db   = new PDO('sqlite:../../'.$this->mainpath.'/'.$this->mydbase.'.db');
		$this->row	= $this->db->query("SELECT * FROM ".$this->mytable. " WHERE ".$this->mytable.".msgid='".$this->msgid."';")->fetchAll(PDO::FETCH_ASSOC);
		
		$this->id			= $this->row[0][id];
		$this->msgid		= $this->row[0][msgid];
		$this->active		= $this->row[0][active];
		$this->razdel		= $this->row[0][razdel];
		$this->mainrazdel	= $this->row[0][mainrazdel];
		$this->opisanie		= $this->row[0][opisanie];
		$this->itempix		= $this->row[0][itempix];
		
		$this->bann001		= $this->row[0][bann001];
		$this->bann002		= $this->row[0][bann002];
		$this->bann003		= $this->row[0][bann003];	

	}
	
	public function initRubrik(){
		
		$this->db   = new PDO('sqlite:../../'.$this->mainpath.'/'.$this->mydbase.'.db');
		$this->row	= $this->db->query("SELECT * FROM ".$this->mytable." ORDER BY id DESC;")->fetchAll(PDO::FETCH_ASSOC);
		$this->totalrecs = count($this->row);
	}
	
	public function updateDelPhoto($msgid){
		$this->msgid=$msgid;
		
		$this->db   = new PDO('sqlite:../../'.$this->mainpath.'/'.$this->mydbase.'.db');
		$this->row	= $this->db->query("UPDATE ".$this->mytable." SET itempix='noimage.jpg' WHERE ".$this->mytable.".msgid=".$this->msgid.";");
		
		
		}
	
	
	
	public function delRubrik($msgid){
		$this->msgid=$msgid;
	
		$this->db   = new PDO('sqlite:../../'.$this->mainpath.'/'.$this->mydbase.'.db');
		$this->row	= $this->db->query("DELETE FROM ".$this->mytable." WHERE ".$this->mytable.".msgid='".$this->msgid."';");
			
	
	}
	
	private function closePG(){
		echo"<html>";
		echo"<head><title>...</title>";
		echo"<script languare='javascript'>";
		echo"top.opener.location.href = 'index.php'";
		echo"</script>";
		echo"</head>";
		echo"<body></body></html>";
		echo"<script languare='javascript'>";
		echo"window.close()";
		echo"</script>";
	}	
}
?>