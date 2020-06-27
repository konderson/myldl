<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
 
   
</head>
<body>

<table class="wp-block-table action"><tbody><tr><td>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
    <tr>
        <td>
            <h1>Пожайлуста подтвердите свою почту передя по ссылки</h1>
        </td>
    </tr>
<tr>
<td><a class="btn btn-info" style="color:blue" href="{{ $link }}" target="_blank" rel="noopener">Подтвердить</a></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

</body>
</html>