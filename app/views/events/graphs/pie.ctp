<?php // content="text/plain; charset=utf-8"
//require_once ('jpgraph/jpgraph.php');
//require_once ('jpgraph/jpgraph_line.php');
App::import('Vendor', 'jpgraph');
App::import('Vendor', 'jpgraph_pie');
App::import('Vendor', 'jpgraph_pie3d');

// Create the Pie Graph.
$graph = new PieGraph(350,250);


$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set(__('Estadistica de ventas', true));
$graph->legend->SetPos(0.5,0.97, 'center', 'bottom');
$graph->legend->SetColumns(2);

// Create
$p1 = new PiePlot3D($data);
$p1->SetLegends(array('Libres (%1.1f%%)', 'Vendidas (%1.1f%%)'));


$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->ExplodeSlice(1);
$graph->Stroke();
?>
