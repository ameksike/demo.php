<?php include "src/Server.php"; ?>
<html>
	<head>
 		<TITLE>Mapscript Example</TITLE>
 	</head>

	<body>
		<CENTER><FORM METHOD=POST ACTION='' >
			<TABLE>
				<TR>
					<TD> <INPUT TYPE=IMAGE NAME="mapa" SRC="<?php echo "./".$URL; ?>"> </TD>
				</TR>
				<TR>
					<TD> <b> Pan: ------------------------------------------------> </b> </TD>
					<TD> <INPUT TYPE=RADIO name='action' value="0" CHECKED > </TD>
				</TR>
				<TR>
					<TD> <b>Zoom In: ---------------------------------------------></b></TD>
					<TD> <INPUT TYPE=RADIO name='action' value="1" > </TD>
				</TR>
				<TR>
					<TD> <b>Zoom Out: --------------------------------------------></b></TD>
					<TD> <INPUT TYPE=RADIO name='action' value="-1"> </TD>
				</TR>
				<TR>
					<TD> <b>Zoom Size: -------------------------------------------></b></TD> 
					<TD> .....<INPUT TYPE=TEXT name="factor" SIZE=2 value='3'> </TD>
	 			</TR>
	 			<TR>
					<TD> <b>Full Extent: ----------------------------------------></b></TD>
					<TD> .....<INPUT TYPE=SUBMIT name="full" value="Do" SIZE=2> </TD>
				</TR>

	 			<TR>
					<TD> <b>Query:</b> <?php if(isset($data)) echo '<pre>'; print_r( $data ); echo '</pre>'?></TD>
					<TD>    <INPUT TYPE=RADIO name='action' value="q" > 
						<INPUT TYPE=TEXT name="query" value="puentes" SIZE=2>
					</TD>
				</TR>

	 			<TR>
					<TD> <b>Information: </b> <?php echo '<pre>'; print_r( $inf ); echo '</pre>';?> </TD>
				</TR>

	 		</TABLE>
 			<INPUT TYPE=HIDDEN NAME="extent" VALUE='<?php echo $extent ?>'>
 		</FORM></CENTER>
	</body>
</html>
