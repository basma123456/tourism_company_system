 <table style="
    border:1px solid #ddd;
    padding:16px;
    margin-bottom:16px;
    font-family:Arial;
    width: 100%;
">
    <tr style="display:flex;align-items:center;gap:10px;">
        <th style="font-weight:bold; width: 40%">${lang.date}:</th>
        <th style="color:darkred;margin:0;">${data[0].inv_date}</th>
    </tr>

    <div style="margin-top:15px;">
        <tr style="display:flex;  ">
            <td style="width:200px;  width: 40%; background-color: rgba(173,216,230,0.31); border: 1px solid rgba(128,128,128,0.16); border-bottom:0; padding: 19px;">${lang.amount_before_tax}</td>
            <td style="margin: auto">${data[0].invoice_amount}</td>
        </tr>

        <tr style="display:flex; ">
            <td style="width:200px;  width: 40%; background-color: rgba(173,216,230,0.31); border: 1px solid rgba(128,128,128,0.16);  border-bottom:0; padding: 19px;">${lang.tax}</td>
            <td style="margin: auto">(14%) ${data[0].invoice_tax}</td>
        </tr>

        <tr style="display:flex;  ">
            <td style="width:200px;  width: 40%;  background-color: rgba(173,216,230,0.31); border: 1px solid rgba(128,128,128,0.16);  padding: 19px; ">${lang.amount}</td>
            <td style="margin: auto">${data[0].invoice_amount - data[0].invoice_tax}</td>
        </tr>
    </div>
</table>

 <div style="border:1px solid #ddd;padding:16px;font-family:Arial;">
    <table style="
    width:100%;
    border-collapse:collapse;
    text-align:left;
">
        <thead>
        <tr style="background:#f2f2f2;">
            <th style="border:1px solid #000;padding:6px;">${lang.id}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.ticket_no}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.traveller_name}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.from_city}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.to_city}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.amount}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.book_date}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.travel_date}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.airline}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.client}</th>
            <th style="border:1px solid #000;padding:6px;">${lang.notes}</th>
        </tr>
        </thead>
        <tbody>

         <tr>
            <td style="border:1px solid #000;padding:6px;">${item.id}</td>
            <td style="border:1px solid #000;padding:6px;">${item.ticket_no}</td>
            <td style="border:1px solid #000;padding:6px;">${item.traveller_name}</td>
            <td style="border:1px solid #000;padding:6px;">${item.from_city}</td>
            <td style="border:1px solid #000;padding:6px;">${item.to_city}</td>
            <td style="border:1px solid #000;padding:6px;">${item.final_amount}</td>
            <td style="border:1px solid #000;padding:6px;">${item.book_date}</td>
            <td style="border:1px solid #000;padding:6px;">${item.travel_date}</td>
            <td style="border:1px solid #000;padding:6px;">${item.airline_name}</td>
            <td style="border:1px solid #000;padding:6px;">${item.client_name}</td>
            <td style="border:1px solid #000;padding:6px;">
                <textarea style="width:100%;min-height:40px;">${item.notes}</textarea>
            </td>
        </tr>
         </tbody>
    </table>
</div>

