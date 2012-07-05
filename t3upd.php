<?php
/* version 0.1
 * tom arnold
 * 2012-07-05
 * update script, um an hetzner ftp limits (no symlink per ftp etc) drumherum zu kommen.
 * aufrufen mit ?mode=fetch
 * = holt die src
 * ?mode=install
 * = kopiert die verzeichnisse und index.php aus der src in die root
 * (bloede hetzner no-symlink install)
 */

// hier eintragen:
// momentan installierte version
// $old = '4.6.4';
$old = '4.6.4';
// version, die installiert werden soll
//$new = '4.6.10';
$new = '4.6.10';
// ab hier nix mehr konfigurieren
/* -------------------------------------------- */
$new_src = 'typo3_src-'.$new.'.tar.gz';

if($_GET['mode'] =='fetch'){
	echo 'Start...';
	echo 'Neue src holen: '.$new_src.'... ';
	shell_exec('wget http://prdownloads.sourceforge.net/typo3/'.$new_src);
	echo 'entpacken...';
	shell_exec('tar xf '.$new_src);
	echo 'Done';
}
if($_GET['mode'] == 'install' ){
	echo 'Verzeichnisse verschieben... Start';
	echo 'Alte Verzeichnisse verschieben...';
	if( is_dir('./typo3') ){
		shell_exec('mv ./typo3 ./_'.$old.'-typo3');
	}
	if( is_dir('./t3lib') ){
		shell_exec('mv ./t3lib ./_'.$old.'-t3lib');
	}
	if( is_file('./index.php') ){
		shell_exec('mv ./index.php ./_'.$old.'-index.php');
	}
	echo 'Neue Verzeichnisse verschieben...';
	shell_exec('mv ./typo3_src-'.$new.'/typo3 ./typo3');
	shell_exec('mv ./typo3_src-'.$new.'/index.php ./index.php');
	shell_exec('mv ./typo3_src-'.$new.'/t3lib ./t3lib');
	echo 'Done';
}
?>
