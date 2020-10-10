@if (substr($data["message"], 0, 5) == "Error")
    <div class="alert alert-danger alert-block">
@elseif (substr($data["message"], 0, 5) == "Exito")
    <div class="alert alert-success alert-block">
@else 
    <div class="alert alert-warning alert-block">
@endif
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $data["message"] }}</strong>
    </div>