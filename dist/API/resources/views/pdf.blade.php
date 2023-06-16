<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $formName }}</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css')}}">
</head>
<body onload="window.print()">
    <div class="container">
        <!--<div class="logo">-->
        <!--    <img src="{{ asset('public/img/logo.png') }}" alt="logo">-->
        <!--</div>-->
        <div class="company">
            <img src="{{ asset('public/img/logo.png')}}" alt="company">
        </div>
        <center>
            <h1>{{ $formName }}</h1>
            
            <div class="data-table">
                <table>
                    <tbody>
                        <tr>
                            <td>الوحدات التنفيذية -خدمات الحج
                                رقم ({{ $unit->unit_number }})
                            </td>
                            <td>
                                الجنسية: {{ $unit->nationality }}
                            </td>
                            <td>
                                عدد الحجاج:{{ $unit->pilgrims }}
                            </td>
                        </tr>
                        <tr>
                            <td>المفتش: {{ $user }}
                            </td>
                            <td>
                                رقم العمارة:{{ $unit->building_number }}
                            </td>
                            <td>
                                رقم التصريح:{{ $unit->permissions }}
                            </td>
                        </tr>
                        <tr>
                            <td>اليوم:{{ $day }}
                            </td>
                            <td>
                                الموافق:{{ $unit->created_at->format('y-m-d') }}
                            </td>
                            <td>
                                الساعة:{{ $unit->created_at->format('h-m') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>

            <div class="question">
                <table>
                    <thead style="background-color:#dfdfdf;">
                        <tr>
                            <th style="width: 30px">م</th>
                            <th style="width: 600px">العنصر</th>
                            <th style="width: 100px">الاجابة</th>
                            <th style="width: 480px">ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item['question'] }}</td>
                            <td>{{ $item['answer'] }}</td>
                            <td>{{ $item['notes'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </center>
    </div>

</body>
</html>