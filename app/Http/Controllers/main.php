<?php

namespace App\Http\Controllers;
use App\Students;
use Illuminate\Support\Facades\DB ;
use Illuminate\Http\Request;
use Datatables;


use PDF;

use TCPDF_FONTS ;

class main extends Controller
{
    //

    function index(){

        return view('welcome');
     
    }

    function showList(Request $request){
       
        
        return view('ListOfStudent');

    }

    function getlist(Request $request){

        //$name = $request->get('name');

        // $students = DB::table('students')->leftJoin("country" , "students.birthcountry","=","country.code")
        //         ->leftJoin("city","students.birthcity","=","city.id")
        //         ->leftJoin("country AS country_1", "students.nationality", "=" ,"country_1.code")
        //         ->join("d_student_total" ,"students.code", "=", "d_student_total.code")
        //         ->leftJoin("main_spec","d_student_total.main_spec","=","main_spec.id")
        //         ->leftJoin("minor_spec" ,"d_student_total.minor_spec" ,"=" ,"minor_spec.id")
        //         ->leftJoin("honour" , "d_student_total.honour","=" ,"honour.id")
        //         ->leftJoin("general_grade", "d_student_total.grade", "=", "general_grade.id")
        //         ->leftJoin("grade_id","d_student_total.proj_grade", "=", "grade_id.id")
        //         ->leftJoin("d_term", "d_student_total.term", "=","d_term.id")
        //         ->select("students.code", "students.name", "students.ename", "students.nationalid", "students.gender", "students.birthdate",
        //         "students.birthcountry", "country.name AS cname", "country.ename AS cename", "students.birthcity", "city.name AS CIname", 
        //         "city.ename AS CIname", "students.nationality", "country_1.name AS C1name", "country_1.ename AS C1ename", "d_term.fapproval", 
        //         "d_term.uapproval", "d_student_total.main_spec", "main_spec.name AS MSname", "main_spec.ename AS MSename", "d_student_total.minor_spec",
        //         "minor_spec.name2", "minor_spec.ename AS MIename", "d_student_total.term", "d_term.name AS DTname", "d_term.ename AS DTename", 
        //         "d_term.desc", "d_student_total.total", "d_student_total.total_f", "d_student_total.grade", "general_grade.name AS Gname", 
        //         "general_grade.ename AS Gename", "d_student_total.proj_grade", "grade_id.name AS GIDname", "grade_id.ename AS GIDename", 
        //         "d_student_total.honour", "honour.name AS Hname", "honour.ename AS Hename","Y0m","Y1m", "Y2m", "Y3m", "Y4m");
                 
                //$name ? 'حسين' : $name;

               $students = DB::table('student_info_view')
                  ->select("code", "name","Gname","MSname","DTname"); //
      //  $students = Students::select('*')->pagi;

        // select "students.code", "students.name","general_grade.name As Gname","main_spec.name AS MSname","d_term.name AS DTname" from students
        // join "d_student_total" ON "students.code" = "d_student_total.code"
        // LEFT JOIN "general_grade"  ON "d_student_total.grade" =  "general_grade.id"
        // LEFT JOIN "main_spec" ON "d_student_total.main_spec" = "main_spec.id"
        // LEFT JOIN "d_term"  ON "d_student_total.term"  = "d_term.id"
//                dump($students);
//                die();
                //response()->json($students)
                
          return Datatables::of($students) ->addColumn('action', function ($students) {
              return '<a href="profile?code='.$students->code.'" ><i class="fa fa-eye fa-lg"></i></a>';
          })->make(true);

//        return view('test')->with('students',$students);

    }

