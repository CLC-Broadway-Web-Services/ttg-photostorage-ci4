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



if($_GET['pdf']=='true')
{
    /**

$models = Ninja_Forms()->form( 1 )->get_fields();
	
	
	// Get all settings for a model
// Get a single setting for a Model by key
foreach($models as $model)
{
$setting = $model->get_settings();
print_r($setting);
}
    
 $ninja=   Ninja_Forms()->form( 1 )->get_subs();

 
 foreach($ninja as $onesubmission)
 {
      $field_values = $onesubmission->get_field_values();
 print_r($field_values);
 }
 exit();
 **/
 
 

/**
require('mc_table.php');
$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,0,'Hello World!');
$pdf->SetFont('Arial','',14);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,50,30,40));
for($i=0;$i<20;$i++)
    $pdf->Row(array($data[0][_field_1][0],$data[0][_field_2][0],$data[0][_field_3][0],$data[0][_field_4][0]));
$pdf->Output();
**/


$json='{"_field_27":"29\/04\/2018","date_1524056764468":"29\/04\/2018","_field_28":"C234","lab_sr_no_1524056761475":"C234","_field_29":"2","ref_no_1524240022814":"2","_field_31":"","prefix_1524057466550":"","_field_34":"male","gender_1524667250818":"male","_field_238":"73 KG","weight_1524667449168":"73 KG","_field_40":"XXX002","passport_no_1524059611802":"XXX002","_field_32":"SHAKIR","firstname_1524057587955":"SHAKIR","_field_37":"","marital_status_1524058164262":"","_field_36":"06-04-1992","d_o_b_1524057968307":"06-04-1992","_field_240":"WEB DEVELOPER","profession_1524667521988":"WEB DEVELOPER","_field_33":"SAIFI","lastname_1524057591086":"SAIFI","_field_241":"167 CM","height_1524667427110":"167 CM","_field_39":"INDIAN","nationality_1524059582635":"INDIAN","_field_41":"SYSTEM ANALYST","post_applied_for_1524059688968":"SYSTEM ANALYST","_field_94":"a:1:{i:6;s:72:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Patient_Pic-2.jpg\";}","upload_photo_1524066995590":"a:1:{i:6;s:72:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Patient_Pic-2.jpg\";}","_field_42":"24\/11\/2017","date_of_issue_1524059831769":"24\/11\/2017","_field_43":"NEW DELHI","place_of_issue_1524059849921":"NEW DELHI","_field_209":"03\/10\/2017","report_valid_upto_1524230856315":"03\/10\/2017","_field_210":"6-6","vision_r_eye_1524231016884":"6-6","_field_46":"","vision_r_eye_1524061387651":"","_field_211":"6-6","vision_l_eye_1524231510592":"6-6","_field_47":"","vision_l_eye_1524061404555":"","_field_48":"","other_r_eye_1524061433140":"","_field_49":"","other_l_eye_1524061454671":"","_field_52":"NAD","r_ear_1524061632014":"NAD","_field_53":"NAD","l_ear_1524061644914":"NAD","_field_54":"180","blood_pressure_1524062098857":"180","_field_55":"123","heart_1524062094243":"123","_field_56":"123","lungs_1524062115184":"123","_field_57":"123","abdomen_1524062128570":"123","_field_212":"reactive","vdrl_1524232556068":"reactive","_field_213":"reactive","tpha_1524232665138":"reactive","_field_214":"absent","sugar_1524232848452":"absent","_field_215":"detected","albumin_1524232991874":"detected","_field_216":"seen","bilharziasis_1524233053985":"seen","_field_69":"NORMAL","others_1524064628223":"NORMAL","_field_217":"not-seen","helminthes_1524233186668":"not-seen","_field_218":"not-seen","bilharziasis_1524233256250":"not-seen","_field_74":"NAD","salmonella_shigella_1524064800210":"NAD","_field_75":"NAD","v_cholera_1524064796096":"NAD","_field_76":"NORMAL","others_1524064824810":"NORMAL","_field_80":"NOT SEEN","hemoglobin_1524065246116":"NOT SEEN","_field_81":"NOT SEEN","malaria_film_1524065451868":"NOT SEEN","_field_219":"a-ve","blood_group_1524233392783":"a-ve","_field_220":"select","micro_filaria_1524233650720":"select","_field_82":"NORMAL","others_1524065470438":"NORMAL","_field_221":"reactive","hiv_1524233843997":"reactive","_field_222":"reactive","hbsag_1524233892890":"reactive","_field_223":"reactive","anti_hcv_1524233915055":"reactive","_field_224":"Normal","l_f_t_1524234110390":"Normal","_field_89":"235mg\/dl","urea_1524065710777":"235mg\/dl","_field_90":"235 mg\/dl","creatinine_1524065743889":"235 mg\/dl","_field_91":"254 mg\/dl","blood_sugar_1524065765181":"254 mg\/dl","_field_230":"negative","listselect_1524234607504":"negative","_field_231":"NAD","chest_x-ray_1524234666653":"NAD","_field_225":"The candidate is fine and fit.","remarks_1524234225861":"The candidate is fine and fit.","_field_226":"","result_1524234241702":"","_field_227":"a:1:{i:7;s:68:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Signature.png\";}","upload_sign_1524234319114":"a:1:{i:7;s:68:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Signature.png\";}","_field_228":"a:1:{i:8;s:67:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Result-1.jpg\";}","upload_result_1524234476865":"a:1:{i:8;s:67:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Result-1.jpg\";}","_field_229":"a:1:{i:9;s:66:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Stamp-1.jpg\";}","upload_stamp_1524234412276":"a:1:{i:9;s:66:\"http:\/\/www.alaiman.in\/wp-content\/uploads\/ninja-forms\/5\/Stamp-1.jpg\";}","_form_id":"5","_seq_num":"3","_edit_lock":"1525108307:1"}';
$data=json_decode($json,true);

$data['name']=$data['prefix_1524057466550']." ".$data['firstname_1524057587955']." ".$data['lastname_1524057591086'];


$from = new DateTime( $data['d_o_b_1524057968307']);
$to   = new DateTime('today');
$data['year']= $from->diff($to)->y;
$data['month']= $from->diff($to)->m;
$data['age']=$data['year']." Yr(s) ".$data['month']." Mnth(s)";
$data['profile_url']=unserialize($data['upload_photo_1524066995590']);
$data['profile_url']= reset($data['profile_url']);
$data['ref_no_1524240022814']=1000000;
$data['ref_no_1524240022814']=dechex($data['ref_no_1524240022814']);
$data['ref_no_1524240022814']=strtoupper($data['ref_no_1524240022814']);
require('fdpi.php');
$pdf = new \setasign\Fpdi\Fpdi();;

$pageCount = $pdf->setSourceFile(get_template_directory().'/inc/reports/wes/basic.tmplt4');
$pageId = $pdf->importPage(1, setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId, 10, 10, 200);
$pdf->SetFont('Arial','B',7);



$date = $data['date_1524056764468']; 
$enddate = date("d-m-Y", strtotime($date."+1 month")); 



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
$pdf->Image(get_template_directory().'/inc/reports/wes/fit.png',125,242,21);
//stamp
$pdf->Image(get_template_directory().'/inc/reports/wes/stamp.png',165,242,21);
//sign
$pdf->Image(get_template_directory().'/inc/reports/wes/sign.png',170,252,21);
//report table top 1
$pdf->Image($data['profile_url'],170,71,21);
$ly=142.00;
$lx=41.00;
$ld=5.3;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['lab_sr_no_1524056761475']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['ref_no_1524240022814']);

