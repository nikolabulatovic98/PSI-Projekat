<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="\css\design4.css">
      <link rel="stylesheet" href="\css\style.css">
</head>
<body>
    <form action="<?= site_url("Gost/pronadji_idealno") ?>" method="POST">
    <table class="mytable" align="center">
           <tr>
            <td class="pitanje">
                Koliko imate godina?
            </td>
           </tr>
            <tr>
                <td>
                    <label class="container1">do 18
                        <input type="radio" checked="checked" name="radio1" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container1">18 - 35
                        <input type="radio" name="radio1" value="2">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container1">35 - 55
                        <input type="radio" name="radio1" value="3">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container1">55+
                        <input type="radio" name="radio1" value="4">
                        <span class="checkmark"></span>
                    </label>
                    <hr>
                </td>
            </tr>
           <tr>
               <td class="pitanje">
                   Sa kim biste želeli da putujete ?
               </td>
           </tr>
           <tr>
               <td>
                <label class="container1">Porodica
                    <input type="radio" checked="checked" name="radio"  value="Porodica"  >
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Voljena osoba
                    <input type="radio" name="radio" value="Voljena osoba">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Društvo
                    <input type="radio" name="radio" value="Društvo">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Poslovno putovanje
                    <input type="radio" name="radio" value="Poslovno">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Solo putovanje
                      <input type="radio" name="radio" value="Solo putovanje">
                      <span class="checkmark"></span>
                </label>
                <hr>
               </td>
           </tr>
            <tr>
                <td class="pitanje">
                    Šta Vam je prioritet na ovom putovanju?
                </td>
            </tr>
            <tr>
                <td>
                <label class="container1">Razgledanje znamenitosti
                    <input type="radio" checked="checked" name="radio2" value="Gradovi Evrope">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Egzoticne destinacije i upoznavanje sa novim kulturama
                    <input type="radio" name="radio2" value="Daleke">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Odmor i priroda
                    <input type="radio" name="radio2" value="Izleti">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">More i nightlife
                    <input type="radio" name="radio2" value="Letovanje">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Skijanje, planinarenje i druge aktivnosti
                    <input type="radio" name="radio2" value="Zimovanje">
                    <span class="checkmark"></span>
                </label>
                <hr>
                </td>
            </tr>
            <tr>
                <td class="pitanje">
                    Koliko dugo želite da ostanete?
                </td>
            </tr>
            <tr>
                <td>
                <label class="container1">Vikend
                    <input type="radio" checked="checked" name="radio3" value="1">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Nedelju dana
                    <input type="radio" name="radio3" value="5">
                    <span class="checkmark"></span>
                </label>
                <label class="container1">Duže
                    <input type="radio" name="radio3" value="7">
                    <span class="checkmark"></span>
                </label>
                <hr>
                </td>
            </tr>
            <tr>
                <td>
                <button class="button" type="submit">Pronadji putovanje</button>
                </td>
            </tr>
    </table>
        </form>
</body>
</html>

