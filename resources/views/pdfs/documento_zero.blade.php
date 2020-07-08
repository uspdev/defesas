
@extends('pdfs.fflch')

TESTE

@section('content')
{{$agendamento->titulo}}

<table>
  <tr> 
    <td> 2 PRÉ-RELATÓRIOS </td> 
    <td>  (&nbsp;&nbsp;) </td> 
  </tr>
  <tr> 
    <td>ENVIO IMPRESSO ___/____   </td> 
    <td>  (&nbsp;&nbsp;)  </td> 
  </tr>
  <tr> 
    <td>  ENVIO PDF ___/____ </td> 
    <td>  (&nbsp;&nbsp; ) </td> 
  </tr>
  <tr> 
    <td>  SITE    </td> 
    <td>  (&nbsp;&nbsp;)  </td> 
  </tr>
  <tr> 
    <td>  PRÓ-LABORE </td> 
    <td>  (&nbsp;&nbsp; ) </td> 
  </tr>
</table>

@endsection('content')