    function GetRop(Request $request ){
         
        $code = $request->input('code');
        $certificate = $request->input('certificate');
        $applyto = $request->get('applyto');
        $from = $request->get('from');
        $to = $request->get('to');
         
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
         $students = DB::table('students')
                          ->join('student_status_latest', 'students.code', '=','student_status_latest.code')
                          ->leftJoin('main_spec','student_status_latest.main_spec', '=','main_spec.id')
                          ->leftJoin('minor_spec','student_status_latest.minor_spec', '=','minor_spec.id')
                          ->leftJoin('year', 'student_status_latest.year', '=','year.id')
                          ->leftJoin('d_term', 'student_status_latest.term', '=','d_term.id')
                          ->leftJoin('country', 'students.birthcountry', '=','country.code')
                          ->leftJoin('city','students.birthcity', '=','city.id')
                          ->leftJoin('country AS C1','students.nationality','=','C1.code')
                          ->leftJoin('student_status_index', 'student_status_latest.fac_student_status', '=','student_status_index.id')
                          ->select('students.code', 'students.name', 'students.ename','students.nationalid', 'students.gender', 'students.birthdate', 
                                   'students.birthcountry', 'country.name AS coname', 'country.ename AS coename', 'students.birthcity','city.name AS ciname',
                                   'city.ename AS ciename', 'students.nationality', 'C1.name AS Cname', 'C1.ename AS c1ename','students.militaryno', 
                                   'students.militarystatus', 'students.military_order', 'students.military_order_year','students.military_age', 'd_term.fapproval',
                                   'd_term.uapproval', 'student_status_latest.fac_student_status','student_status_index.name AS SSIname', 'student_status_index.ename AS SSIename',
                                   'student_status_index.desc AS SSIdesc', 'student_status_latest.Year','year.name AS Yname', 'year.ename AS Yename', 
                                   'student_status_latest.main_spec', 'main_spec.name AS MSname', 'main_spec.ename AS MSename', 'student_status_latest.minor_spec',
                                   'minor_spec.name2', 'minor_spec.ename AS MIename', 'student_status_latest.term','d_term.name AS Dname', 'd_term.ename AS Dename',
                                   'd_term.desc')->where('students.code','=',"".$code)->get();
         
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
      $students_graduated = DB::table('students')->leftJoin("country" , "students.birthcountry","=","country.code")
                                      ->leftJoin("city","students.birthcity","=","city.id")
                                      ->leftJoin("country AS country_1", "students.nationality", "=" ,"country_1.code")
                                      ->join("d_student_total" ,"students.code", "=", "d_student_total.code")
                                      ->leftJoin("main_spec","d_student_total.main_spec","=","main_spec.id")
                                      ->leftJoin("minor_spec" ,"d_student_total.minor_spec" ,"=" ,"minor_spec.id")
                                      ->leftJoin("honour" , "d_student_total.honour","=" ,"honour.id")
                                      ->leftJoin("general_grade", "d_student_total.grade", "=", "general_grade.id")
                                      ->leftJoin("grade_id","d_student_total.proj_grade", "=", "grade_id.id")
                                      ->leftJoin("d_term", "d_student_total.term", "=","d_term.id")
                                      ->select("students.code", "students.name", "students.ename", "students.nationalid", "students.gender", "students.birthdate",
                                         "students.birthcountry", "country.name AS cname", "country.ename AS cename", "students.birthcity", "city.name AS CIname", 
                                         "city.ename AS CIname", "students.nationality", "country_1.name AS C1name", "country_1.ename AS C1ename", "d_term.fapproval", 
                                         "d_term.uapproval", "d_student_total.main_spec", "main_spec.name AS MSname", "main_spec.ename AS MSename", "d_student_total.minor_spec",
                                         "minor_spec.name2", "minor_spec.ename AS MIename", "d_student_total.term", "d_term.name AS DTname", "d_term.ename AS DTename", 
                                         "d_term.desc", "d_student_total.total", "d_student_total.total_f", "d_student_total.grade", "general_grade.name AS Gname", 
                                         "general_grade.ename AS Gename", "d_student_total.proj_grade", "grade_id.name AS GIDname", "grade_id.ename AS GIDename", 
                                         "d_student_total.honour", "honour.name AS Hname", "honour.ename AS Hename","Y0m","Y1m", "Y2m", "Y3m", "Y4m")->where('students.code','=',"".$code)->get();
                                         
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       
   
        $AppreciationCertificate = DB::table('students')->leftJoin("country" , "students.birthcountry","=","country.code")
                                      ->leftJoin("city","students.birthcity","=","city.id")
                                      ->leftJoin("country AS country_1", "students.nationality", "=" ,"country_1.code")
                                      ->join("d_student_total" ,"students.code", "=", "d_student_total.code")
                                      ->leftJoin("main_spec","d_student_total.main_spec","=","main_spec.id")
                                      ->leftJoin("minor_spec" ,"d_student_total.minor_spec" ,"=" ,"minor_spec.id")
                                      ->leftJoin("honour" , "d_student_total.honour","=" ,"honour.id")
                                      ->leftJoin("general_grade", "d_student_total.grade", "=", "general_grade.id")
                                      ->leftJoin("grade_id","d_student_total.proj_grade", "=", "grade_id.id")
                                      ->leftJoin("d_term", "d_student_total.term", "=","d_term.id")
                                      ->leftJoin("general_grade AS general_grade_0" , "d_student_total.grade0", "=","general_grade_0.id")
                                      ->leftJoin("general_grade AS general_grade_1","d_student_total.grade1","=","general_grade_1.id")
                                      ->leftJoin("general_grade AS general_grade_2" , "d_student_total.grade2", "=", "general_grade_2.id")
                                      ->leftJoin("general_grade AS general_grade_3", "d_student_total.grade3","=","general_grade_3.id")
                                      ->leftJoin("general_grade AS general_grade_4","d_student_total.grade4","=","general_grade_4.id")
                                      ->select("students.code", "students.name", "students.ename", "students.nationalid", "students.gender", "students.birthdate",
                                         "students.birthcountry", "country.name AS cname", "country.ename AS cename", "students.birthcity", "city.name AS CIname", 
                                         "city.ename AS CIname", "students.nationality", "country_1.name AS C1name", "country_1.ename AS C1ename", "d_term.fapproval", 
                                         "d_term.uapproval", "d_student_total.main_spec", "main_spec.name AS MSname", "main_spec.ename AS MSename", "d_student_total.minor_spec",
                                         "minor_spec.name2", "minor_spec.ename AS MIename", "d_student_total.term", "d_term.name AS DTname", "d_term.ename AS DTename", 
                                         "d_term.desc", "d_student_total.total", "d_student_total.total_f", "d_student_total.grade", "general_grade.name AS Gname", 
                                         "general_grade.ename AS Gename", "d_student_total.proj_grade", "grade_id.name AS GIDname", "grade_id.ename AS GIDenam", 
                                         "d_student_total.honour", "honour.name AS Hname", "honour.ename AS Hename","d_student_total.Y0m", "d_student_total.Y1m", 
                                         "d_student_total.Y2m","d_student_total.Y3m","d_student_total.Y4m", "general_grade_0.name AS G0name","general_grade_0.ename AS G0ename", 
                                         "general_grade_1.name AS G1name","general_grade_1.ename AS G1ename","general_grade_2.name AS G2name","general_grade_2.ename AS G2ename", 
                                         "general_grade_3.name AS G3name","general_grade_3.ename AS G3ename","general_grade_4.name AS G4name", "general_grade_4.ename AS G4ename" )
                                         ->where('students.code','=',"".$code)->get();
                                         
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           $lastCertifcate = DB::table('students')->leftJoin("country" , "students.birthcountry","=","country.code")
                                      ->leftJoin("city","students.birthcity","=","city.id")
                                      ->leftJoin("country AS country_1", "students.nationality", "=" ,"country_1.code")
                                      ->join("d_student_total" ,"students.code", "=", "d_student_total.code")
                                      ->leftJoin("main_spec","d_student_total.main_spec","=","main_spec.id")
                                      ->leftJoin("minor_spec" ,"d_student_total.minor_spec" ,"=" ,"minor_spec.id")
                                      ->leftJoin("honour" , "d_student_total.honour","=" ,"honour.id")
                                      ->leftJoin("general_grade", "d_student_total.grade", "=", "general_grade.id")
                                      ->leftJoin("grade_id","d_student_total.proj_grade", "=", "grade_id.id")
                                      ->leftJoin("d_term", "d_student_total.term", "=","d_term.id")
                                      ->select("students.code", "students.name", "students.ename", "students.nationalid", "students.gender", "students.birthdate",
                                         "students.birthcountry", "country.name AS cname", "country.ename AS cename", "students.birthcity", "city.name AS CIname", 
                                         "city.ename AS CIname", "students.nationality", "country_1.name AS C1name", "country_1.ename AS C1ename", "d_term.fapproval", 
                                         "d_term.uapproval", "d_student_total.main_spec", "main_spec.name AS MSname", "main_spec.ename AS MSename", "d_student_total.minor_spec",
                                         "minor_spec.name2", "minor_spec.ename AS MIename", "d_student_total.term", "d_term.name AS DTname", "d_term.ename AS DTename", 
                                         "d_term.desc", "d_student_total.total", "d_student_total.total_f", "d_student_total.grade", "general_grade.name AS Gname", 
                                         "general_grade.ename AS Gename", "d_student_total.proj_grade", "grade_id.name AS GIDname", "grade_id.ename AS GIDenam", 
                                         "d_student_total.honour", "honour.name AS Hname", "honour.ename AS Hename","Y0m", "Y1m", "Y2m", "Y3m", "Y4m")
                                         ->where('students.code','=',"".$code)->get();
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
                //   $unionQuery = DB::table('student_year_latest')->leftJoin("d_term","student_year_latest.term", "=", "d_term.id")
    //              ->leftJoin("year", "student_year_latest.year", "=", "year.id")
    //              ->leftJoin("main_spec","student_year_latest.main_spec" ,"=" ,"main_spec.id")
    //              ->leftJoin("minor_spec","student_year_latest.minor_spec" ,"=" ,"minor_spec.id")
    //              ->leftJoin("general_grade","student_year_latest.grade" ,"=" ,"general_grade.id")->select("student_year_latest.code", "student_year_latest.term",
    //              "d_term.desc", "student_year_latest.year", "year.name AS yname", "year.ename AS yename", "student_year_latest.main_spec", "main_spec.name AS maname", 
    //              "main_spec.ename AS maename", "student_year_latest.minor_spec", "minor_spec.name2 AS miname", "minor_spec.ename AS miename", "student_year_latest.grade",
    //              "general_grade.name AS gname", "general_grade.ename AS gename")->where("code","=",$code);//->orderBy("student_year_latest.term","student_year_latest.year");

    
                // $unionQuery = DB::table('student_year_latest')
    //                 ->leftJoin("d_term","student_year_latest.term", "=", "d_term.id")
    //                 ->leftJoin("year", "student_year_latest.year", "=", "year.id")
    //                 ->leftJoin("main_spec","student_year_latest.main_spec" ,"=" ,"main_spec.id")
    //                 ->leftJoin("minor_spec","student_year_latest.minor_spec" ,"=" ,"minor_spec.id")
    //                 ->leftJoin("general_grade","student_year_latest.grade" ,"=" ,"general_grade.id")
    //                 ->select("student_year_latest.code", "student_year_latest.term",
    //                 "d_term.desc", "student_year_latest.year", "year.name AS yname", "year.ename AS yename", "student_year_latest.main_spec", "main_spec.name AS maname", 
    //                 "main_spec.ename AS maename", "student_year_latest.minor_spec", "minor_spec.name2 AS miname", "minor_spec.ename AS miename", "student_year_latest.grade",
    //                 "general_grade.name AS gname", "general_grade.ename AS gename")->where("code","=",$code)->get();

      
                //   $lastYear = DB::table('student_year_latest')
    //              ->leftJoin("year", "student_year_latest.year", "=", "year.id")
    //              ->leftJoin("main_spec","student_year_latest.main_spec" ,"=" ,"main_spec.id")
    //              ->leftJoin("minor_spec","student_year_latest.minor_spec" ,"=" ,"minor_spec.id")
    //              ->leftJoin("general_grade","student_year_latest.grade" ,"=" ,"general_grade.id")
    //              ->select("student_year_transfer_latest.code","student_year_latest.term as term2",
    //              "d_term.desc as term_desc","student_year_transfer_latest.year", "year.name AS yname", "year.ename AS yename", "student_year_transfer_latest.main_spec", "main_spec.name AS maname", 
    //               "main_spec.ename AS maename", "student_year_transfer_latest.minor_spec", "minor_spec.name2 AS miname", "minor_spec.ename AS miename","student_year_latest.grade as grads2", 
    //               "general_grade.name AS gname","general_grade.ename  AS gename")->where("code","=",$code)->union($unionQuery)->get();//->orderBy("student_year_transfer_latest.year")->get();
                  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                
                //   ->leftJoin("student_status_latest",function($join){
                //     $join->on("course_inf.code","=", "student_status_latest.course_code");
                //     $join->on("course_inf.dept","=","student_status_latest.dept");
                // })
                // ->leftJoin("grade_id","student_status_latest.grade","=","grade_id.id")
                // ->leftJoin("course_related_inf_e","","=","")
                // ->leftJoin("course_inf_e",function($join){
                //    $join->on("course_related_inf_e.code_e","=","course_inf_e.code_e"); 
                //    $join->on("course_related_inf_e.dept_e","=","course_inf_e.dept");
                //    $join->on("course_related_inf_e.year","=","course_inf_e.year");
                //    $join->on("course_related_inf_e.minor_spec","=","course_inf_e.minor_spec");
                //    $join->on("course_related_inf_e.main_spec","=","course_inf_e.main_spec");
                // })   
                //WHERE (((course_inf.main_spec)='".$row3[6]."') AND ((course_inf.minor_spec)='".$row3[9]."') AND
                // ((course_inf.year)='".$row3[3]."') AND ((all_student_course_latest.code)='".$hash->idauto ."'))
               

          $html = $this::rop($students,
                            $students_graduated,
                            $AppreciationCertificate,
                            $lastCertifcate,
                            $certificate ,
                            $code ,
                            $applyto ,
                            $from, $to);
                                                          
//            $lg = Array();
//            $lg['a_meta_charset'] = 'UTF-8';
//            $lg['a_meta_dir'] = 'rtl';
//            $lg['a_meta_language'] = 'ar';
//            $lg['w_page'] = 'page';
//
//
//
//                PDF::setLanguageArray($lg);

                //aealarabiya
                //Courier
                //*aefurat

               PDF::SetFont('aefurat',' ', 18);
//                PDF::setFontSubsetting(true);
//                $f = TCPDF_FONTS::addTTFfont('lateefregot.ttf','TrueTypeUnicode');
//                PDF::SetFont('lateefregot', '', 18);

                // set document information
                PDF::SetCreator(PDF_CREATOR);
                PDF::SetAuthor('Nicola Asuni');
                PDF::SetTitle('Certificate');
                PDF::SetSubject('TCPDF Tutorial');
                PDF::SetKeywords('TCPDF, PDF, example, test, guide');
               // set default header data
                PDF::SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);

