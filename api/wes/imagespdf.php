<?php

$getimagesize = 0;
$limit = 1000;
if (isset($_GET['limit'])) {
    $limit =   $_GET['limit'];
}

$data = search_data_main($_GET['genrate_pdf'], $limit);

if ($data) {
    $count = count($data) - 1;
    $size = attachment_size($data) / (1024 * 1024);
    if ($size > 20) {
        die("Error: Attachment limit is 20 MB Please remove file ");
    }
} else {
    die("Error: No Results Found ");
}

require_once("fpdf.php");
class hellopdf extends fpdf
{
    protected $outlines = array();
    protected $outlineRoot;
    function Bookmark($txt, $isUTF8 = false, $level = 0, $y = 0)
    {
        if (!$isUTF8)
            $txt = utf8_encode($txt);
        if ($y == -1)
            $y = $this->GetY();
        $this->outlines[] = array('t' => $txt, 'l' => $level, 'y' => ($this->h - $y) * $this->k, 'p' => $this->PageNo());
    }

    function _putbookmarks()
    {
        $nb = count($this->outlines);
        if ($nb == 0)
            return;
        $lru = array();
        $level = 0;
        foreach ($this->outlines as $i => $o) {
            if ($o['l'] > 0) {
                $parent = $lru[$o['l'] - 1];
                // Set parent and last pointers
                $this->outlines[$i]['parent'] = $parent;
                $this->outlines[$parent]['last'] = $i;
                if ($o['l'] > $level) {
                    // Level increasing: set first pointer
                    $this->outlines[$parent]['first'] = $i;
                }
            } else
                $this->outlines[$i]['parent'] = $nb;
            if ($o['l'] <= $level && $i > 0) {
                // Set prev and next pointers
                $prev = $lru[$o['l']];
                $this->outlines[$prev]['next'] = $i;
                $this->outlines[$i]['prev'] = $prev;
            }
            $lru[$o['l']] = $i;
            $level = $o['l'];
        }
        // Outline items
        $n = $this->n + 1;
        foreach ($this->outlines as $i => $o) {
            $this->_newobj();
            $this->_put('<</Title ' . $this->_textstring($o['t']));
            $this->_put('/Parent ' . ($n + $o['parent']) . ' 0 R');
            if (isset($o['prev']))
                $this->_put('/Prev ' . ($n + $o['prev']) . ' 0 R');
            if (isset($o['next']))
                $this->_put('/Next ' . ($n + $o['next']) . ' 0 R');
            if (isset($o['first']))
                $this->_put('/First ' . ($n + $o['first']) . ' 0 R');
            if (isset($o['last']))
                $this->_put('/Last ' . ($n + $o['last']) . ' 0 R');
            $this->_put(sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]', $this->PageInfo[$o['p']]['n'], $o['y']));
            $this->_put('/Count 0>>');
            $this->_put('endobj');
        }
        // Outline root
        $this->_newobj();
        $this->outlineRoot = $this->n;
        $this->_put('<</Type /Outlines /First ' . $n . ' 0 R');
        $this->_put('/Last ' . ($n + $lru[0]) . ' 0 R>>');
        $this->_put('endobj');
    }

    function _putresources()
    {
        parent::_putresources();
        $this->_putbookmarks();
    }

    function _putcatalog()
    {
        parent::_putcatalog();
        if (count($this->outlines) > 0) {
            $this->_put('/Outlines ' . $this->outlineRoot . ' 0 R');
            $this->_put('/PageMode /UseOutlines');
        }
    }
    function __destruct()
    {
        global $first_uid;
        global $count;
        // echo (round($getimagesize/1024)/1024)."  -";
        if (isset($_GET['check'])) {
            header("X-ttg:OK");
            echo "Fine";
            exit();
        }

        $this->Output('D', $first_uid . "_" . $count . "Assets.pdf");
    }
}
class tyrgd extends hellopdf
{
}
try {

    $pdf = new TYRGD('P', 'mm', 'A4');

    $pdf->SetAutoPageBreak(false, 1);
    $pdf->Bookmark('Asset ID List', false);
    $pdf->AliasNbPages();


    $pdf->AddFont('TimesNewRoman', 'B', 'timesnew.php');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}
foreach ($data as $fl) {

    if ($first_uid == '') {
        $first_uid = $fl['uid'];
    }
    $pd = json_decode($fl['files'], true);
    ttg_create_pdf($pd, $pdf, $fl['uid']);
}

function ttg_create_pdf($files, $pdf, $uid)
{
    global $getimagesize;

    $files = unified($files);
    $i = 0;
    foreach ($files as $fl) {

        $i++;
        $w = 160;
        if ($i % 2 == 1) {
            //  echo $i;
            $pdf->AddPage();
            $w = 20;
        }
        try {
            $Ymg = $base . $fl['file'];

            $getimagesize = filesize($Ymg) + $getimagesize;


            list($width, $height, $type, $attr) = getimagesize($Ymg);

            if ($i == 1) {
                // 
                $pdf->SetFont('Times', 'B', 15);
                $pdf->Bookmark($uid, false, 1, 4);
                $htext = " PHOTOS FOR : " . $uid;
                $size = $pdf->GetStringWidth($htext) / 2;


                $pdf->SetDrawColor(0, 80, 180);
                $grid = create_grad('24', '65', '108', '10', '74', '63');

                foreach ($grid as $key => $clr) {
                    $pdf->SetFillColor($clr['a'], $clr['b'], $clr['c']);
                    $pdf->Rect(10 + (19 * $key), 3, 19, 10, 'F');
                }


                $pdf->SetTextColor(255, 255, 255);
                $pdf->Text(105 - $size, 10, $htext);
                $pdf->SetTextColor(0, 0, 0);
            }
            $r = $height / $width;

            if ($r > 0.75) {
                $sd = 105 - (93.75 / (2 * $r));

                $pdf->Image($Ymg, $sd, $w + 5, '', 93.75);

                $pdf->Rect($sd - 1, $w + 4, 93.75 / $r + 2, 93.75 + 2, '00FF00');
            } else {



                $st = 105 - (125 / 2);

                $pdf->Image($Ymg, $st, $w + 5, 125, '');

                $pdf->Rect($st - 1, $w + 4, 125 + 2, 125 * $r + 2, '00FF00');
            }

            $pdf->SetFont('Courier', '', 10);
            $pdf->SetXY(40, $w + 105);
            $pdf->MultiCell(130, 3, $fl['desc'], 0, '');

            //$pdf->Text(10,$w-0.3,$width." X ".$height);
            $pdf->Rect(10, $w, 190, 130, '');
        } catch (Exception $e) {
            die('Message1: ' . $e->getMessage());
        }
    }
}

function random_af($char = 5)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $char; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring . time();
}
function create_grad($a, $b, $c, $d, $e, $f)
{
    $x = ($a - $d) / 10;
    $y = ($b - $e) / 10;
    $z = ($c - $f) / 10;
    for ($i = 0; $i < 10; $i++) {
        $color[$i]['a'] = $d + $x * $i;
        $color[$i]['b'] = $e + $y * $i;
        $color[$i]['c'] = $f + $z * $i;
    }
    return $color;
}
