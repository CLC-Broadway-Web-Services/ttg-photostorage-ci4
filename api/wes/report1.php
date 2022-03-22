<?
/** ninja form action **/

add_filter( 'ninja_forms_run_action_settings', 'my_ninja_forms_run_action_settings', 10, 4 );
function my_ninja_forms_run_action_settings( $action_settings, $form_id, $action_id, $form_settings ) {
  return $action_settings;
}
/** code starts here **/ 
add_action( 'admin_post_approve', 'my_admin_approve' );

function my_admin_approve()
{ global $post;
     $postid=$post->ID;
     if($ref_no=get_option('report_ref'))
     {
         $ref_no= $ref_no+1;
     }
     else
     {
         $ref_no=10000;
     }
  if(isset($_GET['action']))
  {
     $ref_no_ex= getToken(3).$ref_no;
      
      if(add_post_meta( $_GET['post'], 'approval', $ref_no_ex,true ))
      {
         update_option( 'report_ref', $ref_no, false);  
global $post;
 $postid=$post->ID;
          die("Approved via refrence no.<a href='http://www.sunrisediagnostic.co.in/?pdf=true&pid=".$_GET['post']."'><b> ". $ref_no_ex."</b></a>"); 
      }
      else
      {
          die("Sorry! Failed to approve. Refresh and try again");
      }
      
      
  }
    
}
function adding_custom_meta_boxes( $post_type, $post ) {
    add_meta_box( 
        'my-meta-box',
        __( 'Approval' ),
        'render_my_meta_box',
        'nf_sub',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'adding_custom_meta_boxes', 10, 2 );

function render_my_meta_box($post)
{
    $postid=$post->ID;
    
     $approval=get_post_meta($postid,'approval',true);
     if(!$approval)
     {
  echo '<div id="appr" ><input type=button class=button-large onclick="loadDoc()" value="Approve"  /></div>';
     }
     else
     {
         global $post;
 $postid=$post->ID;
       echo  "Approved via refrence no.<a href='http://www.sunrisediagnostic.co.in/?pdf=true&pid=".$postid."'><b> ". $approval."</b></a>";
     }
  
   
   
   echo '<script>
   function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("appr").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "admin-post.php?post='.$postid.'&action=approve&data=approve", true);
  xhttp.send();
}</script>';
}

function medi_function() {

if($_GET['pdf']=='true')
{
 

$models = Ninja_Forms()->form( 5 )->get_fields();
// Get all settings for a model

 function get_post_via_refrence($ref)
 {
	$query = new WP_Query( array( 'post_type' => 'nf_sub' ) );
$posts = $query->posts;

foreach($posts as $post) {
	$post_id=$post->ID;
    $theform=  get_post_meta($post_id, 'approval', true );
	if($theform)
	{
return $post_id;
	}
}
return false;
}


function get_ref_via_post($post_id)
 {

    $theform=  get_post_meta($post_id, 'approval', true );
	if($theform)
	{
return $theform;
	}
return false;
}

    
 $ninja=   Ninja_Forms()->form( 5 )->get_subs();

if(isset($_GET['pid']))
{
$pid=$_GET['pid'];
}
else if(isset($_GET['ref']))
{
$pid=get_post_via_refrence($_GET['ref']);

}

$field_values = $ninja[$pid]->get_field_values();

$data=$field_values;

$data['name']=$data['prefix_1524057466550']." ".$data['firstname_1524057587955']." ".$data['lastname_1524057591086'];


$from = new DateTime( $data['d_o_b_1524057968307']);
$to   = new DateTime('today');
$data['year']= $from->diff($to)->y;
$data['month']= $from->diff($to)->m;
$data['age']=$data['year']." Year(s) ";
$data['profile_url']=unserialize($data['upload_photo_1524066995590']);
$data['profile_url']= reset($data['profile_url']);
$data['ref_no_1524240022814']=1000000;
$data['ref_no_1524240022814']=dechex($data['ref_no_1524240022814']);
$data['ref_no_1524240022814']=strtoupper($data['ref_no_1524240022814']);
require('fdpi.php');
$pdf = new \setasign\Fpdi\Fpdi();;

$pageCount = $pdf->setSourceFile(get_template_directory().'/inc/reports/wes/basic.tmplt1');
$pageId = $pdf->importPage(1, setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId, 0, 0, 210);
$pdf->SetFont('Arial','B',7);



$date = $data['date_1524056764468'];
 $date = str_replace("/", "-", $date);
$enddate = date("d-m-Y",strtotime($date)+2592000); 


 $enddate = str_replace("-", "/", $enddate);

//$enddate = strtotime("+1 months", 

//Medical data 
$medi[]="";
$medi[]=$data['vision_r_eye_1524231016884'];
$medi[]=$data['other_r_eye_1524061433140'];
$medi[]=$data['vision_l_eye_1524061404555'];
$medi[]=$data['other_l_eye_1524061454671'];
$medi[]="";
$medi[]=$data['r_ear_1524061632014'];
$medi[]=$data['l_ear_1524061644914'];
$medi[]="";
$medi[]=$data['blood_pressure_1524062098857'];
$medi[]=$data['heart_1524062094243'];
$medi[]=$data['lungs_1524062115184'];
$medi[]=$data['abdomen_1524062128570'];
$medi[]="";
$medi[]=$data['vdrl_1524232556068'];
$medi[]=$data['tpha_1524232665138'];
$medi[]=$data['chest_x-ray_1524234666653'];
$medi[]=$data[''];

//Laboratory data 
$lab[]="";
$lab[]=$data['sugar_1524232848452'];
$lab[]=$data['albumin_1524232991874'];
$lab[]=$data['bilharziasis_1524233053985'];
$lab[]=$data['[others_1524064628223'];
$lab[]="";
$lab[]=$data['hemoglobin_1524065246116'];
$lab[]=$data['malaria_film_1524065451868'];
$lab[]=$data['blood_group_1524233392783'];
$lab[]=$data['micro_filaria_1524233650720'];
$lab[]=$data['others_1524065470438'];
$lab[]="";
$lab[]=$data['helminthes_1524233186668'];
$lab[]=$data['bilharziasis_1524233256250'];
$lab[]=$data['salmonella_shigella_1524064800210'];
$lab[]=$data['v_cholera_1524064796096'];
$lab[]=$data['others_1524064824810'];
$lab[]="";
$lab[]=$data['hiv_1524233843997'];
$lab[]=$data['hbsag_1524233892890'];
$lab[]=$data['anti_hcv_1524233915055'];
$lab[]=$data['l_f_t_1524234110390'];
$lab[]=$data['urea_1524065710777'];
$lab[]=$data['creatinine_1524065743889'];
$lab[]=$data['blood_sugar_1524065765181'];

// fit and unfit 
$pdf->Image(get_template_directory().'/inc/reports/wes/fit.png',85,247,40);
//stamp
$pdf->Image(get_template_directory().'/inc/reports/wes/stamp.png',155,246,40);
//sign
$pdf->Image(get_template_directory().'/inc/reports/wes/sign.png',160,227,40);
//report table top 1

$photo_size=getimagesize($data['profile_url']);
$ratio=$photo_size[0]/$photo_size[1];
if($ratio < 1)
{
    $prowid=$ratio*19;
}
else
{
    $prowid=19 ;
}
$pdf->Image($data['profile_url'],177,67.7, $prowid);
$ly=147.00;
$lx=34.00;
$ld=5.3;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['lab_sr_no_1524056761475']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['ref_no_1524240022814']);

//report top 2 
$ly=125;
$lx=54;
$ld=22.00;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['date_1524056764468']);
$pdf->SetXY($ly+$ld, $lx);
$pdf->Write(0, $enddate);