                // set header and footer fonts
                PDF::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                // set default monospaced font
                PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                 // set margins
                PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
                PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

                // set auto page breaks
                PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                // set image scale factor

                PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);


               // PDF::setFontSubsetting(true);

              // $fontname = TCPDF_FONTS::addTTFfont(public_path().'/certificate_font/LateefRegOT.ttf', 'TrueTypeUnicode', '', 96);

               // use the font

               // PDF::SetFont($fontname, '', 14, '', false);

               //$f = TCPDF_FONTS::addTTFfont('LateefRegOT.ttf','TrueTypeUnicode');






                PDF::AddPage();



                PDF::setJPEGQuality(75);

               // PDF::SetXY(110, 200);
                PDF::Image('image/logo.jpg', 123 , 6, 33, 33, '', '', 'T', false, 100, '', false, false, 0, false, false, false);

                PDF::writeHTML($html, true, false, true, false, '');

                PDF::Output('hello_world.pdf');







    }


    public static function rop($students,
                               $students_graduated,
                               $AppreciationCertificate,
                               $lastCertifcate,
                               $certificate ,
                               $code ,
                               $applyto,
                               $from ,
                               $to){



        $western_arabic = array('0','1','2','3','4','5','6','7','8','9','.');
        $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩',',');

        $html = '';
        

        switch ($certificate){
 
         case 1:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);

           $html = $html .'<br><br><br><br> <table >  <tr>   <td width=250 >   <h1 > </h1>   </td>   <td >   <h1 >شـهــــادة</h1>
            </td>   <td width=250 >   <h1 > </h1>   </td>  </tr> </table> ';
          
                  if($students[0]->gender==1)
                      $html = $html .'<br> تشهد كلية الهندسة جامعة عين شمس بأن الطالبة/   ';
                  else
                      $html = $html .'<br> تشهد كلية الهندسة جامعة عين شمس بأن الطالب/   ';
                          
                         //$html= $html.'<br>';
                         
          $html = $html .$students[0]->name;
          $html = $html .'<br/><br/><table >  <tr style"width:100%">   <td style="float:right; width:33.33333%; max-width:33.33333%; " > بلد الجنسية:';
          $html = $html .$students[0]->nationality;
          $html = $html .'</td>   <td style="float:right; width:33.33333%; max-width:33.33333%; " >   محل الميلاد:';
                  $html = $html .$students[0]->coname." : ".$students[0]->coename;
          $html = $html .'</td>   <td style="float:right; width:33.33333%; max-width:33.33333%; ">     تاريخ الميلاد:';
                  $html = $html . str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($students[0]->birthdate)));   //date_format($row[5],"Y/m/d");
          $html = $html .'</td>  </tr> </table>';
          
                  
             $html = $html .'<table >  <tr>   <td width=230 > ';
                          if($students[0]->gender==1)
                      $html = $html .'مقيدة بالفرقة:';
                  else
                      $html = $html .'مقيد بالفرقة:';
          $html = $html .$students[0]->year;
          $html = $html .'</td>   <td width=350 >   تخصص :';
                  $html = $html .$students[0]->MSname;
          $html = $html .'</td>  </tr> </table>';
                  
          $html = $html .'شعبة :';
                  $html = $html .$students[0]->name2;
          $html = $html .'<br>نظامى فى العام الجامعى : ';
          $html = $html . str_replace($western_arabic, $eastern_arabic, $students[0]->desc);
                  
          $html = $html .'&nbsp; &nbsp; &nbsp; كطالب :';
           $html = $html .$students[0]->SSIdesc;
           
                   if($students[0]->gender==1)
                      $html = $html .'<br> وقد أعطيت لها هذه الشهادة بناء على طلبها لتقديمها إلى  : ';
                  else
                      $html = $html .'<br><br> وقد أعطيت له هذه الشهادة بناء على طلبه  لتقديمها إلى  : ';

                  $html = $html.$applyto;
          
                  
          $html = $html .'<br> وذلك دون أدنى مسئولية على الجامعة أو الحكومة فيما يتعلق بحقوق الغير.
          
          <br><br><table >  <tr>   <td width=200 > الموظف المسئول
                               </td>   <td width=200 >   المراجع
                               </td>   <td width=300 >   مدير إدارة شئون التعليم والطلاب  
                               </td>  </tr> </table>
                                             
          <br><br><br><table >  <tr>   <td width=200 >  
                               </td>   <td width=200 >   
                               </td>   <td width=300 >     وكيل الكلية لشئون التعليم والطلاب       
                               </td>  </tr> </table>
          ';
            break;

         case 2:

            $lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'ar';
            $lg['w_page'] = 'page';



            PDF::setLanguageArray($lg);


             $html = $html .' <table >  <tr>   <td width=250 >   <h1 > </h1>   </td>   <td >   <h1 >شـهــــادة</h1>
              </td>   <td width=250 >   <h1 > </h1>   </td>  </tr> </table> ';
        
                if($students[0]->gender==1)
                    $html = $html .'<br> تشهد كلية الهندسة جامعة عين شمس بأن الطالبة/   ';
                else
                    $html = $html .'<br> تشهد كلية الهندسة جامعة عين شمس بأن الطالب/   ';
                     
                   $html = $html.'<br/>';
                    
                $html = $html .$students[0]->name;
                $html = $html .'<table >  <tr>   <td width=200 > بلد الجنسية:';
                $html = $html .$students[0]->nationality;
                $html = $html .'</td>   <td width=250 >   محل الميلاد:';
                         $html = $html .$students[0]->coname." : ".$students[0]->coename;
                $html = $html .'</td>   <td width=200 >     تاريخ الميلاد:';
                        $html = $html .str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($students[0]->birthdate)));
                $html = $html .'</td>  </tr> </table>';
                
                        
                   $html = $html .'<table >  <tr>   <td width=230 > ';
                        if($students[0]->gender==1)
                            $html = $html .'مقيدة بالفرقة:';
                        else
                            $html = $html .'مقيد بالفرقة:';
                $html = $html .$students[0]->year;
                $html = $html .'</td>   <td width=350 >   تخصص :';
                        $html = $html .$students[0]->MSname;
                $html = $html .'</td>  </tr> </table>';
                        
                $html = $html .'شعبة :';
                        $html = $html .$students[0]->name2;
                $html = $html .'<br>نظامى فى العام الجامعى : ';
                $html = $html .str_replace($western_arabic, $eastern_arabic, $students[0]->desc);
                        
                $html = $html .'&nbsp; &nbsp; &nbsp; كطالب :';
                 $html = $html .$students[0]->SSIdesc;
                 
                        
                 if($students[0]->gender==1)
                            $html = $html .'<br>والكلية ليس لديها مانع من سفر الطالبة المذكورة خلال أجازة آخر العام فى الفترة من &nbsp; &nbsp;';
                        else
                            $html = $html .'<br>والكلية ليس لديها مانع من سفر الطالب المذكور خلال أجازة آخر العام فى الفترة من &nbsp; &nbsp;';
                $html = $html .str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($from))). '&nbsp; &nbsp; حتى &nbsp; &nbsp;';
                $html = $html .str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($to))). '&nbsp; &nbsp;';
                
                        if($students[0]->gender==1){}
                        else
                    {
                         //$html = $html .'والمذكور &nbsp; &nbsp;'. $row[16] . '&nbsp; &nbsp; تجنيده بالقرار رقم &nbsp; &nbsp;'. str_replace($western_arabic, $eastern_arabic, $row[17] ). '&nbsp; &nbsp;   لسنة &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic,  $row[18]) . '&nbsp; &nbsp;   لسن &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic,  $row[19]) . '&nbsp; &nbsp; وبرقم ثلاثى   &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic,  $row[15]) . '&nbsp; &nbsp; ';
                   
                        }
                        
                        
                        
                        
                        $html = $html .'إذا ما وافقت الجهات المختصة على ذلك.';       
                 
                         if($students[0]->gender==1)
                            $html = $html .'<br> وقد أعطيت لها هذه الشهادة بناء على طلبها لتقديمها إلى  : ';
                        else
                            $html = $html .'<br> وقد أعطيت له هذه الشهادة بناء على طلبه لتقديمها إلى  : ';
                        $html = $html .$applyto;
                
                        $html = $html .'<br> وذلك دون أدنى مسئولية على الجامعة أو الحكومة فيما يتعلق بحقوق الغير.
                
                <br><br><table >  <tr>   <td width=200 > الموظف المسئول
                                     </td>   <td width=200 >   المراجع
                                     </td>   <td width=300 >   مدير إدارة شئون التعليم والطلاب  
                                     </td>  </tr> </table>
                                                   
                <br><br><br><table >  <tr>   <td width=200 >  
                                     </td>   <td width=200 >   
                                     </td>   <td width=300 >     وكيل الكلية لشئون التعليم والطلاب       
                                     </td>  </tr> </table>
        ';
            break;
            
         case 3:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);
                    
        $html = $html .' <table >  <tr>   <td width=200 >   <h1 > </h1>   </td>   <td width=250>   <h1 > شـهــــادة تخرج</h1>
          </td>   <td width=200 >   <h1 > </h1>   </td>  </tr> </table> <br><br> ';
        
                    $html = $html .'تشهد كلية الهندسة جامعة عين شمس أن/  ';
                     
                  
                    
                     
                $html = $html .$students[0]->name ;
                $html = $html .'<br><br><table >  <tr>   <td width=200 > بلد الجنسية:';
                $html = $html .$students[0]->nationality;
                $html = $html .'</td>   <td width=250 >   محل الميلاد:';
                         $html = $html .$students[0]->coname." : ".$students[0]->coename;
                $html = $html .'</td>   <td width=200 >     تاريخ الميلاد:';
                        $html = $html .str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($students[0]->birthdate)));
                $html = $html .'</td>  </tr> </table><br>';
                
                 if($students[0]->gender==1)
                    $html = $html .'<br>قد حصلت على درجة  &nbsp; &nbsp; بكالوريوس &nbsp; &nbs'.$students_graduated[0]->MSname  .'&nbsp; &nbsp; شعبة &nbsp; &nbsp;'.$students[0]->name2;
                else
                    $html = $html .'<br>قد حصل على درجة  &nbsp; &nbsp; بكالوريوس &nbsp; &nbsp;' .$students[0]->MSname   .'&nbsp; &nbsp; شعبة &nbsp; &nbsp;'.$students[0]->name2;
                    
                
                $html = $html .'<br><br>فى دور  &nbsp; &nbsp; ' .str_replace($western_arabic, $eastern_arabic, $students[0]->Dname)  
                                                               .'&nbsp; &nbsp; بتقدير &nbsp; &nbsp;'.$students_graduated[0]->Gname.'&nbsp; &nbsp;'.$students_graduated[0]->Hname;
                $html = $html .'<br><br> وحصل على المشروع بتقدير  &nbsp; &nbsp;'.$students_graduated[0]->GIDname;
                
                $total=$students_graduated[0]->Y0m + $students_graduated[0]->Y1m+ $students_graduated[0]->Y2m+$students_graduated[0]->Y3m+$students_graduated[0]->Y4m; 
                $percent= $students_graduated[0]->total*100/$total;
        		if($percent>=64 && $percent<65 ) $percent=65;
        		if($percent>=74 && $percent<75 ) $percent=75;
        		if($percent>=84 && $percent<85 ) $percent=85;
                $percent=number_format((float)$percent, 2, '.', '');
                //$string = sprintf("%.3f", $float);
                $html = $html .'<br><br> مجموع تراكمى     &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic, $students_graduated[0]->total)
                .'&nbsp; من&nbsp;'.str_replace($western_arabic, $eastern_arabic, $total).'&nbsp; &nbsp; النسبة المئوية &nbsp; &nbsp;';
                $html = $html.str_replace($western_arabic, $eastern_arabic, $percent) .'&nbsp; % &nbsp;' ;
              
                $html = $html .'<br><br> وقد إعتمد مجلس الكلية نتيجة الإمتحان فى      &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($students_graduated[0]->fapproval))); 
                $html = $html .'<br><br> والجامعة فى       &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($students_graduated[0]->uapproval)));
        
        
        
                $html = $html .'<br><br><br><table >  <tr>   <td width=150 > الموظف المسئول
                             </td>   <td  width=50>   المراجع
                             </td>   <td  width=290>   مدير إدارة شئون التعليم والطلاب  
                             </td>   <td width=150>       عميد الكلية  
                             </td>  </tr> </table>   ';
                     
             break;
         
         case 4:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);
            
      $html = $html .' <br><br><br><br>
                          <table>
                             <tr>
                               <td width=250><h1></h1></td><td> 
                                    <h1 style=" font-size: 19px;" align="center">شهادة تقديرات</h1>
                               </td><td width=250><h1 ></h1></td>  
                              </tr> 
                        </table><br> ';
    
                $html = $html .' <p style="font-size: 11pt;  line-height: 100%;" ><br> تشهد كلية الهندسة جامعة عين شمس بأن /  ';
                 
              
                
            $html = $html .$AppreciationCertificate[0]->name.' </p>' ;
            $html = $html .'<table  >  <tr>   <td width=200  style="font-size: 11pt;  line-height: 100%;"> بلد الجنسية:';
            $html = $html .$AppreciationCertificate[0]->nationality;
            $html = $html .'</td>   <td width=250  style="font-size: 11pt;  line-height: 100%;" >   محل الميلاد:';
                    $html = $html .$AppreciationCertificate[0]->cname." : ".$AppreciationCertificate[0]->cename;
            $html = $html .'</td>   <td width=200  style="font-size: 11pt;  line-height: 100%;" >     تاريخ الميلاد:';
                    $html = $html .str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($AppreciationCertificate[0]->birthdate)));   //date_format($row[5],"Y/m/d");
            $html = $html .'</td>  </tr> </table>';
    
    
    
            
            if($AppreciationCertificate[0]->gender==1)
                $html = $html .'<p style="font-size: 11pt;  line-height: 110%;" >قد حصلت على درجة  &nbsp; &nbsp; بكالوريوس &nbsp; &nbsp;
                ' .$AppreciationCertificate[0]->MSname .'&nbsp; &nbsp; شعبة &nbsp; &nbsp;'.$AppreciationCertificate[0]->name2;
            else
                $html = $html .'<p style="font-size: 11pt;  line-height: 110%;" >قد حصل على درجة  &nbsp; &nbsp; بكالوريوس &nbsp; &nbsp;
                ' .$AppreciationCertificate[0]->MSname .'&nbsp; &nbsp; شعبة &nbsp; &nbsp;'.$AppreciationCertificate[0]->name2; 
                
            $html = $html .'&nbsp;&nbsp;&nbsp; دور  '
            .str_replace($western_arabic, $eastern_arabic,$AppreciationCertificate[0]->DTname)  .'&nbsp; &nbsp; بتاريخ: &nbsp; &nbsp;
            '.str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($AppreciationCertificate[0]->Gename))) 
            .'&nbsp; &nbsp;&nbsp; &nbsp; بتقدير &nbsp; &nbsp;'.$AppreciationCertificate[0]->Gname.'&nbsp; &nbsp;'.$AppreciationCertificate[0]->Hname;
            
            $html = $html .' وحصل على المشروع بتقدير  &nbsp; &nbsp;'.$AppreciationCertificate[0]->GIDname;
            
             $total=$AppreciationCertificate[0]->Y0m + $AppreciationCertificate[0]->Y1m+ $AppreciationCertificate[0]->Y2m+$AppreciationCertificate[0]->Y3m+$AppreciationCertificate[0]->Y4m; 
                $percent= $AppreciationCertificate[0]->total*100/$total;
    		if($percent>=64 && $percent<65 ) $percent=65;
    		if($percent>=74 && $percent<75 ) $percent=75;
    		if($percent>=84 && $percent<85 ) $percent=85;
            $percent=number_format((float)$percent, 2, '.', '');
            
            $html = $html .'<br> مجموع تراكمى     &nbsp; &nbsp;
            '.str_replace($western_arabic, $eastern_arabic, $AppreciationCertificate[0]->total).'&nbsp; من&nbsp;'
            .str_replace($western_arabic, $eastern_arabic, $total).'&nbsp; &nbsp; النسبة المئوية &nbsp; &nbsp;';
            $html = $html.str_replace($western_arabic, $eastern_arabic, $percent ).'&nbsp; % &nbsp;' ;
          
            $html = $html .'<br> وفيما يلى بيان بتقديرات المواد التى تمت دراستها وعدد الساعات أسبوعيا </p>';



             $student_Ginfo = DB::select(DB::raw('SELECT
                                                        YEAR.name AS yname,
                                                        d_student_status.code,
                                                        d_term.name AS DTname,
                                                        student_status_index.name AS SSname,
                                                        d_student_status.sum,
                                                        d_student_status.bn,
                                                        grade_id.name AS Gname,
                                                        d_student_status.year,
                                                        d_student_status.term,
                                                        d_term.desc,
                                                        main_spec.name AS MSname
                                                        
                                                    FROM
                                                        d_student_total
                                                    LEFT JOIN d_student_status ON d_student_status.code = d_student_total.code
                                                    LEFT JOIN YEAR ON d_student_status.year = YEAR.id
                                                    LEFT JOIN student_status_index ON student_status_index.id = d_student_status.student_status
                                                    LEFT JOIN d_term ON d_term.id = d_student_status.term
                                                    LEFT JOIN main_spec ON d_student_total.main_spec = main_spec.id
                                                    LEFT JOIN grade_id ON grade_id.id = d_student_status.grade
                                                    WHERE
                                                        d_student_status.code = "'.$code.'"
                                                    AND
                                                         d_student_status.sum > 0
                                                    ORDER BY
                                                         d_student_status.bn,d_term.name '));
                    
                  foreach ($student_Ginfo as $item){

                        //                            $Courses = DB::table('course_inf')
//                                ->leftJoin("d_student_course",function($join){
//                                    $join->on("course_inf.code","=", "d_student_course.course_code");
//                                    $join->on("course_inf.dept","=","d_student_course.dept");
//                                })
//                                ->leftJoin('course_related_inf_e','course_related_inf_e.counter','=','d_student_course.counter_for_e')
//                                ->leftJoin("grade_id","d_student_course.grade","=","grade_id.id")
//                                ->leftJoin("course_inf_e",function($join){
//                                    $join->on("course_related_inf_e.code_e","=","course_inf_e.code_e");
//                                    $join->on("course_related_inf_e.dept_e","=","course_inf_e.dept");
//                                    $join->on("course_related_inf_e.year","=","course_inf_e.year");
//                                    $join->on("course_related_inf_e.minor_spec","=","course_inf_e.minor_spec");
//                                    $join->on("course_related_inf_e.main_spec","=","course_inf_e.main_spec");
//                                })
//                                ->select("course_inf.dept", "course_inf.code", "course_inf.name AS cname", "course_inf.ename AS cename",
//                                "course_inf_e.name AS elname","course_inf_e.ename AS elename","course_inf.weeks","course_inf.lecture",
//                                "course_inf.tutorial","grade_id.name AS gname", "grade_id.ename AS gename","d_student_course.grade",'course_inf.year')
//                                ->where('course_inf.main_spec','=',$students[0]->main_spec)->where('course_inf.minor_spec','=',$students[0]->minor_spec)
//                                ->where('course_inf.year','=',$i)->where('d_student_course.code','=',$code)
//                                //->take(10)
//                                ->get();

                      $html = $html .'<table >  <tr > <td style="font-size: 17px; font-weight:bold;">';
                      $html = $html .' -الفرقة  &nbsp; '.$item->yname. ' &nbsp; تخصص: &nbsp;'.$item->MSname
                          . ' &nbsp; شعبة: &nbsp;'.$students[0]->name2. ' &nbsp; '
                          .str_replace($western_arabic, $eastern_arabic, $item->desc);
                      $html = $html .'  </td>  </tr> </table> ';
                            $Courses = DB::select(DB::raw('
                                               SELECT
                                                   course_inf.dept, 
                                                   course_inf.code, 
                                                   course_inf.name AS cname, 
                                                   course_inf.ename AS cename,
                                                   course_inf_e.name AS elname,
                                                   course_inf_e.ename AS elename,
                                                   course_inf.weeks,
                                                   course_inf.lecture,
                                                   course_inf.tutorial,
                                                   grade_id.name AS gname, 
                                                   grade_id.ename AS gename,
                                                   d_student_course.grade,
                                                   course_inf.year
                                                FROM
                                                    (
                                                        (
                                                            course_inf
                                                        LEFT JOIN d_student_course ON(
                                                                course_inf.code = d_student_course.course_code
                                                            ) AND(
                                                                course_inf.dept = d_student_course.dept
                                                            ) AND(
                                                                 course_inf.minor_spec = d_student_course.minor_spec
                                                            )
                                                        )
                                                    LEFT JOIN grade_id ON d_student_course.grade = grade_id.id
                                                    LEFT JOIN department ON department.id = d_student_course.dept
                                                    LEFT JOIN course_state ON course_state.id = d_student_course.course_state
                                                    LEFT JOIN control_action ON control_action.id = d_student_course.control_action
                                                    )
                                                LEFT JOIN(
                                                        course_related_inf_e
                                                    LEFT JOIN course_inf_e ON(
                                                            course_related_inf_e.code_e = course_inf_e.code_e
                                                        ) AND(
                                                            course_related_inf_e.dept_e = course_inf_e.dept
                                                        ) AND(
                                                            course_related_inf_e.year = course_inf_e.year
                                                        ) AND(
                                                            course_related_inf_e.minor_spec = course_inf_e.minor_spec
                                                        ) AND(
                                                            course_related_inf_e.main_spec = course_inf_e.main_spec
                                                        )
                                                    )
                                                ON
                                                    d_student_course.counter_for_e = course_related_inf_e.counter
                                                WHERE
                                                    d_student_course.code = "'.$item->code.'" AND d_student_course.year="'.$item->year.'" 
                                                    AND d_student_course.term = "'.$item->term.'"
             '));

                               
                   $html = $html .'<table  border="1" style="font-size: 12px;"> <tr> <td width=70 style="font-size: 16px;  line-height: 100%;">المواد</td>';
                      foreach($Courses as &$course){
                                   
                                    $row5=(array)$course;


                          $coursename="";
                    if(strlen($row5["elname"])==0)  $coursename=$row5["cname"]; else  $coursename=$row5["elname"];
                          
                          $html = $html .'<td width=70  style="font-size: 12px;  line-height: 100%; text-align: center;">'.str_replace($western_arabic, $eastern_arabic, $coursename).'</td>';
                   
                                }
                    // if(strlen($row2[2])!=0) $html = $html .' <td width=70  style="font-size: 10pt;  line-height: 100%;">التقدير العام</td>';
                       $html = $html .'</tr> <tr> <td width=70  style="font-size: 12px;  line-height: 100%;">عدد الساعات</td>';
                   foreach($Courses as &$row4){
                                   
                                    $row5=(array)$row4;
                          
                       $n1="0";
                       $n2="0";
                       $n3="";
                       if(strlen($row5["lecture"])==0)  $n1="0"; else  $n1=$row5["lecture"];
                       if(strlen($row5["tutorial"])==0)  $n2="0"; else  $n2=$row5["tutorial"];
                       if(strlen($row5["weeks"])>0){
                       if($row5["weeks"]>20) 
                         $n3="**"; else  $n3="*";
                           
                       }
                          
                          $html = $html .'<td width=70  style="font-size: 12px;  line-height: 100%;">'.str_replace($western_arabic, $eastern_arabic, $n1). '-'.str_replace($western_arabic, $eastern_arabic, $n2).str_replace($western_arabic, $eastern_arabic, $n3).'</td>';
                   
                         }
                  // if(strlen($row2[2])!=0) $html = $html .' <td></td>';
                   $html = $html .'</tr><tr> <td width=70  style="font-size: 13px;  line-height: 100%;">التقدير</td>';
                   foreach($Courses as &$row4){
                                   
                                    $row5=(array)$row4;
                          
                          
                          $html = $html .'<td width=70  style="font-size: 13px;  line-height: 100%;">'.$row5["gname"].'</td>';
                   
                                }
                //    if(strlen($row2[2])!=0)
                //      $html = $html .' <td width=70  style="font-size: 10pt;  line-height: 100%;">'.$row3[13].'</td>';
                     
                   $html = $html .'</tr> </table><br>';
                            }
                    
                    $html = $html .'<table >  <tr>   <td style="font-size:10pt;" >       
                         عدد الساعات أسبوعيا(محاضرة-تمرين/عملى)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *مادة فصلية (14 أسبوع) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**مادة متصلة (28 أسبوع)    
                    </td>    </tr> </table>  ';
                  $html = $html .'<table >  <tr>   <td style="font-size: 10pt;" >';       
                    $html = $html ."<p></p>".'تحريرا فى :  &nbsp;'.str_replace($western_arabic, $eastern_arabic, date("Y/m/d", time())); 
                      $html = $html .'</td>    </tr> </table>  ';
             
                            $html = $html .'<table >  <tr>   <td style="font-size: 9.5pt;" >       
                          وقد أعطيت له هذه الشهادة بناء على طلبه لتقديمها إلى من يهمه الأمر دون أدنى مسئولية على الجامعة أو الحكومة فيما يتعلة بحقوق الغير.  
                           </td>    </tr> </table>';
                    
                    
               //     $html = $html ."<p></p>".'تحريرا فى :  &nbsp;'.str_replace($western_arabic, $eastern_arabic, date("Y/m/d", time())); 
               //     $html = $html .'<p></p>'.'وقد أعطيت له هذه الشهادة بناء على طلبه لتقديمها إلى من يهمه الأمر دون أدنى مسئولية على الجامعة أو الحكومة فيما يتعلق بحقوق الغير.';
                    $html = $html .'<table style="width: 100%"> <tr > 
                                 <td style="font-size: 12pt; width: 20%"> الموظف المسئول
                                 </td>   <td style="font-size: 12pt; width: 20%;">   المراجع
                                 </td>   <td  style="font-size: 12pt; text-align:right; width: 40%;">   مدير إدارة شئون التعليم والطلاب  
                                 </td>   <td  style="font-size: 12pt; text-align: left; width: 20%;">       عميد الكلية  
                                 </td>  </tr> </table>  ';
                    
   // }
             
             break;

         case 5:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);
                         
                        $html = '<hr style="height:25pt; visibility:hidden;color:rgb(255,255,255)" />';
                        $html = '<br style="line-height:32px;color:rgb(70, 136, 241)">';
                    

            
                        $html = $html .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;'.'الـهـنـدســــــــــــة<br> ';
                         
                        $html = $html.'<hr style="height:1pt; visibility:hidden;color:rgb(255,255,255)" />';
                    
                        
            $html = $html .'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;'.$lastCertifcate[0]->name;
            $html = $html.'<hr style="height:4pt; visibility:hidden;color:rgb(255,255,255)" />';
            $html = $html .'<table >  <tr>   <td width=320 >';
            $html = $html .'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'.$lastCertifcate[0]->CIname;
            $html = $html .'</td>   <td width=220 >';
            $html = $html .str_replace($western_arabic, $eastern_arabic, $lastCertifcate[0]->nationalid) ;
            $html = $html .'</td>   <td width=150 >';
            $html = $html .$lastCertifcate[0]->C1name;
            $html = $html .'</td>  </tr> </table>';
            
                    
                           // $html = $html.'<hr style="height:-1pt; visibility:hidden;color:rgb(255,255,255)" />';    
              
                        $html = $html .'&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; بكالوريوس &nbsp;' .$lastCertifcate[0]->MSname ;
                        $html = $html    .'&nbsp;-&nbsp; شعبة  &nbsp;'.$lastCertifcate[0]->name2;
                    
                    
                                 // $html = $html.'<hr style="height:0pt; visibility:hidden;color:rgb(255,255,255)" />';    
              
                     $html = $html .' &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; وحصل على المشروع بتقدير  &nbsp; &nbsp;'.$lastCertifcate[0]->GIDname;
                    
                    $grdyear=  $lastCertifcate[0]->DTname;
                    $len=strlen ($grdyear);
                    $grdyear=substr($grdyear, 0, $len-4) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . substr($grdyear, $len-4);
                    
                    $html = $html.'<hr style="height:6pt; visibility:hidden;color:rgb(255,255,255)" />';    
            
                    
                    $html = $html .'<table >  <tr height=90>   <td width=400 >';
            $html = $html .' &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'.str_replace($western_arabic, $eastern_arabic, $grdyear) ;
            $html = $html .'</td>   <td width=250 >';
            $html = $html.'&nbsp;&nbsp;' .$lastCertifcate[0]->Gname.'&nbsp; &nbsp;'.$lastCertifcate[0]->Hname;
            $html = $html .'</td> </tr><tr height=90>   <td colspan="2" ;width=650 > ';
        
                    $html = $html .'</td> </tr></table> ';
                    $total=$lastCertifcate[0]->Y0m+$lastCertifcate[0]->Y1m+$lastCertifcate[0]->Y2m+$lastCertifcate[0]->Y3m+$lastCertifcate[0]->Y4m;
                    $percent= $lastCertifcate[0]->total*100/$total;
            		if($percent>=64 && $percent<65 ) $percent=65;
            		if($percent>=74 && $percent<75 ) $percent=75;
            		if($percent>=84 && $percent<85 ) $percent=85;
                    $percent=number_format((float)$percent, 2, '.', '');
                    //$string = sprintf("%.3f", $float);
                                    //$html = $html.'<hr style="height:-2pt; visibility:hidden;color:rgb(255,255,255)" />';    
            
                    $html = $html .'&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;   &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic, $lastCertifcate[0]->total).'&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;'.str_replace($western_arabic, $eastern_arabic, $total).
                    '&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                    $html = $html.str_replace($western_arabic, $eastern_arabic, $percent) .'&nbsp; % &nbsp;</p>' ;
                                  $html = $html.'<hr style="height:1pt; visibility:hidden;color:rgb(255,255,255)" />';    
            
                    $html = $html .'&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;    
                    &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($lastCertifcate[0]->fapproval))); 
                    
                    $html = $html.'<hr style="height:1pt; visibility:hidden;color:rgb(255,255,255)" />';    
            
                    $html = $html .'&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;       
                    &nbsp; &nbsp;'.str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($lastCertifcate[0]->uapproval))); 

                                   // $html = $html.'<hr style="height:72pt; visibility:hidden;color:rgb(255,255,255)" />';    
            
                    $html = $html .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;'.
                    str_replace($western_arabic, $eastern_arabic, date("Y/m/d", time())); 


             break;

         case 6:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);

             $html = '<br><br><br><br>
                                      <table>
                                         <tr>
                                           <td width=250 style="font-size:13px;"><h1></h1></td><td> 
                                                <p align="center" style="font-size:13px;">أدارة شئون الطلاب <br>
                                                                  student Affairs
                                                </p>                         
                                           </td><td width=250><h1 ></h1></td>  
                                          </tr> 
                                      </table>';

             $html = $html .'<br><br>
                                      <table>
                                         <tr>
                                           <td width=250><h1></h1></td><td> 
                                                <h1 style="text-decoration: underline; 
                                                           font-size: 19px;" align="center">افادة</h1>
                                           </td><td width=250><h1 ></h1></td>  
                                          </tr> 
                                      </table><br>';

             $html = $html .'<br><br/> <table style="font-size:16px;">  <tr style"width:100%">';
             if($students[0]->gender==1)
                 $html = $html .'<td style="float:right; width:85%; max-width:85%; ">تفيد كلية الهندسة جامعة عين شمس بأن الطالبة/ ';
             else
                 $html = $html .'<td style="float:right; width:85%; max-width:85%; ">تفيد كلية الهندسة جامعة عين شمس بأن الطالب / ';
             $html = $html .$students[0]->name;
             $html = $html .'</td>   <td style="float:right; width:15%; max-width:15%; "> جنسيته: ';
             $html = $html .$students[0]->nationality;
             $html = $html .'</td>  </tr> </table>';



             $html = $html .'<br><br/> <table style="font-size: 16px;">  <tr style"width:100%">';
             $html = $html .'<td style="float:right; width:70%; max-width:70%; " >  المولود فى ';
             $html = $html .$students[0]->coname." : ".$students[0]->coename;
             $html = $html .'</td>   <td style="float:right; width:30%; max-width:30%; "> تاريخ الميلاد:';
             $html = $html . str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($students[0]->birthdate)));   //date_format($row[5],"Y/m/d");
             $html = $html .'</td>  </tr> </table> <br>';

             $html = $html.'<h1 style="font-size: 16px;"> الطالب مقيد بالبرامج الجديدة وقد سجل (120) ساعة من (180) ساعة معتمدة مطلوبة للتخرج وبذلك فهو مقيد<br><br> بالمستوى الثالث هندسة الميكاترونيات 2017/2018 <br></h1>';

             if($students[0]->gender==1)
                 $html = $html .'<h1 style="font-size: 17px"> وقد أعطيت لها هذه الشهادة بناء على طلبها لتقديمها إلى  / ';
             else
                 $html = $html .'<br><h1 style="font-size:17px"> وقد أعطيت له هذه الشهادة بناء على طلبه  لتقديمها إلى  / ';

             $html = $html.$applyto .'</h1>';


             $html = $html .'<h1 style="font-size: 17px;"> وذلك دون أدنى مسئولية على الجامعة أو الحكومة فيما يتعلق بحقوق الغير. <br><br></h1>';

             $html = $html .'<br/><br><br><br><table style="font-size: 17px;"><tr><td width=200 > الموظف المسئول
                               </td>   <td width=200 >   المراجع
                               </td>   <td width=300 >   مدير إدارة شئون التعليم والطلاب  
                               </td>  </tr> </table><br><br><br><br>
                                             
                       <table style="font-size: 17px;">
                             <tr style="width: 100%">
                                <td style="width: 60%"></td>   
                                 <td style="width: 40%" align="left">  وكيل الكلية لشئون التعليم والطلاب  </td>  
                              </tr> 
                       </table>
          ';


           break;

         case 7:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);

             $html = '<br><br><br><br>
                                      <table>
                                         <tr>
                                           <td width=250 style="font-size:13px;"><h1></h1></td><td> 
                                                <p align="center" style="font-size:13px;">أدارة شئون الطلاب <br>
                                                                  student Affairs
                                                </p>                         
                                           </td><td width=250><h1 ></h1></td>  
                                          </tr> 
                                      </table>';

             $html = $html .'<br><br>
                                      <table>
                                         <tr>
                                           <td width=250><h1></h1></td><td> 
                                                <h1 style="text-decoration: underline; 
                                                           font-size: 19px;" align="center">افادة</h1>
                                           </td><td width=250><h1 ></h1></td>  
                                          </tr> 
                                      </table><br>';

             $html = $html .'<br><br/> <table style="font-size:16px;">  <tr style"width:100%">';
             if($students[0]->gender==1)
                 $html = $html .'<td style="float:right; width:85%; max-width:85%; ">تفيد كلية الهندسة جامعة عين شمس بأن الطالبة/ ';
             else
                 $html = $html .'<td style="float:right; width:85%; max-width:85%; ">تفيد كلية الهندسة جامعة عين شمس بأن الطالب / ';
             $html = $html .$students[0]->name;
             $html = $html .'</td>   <td style="float:right; width:15%; max-width:15%; "> جنسيته: ';
             $html = $html .$students[0]->nationality;
             $html = $html .'</td>  </tr> </table>';



             $html = $html .'<br><br/> <table style="font-size: 16px;">  <tr style"width:100%">';
             $html = $html .'<td style="float:right; width:70%; max-width:70%; " >  المولود فى ';
             $html = $html .$students[0]->coname." : ".$students[0]->coename;
             $html = $html .'</td>   <td style="float:right; width:30%; max-width:30%; "> تاريخ الميلاد:';
             $html = $html . str_replace($western_arabic, $eastern_arabic, date("Y/m/d", strtotime($students[0]->birthdate)));   //date_format($row[5],"Y/m/d");
             $html = $html .'</td>  </tr> </table> <br>';
                 //
             $html = $html.'<h1 style="font-size: 16px;"> الطالب مقيد بالفرقة الأولى هندسة ميكانيكية مستجد بالعام الجامعى 2018/2017</h1> <br>';
             $html = $html.'<h1 style="font-size: 16px;">علما بأن الطالب المذكور مؤجل لسن 28 عام برقم ثلاثى (1190/43/98)ورقم قرار 2018/3/1/2356 والكلية  </h1>';
             $html = $html.'<h1 style="font-size: 16px;"> ليس لديها مانع من استخراج / تجديد جواز سفر للطالب المذكور أذا ماوافقت الجهات المختصة على ذلك <br></h1>';


             if($students[0]->gender==1)
                 $html = $html .'<h1 style="font-size: 17px"> وقد أعطيت لها هذه الشهادة بناء على طلبها لتقديمها إلى  / ';
             else
                 $html = $html .'<br><h1 style="font-size:17px"> وقد أعطيت له هذه الشهادة بناء على طلبه  لتقديمها إلى  / ';

             $html = $html.$applyto .'</h1>';


             $html = $html .'<h1 style="font-size: 17px;"> وذلك دون أدنى مسئولية على الجامعة أو الحكومة فيما يتعلق بحقوق الغير. <br><br></h1>';

             $html = $html .'<br/><br><br><br><table style="font-size: 17px;"><tr><td width=200 > الموظف المسئول
                               </td>   <td width=200 >   المراجع
                               </td>   <td width=300 >   مدير إدارة شئون التعليم والطلاب  
                               </td>  </tr> </table><br><br><br><br>
                                             
                       <table style="font-size: 17px;">
                             <tr style="width: 100%">
                                <td style="width: 60%"></td>   
                                 <td style="width: 40%" align="left">  وكيل الكلية لشئون التعليم والطلاب  </td>  
                              </tr> 
                       </table>
          ';

            break;

         case 8:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);

             $html = '<br><br><br><br>
                                      <table>
                                         <tr>
                                           <td width=250 style="font-size:13px;"><h1></h1></td><td> 
                                                <p align="center" style="font-size:13px;">أدارة شئون الطلاب <br>
                                                                  student Affairs
                                                </p>                         
                                           </td><td width=250><h1 ></h1></td>  
                                          </tr> 
                                      </table>';

             $html = $html.'<br><br><h1 style="font-size: 16px;">السيد / رئيس قطاع التدريب بشركة المقاولون العرب </h1> ';

             $html = $html . '<h1 style="text-align: center; font-size: 16px;" > تحية طيبة وبعد .... </h1><br/>';

             $html = $html . '<h1 style="font-size: 16px;"> بناء على الطلب المقدم من الطالب / مصطفى احمد السيد غطاس</h1><br/>';

             $html = $html . '<br><table style="width: 100%; font-size:16px;">
                                 <tr style="width: 100%;">
                                   <td style="width: 25%"> المقيد : مستجد</td>
                                   <td style="width: 25%"> بالفرقة : الأولى </td>
                                   <td style="width: 25%"> قسم :ميكانيكا</td>
                                   <td style="width: 25%;"> شعبة: عامة</td>
                                 </tr>
                              </table> <br/>';

             $html = $html.'<h1 style="font-size: 16px;">العام الجامعى 2018/2017 والخاص بتدريبه خلال العطلة الصيفية.</h1> <br/>';

             $html = $html.'<h1 style="font-size: 16px;">نتشرف بالافادة بأن الكلية ليس لديها مانع من التدريب طرفكم بناء على طلبه .<br/></h1>';

             $html = $html.'<br><table style="width: 100%; font-size: 16px;">
                             <tr style="width: 100%">
                              <td style="text-align: center;">وتفضلوا بقبول فائق الاحترام</td>
                             </tr>
                           </table> <br/><br/><br/>';

             $html = $html.'<table style="width: 100%; font-size: 16px;">
                              <tr style="font-size: 100%">
                                <td style="width: 33.333%; text-align: center;"> الموظف المسئول </td>
                                <td style="width: 33.333%; text-align: center;">  رئيس شئون الطلاب </td>
                                <td style="width: 33.333%; text-align: center;">  مدير ادارة شئون الطلاب </td>
                              </tr>
                           </table>';

             break;

         case 9:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);

             $html = '<br><br><br><br>
                                      <table>
                                         <tr>
                                           <td width=250 style="font-size:13px;"><h1></h1></td><td> 
                                                <p align="center" style="font-size:13px;">أدارة شئون الطلاب <br>
                                                                  student Affairs
                                                </p> 
                                           </td><td width=250><h1 ></h1></td>  
                                          </tr> 
                                      </table>';

             $html = $html.'<table style="width: 100%;"><tr style="width: 100%;"><td><br/><hr/></td></tr></table>';

             $html = $html.'<br/><table style="width: 100%;">
                                 <tr style="width: 100%;">
                                  <td style="text-align:center; text-decoration:underline; direction:ltr; font-size:19px;">STATEMENT</td>
                                 </tr></table>';
             $html = $html.'<br/><br/><table style="width: 100%;">
                                          <tr style="width: 100%">
                                           <td style="font-size:18px; text-align:left;">The Faculty of Engineering, Ain shams University confirms that <br/></td>
                                          </tr>
                            </table>';

             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Mr.Shady Ashraf Eryan Riad<br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Nationality:Egyption <br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 18px;"> National ID#:29801070101078 <br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 16px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 18px;"> Passport Number#:A20629641<br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Born on:7/1/1998 <br/></h1></td>
                             </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 100%;">
                                          <tr style="width: 100%">
                                           <td style="font-size:18px; text-align:left;">Is Resgister As a regular student in<br/> </td>
                                          </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Program:Mechanical Engineering <br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Level:First Year <br/></h1></td>
                             </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Academic Year: 2017/2018 <br/></h1></td>
                             </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 100%;">
                                          <tr style="width: 100%">
                                           <td style="font-size:19px; text-align:left;">The Language of Instruction in this Program is English <br/></td>
                                          </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 100%;">
                                          <tr style="width: 100%">
                                           <td style="font-size:20px; text-align:left;"> This Statement Was Prepared based on his request to submit to German Embassy</td>
                                          </tr>
                            </table><br/><br/>';
             $html = $html.'<table style="width: 100%; font-size: 17px;">
                              <tr>
                                <td style="text-align: left;">By: <br/> Date:6/6/2018 </td>
                              </tr>
                            </table>';
             $html = $html.'<br/><br/><table style="100%;">
                               <tr style="width: 100%;">
                                 <td style="font-size: 17px; width: 50%; text-align: center;">Registrar</td>
                                 <td style="font-size: 17px; width: 50%; text-align: center;">Dean</td>
                               </tr>
                            </table>';


             break;

         case 10:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'rtl';
             $lg['a_meta_language'] = 'ar';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);

             $html = '<br><br><br><br>
                                      <table>
                                         <tr>
                                           <td width=250 style="font-size:13px;"><h1></h1></td><td> 
                                                <p align="center" style="font-size:13px;">أدارة شئون الطلاب <br>
                                                                  student Affairs
                                                </p> 
                                           </td><td width=250><h1 ></h1></td>  
                                          </tr> 
                                      </table>';

             $html = $html.'<br/><br/><br/><table style="width: 100%;">
                                 <tr style="width: 100%;">
                                  <td style="text-align:center; text-decoration:underline; direction:ltr; font-size:19px;">CERTIFICATE</td>
                                 </tr></table>';
             $html = $html.'<br/><br/><table style="width: 100%;">
                                          <tr style="width: 100%">
                                           <td style="font-size:18px; text-align:left;">The Faculty of Engineering, Ain shams University confirms that <br/></td>
                                          </tr>
                            </table>';

             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Mr.Shady Ashraf Eryan Riad<br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Nationality:Egyption <br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 18px;"> National ID#:29801070101078 <br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 16px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 18px;"> Passport Number#:A20629641<br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Born on:7/1/1998 <br/></h1></td>
                             </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 100%;">
                                          <tr style="width: 100%">
                                           <td style="font-size:18px; text-align:left;">Attended the faculty on a full-time basis<br/> </td>
                                          </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> From: September 2001, To: june 2006 <br/></h1></td>
                             </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Program:Electrical Engineering, Electrical Communication Sec <br/></h1></td>
                             </tr>
                            </table><br/>';
             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Cumulative:(Good) <br/></h1></td>
                             </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 95%; font-size: 18px;">
                             <tr>
                               <td style="width: 100%;"><h1 style="width: 100%; text-align: left; font-size: 16px;"> Project Grade: Distinction <br/></h1></td>
                             </tr>
                            </table><br/>';

             $html = $html.'<table style="width: 100%;">
                                          <tr style="width: 100%">
                                           <td style="font-size:18px; text-align:left;"> 
                                             This represents the completion of 5 academic years. The language of instruction in this Program is English
                                           </td>
                                          </tr>
                            </table><br/><br/>';
             $html = $html.'<table style="width: 100%; font-size: 17px;">
                              <tr>
                                <td style="text-align: left;">By: <br/> Date:6/6/2018 </td>
                              </tr>
                            </table>';
             $html = $html.'<br/><br/><table style="100%;">
                               <tr style="width: 100%;">
                                 <td style="font-size: 17px; width: 40%; text-align: center;">Vice Dean For Education and Student Affairs</td>
                                 <td style="font-size: 17px; width: 60%; text-align: center;">Registrar</td>
                               </tr>
                            </table>';

             break;

         case 11:

             $lg = Array();
             $lg['a_meta_charset'] = 'UTF-8';
             $lg['a_meta_dir'] = 'ltr';
             $lg['a_meta_language'] = 'en';
             $lg['w_page'] = 'page';



             PDF::setLanguageArray($lg);

             $html = $html.'<br/><br/><br/><br/><br/><br/><table style="width: 100%;">
                                 <tr style="width: 100%;">
                                  <td style="text-align:center; text-decoration:underline; direction:ltr; font-size:19px;">GPA</td>
                                 </tr></table>';

             $html = $html.'<table style="width: 100%; font-size: 15px; text-align:left;">
                              <tr>
                                 <td style="width: 95%; text-align: left;">
                                     
                                    This is to certify that
                                    <strong style=" text-align: left;">MR./</strong>
                                   <strong style="text-decoration: underline; font-size:16px; text-align: left;">Mohamed Mahmoud Hassan Mahmoud El-Kashif.
                                   </strong>
                                   
                                 </td>
                              </tr>
                           </table>';

             $html = $html.'<table style="width: 100%; font-size: 15px; text-align: left;">
                              <tr>
                                 <td style="width: 100%; ">
                                  <strong> 
                                  Is a regular student at this Faculty, Fourth Year(Electrical Computers & System Section) 
                                  in the Academic year 2015/2016 <br/></strong>
                                  <strong style="width: 90%;text-align: left;"> The follow are the credit hours</strong>
                                 </td>
                              </tr>
                            </table>';

             $html =$html.'<table border="2" style="width: 100%; font-size: 14px; text-align: center; line-height: 100%; direction: ltr;">
                              <tr style="width: 100%">
                                <td width="20%">Course</td>
                                <td width="7.5%">Grade</td>                              
                                <td width="7.5%">point</td>
                                <td width="7.5%">credit Hours</td>
                                <td width="7.5%">Earned Point</td>
                                <td width="20%">Course</td>
                                <td width="7.5%">Grade</td>                              
                                <td width="7.5%">point</td>
                                <td width="7.5%">credit Hours</td>
                                <td width="7.5%">Earned Point</td>
                              </tr>
                              
                           </table>';
             // years
             $html = $html.'<table style="width: 50%; font-size: 13px; text-align: left;" border="1">
                             <tr>
                              <td style="width: 100%;">Preparatory Year:2009/2010</td>
                             </tr>
                           </table>';

             $html = $html.'<table style="width: 100%; font-size: 13px; text-align: left;" border="1" >
                               <tr style="width:100%; max-width: 100%;">
                                     <td style="width: 50%; display: block;">
                                       <table border="1" style="width: 100%;">
                                         <tr style="width: 100%;">
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                         </tr>
                                       </table>
                                     </td>
                                     <td style="width: 50%; display: inline-block;">
                                       <table border="1">
                                         <tr>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                         </tr>
                                       </table>
                                     </td>
                                     
                                      <td style="width: 50%; display: inline-block;">
                                       <table border="1">
                                         <tr>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                            <td>Mathematics(1)</td>
                                         </tr>
                                       </table>
                                     </td>
                                                                   
                                       
                               </tr>
                          
                              
                           </table>';






             break;
        }
        
        return $html;


    }


}
