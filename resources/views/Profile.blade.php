<?php use Illuminate\Support\Facades\DB; ?>

@extends('layouts.profileLayout')
@section('content')

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>
          Student Profile
        </h2>
      </div>
      <div class="row clearfix">
        <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                Student Data List
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
                      <table class="table table-striped" style="direction: rtl">
                        <tbody>
                        <tr>
                          <th>الاسم : </th>
                          <td>{{$students->name}}</td>
                          <th>التقدير:</th>
                          <td>{{$students->Gname}}</td>
                          <th>الرقم القومى:</th>
                          <td>{{$students->nationalid}}</td>
                        </tr>
                        <tr>
                          <th>التخصص:</th>
                          <td>{{$students->MSname}}</td>
                          <th>الشعبة:</th>
                          <td>{{$students->name2}}</td>
                          <th>اخر فصل دراسى:</th>
                          <td>{{$students->DTname}} </td>
                        </tr>
                        <tr>
                          <th>محل الميلاد:</th>
                          <td>{{$students->ciname .'/'. $students->coname}}</td>
                          <th>تاريخ الميلاد:</th>
                          <td>{{$students->birthdate}}</td>
                          <th>مجموع الثانوية العامة:</th>
                          <td></td>
                        </tr>
                        <tr>
                          <th>العنوان:</th>
                          <td></td>
                          <th>حالة التجنيد:</th>
                          <td></td>
                          <th>رقم التليفون:</th>
                          <td>{{$students->militarystatus}}</td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
          {{--{{  (file_exists("photo/photos/".$student_Ginfo[0]->code)) }}--}}
          {{--<img src="photo/photos/{{$student_Ginfo[0]->code}}.jpg"--}}
               {{--class="img-responsive img-thumbnail"--}}
               {{--alt="user-image" style="width: 100%; height: 265px">--}}



            <img src="photo/photos/0000026.jpg"
               class="img-responsive img-thumbnail"
               alt="user-image" style="width: 100%; height: 265px">


        </div>
             </div>
      <!-- Select -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                Certificates
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="row clearfix" dir="rtl">
                <div class="col-sm-12">
                  <form class="form-horizontal" method="POST" action= "{{ url('/certificate')}}" >
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$student_Ginfo[0]->code}}" name="code">
                      <select class="show-tick form-group" name="certificate">
                        <option value=""> اختار الشهادة </option>
                        <option value="1">شهادة قيد</option>
                        <option value="2">شهادة سفر</option>
                        <option value="3">شهادة تخرج</option>
                        <option value="4">تقديرات طالب</option>
                        <option value="5">تقديرات خريج</option>
                        <option value="6">test</option>
                        <option value="7">test2</option>
                        <option value="8">test3</option>
                        <option value="9">test4</option>
                        <option value="10">test5</option>
                        <option value="11">test6</option>
                      </select>
                    <div class="row clearfix">
                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" id="email_address_2" class="form-control" name="applyto">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="email_address_2">ليقدم الى </label>
                      </div>
                    </div>
                    <div class="row clearfix">
                      <div class="col-sm-4">
                       <div class="form-group">
                        <div class="form-line">
                          <input type="text" class="datepicker form-control" placeholder="من فضلك ادخل التاريخ" data-dtp="dtp_Lqjv7" name="to">
                        </div>
                      </div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label>الى </label>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" class="datepicker form-control" placeholder="من فضلك ادخل التاريخ" data-dtp="dtp_Lqjv7" name="from">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label > من </label>
                      </div>
                    </div>
                    <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" style="padding: 11px 41px; margin-right:27px; font-size: 18px;">
                          الحصول على الشهادة
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- #END# Select -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card" >
            <div class="header">
              <h2>
                Student Data List
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
                 <table id="simple-table" class="table  table-bordered table-hover" style="direction: rtl;">
                   <thead>
                   <tr>
                     <th class="detail-col">لتفاصيل</th>
                     <th>الفرقة</th>
                     <th>التقدير</th>
                     <th class="hidden-480">المجموع</th>
                     <th>العام الدراسى</th>
                     <th>رقم الجلوس</th>
                     <th class="hidden-480">الحالة</th>
                   </tr>
                   </thead>

                   <tbody>
                   @foreach( $student_Ginfo as $info)
                   <tr>
                     <td class="center">
                       <div class="action-buttons">
                         <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                           <i class="ace-icon fa fa-angle-double-down" style="font-size: 24px;position: relative;right:35px;"></i>
                           <span class="sr-only">التفاصيل</span>
                         </a>
                       </div>
                     </td>

                     <td>{{$info->yname}}</td>
                     <td>{{$info->Gname}}</td>
                     <td class="hidden-480">{{$info->sum}}</td>
                     <td>{{$info->DTname}}</td>
                     <td>{{$info->bn}}</td>
                     <td>{{$info->SSname}}</td>

                   <?php  $student_year_info = DB::select(DB::raw('
                                               SELECT
                                                    CONCAT(department.code ,course_inf.code) AS courseCode,
                                                    course_inf.name AS cname,
                                                    grade_id.name AS gname,
                                                    course_state.name AS state,
                                                    course_inf.max_total,
                                                    d_student_course.total,
                                                    control_action.abr AS caction,
                                                    control_action.name AS note
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
                                                    d_student_course.code = "'.$info->code.'" AND d_student_course.year = '.$info->year.'
                                                    AND d_student_course.term = '.$info->term.'
             ')) ?>

                   <tr class="detail-row open">
                     <td colspan="8">
                       <div class="table-detail">
                         <div class="row">

                           <div class="col-xs-12">

                             <table class="table  table-bordered ">
                               <thead>
                               <tr>
                                 <th>كود المادة</th>
                                 <th>اسم المادة</th>
                                 <th>الحالة</th>
                                 <th>الدرجة</th>
                                 <th>النهاية العظمى</th>
                                 <th>التقدير</th>
                                 <th>علامات الكنترول</th>
                                 <th>الملاحظات</th>
                                 <th>الملاحظات</th>
                               </tr>
                               </thead>

                               <tbody>
                               @foreach($student_year_info as $courseInfo)
                               <tr>
                                 <td>{{$courseInfo->courseCode}}</td>
                                 <td>{{$courseInfo->cname}}</td>
                                 <td>{{$courseInfo->state}}</td>
                                 <td>{{$courseInfo->total}}</td>
                                 <td>{{$courseInfo->max_total}}</td>
                                 <td>{{$courseInfo->gname}}</td>
                                 <td>{{$courseInfo->caction}}</td>
                                 <td>{{$courseInfo->note}}</td>
                                 <td>حالة عادية</td>
                               </tr>
                               @endforeach

                            </tbody>
                      </table>

                           </div>

                         </div>
                       </div>
                     </td>
                   </tr>

             @endforeach
                   </tbody>
                 </table>
               </div>
          </div>
        </div>
    </div>
    </div>
  </section>

   @endsection

