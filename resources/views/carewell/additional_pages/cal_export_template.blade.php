<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Export Data</title>
    </head>
    <body>
        <h2>MERCHANT LIST</h2>
        <table>
            <tr>
                <td>Due Before 5-4 Days</td>
                <td style="background-color: #a200ff;"></td>
            </tr>
            <tr>
                <td>Due Before 3 Days</td>
                <td style="background-color: #22baa0;"></td>
            </tr>
            <tr>
                <td>Due Before 2-1-0 Days</td>
                <td style="background-color: #ff0000;"></td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th style="width:25px;">COMPANY</th>
                    <th style="width:25px;">CAL NUMBER</th>
                    <th style="width:25px;">CAREWELL ID</th>
                    <th style="width:25px;">MEMBER FIRST NAME</th>
                    <th style="width:25px;">MEMBER MIDDLE NAME</th>
                    <th style="width:25px;">MEMBER LAST NAME</th>
                    <th style="width:25px;">AMOUNT</th>
                    <th style="width:25px;">MEMBER STATUS</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($_member as $member)
                <tr>
                    <td>
                        {{$member->company_name}}
                    </td>
                    <td>{{$member->cal_number}}</td>
                    <td>{{$member->member_company_carewell_id}}</td>
                    <td>
                        {{$member->member_first_name}}
                    </td>
                    <td>{{$member->member_middle_name}}</td>
                    <td>{{$member->member_last_name}}</td>
                    <td>STATUS</td>

                    
                    <td style="color: #a200ff;text-decoration: underline;">
                        STATUS
                    </td> 
                </tr>
                @endforeach
                
            </tbody>
        </table>
        
    </body>
</html>