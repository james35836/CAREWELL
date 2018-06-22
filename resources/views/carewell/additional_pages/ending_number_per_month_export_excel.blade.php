<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="assets/css/export_excel.css">
    
  </head>
  <body>
    <table>
      <tr>
        <th colspan="15">ENDING NUMBER PER MONTH</th>
      </tr>
      <tr>
        <th colspan="15">{{$date}}</th>
      </tr>
      <tr>
        <th>COMPANY</th>
        <th>PREM</th>
        <th>DATE ACQUIRED</th>
        <th>JANUARY</th>
        <th>FEBRUARY</th>
        <th>MARCH</th>
        <th>APRIL</th>
        <th>MAY</th>
        <th>JUNE</th>
        <th>JULY</th>
        <th>AUGUST</th>
        <th>SEPTEMBER</th>
        <th>OCTOBER</th>
        <th>NOVEMBER</th>
        <th>DECEMBER</th>
      </tr>
      @foreach($_company as $company)
      <tr>
        <td>{{$company->company_name}}</td>
        <td>{{$company->coverage_plan_premium}}</td>
        <td>{{substr($company->company_created,0,10)}}</td>
        <td>{{$company->count_jan}}</td>
        <td>{{$company->count_feb}}</td>
        <td>{{$company->count_mar}}</td>
        <td>{{$company->count_apr}}</td>
        <td>{{$company->count_may}}</td>
        <td>{{$company->count_jun}}</td>
        <td>{{$company->count_jul}}</td>
        <td>{{$company->count_aug}}</td>
        <td>{{$company->count_sep}}</td>
        <td>{{$company->count_oct}}</td>
        <td>{{$company->count_nov}}</td>
        <td>{{$company->count_dec}}</td>
      </tr>
      @endforeach
      <tr>
        <td>TOTAL</td>
        <td></td>
        <td></td>
        <td>{{$_company[0]->count_jan_total}}</td>
        <td>{{$_company[0]->count_feb_total}}</td>
        <td>{{$_company[0]->count_mar_total}}</td>
        <td>{{$_company[0]->count_apr_total}}</td>
        <td>{{$_company[0]->count_may_total}}</td>
        <td>{{$_company[0]->count_jun_total}}</td>
        <td>{{$_company[0]->count_jul_total}}</td>
        <td>{{$_company[0]->count_aug_total}}</td>
        <td>{{$_company[0]->count_sep_total}}</td>
        <td>{{$_company[0]->count_oct_total}}</td>
        <td>{{$_company[0]->count_nov_total}}</td>
        <td>{{$_company[0]->count_dec_total}}</td>
      </tr>
    </table>
  </body>