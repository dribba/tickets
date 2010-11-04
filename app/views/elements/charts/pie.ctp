<?php

App::import('Vendor', 'jpgraph');
App::import('Vendor', 'jpgraph_pie');
App::import('Vendor', 'jpgraph_pie3d');

// Create the Pie Graph.
$graph = new PieGraph($data['width'], $data['height']);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set($data['title']);
$graph->legend->SetPos(0.5, 0.97, 'center', 'bottom');
$graph->legend->SetColumns(2);

// Create
$p1 = new PiePlot3D($data['data']);
$p1->SetLegends($data['legends']);


$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->ExplodeSlice(1);
$graph->Stroke();