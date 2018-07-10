<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB ;

use App\Http\Requests;

class student extends Controller
{

    function index( Request $request){

        $code = $request->get('code');

      $students = DB::table('students')
            ->join('student_status_latest', 'students.code', '=','student_status_latest.code')
            ->join("d_student_total" ,"students.code", "=", "d_student_total.code")
            ->leftJoin('main_spec','student_status_latest.main_spec', '=','main_spec.id')
            ->leftJoin('minor_spec','student_status_latest.minor_spec', '=','minor_spec.id')
            ->leftJoin('year', 'student_status_latest.year', '=','year.id')
            ->leftJoin('d_term', 'student_status_latest.term', '=','d_term.id')
            ->leftJoin('country', 'students.birthcountry', '=','country.code')
            ->leftJoin("general_grade", "d_student_total.grade", "=", "general_grade.id")
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
                'd_term.desc', "d_student_total.term", "d_term.name AS DTname", "d_term.ename AS DTename", "d_term.desc", "d_student_total.total",
                "d_student_total.total_f", "d_student_total.grade", "general_grade.name AS Gname", "general_grade.ename AS Gename","d_student_total.proj_grade")
            ->where('students.code','=',"".$code)->get();

             $student_Ginfo = DB::select(DB::raw('SELECT
                                                        YEAR.name AS yname,
                                                        d_student_status.code,
                                                        d_term.name AS DTname,
                                                        student_status_index.name AS SSname,
                                                        d_student_status.sum,
                                                        d_student_status.bn,
                                                        grade_id.name AS Gname,
                                                        d_student_status.year,
                                                        d_student_status.term
                                                    FROM
                                                        d_student_total
                                                    LEFT JOIN d_student_status ON d_student_status.code = d_student_total.code
                                                    LEFT JOIN YEAR ON d_student_status.year = YEAR.id
                                                    LEFT JOIN student_status_index ON student_status_index.id = d_student_status.student_status
                                                    LEFT JOIN d_term ON d_term.id = d_student_status.term
                                                    LEFT JOIN grade_id ON grade_id.id = d_student_status.grade
                                                    WHERE
                                                        d_student_status.code = "'.$code.'"
                                                    ORDER BY
                                                         d_student_status.bn,d_term.name '));
             $student_year_info = DB::select(DB::raw('
                                               SELECT
                                                    course_inf.dept,
                                                    course_inf.code,
                                                    course_inf.name AS cname,
                                                    course_inf_e.name AS elname,
                                                    d_student_course.grade,
                                                    grade_id.name AS gname
                                                FROM
                                                    (
                                                        (
                                                            course_inf
                                                        LEFT JOIN d_student_course ON(
                                                                course_inf.code = d_student_course.course_code
                                                            ) AND(
                                                                course_inf.dept = d_student_course.dept
                                                            )
                                                        )
                                                    LEFT JOIN grade_id ON d_student_course.grade = grade_id.id
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
                                                    d_student_course.code = "'.$code.'" 
             '));
//
             //dump($student_year_info);
             //die();

        return view('Profile',['students'=>$students[0],'student_Ginfo'=>$student_Ginfo,'student_year_info'=>$student_year_info]);
    }
}
