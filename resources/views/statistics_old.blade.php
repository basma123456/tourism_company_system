{{--generalReportForClubsAndWeapons--}}

@extends('admin.master')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .show_print{
            display: none;
        }

        .fs_10{
            font-size: 0.6rem
        }

        .pink_bg{
            background-color: #f1556c3b !important;
        }

        .pink_bg td{
            color:#bf1e2f !important;
        }
    </style>
    <div class="page-container my-4">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="page-container my-4">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <h4 class="header-title"> الاحصائيات </h4>
                </div>
                <div class="col-12 col-md-4 text-md-end text-center">


{{--                    <div class="">--}}

{{--                        <span title="اكسيل" onclick="exportDivToExcel('pr', 'final_report.xlsx')" target="_blank"--}}
{{--                              class="btn btn-sm btn-success  ">--}}
{{--                        <i class="ri-file-excel-line"></i>--}}
{{--                    </span>--}}


                        <span title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                    </div>
                </div>
            </div>


            <div class="card shadow-sm border-0">


                <div class="card-body">
                    <!--  -->
                    <div class="card border-success mb-3 rounded-3 overflow-hidden" id="pr">
                        <div class="show_print">
                            @include('print.table_header',['title'=>  " تقرير الإحصاء العام للأسلحة والنوادي"  ])
                        </div>

                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                تقرير الإحصاء العام للأسلحة والنوادي
                            </h5>
                        </div>
                        <div class="card-body">

                            <table class="table table-borderedr">
                                <thead>
                                <tr>
                                    <th>النادي</th>
                                    @foreach($generalReportForClubsAndWeapons->pluck('club_name')->unique() as $clubName)
                                        <th>{{ $clubName }}</th>
                                    @endforeach
                                </tr>
                                </thead>

                                <tbody>
                                <tr>

                                    <th style="background-color:  #f1556c3b">السلاح</th>
                                    <?php  $i = 0;  ?>
                                    @foreach($generalReportForClubsAndWeapons->pluck('club_name')->unique() as   $clubName)
                                        <?php   $i++;  ?>
                                        {{--                                        <th style="{{$i%2 == 0   ?   'background-color: #EFC3CA' :  'background-color:#E7DDFF'   }}">--}}
                                        <th style="{{$i%2 == 0   ?   'background-color: #f1556c3b' :  'background-color:#E3B0E7'   }}">
                                            <div class="row ">
                                                <div class="col-3 fw-bold fs_10 px-1 " style="width:25%;float:right;">المسجلين</div>
                                                <div
                                                    class="col-3 fw-bold fs_10   px-1 border   border-1 border-top-0  border-bottom-0 " style="width:25%;float:right;">
                                                    المفعلين
                                                </div>
                                                <div class="col-3 fw-bold fs_10   px-1  border   border-1 border-top-0  border-bottom-0" style="width:25%;float:right;">الرماه</div>

                                                <div class="col-3 fw-bold fs_10   px-1" style="width:25%;float:right;">المتأهلين</div>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>

                                @php
                                    $weapons = $generalReportForClubsAndWeapons->pluck('weapon_name', 'weapon_id')->unique();
                                @endphp

                                @foreach($weapons as $weaponId => $weaponName)
                                    <tr>
                                        <th class="{{$weaponName}}  fs-12">{{ $weaponName }}</th>
                                        @php  $i2 = 0;                                         @endphp



                                        @foreach($generalReportForClubsAndWeapons->pluck('club_name')->unique() as $clubName)

                                            @php
                                                $record = $generalReportForClubsAndWeapons
                                                    ->first(fn($r) => $r->weapon_id == $weaponId && $r->club_name == $clubName);
                                            $i2++;
                                            @endphp

                                            @if($record)
                                                <td style="{{$i2%2 == 0   ?   'background-color:white' :  ''   }}">
                                                    <div class="row">
                                                        <div style="width:25%;float:right;"
                                                            class="col-3 fw-bold text-primary px-1  {{'all_' .$record->club_id   }}">{{ $record->all_members_count }}</div>
                                                        <div style="width:25%;float:right;"
                                                            class="col-3 px-1   {{'active_' .$record->club_id   }}  ">{{ $record->active_members_count }}</div>
                                                        <div style="width:25%;float:right;"
                                                            class="col-3 px-1   {{ 'archers_' .$record->club_id }} ">{{ $record->archers }}</div>

                                                        <div style="width:25%;float:right;"
                                                            class="col-3 px-1   {{ 'qualified_' .$record->club_id }} ">{{ $record->qualified }}</div>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-muted"
                                                    style="{{$i2%2 == 0   ?   'background-color:white' :  ''   }}">—
                                                </td>
                                            @endif


                                        @endforeach
                                    </tr>
                                @endforeach

                                <tr class="pink_bg">
                                    <td>المجموع</td>
                                    @foreach($count_members_of_clubs as $key => $val)
                                        <td>
                                            <div class="d-flex  ">
                                                <div class=" fs-12 px-1 " style="width:25%;float:right;">
                                                    <div class="my_val_{{$val->cid}}  text-primary "></div>
                                                </div>
                                                <div class=" fs-12  px-1 " style="width:25%;float:right;">
                                                    <div class="my_active_{{$val->cid}} text-secondary"></div>
                                                </div>
                                                <div class=" fs-12  px-1 " style="width:25%;float:right;">
                                                    <div class="my_archers_{{$val->cid}} text-primary"></div>
                                                </div>

                                                <div class=" fs-12  px-1 " style="width:25%;float:right;">
                                                    <div class="my_qualified_{{$val->cid}} text-success"></div>
                                                </div>
                                            </div>


                                            <script>
                                                all_sum = 0;
                                                elements = document.querySelectorAll('.all_' + "{{$val->cid}}");
                                                elements.forEach(element => {
                                                    all_sum += parseInt(element.innerText);
                                                    console.log(element.innerText);
                                                });
                                                $('.my_val_' + "{{$val->cid}}")[0].innerText = all_sum;

                                                <!---------------------------------------------->
                                                active_sum = 0;
                                                elements2 = document.querySelectorAll('.active_' + "{{$val->cid}}");
                                                elements2.forEach(element => {
                                                    if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                        active_sum += parseInt(element.innerText);
                                                        console.log(element.innerText);
                                                    }
                                                });
                                                $('.my_active_' + "{{$val->cid}}")[0].innerText = active_sum;


                                                <!---------------------------------------------->
                                                archers_sum = 0;
                                                elementsarchers = document.querySelectorAll('.archers_' + "{{$val->cid}}");
                                                elementsarchers.forEach(element => {
                                                    if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                        archers_sum += parseInt(element.innerText);
                                                        console.log(element.innerText);
                                                    }
                                                });
                                                $('.my_archers_' + "{{$val->cid}}")[0].innerText = archers_sum;

                                                <!---------------------------------------------->
                                                qualified_sum = 0;
                                                elements3 = document.querySelectorAll('.qualified_' + "{{$val->cid}}");
                                                elements3.forEach(element => {
                                                    if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                        qualified_sum += parseInt(element.innerText);
                                                        console.log(element.innerText);
                                                    }
                                                });
                                                $('.my_qualified_' + "{{$val->cid}}")[0].innerText = qualified_sum;


                                            </script>

                                        </td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <br>
                    <br>


                    <span title="طباعة" onclick="printDiv('pr2')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                    <div class="card border-success mb-3 rounded-3 overflow-hidden" id="pr2">
                        <div class="show_print">
                            @include('print.table_header',['title'=>  " تقرير الأحصاء العام لمسلبقات الرماية السنوية - مسابقات الرماية الرابع عشر - 2025 "  ])
                        </div>

                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                تقرير الأحصاء العام لمسلبقات الرماية السنوية - مسابقات الرماية الرابع عشر - 2025 </h5>
                        </div>
                        <div class="card-body">

                            <table class="table table-borderedr">
                                <thead>
                                <tr>
                                    <th>النادي</th>
                                    <th>المسجلين</th>
                                    <th> المفعلين</th>
                                    <th>رماه</th>
                                    <th>المتأهلين</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($allCometetionsWithAllClubs as $club)
                                    <tr>
                                        <td>{{$club->club_name}}</td>

                                        <td class="competition_clubs_all">
                                            {{$club->all_members_count}}
                                        </td>

                                        <td class="competition_clubs_active">
                                            {{$club->active_members_count}}
                                        </td>
                                        <td class="competition_clubs_archers">
                                            {{$club->archers}}
                                        </td>

                                        <td class="competition_clubs_qualified">
                                            {{$club->qualified}}
                                        </td>

                                    </tr>
                                @endforeach
                                <tr class="pink_bg">
                                    <td>المجموع</td>
                                    <td class="compete_all"></td>
                                    <td class="compete_active"></td>
                                    <td class="compete_archers"></td>
                                    <td class="compete_qualified"></td>
                                    <script>
                                        compete_all = 0;
                                        compete_all_elements = document.querySelectorAll('.competition_clubs_all');
                                        compete_all_elements.forEach(element => {
                                            if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                compete_all += parseInt(element.innerText);
                                                console.log(element.innerText);
                                            }
                                        });
                                        $('.compete_all')[0].innerText = compete_all;

                                        <!---------------------------------------------->

                                        compete_active = 0;
                                        compete_active_elements = document.querySelectorAll('.competition_clubs_active');
                                        compete_active_elements.forEach(element => {
                                            if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                compete_active += parseInt(element.innerText);
                                                console.log(element.innerText);
                                            }
                                        });
                                        $('.compete_active')[0].innerText = compete_active;
                                        <!---------------------------------------------->

                                        compete_archers = 0;
                                        compete_archers_elements = document.querySelectorAll('.competition_clubs_archers');
                                        compete_archers_elements.forEach(element => {
                                            if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                compete_archers += parseInt(element.innerText);
                                                console.log(element.innerText);
                                            }
                                        });
                                        $('.compete_archers')[0].innerText = compete_archers;

                                        <!---------------------------------------------->

                                        compete_qualified = 0;
                                        compete_qualified_elements = document.querySelectorAll('.competition_clubs_qualified');
                                        compete_qualified_elements.forEach(element => {
                                            if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                compete_qualified += parseInt(element.innerText);
                                                console.log(element.innerText);
                                            }
                                        });
                                        $('.compete_qualified')[0].innerText = compete_qualified;

                                    </script>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <br>
                    <br>

                    <!--------weapons and teams -------------------------->
                    <span title="طباعة" onclick="printDiv('pr_weapons_teams')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                    <div class="card border-success mb-3 rounded-3 overflow-hidden" id="pr_weapons_teams">
                        <div class="show_print">
                            @include('print.table_header',['title'=>  " إحصائية فرق مسابقة إسقاط الصحون ليوم الاربعاء - مسابقات الرماية الرابع عشر - 2025"  ])
                        </div>


                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                إحصائية فرق مسابقة إسقاط الصحون ليوم الاربعاء - مسابقات الرماية الرابع عشر - 2025
                            </h5>
                        </div>
                        <div class="card-body">

                            <table class="table table-borderedr">
                                <thead>
                                <tr>
                                    <th>الفئة</th>
                                    <th>العمر من</th>
                                    <th>العمر الى</th>
                                    <th> عدد الفرق</th>
                                    <th> عدد المتسابقين</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($teams  as   $item)
                                    <tr>
                                        <td>
                                            {{$item->weapon_name}}
                                        </td>
                                        <td>{{$item->age_from ?? ''}}</td>
                                        <td>{{$item->age_to ?? '_'}}</td>

                                        <td class="teams_count">
                                            {{$item->teams_count}}
                                        </td>
                                        <td class="members_count">
                                            {{$item->members_count}}
                                        </td>
                                    </tr>

                                @endforeach

                                <tr class="pink_bg">
                                    <td>المجموع</td>
                                    <td>_</td>
                                    <td>_</td>
                                    <td class="teams_count_class"></td>
                                    <td class="members_count_class"></td>

                                </tr>
                                <script>
                                    teams_count_all = 0;
                                    teams_elements = document.querySelectorAll('.teams_count');
                                    teams_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            teams_count_all += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.teams_count_class')[0].innerText = teams_count_all;

                                    // <!--------------------------------------------->

                                    members_count_all = 0;
                                    members_count_elements = document.querySelectorAll('.members_count');
                                    members_count_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            members_count_all += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.members_count_class')[0].innerText = members_count_all;


                                </script>

                                </tbody>
                            </table>
                            <br>
                            <table class="table table-borderedr">
                                <thead>
                                <tr>
                                    <th>الفئة</th>
                                    <th> عدد الفرق</th>
                                    <th> عدد المتسابقين</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($teams_with_no_age  as   $item)
                                    <tr>
                                        <td>
                                            {{$item->weapon_name}}
                                        </td>
                                        <td class="teams_count_no_age">
                                            {{$item->teams_count}}
                                        </td>
                                        <td class="members_count_no_age">
                                            {{$item->members_count}}
                                        </td>
                                    </tr>

                                @endforeach
                                <tr class="pink_bg">
                                    <td>المجموع</td>
                                     <td class="teams_count_no_age_class"></td>
                                    <td class="members_count_no_age_class"></td>

                                </tr>
                                <script>
                                    teams_count_no_age = 0;
                                    teams_count_no_age_elements = document.querySelectorAll('.teams_count_no_age');
                                    teams_count_no_age_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            teams_count_no_age += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.teams_count_no_age_class')[0].innerText = teams_count_no_age;

                                    // <!--------------------------------------------->

                                    members_count_no_age = 0;
                                    members_count_no_age_elements = document.querySelectorAll('.members_count_no_age');
                                    members_count_no_age_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            members_count_no_age += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.members_count_no_age_class')[0].innerText = members_count_no_age;


                                </script>


                                </tbody>
                            </table>

                        </div>
                    </div>
                    <br>
                    <br>


                    <span title="طباعة" onclick="printDiv('pr_groups')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>
                    <div class="card border-success mb-3 rounded-3 overflow-hidden" id="pr_groups">

                        <div class="show_print">
                            @include('print.table_header',['title'=>   " كشف إحصاء المشاركين العسكريين فى مسابقات الرماية  - مسابقات الرماية الرابع عشر - 2025"  ])
                        </div>

                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                كشف إحصاء المشاركين العسكريين فى مسابقات الرماية  - مسابقات الرماية الرابع عشر - 2025
                            </h5>
                        </div>
                        <div class="card-body">

                            <table class="table table-borderedr">
                                <thead>
                                <tr>
                                    <th>الوحدة</th>
                                    <th>المسجلين</th>
                                    <th> رماه</th>
                                    <th>المتأهلين</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <th>{{$group->name}}</th>
                                        <td class="groups_all">
                                            {{$group->players_count}}
                                        </td>

                                        <td class="groups_un_qualified">
                                            {{$group->players_count}}
                                        </td>

                                        <td class="groups_qualified">
                                            {{$group->qualified_count}}
                                        </td>

                                    </tr>
                                @endforeach

                                <tr class="pink_bg">
                                    <td>المجموع</td>
                                    <td class="groups_all_total"></td>
                                    <td class="groups_un_qualified_total"></td>
                                    <td class="groups_qualified_total"></td>
                                </tr>


                                <script>
                                    groups_all = 0;
                                    groups_all_elements = document.querySelectorAll('.groups_all');
                                    groups_all_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            groups_all += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.groups_all_total')[0].innerText = groups_all;

                                    // <!--------------------------------------------->

                                    groups_un_qualified = 0;
                                    groups_un_qualified_elements = document.querySelectorAll('.groups_un_qualified');
                                    groups_un_qualified_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            groups_un_qualified += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.groups_un_qualified_total')[0].innerText = groups_un_qualified;


                                    // <!------------------------------------>
                                    groups_qualified = 0;
                                    groups_qualified_elements = document.querySelectorAll('.groups_qualified');
                                    groups_qualified_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            groups_qualified += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.groups_qualified_total')[0].innerText = groups_qualified;


                                </script>

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <br>
                    <br>


                    <span title="طباعة" onclick="printDiv('club_weapon')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                    <div id="club_weapon" class="card border-success mb-3 rounded-3 overflow-hidden">

                        <div class="show_print">
                            @include('print.table_header',['title'=>   " المشاركين في كل سلاح في نادي " ])
                        </div>


                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                المشاركين في كل سلاح في نادي </h5>
                        </div>
                        <div class="card-body">


                            <select class="form-control w-25" onchange="onClubChange(this)">
                                <option value="">
                                    اختر النادي ...
                                </option>
                                @foreach($clubs as $club)
                                    <option
                                        {{(int)request()->get('cid' ) == $club->cid ? "selected" : ''}} action-attr="{{route('statistics.index')   }}?cid={{$club->cid}}&#club_weapon"
                                        value="{{$club->cid}}">{{$club->name}}   </option>
                                @endforeach
                            </select>
                            <table class="table table-borderedr">
                                <thead>
                                <tr>
                                    <th>السلاح</th>
                                    <th>ذكور</th>
                                    <th> إناث</th>
                                    <th>إجمالي</th>

                                    <th>المتأهلين</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($weapons_partcicipents_for_club as $weapon)
                                    <tr>
                                        <th>{{$weapon->weapon_name}}</th>
                                        <td class="male_count_club_weapon">
                                            {{$weapon->male_count}}
                                        </td>

                                        <td class="female_count_club_weapon">
                                            {{$weapon->female_count}}
                                        </td>

                                        <td class="all_count_club_weapon">
                                            {{$weapon->members_count}}
                                        </td>
                                        <td class="qualified_count_club_weapon">
                                            {{$weapon->qualified_count}}

                                        </td>

                                    </tr>
                                @endforeach


                                <tr class="pink_bg">
                                    <td>المجموع</td>
                                    <td class="male_count_club_weapon_total"></td>
                                    <td class="female_count_club_weapon_total"></td>
                                    <td class="all_count_club_weapon_total"></td>
                                    <td class="qualified_count_club_weapon_total"></td>

                                </tr>


                                <script>
                                    male_count_club_weapon = 0;
                                    male_count_club_weapon_elements = document.querySelectorAll('.male_count_club_weapon');
                                    male_count_club_weapon_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            male_count_club_weapon += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.male_count_club_weapon_total')[0].innerText = male_count_club_weapon;

                                    // <!--------------------------------------------->

                                    female_count_club_weapon = 0;
                                    female_count_club_weapon_elements = document.querySelectorAll('.female_count_club_weapon');
                                    female_count_club_weapon_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            female_count_club_weapon += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.female_count_club_weapon_total')[0].innerText = female_count_club_weapon;


                                    // <!------------------------------------>
                                    all_count_club_weapon = 0;
                                    all_count_club_weapon_elements = document.querySelectorAll('.all_count_club_weapon');
                                    all_count_club_weapon_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            all_count_club_weapon += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.all_count_club_weapon_total')[0].innerText = all_count_club_weapon;

                                    // <!------------------------------------>
                                    qualified_count_club_weapon = 0;
                                    qualified_count_club_weapon_elements = document.querySelectorAll('.qualified_count_club_weapon');
                                    qualified_count_club_weapon_elements.forEach(element => {
                                        if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                            qualified_count_club_weapon += parseInt(element.innerText);
                                            console.log(element.innerText);
                                        }
                                    });
                                    $('.qualified_count_club_weapon_total')[0].innerText = qualified_count_club_weapon;


                                </script>


                                </tbody>
                            </table>
                        </div>
                        <script>
                            function onClubChange(obj) {
                                if (obj.value != '') {
                                    let url = (obj.options[obj.selectedIndex]).getAttribute('action-attr');
                                    if (url) {
                                        return window.location.href = url;
                                    } else {
                                        return window.location.href = "{{route('statistics.index')   }}?#club_weapon";
                                    }
                                }
                                return window.location.href = "{{route('statistics.index')   }}?#club_weapon";

                            }


                        </script>
                    </div>

                    <br>
                    <br>


                    <span title="طباعة" onclick="printDiv('pr_other_statistics')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                    <div class="card border-success mb-3 rounded-3 overflow-hidden" id="pr_other_statistics">
                        <div class="show_print">
                            @include('print.table_header',['title'=>    " احصائيات اخرى"])
                        </div>

                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                احصائيات اخرى
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-----------------start multiple tables ---->

                            <div class="row d-flex" style="justify-content: center">
                                {{-- first comtetitions and clubs--}}
                                <div class="col-md-3">
                                    <table class="table table-borderedr">
                                        <thead>
                                        <tr>
                                            <th colspan="2">الاندية و المسابقات</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr style="background-color:  #f1556c3b !important;">
                                            <td class="text-primary">اسم النادي</td>
                                            <td class="text-primary">عدد المسابقات</td>
                                        </tr>
                                            @foreach($clubs_weapons as $club)
                                                <tr>
                                                <th>{{$club->name}}</th>
                                                <td>{{$club->weapons_count}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{--second number of participants in each club--}}
                                <div class="col-md-4">
                                    <table class="table table-borderedr">
                                        <thead>
                                        <tr>
                                            <th colspan="4">عدد المشاركين في كل نادي</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr style="background-color:  #f1556c3b !important;">
                                            <td class="text-primary">اسم النادي</td>
                                            <td class="text-primary">عدد المسابقات</td>
                                            <td class="text-primary">عدد المسابقات</td>
                                            <td class="text-primary">عدد المسابقات</td>

                                        </tr>
                                        @foreach($numberOfParticipantsPerClub as $item)
                                            <tr>
                                                <th>{{$item->club_name}}</th>
                                                <td class="num_participants_female_count">{{$item->female_count}}</td>
                                                <td class="num_participants_male_count">{{$item->male_count}}</td>
                                                <td class="num_participants_all_count">{{$item->female_count + $item->male_count}}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="pink_bg">
                                            <td>
                                                المجموع
                                            </td>
                                            <td class="num_participants_female_count_total"></td>
                                            <td class="num_participants_male_count_total"></td>
                                            <td class="num_participants_all_count_total"></td>

                                        </tr>


                                        <script>
                                            num_participants_female_count = 0;
                                            num_participants_female_count_elements = document.querySelectorAll('.num_participants_female_count');
                                            num_participants_female_count_elements.forEach(element => {
                                                if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                    num_participants_female_count += parseInt(element.innerText);
                                                    console.log(element.innerText);
                                                }
                                            });
                                            $('.num_participants_female_count_total')[0].innerText = num_participants_female_count;

                                            // <!--------------------------------------------->
                                            num_participants_male_count = 0;
                                            num_participants_male_count_elements = document.querySelectorAll('.num_participants_male_count');
                                            num_participants_male_count_elements.forEach(element => {
                                                if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                    num_participants_male_count += parseInt(element.innerText);
                                                    console.log(element.innerText);
                                                }
                                            });
                                            $('.num_participants_male_count_total')[0].innerText = num_participants_male_count;

                                            // <!--------------------------------------------->
                                            num_participants_all_count = 0;
                                            num_participants_all_count_elements = document.querySelectorAll('.num_participants_all_count');
                                            num_participants_all_count_elements.forEach(element => {
                                                if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                    num_participants_all_count += parseInt(element.innerText);
                                                    console.log(element.innerText);
                                                }
                                            });
                                            $('.num_participants_all_count_total')[0].innerText = num_participants_all_count;


                                        </script>
                                        </tbody>
                                    </table>
                                </div>


                                {{--third places of regiteration--}}
                                <div class="col-md-4">
                                    <table class="table table-borderedr ">
                                        <thead>
                                        <tr>
                                            <th colspan="4">اماكن التسجيل</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr style="background-color:  #f1556c3b !important;">
                                            <td class="text-primary">اسم النادي</td>
                                            <td class="text-primary">عدد المسابقات</td>
                                            <td class="text-primary">عدد المسابقات</td>
                                            <td class="text-primary">عدد المسابقات</td>

                                        </tr>
                                        @foreach($registerPlaces as $item)
                                            <tr>
                                                <th>{{$item->club_name}}</th>
                                                <td class="register_places_female_count">{{$item->female_count}}</td>
                                                <td class="register_places_male_count">{{$item->male_count}}</td>
                                                <td class="register_places_all_count">{{$item->female_count + $item->male_count}}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="pink_bg">
                                            <td>المجموع</td>
                                            <td class="register_places_female_count_total"></td>
                                            <td class="register_places_male_count_total"></td>
                                            <td class="register_places_all_count_total"></td>

                                        </tr>


                                        <script>
                                            register_places_female_count = 0;
                                            register_places_female_count_elements = document.querySelectorAll('.register_places_female_count');
                                            register_places_female_count_elements.forEach(element => {
                                                if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                    register_places_female_count += parseInt(element.innerText);
                                                    console.log(element.innerText);
                                                }
                                            });
                                            $('.register_places_female_count_total')[0].innerText = register_places_female_count;

                                            // <!--------------------------------------------->
                                            register_places_male_count = 0;
                                            register_places_male_count_elements = document.querySelectorAll('.register_places_male_count');
                                            register_places_male_count_elements.forEach(element => {
                                                if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                    register_places_male_count += parseInt(element.innerText);
                                                    console.log(element.innerText);
                                                }
                                            });
                                            $('.register_places_male_count_total')[0].innerText = register_places_male_count;

                                            // <!--------------------------------------------->
                                            register_places_all_count = 0;
                                            register_places_all_count_elements = document.querySelectorAll('.register_places_all_count');
                                            register_places_all_count_elements.forEach(element => {
                                                if (!isNaN(element.innerText) && element.innerText !== '' && element.innerText !== '_') {
                                                    register_places_all_count += parseInt(element.innerText);
                                                    console.log(element.innerText);
                                                }
                                            });
                                            $('.register_places_all_count_total')[0].innerText = register_places_all_count;


                                        </script>

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="row m-auto d-flex" style="justify-content: center">
                                <div class=" col-md-6">
                                    {{--fourth other statistics--}}
                                    <table class="table table-borderedr">
                                        <thead>
                                        <tr>
                                            <th colspan="2">احصائيات اخري</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr>
                                            <th>اجمالي المفعلين</th>
                                            <td>{{$allActiveMembers}}</td>
                                        </tr>
                                        <tr>
                                            <th>اجمالي الغير مفعلين</th>
                                            <td>{{$allDeActiveMembers}}</td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-----------------end multiple tables ---->

                    </div>


                    <br>
                    <br>


                    <span title="طباعة" onclick="printDiv('pr_min_max_statistics')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                    <div class="card border-success mb-3 rounded-3 overflow-hidden" id="pr_min_max_statistics">
                        <div class="show_print">
                            @include('print.table_header',['title'=>     "  أحصائية أكبر و اصغر رامى فى كل سلاح "])
                        </div>

                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                أحصائية أكبر و اصغر رامى فى كل سلاح </h5>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <table class="table table-borderedr">
                                        <thead>
                                        <tr>
                                            <th colspan="5"> بيانات أكبر رامى ذكور</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr style="background-color:  #f1556c3b !important;">
                                            <td class="text-primary">الاسم</td>
                                            <td class="text-primary">السلاح</td>
                                            <td class="text-primary">رقم الهوية</td>
                                            <td class="text-primary">رقم الهاتف</td>
                                            <td class="text-primary">العمر</td>

                                        </tr>
                                        <tr>
                                            <th>{{optional($ageDetails['oldestMemberMale'])->name}} </th>
                                            <td>{{optional($ageDetails['oldestMemberMale'])->weapon->name}}</td>
                                            <td>{{optional($ageDetails['oldestMemberMale'])->ID}} </td>
                                            <td>{{optional($ageDetails['oldestMemberMale'])->phone1}}</td>
                                            <td>{{optional($ageDetails['oldestMemberMale'])->age_calculation()}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>


                                <div class="col-md-6">
                                    <table class="table table-borderedr ">
                                        <thead>
                                        <tr>
                                            <th colspan="5">بيانات أصغر رامى ذكور

                                            </th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr style="background-color:  #f1556c3b !important;">
                                            <td class="text-primary">الاسم</td>
                                            <td class="text-primary">السلاح</td>
                                            <td class="text-primary">رقم الهوية</td>
                                            <td class="text-primary">رقم الهاتف</td>
                                            <td class="text-primary">العمر</td>

                                        </tr>
                                        <tr>
                                            <th>{{optional($ageDetails['youngerMemberMale'])->name}} </th>
                                            <td>{{optional($ageDetails['youngerMemberMale'])->weapon->name}}</td>
                                            <td>{{optional($ageDetails['youngerMemberMale'])->ID}} </td>
                                            <td>{{optional($ageDetails['youngerMemberMale'])->phone1}}</td>
                                            <td>{{optional($ageDetails['youngerMemberMale'])->age_calculation()}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderedr">
                                        <thead>
                                        <tr>
                                            <th colspan="5">بيانات أكبر رامى أناث</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr style="background-color:  #f1556c3b !important;">
                                            <td class="text-primary">الاسم</td>
                                            <td class="text-primary">السلاح</td>
                                            <td class="text-primary">رقم الهوية</td>
                                            <td class="text-primary">رقم الهاتف</td>
                                            <td class="text-primary">العمر</td>

                                        </tr>
                                        <tr>
                                            <th>{{optional($ageDetails['oldestMemberFemale'])->name}} </th>
                                            <td>{{optional($ageDetails['oldestMemberFemale'])->weapon?->name}}</td>
                                            <td>{{optional($ageDetails['oldestMemberFemale'])->ID}} </td>
                                            <td>{{optional($ageDetails['oldestMemberFemale'])->phone1}}</td>
                                            <td>{{optional($ageDetails['oldestMemberFemale'])->age_calculation()}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderedr ">
                                        <thead>
                                        <tr>
                                            <th colspan="5">بيانات أصغر رامى أناث</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        <tr style="background-color:  #f1556c3b !important;">
                                            <td class="text-primary">الاسم</td>
                                            <td class="text-primary">السلاح</td>
                                            <td class="text-primary">رقم الهوية</td>
                                            <td class="text-primary">رقم الهاتف</td>
                                            <td class="text-primary">العمر</td>

                                        </tr>
                                        <tr>
                                            <th>{{optional($ageDetails['youngerMemberFemale'])->name}} </th>
                                            <td>{{optional($ageDetails['youngerMemberFemale'])->weapon?->name}}</td>
                                            <td>{{optional($ageDetails['youngerMemberFemale'])->ID}} </td>
                                            <td>{{optional($ageDetails['youngerMemberFemale'])->phone1}}</td>
                                            <td>{{optional($ageDetails['youngerMemberFemale'])->age_calculation()}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <br>
                <br>


            </div>
        </div>
        <div class="mt-4 d-flex justify-content-center">

        </div>

    </div>
    </div>
    </div>

    </div>
    <script>
        function countClubAll($id) {

        }
    </script>

@endsection