// report bar code 
$pdf->SetXY(25, 256);
$pdf->Write(0, $data['ref_no_1524240022814']);

//report footer 
/**
$ly=158.00;
$lx=242.50;
$ld=5.0;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['date_of_issue_1524059831769']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['place_of_issue_1524059849921']);
**/
// Profile column 1 
$ly=48.00;
$lx=70.00;
$ld=4.9;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['name']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['height_1524667427110']);

$pdf->SetXY($ly,($lx+2*$ld));
$pdf->Write(0,  $data['d_o_b_1524057968307']);
$pdf->SetXY($ly, ($lx+3*$ld));
$pdf->Write(0,  $data['date_of_issue_1524059831769']);

$pdf->SetXY($ly, ($lx+4*$ld));

// Profile column 2
$ly=94.00;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0,  $data['age']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0,  $data['weight_1524667449168']);

$pdf->SetXY($ly,($lx+2*$ld));
$pdf->Write(0, $data['nationality_1524059582635']);
$pdf->SetXY($ly, ($lx+3*$ld));
$pdf->Write(0, $data['place_of_issue_1524059849921']);

// Profile column 3 
$ly=147.00;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['gender_1524667250818']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['marital_status_1524058164262']);
$pdf->SetXY($ly,($lx+2*$ld));
$pdf->Write(0,  $data['passport_no_1524059611802']);
$pdf->SetXY($ly, ($lx+3*$ld));
$pdf->Write(0,  $data['post_applied_for_1524059688968']);



// Data column 1
$pad=5.1;
for ($i=0;$i<18;$i++)
{
$pdf->SetXY(95, 105+($pad*$i));
$pdf->Write(0, $medi[$i]);
    
}



// Data column 2

for ($i=0;$i<25;$i++)
{
$pdf->SetXY(185, 105+($pad*$i));
$pdf->Write(0,$lab[$i]);
    
}

// Remark
$thehtml="                   It should be clearly understand that “Sunrise Diagnostic Centre” is 
conducting medical examinations examinations only and in no way linked to 
any agency or responsible for placement of any jobwithin INDIA or abroad or 
directing the candidates to any client or their repatriation for any reason
".$data['remarks_1524234225861'];
$pdf->SetFont('Times','',8);
$pdf->SetXY(19, 196);
$pdf-> MultiCell(90,3.4,$thehtml);
$pdf->Output('I',$data['ref_no_1524240022814'].'.pdf');
exit();
}
}
add_action( 'init', 'medi_function', 100 );



function medical_func( ) {
    ?>
   <form action="?pdf=true" method="post">
    <div class="form-group">
      <label for="usr">Refrence Number:
      <input type="text" class="form-control" id="usr" min-size="7" required /></label>
    </div>
<!-- 
    <div class="form-group">
      <label for="pwd">Date of Birth
      <input type="date" class="form-control" id="pwd" max="<?php echo date("Y-m-d"); ?>" required ></label>
    </div>
This is a comment -->
    
    <div class="form-group">
      <label for="btn">
      <input type="submit" class="button-large" id="button" value="Generate" ></label>
    </div>
  </form>
  <?php
}
add_shortcode( 'medical_report', 'medical_func' );






function getToken($length){
     $token = "";
     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  
     $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max-1)];
    }

    return $token;
}