//report top 2 
$ly=120;
$lx=61;
$ld=22.00;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['date_1524056764468']);
$pdf->SetXY($ly+$ld, $lx);
$pdf->Write(0, $enddate);

// report bar code 
$pdf->SetXY(30, 251);
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
$lx=74.00;
$ld=4.9;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, $data['name']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['marital_status_1524058164262']);
$pdf->SetXY($ly,($lx+2*$ld));
$pdf->Write(0,  $data['d_o_b_1524057968307']);
$pdf->SetXY($ly, ($lx+3*$ld));
$pdf->Write(0,  $data['post_applied_for_1524059688968']);
$pdf->SetXY($ly, ($lx+4*$ld));
$pdf->Write(0,  $data['date_of_issue_1524059831769']);
// Profile column 3
$ly=142.00;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0,  $data['age']);
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['gender_1524667250818']);
$pdf->SetXY($ly,($lx+2*$ld));
$pdf->Write(0,  $data['weight_1524667449168']);
$pdf->SetXY($ly, ($lx+3*$ld));
$pdf->Write(0,  $data['passport_no_1524059611802']);
// Profile column 2 
$ly=94.00;
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($ly, $lx);
$pdf->Write(0, '');
$pdf->SetXY($ly, $lx+$ld);
$pdf->Write(0, $data['height_1524667427110']);
$pdf->SetXY($ly,($lx+2*$ld));
$pdf->Write(0, $data['nationality_1524059582635']);
$pdf->SetXY($ly, ($lx+4*$ld));
$pdf->Write(0, $data['place_of_issue_1524059849921']);


// Data column 1
$pad=0;
for ($i=0;$i<18;$i++)
{
$pdf->SetXY(95, 110+($pad*$i));
$pdf->Write(0, $medi[$i]);
    
}



// Data column 2

for ($i=0;$i<25;$i++)
{
$pdf->SetXY(172, 110+($pad*$i));
$pdf->Write(0,$lab[$i]);
    
}

// Remark
$thehtml="                         ".$data['remarks_1524234225861'];
$pdf->SetFont('Times','',7);
$pdf->SetXY(28, 200);
$pdf-> MultiCell(80,3.4,$thehtml);
$pdf->Output();
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


